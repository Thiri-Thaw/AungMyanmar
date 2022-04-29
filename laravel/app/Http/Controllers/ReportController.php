<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function Create()
    {
        // dd(request()->fromdate);
        if (isset(request()->search)) {
            $fromdate =  Carbon::parse(request()->fromdate)->format('Y-m-d');
            $todate =  Carbon::parse(request()->todate . '23:59:59')->format('Y-m-d H:m:s');
            $purchases = Purchase::whereBetween('date', [$fromdate, $todate])
                ->where('enable', 1)
                ->get();

            $sales = Sale::whereBetween('sale_date', [$fromdate, $todate])
                ->where('enable', 1)
                ->get();
            $accounts = Account::whereBetween('enroll_date', [$fromdate, $todate])
                ->where('enable', 1)
                ->get();
            // $types = Type::whereBetween('date', [$fromdate, $todate])
            //     ->where('enable', 1)
            //     ->get();
        } else {
            $purchases = Purchase::where('enable', 1)->get();
            $sales = Sale::where('enable', 1)->get();
            $accounts = Account::where('enable', 1)->get();
        }
        // dd($fromdate, $todate);
        $types = Type::where('enable', 1)->get();
        $p_sub_total = 0;
        $s_sub_total = 0;
        $p_net_total = 0;
        $s_net_total = 0;
        $income = 0;
        $expand = 0;
        $purchase_total = 0;
        $sale_total = 0;
        $p_tax = 0;
        $s_tax = 0;
        $p_discount = 0;
        $s_discount = 0;
        foreach ($purchases as $purchase) {
            $p_sub_total = 0;
            foreach ($purchase->purchase_items as $purchase_item) {
                $p_sub_total += $purchase_item->price * $purchase_item->quantity;
                $purchase_total += $purchase_item->price * $purchase_item->quantity;
            }
            // $purchase_total = $p_sub_total;
            $p_tax += ($purchase->tax * $p_sub_total) / 100;
            $p_discount += ($purchase->discount * $p_sub_total) / 100;
            // $p_sub_total -= ($purchase->discount * $p_sub_total) / 100 + ($purchase->tax * $p_sub_total) / 100;
        }
        foreach ($sales as $sale) {
            $s_sub_total = 0;
            foreach ($sale->saledetail as $sale_detail) {
                $s_sub_total += $sale_detail->sale_price * $sale_detail->quantity;
                $sale_total += $sale_detail->sale_price * $sale_detail->quantity;
            }
            // $sale_net = $s_sub_total;
            $s_tax += ($sale->tax * $s_sub_total) / 100;
            $s_discount += ($sale->discount * $s_sub_total) / 100;
            // $s_sub_total -= ($sale->discount * $s_sub_total) / 100 + ($sale->tax * $s_sub_total) / 100;
        }
        foreach ($accounts as $account) {
            if ($account->type->status == 'income') {
                $income += $account->amount;
            } else {
                $expand += $account->amount;
            }
        }
        $p_net_total += $p_sub_total;
        $s_net_total += $s_sub_total;
        // dd($p_net_total);
        // dd($p_net_total, $s_net_total, $income, $expand);
        return view('reports.create', [
            'p_net_total' => $p_net_total,
            's_net_total' => $s_net_total,
            'income' => $income,
            'expand' => $expand,
            'sale_net' => $sale_total,
            'purchase_net' => $purchase_total,
            'p_tax' => $p_tax,
            's_tax' => $s_tax,
            'p_discount' => $p_discount,
            's_discount' => $s_discount,
            'purchases' => $purchases,
            'sales' => $sales,
            'accounts' => $accounts,
            'types' => $types,
        ]);
    }
}
