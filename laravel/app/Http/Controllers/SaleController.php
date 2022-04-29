<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Sale_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function create()
    {

        $categories = Category::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $items = Item::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $customers =  Customer::where('enable', 1)->orderBy('id', 'ASC')->get();

        $sale_id = Sale::max('id');
        $voucher_id = '';
        $voucher_id .= strVal($sale_id + 1) . strVal(rand(10, 99));
        $date = date('Ymds');
        // echo $date;
        $voucher_id = 'S-' . $date . $voucher_id;
        // dd($voucher_id);

        return view('sales.create', [
            'categories' => $categories,
            'items' => $items,
            'customers' => $customers,
            'voucher_id' => $voucher_id
        ]);
    }
    public function list(Request $request)
    {
        if (isset($request->search)) {
            $fromdate =  Carbon::parse($request->fromDate)->format('Y-m-d');
            // $todate =  Carbon::parse($request->toDate)->format('Y-m-d');
            $todate =  Carbon::parse($request->toDate . '23:59:59')->format('Y-m-d H:m:s');
            $sales = Sale::whereBetween('sale_date', [$fromdate, $todate])
                ->where('enable', 1)
                ->get();
        } else {
            $sales = Sale::where('enable', 1)->get();
        }

        $customers = Customer::where('enable', 1)->orderBy('id', 'ASC')->get();
        return view('sales.list', ['sales' => $sales]);
    }
    public function getSelectedItem()
    {
        return response()->json([
            'name' => 'name',
            'cost' => 'cost',
            'qty' => 5,
        ]);
    }


    public function getselectedCat(Request $r)
    {
        // return 'hello';
        $items = Item::where('category_id', $r->cat_id)->get();
        $temp = [];
        foreach ($items as $item) {
            $temp[] = array('id' => $item->id, 'name' => $item->name, 'catid' => $item->category_id, 'catname' => $item->category->name, 'retail' => $item->retail_price, 'whole' => $item->wholesale_price);
        }
        return response()->json([
            'dt' => $temp,
        ]);
    }
    public function store(Request $request)
    {
        //dd($request->all());
        // return $request->all();
        // DB::transaction(function () use ($request) {
        // sale
        $sales = new Sale;
        $sales->customer_id = $request->customer_id;
        $sales->remark = $request->remark;
        $sales->voucher_id = $request->voucher_id;
        // $sales->sub_total = $request->subtotal;
        $sales->tax = $request->tax;
        $sales->discount = $request->discount;
        $sales->paid_amount = $request->paidamount;
        $sales->sale_date = $request->sale_date;
        // $sales->left_amount = $request->leftamount;
        // $sales->sale_date = $request->sale_date;
        $sales->created_by = auth()->user()->id;
        $sales->save();
        $sale_id = $sales->id;
        $sale_date = $sales->sale_date;

        // sale detail   'item_id','purchase_price','quantity',
        for ($item_id = 0; $item_id < count($request->itemid); $item_id++) {
            $sale_details = new Sale_Detail;
            $sale_details->sale_id = $sale_id;
            $sale_details->sale_date = $sale_date;
            $sale_details->item_id = $request->itemid[$item_id];
            $sale_details->category_id = $request->catid[$item_id];
            $sale_details->sale_price = $request->price[$item_id];
            $sale_details->quantity = $request->qty[$item_id];
            $sale_details->created_by = auth()->user()->id;
            // $sale_details->amount = $request->total_amount[$item_id];
            // $sale_details->discount = $request->discount[$item_id];
            $sale_details->save();
        }
        // });
        return redirect(url('salelist-view/' . $sale_id))->with([
            'status' => 'Sale Created Successfully',
            'save' => true
        ]);
    }
    public function salelist($id)
    {
        $sale = Sale::find($id);
        $sale_details = Sale_Detail::where('sale_id', $id)->get();
        return view('sales.listview', ['sale_details' => $sale_details], ['sale' => $sale]);
    }
    public function edit($id)
    {
        $sale = Sale::find($id);
        $sale_details = Sale_Detail::where('sale_id', $id)->get();
        $sale_details1 = Sale_Detail::where('sale_id', $id)->orderBy('created_at', 'DESC')->first();
        $customers =  Customer::where('enable', 1)->get();
        //   return view('sales.edit1',['sale'=>$sale,'customers'=>$customers]);
        // dd($sale_details1->category_id);
        // $saleat = $sale_details->->orderBy('created_at', 'DESC')->first()->category_id;

        $categories = Category::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $items = Item::where('category_id', $sale_details1->category_id)->orderBy('created_at', 'DESC')->get();
        // dd($items);
        $customers =  Customer::where('enable', 1)->orderBy('id', 'ASC')->get();
        return view('sales.edit1', [
            'categories' => $categories,
            'items' => $items,
            'customers' => $customers,
            'sale' => $sale,
            'sale_details' => $sale_details
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required',
            //   'subtotal' =>'required',
            'tax' => 'required',
            'discount' => 'required',
            'paidamount' => 'required',
            //   'left' =>'required'
        ]);
        //   echo $id;
        //   dd($request->all());

        $sales = Sale::find($id);
        // dd($sales );
        $sales->customer_id = $request->customer_id;
        $sales->remark = $request->remark;
        $sales->voucher_id = $request->voucher_id;
        $sales->tax = $request->tax;
        $sales->discount = $request->discount;
        $sales->paid_amount = $request->paidamount;
        $sales->sale_date = $request->sale_date;
        $sales->edited_by = auth()->user()->id;
        $sales->update();
        $sale_id = $sales->id;
        $sale_date = $sales->sale_date;

        // dd($request->saledetail);

        // sale detail   'item_id','purchase_price','quantity',
        for ($item_id = 0; $item_id < count($request->itemid); $item_id++) {
            //    die($request->saledetail[$item_id]);

            if ($request->saledetail[$item_id] == 0) {
                //    echo "Test1";
                $sale_details = new Sale_Detail;
                $sale_details->sale_id = $sale_id;
                $sale_details->item_id = $request->itemid[$item_id];
                $sale_details->category_id = $request->catid[$item_id];
                $sale_details->sale_price = $request->price[$item_id];
                $sale_details->quantity = $request->qty[$item_id];
                $sale_details->sale_date = $sale_date;
                $sale_details->edited_by = auth()->user()->id;
                $sale_details->save();
            } else {
                //    echo "Test2";
                $sale_details = Sale_Detail::find($request->saledetail[$item_id]);
                $sale_details->sale_price = $request->price[$item_id];
                $sale_details->quantity = $request->qty[$item_id];
                $sale_details->sale_date = $sale_date;
                $sale_details->edited_by = auth()->user()->id;
                $sale_details->update();
            }
            // $sale_details->amount = $request->total_amount[$item_id];
            // $sale_details->discount = $request->discount[$item_id];

        }
        //    dd('test');



        return redirect(route('sale.list'))->with('status', 'Sale List Updated Successfully');
    }
    public function destroy($id)
    {
        $sale_details = Sale_Detail::where('sale_id', $id)->get();
        foreach ($sale_details as $detail) {
            Sale_Detail::find($detail->id)->update([
                'enable' => 0
            ]);
        }
        Sale::find($id)->update([
            'enable' => 0
        ]);
        return redirect()->back()->with('status', 'Sale List Deleted Successfully');
    }
    public function trashsale(Request $request)
    {
        if (isset($request->search)) {
            $fromdate =  Carbon::parse($request->fromDate)->format('Y-m-d');
            // $todate =  Carbon::parse($request->toDate)->format('Y-m-d ');
            $todate =  Carbon::parse($request->toDate . '23:59:59')->format('Y-m-d H:m:s');
            $sales = Sale::whereBetween('sale_date', [$fromdate, $todate])
                ->where('enable', 0)
                ->get();
        } else {
            $sales = Sale::where('enable', 0)->get();
        }
        $sale_details = Sale_Detail::where('enable', 0)->get();

        //    foreach ($sale->saledetail as $detail){

        //         $total +=$detail->sale_price * $detail->quantity;
        //         $total = $total-($sale->discount*$total)/100 + ($sale->tax*$total)/100;
        //    }

        return view('sales.trashsalelist', ['sale_details' => $sale_details, 'sales' => $sales]);
    }
    public function trashsaledetail($id)
    {
        $sale = Sale::find($id);
        $sale_details = Sale_Detail::where('sale_id', $id)->get();
        return view('sales.trashsaledetail', ['sale_details' => $sale_details]);
    }
    public function detailedit($id)
    {
        $items = Item::where('enable', 1)->get();
        $sale_details = Sale_Detail::find($id);
        return view('sales.detailedit', ['sale_details' => $sale_details, 'items' => $items]);
    }
    public function updatedetail(Request $request, $id)
    {
        $request->validate([
            'item' => 'required',
            'price' => 'required',
            'qty' => 'required'
        ]);
        $detail = Sale_Detail::find($id)->update([
            'item_id' => $request->item,
            'sale_price' => $request->price,
            'quantity' => $request->qty
        ]);

        return redirect(url('salelist-view/' . $request->sale_id))->with('status', 'Sale Detail Updated Successfully');
    }
    public function trashsalerestore($id)
    {
        $sale_details = Sale_Detail::where('sale_id', $id)->get();
        foreach ($sale_details as $detail) {
            Sale_Detail::find($detail->id)->update([
                'enable' => 0
            ]);
        }
        Sale::find($id)->update([
            'enable' => 1
        ]);
        return redirect(route('sale.list'))->with('status', 'Sale List Restored Successfully');
    }
}