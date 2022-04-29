<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Type;
use App\Models\Accounttype;
use Carbon\Carbon;
class AccountController extends Controller
{
    public function create(){
        $accounts = Type::all();
        return view('accounts.create',['accounts'=>$accounts]);
    }
    public function store(Request $request){
        $request->validate([
            'reason'=>'required',
            'amount'=>'required',
            'type' =>'required',
            'enroll_date' =>'required'
        ]);
        
        Account::create([
            'reason'=>$request->reason,
            'amount'=>$request->amount,
            'type_id' =>$request->type,
            'enroll_date' =>$request->enroll_date,
            'remark' =>$request->remark
        ]);
        return redirect( route('account.list'))->with('status','Account Created Successfully');

    }
    public function list(Request $request){
        // $accounts = Account::where('enable',1)->get();
        // $accounts = Account::all();
        // $accounttypes = Accounttype::where('enable',1)->get();
        // dd($accounts->accounttype);
        // dd($)
        if(isset($request->search)){
            $fromdate =  Carbon::parse($request->fromDate)->format('Y-m-d');
            $todate =  Carbon::parse($request->toDate)->format('Y-m-d');
            $accounts = Account::whereBetween('enroll_date', [$fromdate, $todate])
            ->where('enable', 1)
            ->get();
            }else{
                 $accounts = Account::where('enable', 1)->get();
            }
            $accounttypes = Type::where('enable',1)->get();
        
        return view('accounts.list',[
            'accounts'=>$accounts,
            'accounttypes'=>$accounttypes
        ]);
    }
    public function edit($id){
        $account = Account::find($id);
        // $accounttypes = Accounttypes::all();
        // dd($account);
        return response()->json([
            'status'=>200,
            'account' => $account,
            // 'accounttypes' => $accounttypes,
           ]);
    }
    public function update(Request $request){
        $account_id = $request->input('account_id');
        $account =  Account::find($account_id);
        // dd($account);
        $account->reason = $request->reason;
        $account->amount = $request->amount;
        $account->type_id = $request->type;
        $account->enroll_date = $request->enroll_date;
        $account->remark = $request->remark;
        $account->update();
        return redirect()->back()->with('status','Account Updated Successfully');;
    }
    public function destroy($id){
        $account = Account::find($id);
        $account->enable = false;
        $account->update();
         return redirect()->back()->with('status','Account Deleted Successfully');;
     }
}
