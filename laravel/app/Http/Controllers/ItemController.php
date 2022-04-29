<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function create()
    {
        $categories = Category::where("enable", true)->get();
        $companies = Company::where("enable", true)->get();
        return view('items.create', ['categories' => $categories], ['companies' => $companies]);
    }
    public function list()
    {
        $categories = Category::where("enable", true)->get();
        $items = Item::where("enable", true)->get();
        return view('items.list', ['items' => $items, 'categories' => $categories]);
    }
    public function store(Request $request)
    {
        $request->validate([
            // 'company' => 'required',
            'category' => 'required',
            'code' => 'required',
            'itemName' => 'required',
            'unit' => 'required',
            'purchase' => 'required',
            'retail' => 'required',
            'wholesale' => 'required'
        ]);

        Item::create([
            'category_id' => $request->category,
            // 'company_id' => $request->company,
            'name' => $request->itemName,
            'code' => $request->code,
            'purchase_price' => $request->purchase,
            'retail_price' => $request->retail,
            'wholesale_price' => $request->wholesale,
            'unit' => $request->unit,
            'remark' => $request->remark,
            'description' => $request->description,
        ]);
        return redirect(route('item.list'))->with('status', 'Item Created Successfully');
    }
    public function edit($id)
    {
        $item = Item::find($id);
        return response()->json([
            'status' => 200,
            'item' => $item,
        ]);
    }
    public function update(Request $request)
    {
        $item_id = $request->input('item_id');
        $item = Item::find($item_id);
        $item->category_id = $request->input('category');
        $item->name = $request->input('itemname');
        $item->code = $request->input('itemcode');
        $item->unit = $request->input('itemunit');
        $item->purchase_price = $request->input('purchase');
        $item->retail_price = $request->input('retail');
        $item->wholesale_price = $request->input('wholesale');
        $item->remark = $request->input('remark');
        $item->description = $request->input('description');
        $item->update();
        return redirect()->back()->with('status', 'Item Updated Successfully');;
    }
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->enable = false;
        $item->update();
        return redirect()->back()->with('status', 'Item Deleted Successfully');;
    }
}