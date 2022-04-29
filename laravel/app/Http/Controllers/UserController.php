<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function create()
    {

        return view('users.create');
    }
    public function list()
    {
        $users = User::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        return view('users.list', [
            'users' => $users,
        ]);
    }
    public function add()
    {
        $validation = Validator(
            request()->all(),
            [
                'user_name' => 'required',
                'user_role' => 'required',
                'user_email' => 'required|unique:users,email',
                'user_pass' => 'required'
            ]
        );
        if ($validation->fails()) {
            return response()->json([
                'code' => 0,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $user = new User;
            $user->name = request()->user_name;
            $user->role = request()->user_role;
            $user->email = request()->user_email;
            $user->password = Hash::make(request()->user_pass);
            $query = $user->save();
            if ($query) {
                return response()->json([
                    "code" => 1,
                    "msg" => "user created successfully...",
                    "all" => request()->all(),
                ]);
            };
            // return response()->json([
            //     'msg' => 'true',
            // ]);
        }
    }
    public function get()
    {
        $user = User::find(request()->user_id);
        return response()->json([
            'user' => $user,
        ]);
    }
    public function getDataTable()
    {
        $users = User::where('enable', 1)->orderBy('created_at', 'DESC')->get();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a type="button" style="cursor:pointer" data-id="' . $row['id'] . '" class="user-edit-btn">
                    <i class="fas fa-user-edit"></i>
                </a>
                <a type="button"  data-id="' . $row['id'] . '"  class="user-delete-btn">
                    <i style="color:red;" class="fas fa-trash-alt ml-2 "></i>
                </a>';
                return 'hello';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function edit()
    {

        $id = request()->id;
        $validation = Validator(
            request()->all(),
            [
                'edit_name' => 'required',
                'edit_role' => 'required',
                'edit_email' => 'required|unique:users,email,' . $id,
                // 'edit_password' => 'required'
            ]
        );
        if ($validation->fails()) {
            return response()->json([
                'code' => 0,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $user = User::find($id);
            $user->name = request()->edit_name;
            $user->role = request()->edit_role;
            $user->email = request()->edit_email;
            request()->edit_password == '' ? '' : $user->password = Hash::make(request()->edit_password);
            $user->updated_at = now();
            $query = $user->save();

            return response()->json([
                "code" => 1,
                "msg" => 'user updated sucessfully!',
            ]);
        };
    }
    public function delete()
    {
        $user = User::find(request()->id);
        $user->enable = 0;
        $user->save();
        return response()->json([
            "msg" => 'user deleted sucessfully!',
        ]);
    }
}
