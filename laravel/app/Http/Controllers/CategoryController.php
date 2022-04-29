<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }

    public function list()
    {
        $categories = Category::where("enable",true)->get();
        return view('categories.list',['categories'=>$categories]);
    }
    public function store(Request $request){
        $request->validate([
            'catname' => 'required'

        ]);
        Category::create([
          'name' => $request->catname,
          'remark' => $request->remark
        ]);
        return redirect( route('category.list') )->with('status','Category Created Successfully');
    }
    public function edit($id){
        $category = Category::find($id);
        return response()->json([
         'status'=>200,
         'category' => $category,
        ]);
    }
    public function update(Request $request){
        $cat_id = $request->input('category_id');
        $category = Category::find($cat_id);
        $category->name = $request->input('catname');
        $category->remark = $request->input('remark');
        $category->update();
        return redirect()->back()->with('status','Category Updated Successfully');
    }
    public function destroy($id){
       $category = Category::find($id);
       $category->enable = false;
       $category->update();
        return redirect()->back()->with('status','Category Deleted Successfully');
    }
}