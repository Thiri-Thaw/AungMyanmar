<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customers.create');
    }
    public function list()
    {
        return view('customers.list');
    }
    public function add()
    {
        $validation = Validator(
            request()->all(),
            [
                'name' => 'required',
                'phone' => 'nullable|unique:customers,phone,',
                'sale_type' => 'required'

            ]
        );
        if ($validation->fails()) {
            return response()->json([
                'code' => 0,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $customer = new Customer;
            $customer->name = request()->name;
            $customer->phone = request()->phone;
            $customer->remark = request()->remark;
            $customer->address = request()->address;
            $customer->sale_type = request()->sale_type;
            $customer->created_at = now();
            $query = $customer->save();
            if (!$query) {
                return response()->json([
                    'msg' => 'something went wrong!'
                ]);
            }
            return response()->json([
                'msg' => 'customer added successfully!'
            ]);
        }
    }
    public function get()
    {
        $customers = Customer::where('enable', 1)->get();
        // $sales = Sale::where('enable',1)->get();
        return DataTables::of($customers)
            ->addIndexColumn()
            ->addColumn('net', function ($row) {
                $sales = Sale::where('enable', 1)->get();
                $s_tax = 0;
                $s_discount = 0;
                $net = 0;
                $t_net = 0;
                foreach ($sales as $sale) {
                    $s_net = 0;
                    if ($sale->customer_id == $row['id']) {
                        foreach ($sale->saledetail as $saledetail) {
                            $net = 0;
                            $net += $saledetail->sale_price * $saledetail->quantity;
                            $s_net += $net;
                            $t_net +=  $saledetail->sale_price * $saledetail->quantity;
                        }
                        $s_tax += ($sale->tax * $s_net) / 100;
                        $s_discount += ($sale->discount * $s_net) / 100;
                    }
                }
                return $t_net + ($s_tax - $s_discount);
            })
            ->addColumn('paid', function ($row) {
                $sales = Sale::where('enable', 1)->get();
                $paid = 0;
                foreach ($sales as $sale) {
                    if ($sale->customer_id == $row['id']) {
                        $paid += $sale->paid_amount;
                    }
                }
                return $paid;
            })
            ->addColumn('left', function ($row) {
                $sales = Sale::where('enable', 1)->get();
                $s_tax = 0;
                $s_discount = 0;
                $net = 0;
                $t_net = 0;
                foreach ($sales as $sale) {
                    $s_net = 0;
                    if ($sale->customer_id == $row['id']) {
                        foreach ($sale->saledetail as $saledetail) {
                            $net = 0;
                            $net += $saledetail->sale_price * $saledetail->quantity;
                            $s_net += $net;
                            $t_net +=  $saledetail->sale_price * $saledetail->quantity;
                        }
                        $s_tax += ($sale->tax * $s_net) / 100;
                        $s_discount += ($sale->discount * $s_net) / 100;
                    }
                }
                $paid = 0;
                foreach ($sales as $sale) {
                    if ($sale->customer_id == $row['id']) {
                        $paid += $sale->paid_amount;
                    }
                }
                $t_net =  $t_net + ($s_tax - $s_discount);
                $left = $t_net - $paid;
                return $left;
            })
            ->addColumn('action', function ($row) {
                return '<a type="button" style="cursor:pointer" data-id="' . $row['id'] . '" class="customer-edit-btn">
                    <i class="fas fa-user-edit"></i>
                </a>
                <a type="button"  data-id="' . $row['id'] . '"  class="customer-delete-btn">
                    <i style="color:red;" class="fas fa-trash-alt ml-2 "></i>
                </a>';
            })
            ->rawColumns(['action', 'net', 'paid'])
            ->make(true);
    }
    public function edit()
    {
        $id = request()->id;
        $validation = Validator(
            request()->all(),
            [
                'name' => 'required',
                'phone' => 'nullable|unique:customers,phone,' . request()->id,
                'sale_type' => 'required',
            ]
        );
        if ($validation->fails()) {
            return response()->json([
                'code' => 0,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $customer = Customer::find($id);
            $customer->name = request()->name;
            $customer->address = request()->address;
            $customer->phone = request()->phone;
            $customer->remark = request()->remark;
            $customer->sale_type = request()->sale_type;
            $customer->updated_at = now();
            $query = $customer->save();

            return response()->json([
                "code" => 1,
                "msg" => 'customer updated sucessfully!',
            ]);
        };
    }
    public function getDatail()
    {
        $customer = Customer::find(request()->user_id);
        return response()->json([
            'customer' => $customer,
        ]);
    }
    public function delete()
    {
        $customer = Customer::find(request()->id);
        $customer->enable = 0;
        $customer->save();
        return response()->json([
            "msg" => 'customer deleted sucessfully!',
        ]);
    }
}