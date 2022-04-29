<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale_Detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    public function list()
    {
        if (isset(request()->search)) {
            $fromdate =  Carbon::parse(request()->fromdate)->format('Y-m-d');
            $todate =  Carbon::parse(request()->todate . '23:59:59')->format('Y-m-d H:m:s');
        } else {
            $fromdate =  Carbon::parse(date("Y-m-d"))->format('Y-m-d');
            $todate =  Carbon::parse(date("Y-m-d") . '23:59:59')->format('Y-m-d H:m:s');
        }
        $op_purchase_items = PurchaseItem::where('date', '<', $fromdate)
            ->where('enable', 1)
            ->get();
        $op_sale_items = Sale_Detail::where('sale_date', '<', $fromdate)
            ->where('enable', 1)
            ->get();
        $purchase_items = PurchaseItem::whereBetween('date', [$fromdate, $todate])
            ->where('enable', 1)->get();
        $sale_details = Sale_Detail::whereBetween('sale_date', [$fromdate, $todate])
            ->where('enable', 1)->get();
        $items = Item::where('enable', 1)->get();
        return view('inventory.inventory', [
            'items' => $items,
            'op_p_items' => $op_purchase_items,
            'op_s_items' => $op_sale_items,
            'purchase_items' => $purchase_items,
            'sale_details' => $sale_details,
        ]);
    }
    // public function getItemByDate()
    // {
    //     return request()->all();
    //     if (isset(request()->fromdate) && isset(request()->todate)) {
    //         $fromdate =  Carbon::parse(request()->fromdate)->format('Y-m-d H:m:s');
    //         $todate =  Carbon::parse(request()->todate . '23:59:59')->format('Y-m-d H:m:s');
    //         $purchase_items = PurchaseItem::where('created_at', '<', $fromdate)
    //             ->where('created_at', '<', $todate)
    //             ->where([
    //                 'enable' => 1,
    //             ])
    //             ->get();
    //         $sale_items = Sale_Detail::where('created_at', '<', $fromdate)
    //             ->where('created_at', '<', $todate)
    //             ->where([
    //                 'enable' => 1,
    //             ])
    //             ->get();
    //         $purchase_qty = $purchase_items->sum('quantity');
    //         $sale_qty = $sale_items->sum('quantity');
    //         Session::put('op_stork');
    //     } else {
    //         $fromdate =  Carbon::parse(date("Y-m-d"))->format('Y-m-d H:m:s');
    //         $todate =  Carbon::parse(date("Y-m-d") . '23:59:59')->format('Y-m-d H:m:s');
    //         $purchases = Purchase::where('created_at', '<', $fromdate)
    //             ->where([
    //                 'enable' => 1,
    //             ])
    //             ->get();
    //         Session::put('op_stork', $purchases);
    //     }
    //     return $purchases;
    // }
    // public function getItem()
    // {
    //     $items = Item::where('enable', 1)->get();
    //     return DataTables::of($items)
    //         ->addIndexColumn()
    //         ->addColumn('cat_name', function ($row) {
    //             return $row['category']['name'];
    //         })
    //         ->addColumn('op_storke', function ($row) {
    //             $op_perchases = Session::get('op_stork');
    //             foreach ($op_perchases as $purchase) {
    //                 foreach ($purchase['purchase_items'] as $purchase_item) {
    //                     if ($purchase_item['item_id'] == $row['id']) {
    //                         return $purchase_item->sum('quantity');
    //                     } else {
    //                         return $row['name'];
    //                     }
    //                 }
    //             }
    //             // return $op_perchases[''];
    //         })
    //         ->addColumn('p_storke', function ($row) {
    //             $fromdate =  Carbon::parse(date("Y-m-d"))->format('Y-m-d H:m:s');
    //             $todate =  Carbon::parse(date("Y-m-d") . '23:59:59')->format('Y-m-d H:m:s');
    //             $purchase_items = PurchaseItem::where('created_at', '>', $fromdate)
    //                 ->where('created_at', '<', $todate)
    //                 ->where([
    //                     'enable' => 1,
    //                     'item_id' => $row['id']
    //                 ])
    //                 ->get();
    //             return $purchase_items->sum('quantity');
    //         })
    //         ->addColumn('s_storke', function ($row) {
    //             $fromdate =  Carbon::parse(date("Y-m-d"))->format('Y-m-d H:m:s');
    //             $todate =  Carbon::parse(date("Y-m-d") . '23:59:59')->format('Y-m-d H:m:s');
    //             $sale_details = Sale_Detail::whereBetween('created_at', [$fromdate, $todate])
    //                 ->where([
    //                     'enable' => 1,
    //                     'item_id' => $row['id']
    //                 ])
    //                 ->get();
    //             return $sale_details->sum('quantity');
    //         })
    //         ->addColumn('c_storke', function ($row) {
    //             $fromdate =  Carbon::parse(date("Y-m-d"))->format('Y-m-d H:m:s');
    //             $todate =  Carbon::parse(date("Y-m-d") . '23:59:59')->format('Y-m-d H:m:s');
    //             $purchase_items = PurchaseItem::whereBetween('created_at', [$fromdate, $todate])
    //                 ->where([
    //                     'enable' => 1,
    //                     'item_id' => $row['id']
    //                 ])
    //                 ->get();
    //             $sale_details = Sale_Detail::whereBetween('created_at', [$fromdate, $todate])
    //                 ->where([
    //                     'enable' => 1,
    //                     'item_id' => $row['id']
    //                 ])
    //                 ->get();
    //             return $purchase_items->sum('quantity') - $sale_details->sum('quantity');
    //         })
    //         ->rawColumns(['cat_name', 'op_storke', 'p_storke', 's_storke', 'c_storke'])
    //         ->make(true);
    // }
}