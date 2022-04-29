<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\Sale_Detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Session::put('purchaseitems', []);
        $fromdate =  Carbon::parse(date("Y-m-d"))->format('Y-m-d');
        $todate =  Carbon::parse(date("Y-m-d") . '23:59:59')->format('Y-m-d H:m:s');
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
        return view('home', [
            'op_p_items' => $op_purchase_items,
            'op_s_items' => $op_sale_items,
            'purchase_items' => $purchase_items,
            'sale_details' => $sale_details,
        ]);
    }
}
