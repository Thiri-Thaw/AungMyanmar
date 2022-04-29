<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class AccounttypeController extends Controller
{
    public function create()
    {
        $types = Type::where('enable', 1)->get();
        return view('types.create', ['types' => $types]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        Type::create([
            'name' => $request->name,
            'remark' => $request->remark,
            'status' => $request->status
        ]);
        return redirect()->back()->with('status', 'Account Type Created Successfully');
    }
    public function edit($id)
    {
        $accounttype = Type::find($id);
        return response()->json([
            'status' => 200,
            'accounttype' => $accounttype,
        ]);
    }
    public function update(Request $request)
    {
        $type_id = $request->input('acctype_id');
        $type =  Type::find($type_id);
        $type->name = $request->input('name');
        $type->remark = $request->input('remark');
        $type->status = $request->input('status');
        $type->update();
        return redirect()->back()->with('status', 'Account Type Updated Successfully');
    }
    public function destroy($id)
    {
        $type = Type::find($id);
        $type->enable = false;
        $type->update();
        return redirect()->back()->with('status', 'Account Type Deleted Successfully');
    }
}