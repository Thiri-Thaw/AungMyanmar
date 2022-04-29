@extends('layouts.app')
@section('content')
<!--search date-->
<div class="col-md-12 d-flex justify-content-end">
    {{-- <div class=" col-md-5 pt-4">
        <a href="{{route('purchase.create')}}" class="btn btn-info  mb-3" role="button" aria-pressed="true">Add New Purchase</a>
    </div> --}}

    {{-- <div class="col-md-2  px-2 ">
        <span ><strong>Total</strong></span><br>
        <input type="text" class="form-control rounded" name="" id="" readonly>
    </div> --}}
    <form class="col-md-5 row mt-3" id="date-search" method="get" action="{{route('report')}}">
                @php
                   $from = date('Y-m-d');$to =date('Y-m-d');
                   if(isset($_GET['fromdate'])){
                    $from = $_GET['fromdate'];
                       }
                   if(isset($_GET['todate'])){
                     $to = $_GET['todate'];
                        }
                @endphp
        <div class="col-md-5  px-2 ">
            <span ><strong>From Date</strong></span><br>
            <input type="date" class="form-control rounded" value="{{$from}}" name="fromdate" id="">
        </div>
        <div class="col-md-5 px-2">
            <span ><strong>To Date</strong></span><br>
            <input type="date" class="form-control rounded" value="{{$to}}" name="todate" id="">
        </div>

        <div class="col-md-2  rounded py-2 my-3 px-0">
            <input type="submit" name='search' class="btn form-control btn-outline-secondary" value="Search">
        </div>
    </form>
</div>
<!--search date-->
        <div class="row">
            <div class="col-md-4 p-5">
                <div class="form-group mb-4 row d-flex align-items-center">
                    <label for="Sale" class="form-label col-4">Sale</label>
                    : &emsp; <input type="text" class="form-control col-7" id="Sale" value="{{$s_net_total=$sale_net + $s_tax - $s_discount}}" readonly>
                </div>
                <div class="form-group mb-4 row">
                    <div class="col-12 d-flex justify-content-end fs-3"> - </div>
                </div>
                <div class="form-group mb-4 row d-flex align-items-center">
                    <label for="Purchase" class="form-label col-4">Purchase</label>
                    : &emsp; <input type="text" class="form-control col-7" id="Purchase" value="{{$p_net_total = $purchase_net + $p_tax - $p_discount }}" readonly>
                </div>
                <hr>
                <div class="form-group mb-4 row d-flex align-items-center">
                    <label for="Purchase&Sale" class="form-label col-4">Purchase & Sale Profit</label>
                    : &emsp; <input type="text" class="form-control col-7" id="Purchase&Sale"  value="{{$p_s_profit=$s_net_total - $p_net_total}}" readonly>
                </div>
                <div class="form-group mb-4 row">
                    <div class="col-12 d-flex justify-content-end fs-4"> + </div>
                </div>
                <div class="form-group mb-4 row d-flex align-items-center">
                    <label for="Income" class="form-label col-4">Income</label>
                    : &emsp; <input type="text" class="form-control col-7" id="Income" value="{{$income}}" readonly>
                </div>
                <hr>
                <div class="form-group mb-4 row d-flex align-items-center">
                    <label for="Profit" class="form-label col-4">Profit</label>
                    : &emsp; <input type="text" class="form-control col-7" id="Profit" value="{{$profit = $p_s_profit+$income}}" readonly>
                </div>
                <div class="form-group mb-4 row">
                    <div class="col-12 d-flex justify-content-end fs-3"> - </div>
                </div>
                <div class="form-group mb-4 row d-flex align-items-center">
                    <label for="Expend" class="form-label col-4">Expend</label>
                    : &emsp; <input type="text" class="form-control col-7" id="Expend" value="{{$expand}}" readonly>
                </div>
                <hr>
                <div class="form-group mt-5 row d-flex align-items-center">
                    <label for="NetProfit" class="form-label col-4 mt-2">Net Profit</label>
                    : &emsp; <input type="text" class="form-control col-7 mt-2" id="NetProfit" value="{{$profit - $expand}}" readonly>
                </div>

            </div>
            <div class="col-md-8 p-4 row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title text-bold">Sale</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row d-flex align-items-center">
                                <label for="SubTol" class="form-label col-4">Sub Tol :</label>
                                <input type="text" class="form-control form-control-sm col" id="SubTol" value="{{$sale_net}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Tax" class="form-label col-4">Tol Tax :</label>
                                <input type="text" class="form-control form-control-sm col" id="Tax" value="{{$s_tax}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Discount" class="form-label col-4">Tol Discount :</label>
                                <input type="text" class="form-control form-control-sm col" id="Discount" value="{{$s_discount}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="NetTol" class="form-label col-4">Net Tol :</label>
                                <input type="text" class="form-control form-control-sm col" id="NetTol" value="{{$sale_net + $s_tax - $s_discount}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Paid" class="form-label col-4">Paid :</label>
                                <input type="text" class="form-control form-control-sm col" id="Paid" value="{{$sales->sum('paid_amount')}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Left" class="form-label col-4">Left :</label>
                                <input type="text" class="form-control form-control-sm col" id="Left" value="{{$sale_net + $s_tax - $s_discount - $sales->sum('paid_amount')}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title text-bold">Purchase</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row d-flex align-items-center">
                                <label for="SubTol" class="form-label col-4">Sub Tol :</label>
                                <input type="text" class="form-control form-control-sm col" id="SubTol" value="{{$purchase_net}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Tax" class="form-label col-4">Tol Tax :</label>
                                <input type="text" class="form-control form-control-sm col" id="Tax" value="{{$p_tax}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Discount" class="form-label col-4">Tol Discount :</label>
                                <input type="text" class="form-control form-control-sm col" id="Discount" value="{{$p_discount}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="NetTol" class="form-label col-4">Net Tol :</label>
                                <input type="text" class="form-control form-control-sm col" id="NetTol" value="{{$purchase_net + $p_tax - $p_discount}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Paid" class="form-label col-4">Paid :</label>
                                <input type="text" class="form-control form-control-sm col" id="Paid" value="{{$purchases->sum('paid')}}" readonly>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Left" class="form-label col-4">Left :</label>
                                <input type="text" class="form-control form-control-sm col" id="Left" value="{{$purchase_net + $p_tax - $p_discount - $purchases->sum('paid')}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title text-bold">Income</h3>
                        </div>
                        <div class="card-body">
                            @php
                                $income = 0;
                            @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $id = 1;
                                    $sum = 0;
                                    $in_sum = 0;
                                @endphp
                            @foreach ($types as $type)
                                @if($type->status == 'income')
                                    <tr>
                                        <td>{{$id++}}</td>
                                        <td>{{$type->name}}</td>
                                        <td>
                                            @php
                                                $in_sum = 0;
                                            @endphp
                                            @foreach ($accounts as $account)
                                                @if($type->id == $account->type_id)
                                                    @php
                                                        $sum += $account->amount;
                                                        $in_sum +=$account->amount;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{$in_sum}}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row d-flex align-items-center">
                                <label for="IncomeTol" class="form-label col-4">Total :</label>
                                <input type="text" class="form-control form-control-sm col" id="IncomeTol" value="{{$sum}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title text-bold">Expand</h3>
                        </div>
                        <div class="card-body">

                            @php
                                $expend = 0;
                            @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $id = 1;
                                    $sum = 0;
                                    $ex_sum = 0;
                                @endphp
                            @foreach ($types as $type)
                                @if($type->status == 'expend')
                                    <tr>
                                        <td>{{$id++}}</td>
                                        <td>{{$type->name}}</td>
                                        <td>
                                            @php
                                                $ex_sum = 0;
                                            @endphp
                                            @foreach ($accounts as $account)
                                                @if($type->id == $account->type_id)
                                                    @php
                                                        $sum += $account->amount;
                                                        $ex_sum += $account->amount;
                                                    @endphp
                                                @endif
                                            @endforeach
                                                {{$ex_sum}}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <div class="form-group row d-flex align-items-center">
                                <label for="IncomeTol" class="form-label col-4">Total :</label>
                                <input type="text" class="form-control form-control-sm col" id="IncomeTol" value="{{$sum}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
