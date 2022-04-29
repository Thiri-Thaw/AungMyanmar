@extends('layouts.app')

@section('content')
 <div class="container">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trash Sale List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Trash Sale Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!--search date-->
    <form action="{{ route('saletrash.list') }}" method="get">
    <div class="col-md-12 d-flex justify-content-between">
        <div class="col-md-6 pt-4 ">
                <a href="{{route('sale.create')}}" class="btn btn-info  mb-3" role="button" aria-pressed="true">Add New Sale</a>
        </div>
        <!-- <div class="col-md-2  px-2 ">
            <span ><strong>Total</strong></span><br>
            <input type="text" class="form-control rounded" name="" id="" readonly>
        </div> -->
        @php
        $from = date('Y-m-d');$to =date('Y-m-d');
        if(isset($_GET['fromDate'])){
            $from = $_GET['fromDate'];
        }
        if(isset($_GET['toDate'])){
            $to = $_GET['toDate'];
        }
        @endphp
        <!-- <div class="col-md-1  rounded py-2 my-3 ">
           <input type="text" name="" class="form-control" value="{{ count($sales) }}" readonly>
        </div> -->
        <div class=" col-md-2 px-2 ">
            <span ><strong>From Date</strong></span><br>
            <input type="date" class="form-control rounded" name="fromDate" id="" value="{{ $from }}">
        </div>
        <div class="col-md-2 px-2">
            <span ><strong>To Date</strong></span><br>
            <input type="date" class="form-control rounded" name="toDate" id="" value="{{ $to }}">
        </div>

        <div class="col-md-1  rounded py-2 my-3 ">
            <input type="submit" name='search' class="btn form-control btn-outline-secondary" value="Search">
        </div>
    </div>
  </form>
    <!--search date-->

    <!-- Sale DataTable -->
    <div class="card mx-auto mb-4 border-info">
        <div class="card-header bg-secondary text-white">Sale Table</div>
        <div class="card-body">
            <span id="sucess_message"></span>
            <div class="table-responsive">
            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Voucher Id</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Tax</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Net Total</th>
                            <th scope="col">Paid Amount</th>
                            <th scope="col">Left Amount</th>
                            <th scope="col">Sale Date</th>
                            <th scope="col">Remark</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; $total = 0;@endphp
                        @foreach($sales as $sale)
                        <tr>
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach ($sale->saledetail as $detail)
                            @php
                                $subtotal +=$detail->sale_price * $detail->quantity;
                            @endphp
                        @endforeach
                            <th scope="row">{{ $no }}</th>
                            <td>{{ $sale->voucher_id }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td>{{ $subtotal }}</td>
                            <td>{{ $sale->tax }}</td>
                            <td>{{ $sale->discount }}</td>
                            <td>

                                {{$nettotal = $subtotal-($sale->discount*$subtotal)/100 + ($sale->tax*$subtotal)/100}}
                                {{-- $purchase->sub_total; --}}
                            </td>
                            <td>{{ $sale->paid_amount }}</td>
                            <td>  {{$nettotal - $sale->paid_amount}} </td>
                            <td>{{ $sale->sale_date }}</td>
                            <td>{{ $sale->remark }}</td>
                            <td class="justify-content-between">
                                <a href="{{ route('trashsalelist.detail',$sale->id) }}"><i class="fas fa-eye text-success"></i></a>
                                <a href="{{ route('trashsale.restore',$sale->id) }}"><i class="fas fa-arrow-rotate-left text-success"></i></a>
                            </td>
                        </tr>
                        @php $no++; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!--sale dataTable-->

    
</div>
 </div>

<!--main content-->
<@endsection
