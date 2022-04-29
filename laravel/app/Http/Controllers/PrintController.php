<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Models\Sale_Detail;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function PrintPurchaseList($id)
    {
        $purchases = Purchase::where('voucher_id', $id)->get()->first();
        // if ($purchases->enable == 0) {
        //     return redirect()->back();
        // }
        $purchase_items = PurchaseItem::where([
            'purchase_id' => $purchases->id,
            'enable' => 1
        ])->orderBy('created_at', 'DESC')->get();
        // $purchase_item = PurchaseItem::find($id);
        // $id = $id - 1;
        return view('print.purchaselist', [
            'purchases' => $purchases,
            'purchase_items' => $purchase_items,
            // 'purchase_item' => $purchase_item,
            'p_id' => $id,
        ]);
    }
    public function PrintSaleList($id)
    {
        $sales = Sale::where('voucher_id', $id)->get()->first();
        // if ($purchases->enable == 0) {
        //     return redirect()->back();
        // }
        $sale_details = Sale_Detail::where([
            'sale_id' => $sales->id,
            'enable' => 1
        ])->orderBy('created_at', 'DESC')->get();
        // $purchase_item = PurchaseItem::find($id);
        // $id = $id - 1;
        return view('print.salelist', [
            'sales' => $sales,
            'sale_details' => $sale_details,
            // 'purchase_item' => $purchase_item,
            's_id' => $id,
        ]);
    }
}
