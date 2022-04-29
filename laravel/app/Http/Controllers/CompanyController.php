<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function create()
    {
        // $companies = Company::all();
        $companies = Company::where("enable", true)->get();
        return view('companies.create', [
            'companies' => $companies
        ]);
    }
    public function detail()
    {
        $companies = Company::where("enable", 1)->get();
        return DataTables::of($companies)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn edit_company" value="' . $row['id'] . '">
                <i style="cursor:pointer" class="fas fa-user-edit"></i>
            </button>
                <a onclick="return confirm("Are you sure to delete this company")" href="/delete-company/' . $row['id'] . '"><i style="color:red;" class="fas fa-trash-alt ml-2"></i></a>';
            })
            ->rawColumns(["action"])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required'
        ]);
        Company::create([
            'name' => $request->company_name,
            'remark' => $request->company_remark
        ]);
        // return redirect()->back();
        return response()->json([
            'msg' => 'company created successfully!'
        ]);
        return redirect()->back()->with('status','Company Created Successfully');   
    }
    public function edit($id)
    {
        $company = Company::find($id);
        return response()->json([
            'status' => 200,
            'company' => $company,
        ]);
    }
    public function update(Request $request)
    {
        // return $request->all();
        $com_id = $request->input('company_id');
        $company = Company::find($com_id);
        $company->name = $request->input('name');
        $company->remark = $request->input('remark');
        $company->update();
        return redirect()->back()->with('status','Company Updated Successfully');
    }
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->enable = false;
        $company->update();
        return redirect()->back()->with('status','Company Deleted Successfully');
    }
}
