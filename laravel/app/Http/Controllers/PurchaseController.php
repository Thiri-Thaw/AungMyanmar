<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    public function create()
    {

        Session::has('purchaseitems') ?: Session::put('purchaseitems', []);
        // Session::put('purchaseitems', []);
        $selectedItems = Session::get('purchaseitems');
        $categories = Category::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $items = Item::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $customers =  Customer::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $companies =  Company::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $purchase_id = Purchase::max('id');
        $voucher_id = '';
        $voucher_id .= strVal($purchase_id + 1) . strVal(rand(10, 99));
        $date = date('Ymds');
        // echo $date;
        // dd($date);
        $voucher_id = 'P-' . $date . $voucher_id;
        // dd($voucher_id);

        return view('purchases.create', [
            'categories' => $categories,
            'items' => $items,
            'customers' => $customers,
            'companies' => $companies,
            'selectedItems' => $selectedItems,
            'voucher_id' => $voucher_id
        ]);
    }
    public function detail()
    {
        $id = request()->id;
        $purchase_item = PurchaseItem::where('id', $id)->first();
        return response()->json([
            'purchase_item' => $purchase_item,
            'id' => $id
        ]);
    }
    public function list(Request $request)
    {
        if (isset($request->search)) {
            $fromdate =  Carbon::parse($request->fromDate)->format('Y-m-d');
            $todate =  Carbon::parse($request->toDate . '23:59:59')->format('Y-m-d H:m:s');
            $purchases = Purchase::whereBetween('date', [$fromdate, $todate])
                ->where('enable', 1)
                ->get();
        } else {
            $purchases = Purchase::where('enable', 1)->orderBy('date', 'DESC')->get();
        }
        return view('purchases.list', [
            'purchases' => $purchases,
        ]);
    }


    public function getSelectedItem()
    {
        $items = Session::get('purchaseitems');

        return DataTables::of($items)
            ->addIndexColumn()
            ->addColumn('price', function ($row) {
                return '<span class="d-flex justify-content-center">
                <input type="number" class="form-conrol form-control-range selected_item_price"  style="width: 60px;" value="' . $row['price'] . '"  data-id="' . $row['id'] . '"/>
            </span>';
            })
            ->addColumn('qty', function ($row) {
                return '<span class="d-flex justify-content-center">
                <input type="number" class="form-conrol form-control-range selected_item_qty" style="width: 40px;" value="' . $row['qty'] . '"  data-id="' . $row['id'] . '"/>
            </span>';
            })
            ->addColumn('action', function ($row) {
                return '<i class="fas fa-minus-circle text-danger remove_select_item" style="cursor:pointer;" data-id="' . $row['id'] . '"></i>';
            })
            ->addColumn('total', function ($row) {
                return $row['qty'] * $row['price'];
            })
            ->rawColumns(['qty', "action", "total", "price"])
            ->make(true);
    }

    public function putSelectedItem()
    {
        $id = request()->id;
        $item = Item::find($id);
        if (Session::has('purchaseitems')) {
            $items = Session::get('purchaseitems');
            $items[$id] = [
                'qty' => array_key_exists($id, $items) ? $items[$id]['qty']  + 1 : 1,
                'id' => $id,
                'cat_id' => $item->category_id,
                'cat_name' => $item->category->name,
                'name' => $item->name,
                'price' => $item->purchase_price,
            ];
            Session::put('purchaseitems', $items);
        } else {
            Session::put('purchaseitems', [
                $id => [
                    'qty' => 1,
                    'id' => $id,
                    'cat_id' => $item->category_id,
                    'cat_name' => $item->category->name,
                    'name' => $item->name,
                    'price' => $item->purchase_price,
                ]
            ]);
        }
        return response()->json([
            // 'msg' => array_key_exists($id, $items),
            'item' => Session::get('purchaseitems'),
            'price' => $item->purchase_price,
        ]);
    }

    public function removeSelectedItem()
    {

        $id = request()->id;
        $item = Item::find($id);
        $items = Session::get('purchaseitems');
        if (array_key_exists($id, $items)) {
            $price = $items[$id]['qty'] * $items[$id]['price'];
            unset($items[$id]);
            Session::put('purchaseitems', $items);
        }

        return response()->json([
            // 'msg' => array_key_exists($id, $items),
            'item' => Session::get('purchaseitems'),
            'price' => $price ?? '',
        ]);
    }
    public function add()
    {

        $items = Session::get('purchaseitems');
        if (count($items) > 0 && request()->remind_date != null) {
            $purchase = new Purchase;
            $purchase->company_id = request()->company;
            $purchase->remark = request()->remark;
            $purchase->tax = request()->tax;
            $purchase->discount = request()->discount;
            $purchase->paid = request()->paid;
            $purchase->date = request()->date;
            $purchase->voucher_id = request()->voucher_id;
            $purchase->remind_date = request()->remind_date;
            $purchase->created_by = auth()->user()->id;
            $purchase->save();

            foreach ($items as $item) {
                $purchaseItem = new PurchaseItem;
                $purchaseItem->purchase_id = $purchase->id;
                $purchaseItem->item_id = $item['id'];
                $purchaseItem->category_id = $item['cat_id'];
                $purchaseItem->price = $item['price'];
                $purchaseItem->date = request()->date;
                $purchaseItem->quantity = $item['qty'];
                $purchaseItem->created_by = auth()->user()->id;
                $purchaseItem->save();
            }
            $items = Session::get('purchaseitems');
            Session::put('purchaseitems', []);
        }
        return response()->json([
            'all' => request()->all(),
            'count' => count($items),
            'items' => $items,
            'id' => $purchase->id ?? '',
        ]);
    }
    public function deleteVoucher($id)
    {
        $purchase = Purchase::find($id);
        if ($purchase->enable == 1) {
            $purchase->enable = 0;
            $purchase->save();
            $purchase_items = PurchaseItem::where([
                'purchase_id' => $id,
            ])->get();
            foreach ($purchase_items as $purchase_item) {
                if ($purchase_item->enable == 1) {
                    $purchase_item->enable = 0;
                    $purchase_item->save();
                }
            }
        }
        return redirect()->back();
    }
    public function retoreVoucher($id)
    {
        $purchase = Purchase::find($id);
        if ($purchase->enable == 0) {
            $purchase->enable = 1;
            $purchase->save();
            $purchase_items = PurchaseItem::where([
                'purchase_id' => $id,
            ])->get();
            foreach ($purchase_items as $purchase_item) {
                if ($purchase_item->enable == 0) {
                    $purchase_item->enable = 1;
                    $purchase_item->save();
                }
            }
        }
        return redirect()->back();
    }
    public function selectedItemQty()
    {
        $id  = request()->id;
        $val = request()->val;
        $item = Session::get('purchaseitems');
        if ($val <= 0) {
            $oldPrice = $item[$id]['qty'] * $item[$id]['price'];
            $item[$id]['qty'] = $val;
            $price = ($item[$id]['qty'] * $item[$id]['price']) - $oldPrice;
            unset($item[$id]);
            Session::put('purchaseitems', $item);
        } else {
            $oldPrice = $item[$id]['qty'] * $item[$id]['price'];
            $item[$id]['qty'] = $val;
            $price = ($item[$id]['qty'] * $item[$id]['price']) - $oldPrice;
            Session::put('purchaseitems', $item);
        }
        return response()->json([
            'all' => request()->all(),
            'price' => $price
        ]);
    }
    public function selectedItemPrice()
    {
        $id  = request()->id;
        $val = request()->val;
        $item = Session::get('purchaseitems');
        if ($val < 0) {
            $oldPrice = $item[$id]['qty'] * $item[$id]['price'];
            $item[$id]['price'] = $val;
            $price = ($item[$id]['qty'] * $item[$id]['price']) - $oldPrice;
            unset($item[$id]);
            Session::put('purchaseitems', $item);
        } else {
            $oldPrice = $item[$id]['qty'] * $item[$id]['price'];
            $item[$id]['price'] = $val;
            $price = ($item[$id]['qty'] * $item[$id]['price']) - $oldPrice;
            Session::put('purchaseitems', $item);
        }
        return response()->json([
            'all' => request()->all(),
            'price' => $price
        ]);
    }
    public function listDetail($id)
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
        return view('purchases.list-detail', [
            'purchases' => $purchases,
            'purchase_items' => $purchase_items,
            // 'purchase_item' => $purchase_item,
            'p_id' => $id,
        ]);
    }
    public function editView()
    {
        $id = request()->id;
        $item_id = request()->item_id;
        $cat_id = request()->cat_id;
        $p_id = request()->purchase_id;
        $purchase_items = PurchaseItem::find($id);
        $categories = Category::all();
        $companies = Company::all();
        $items = Item::all();
        // return request()->all();
        return view(
            'purchases.edit',
            [
                'categories' => $categories,
                'companies' => $companies,
                'items' => $items,
                'item_id' => $item_id,
                'cat_id' => $cat_id,
                'purchase_items' => $purchase_items,
                'p_id' => $p_id,
            ]
        );
    }
    public function edit()
    {
        // return request()->all();
        $p_id =  request()->purchase_id;
        $p_item_id =  request()->id;
        $name =  request()->item_name;
        $cat_id =  request()->category;
        $price =  request()->price;
        $quantity =  request()->quantity;
        $purchase_item = PurchaseItem::find($p_item_id);
        $purchase_item->item_id = $name;
        $purchase_item->category_id = $cat_id;
        $purchase_item->price = $price;
        $purchase_item->edited_by = auth()->user()->id;
        $purchase_item->quantity = $quantity;
        $purchase_item->save();
        return redirect("/list-purchase/" . $p_id);
    }
    public function editVoucher($id)
    {
        // if (Purchase::find($id)->enable == 0) {
        //     return redirect()->back();
        // }
        Session::put('purchaseitems', []);
        $categories = Category::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $item = Item::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $customers =  Customer::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $companies =  Company::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        $purchase = Purchase::find($id);
        $items = Session::get('purchaseitems');
        if (Session::has('purchaseitems')) {
            foreach ($purchase->purchase_items as $purchase_item) {
                $items[$purchase_item->item_id] = [
                    'qty' => $purchase_item->quantity,
                    'id' => $purchase_item->item_id,
                    'cat_id' => $purchase_item->category_id,
                    'cat_name' => $purchase_item->category->name,
                    'name' => $purchase_item->items->name,
                    'price' => $purchase_item->price,
                ];
                Session::put('purchaseitems', $items);
            }
        } else {
            foreach ($purchase->purchase_items as $purchase_item) {
                Session::put('purchaseitems', [
                    $purchase_item->item_id => [
                        'qty' => $purchase_item->quantity,
                        'id' => $purchase_item->item_id,
                        'cat_id' => $purchase_item->category_id,
                        'cat_name' => $purchase_item->category->name,
                        'name' => $purchase_item->items->name,
                        'price' => $purchase_item->price,
                    ]
                ]);
            }
        }
        // return $items;
        $selectedItems = Session::get('purchaseitems');
        $companies = Company::all();
        return view('purchases.edit-voucher', [
            'purchase' => $purchase,
            'companies' => $companies,
            'selectedItems' => $selectedItems,
            'categories' => $categories,
            'items' => $item,
            'customers' => $customers,
        ]);
    }
    public function storeEditVoucher()
    {
        $count = count(Session::get('purchaseitems'));
        $selectedItems = Session::get('purchaseitems');
        $id = request()->purchase_id;
        $company = request()->company;
        $tax = request()->tax;
        $remark = request()->remark;
        $discount = request()->discount;
        $paid = request()->paid;
        if ($count > 0) {
            $purchase = Purchase::find($id);
            $purchase->company_id = $company;
            $purchase->tax = $tax;
            $purchase->discount = $discount;
            $purchase->remark = $remark;
            $purchase->paid = $paid;
            $purchase->date = request()->date;
            $purchase->remind_date = request()->remind_date;
            $purchase->edited_by = auth()->user()->id;
            $purchase->save();
            foreach ($selectedItems as $item) {
                if (PurchaseItem::where([
                    'item_id' => $item['id'],
                    'purchase_id' => $id,
                ])->count() > 0) {
                    $purchaseItem = PurchaseItem::where([
                        'item_id' => $item['id'],
                        'purchase_id' => $id,
                    ])->first();
                    $purchaseItem->item_id = $item['id'];
                    $purchaseItem->category_id = $item['cat_id'];
                    $purchaseItem->price = $item['price'];
                    $purchaseItem->date = request()->date;
                    $purchaseItem->quantity = $item['qty'];
                    $purchaseItem->edited_by = auth()->user()->id;
                    $purchaseItem->update();
                } else {
                    // $purchaseItem->delete();
                    $purchaseItem = new PurchaseItem;
                    $purchaseItem->purchase_id = $id;
                    $purchaseItem->item_id = $item['id'];
                    $purchaseItem->category_id = $item['cat_id'];
                    $purchaseItem->price = $item['price'];
                    $purchaseItem->quantity = $item['qty'];
                    $purchaseItem->edited_by = auth()->user()->id;
                    $purchaseItem->save();
                }
            }
        }
        Session::put('purchaseitems', []);
        return response()->json([
            'id' => $id,
            'count' => $count,
        ]);
    }
    public function removeSelectedItemEdit()
    {
        $id = request()->id;
        $purchase_id = request()->purchase_id;
        if (PurchaseItem::where([
            'item_id' => $id,
            'purchase_id' => $purchase_id,
        ])->count() > 0) {
            $purchaseItem = PurchaseItem::where([
                'item_id' => $id,
                'purchase_id' => $purchase_id,
            ])->first()->delete();
        }
    }
    public function trash(Request $request)
    {
        if (isset($request->search)) {
            $fromdate =  Carbon::parse($request->fromDate)->format('Y-m-d');
            $todate =  Carbon::parse($request->toDate . '23:59:59')->format('Y-m-d H:m:s');
            $purchases = Purchase::whereBetween('date', [$fromdate, $todate])
                ->where('enable', 0)
                ->get();
        } else {
            $purchases = Purchase::where('enable', 0)->get();
        }
        return view('purchases.trash', [
            'purchases' => $purchases,
        ]);
    }
    public function read($id)
    {
        $purchase = Purchase::where('voucher_id', $id)->first();
        if ($purchase->read == 0) {
            $purchase->read = 1;
        }
        $purchase->save();
        return redirect()->route('purchase.list.detail', $id);
    }
}