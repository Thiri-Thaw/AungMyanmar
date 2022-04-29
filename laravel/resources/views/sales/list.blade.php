@extends('layouts.app')

@section('content')
 <div class="container">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sale List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Sale Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!--search date-->
    <form action="{{ route('sale.list') }}" method="get">
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
            <!-- <div class="col-md-1 py-2 my-3 px-2">
                <input type="text" name="" class="form-control" value="{{ count($sales) }}" readonly>
             </div> -->
        <div class=" col-md-2 px-2 ">
            <span ><strong>From Date</strong></span><br>
            <input type="date" required class="form-control rounded" name="fromDate" id="" value="{{ $from }}">
        </div>
        <div class="col-md-2 px-2">
            <span ><strong>To Date</strong></span><br>
            <input type="date" required class="form-control rounded" name="toDate" id="" value="{{ $to }}">
        </div>

        <div class="col-md-1  rounded py-2 my-3 ">
           <input type="submit" name='search' class="btn form-control btn-outline-secondary" value="Search">
        </div>
        {{-- <div class="col-md-1  rounded py-2 my-3 ">
           <input type="text" name="" class="btn form-control btn-outline-secondary" value="{{ count($sales) }}" readonly>
        </div> --}}
        <!-- <div class="col-md-1  rounded py-2 my-3 ">
           <input type="text" name="" class="btn form-control btn-outline-secondary"  value="" readonly>
        </div> -->
    </div>
</form>
    <!--search date-->
    @if(Session::has('status'))
    <div class="alert alert-dismissible" style="background-color:#90EE90">
       <button type="button" class="close" data-dismiss="alert">&times;</button>
       {{ Session::get('status') }}
    </div>
    @endif
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
                            <th scope="col">Tax%</th>
                            <th scope="col">Discount%</th>
                            <th scope="col">Net Total</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Left</th>
                            <th scope="col">Date</th>
                            {{-- <th scope="col">Remark</th> --}}
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1;
                        $totalsubtotal = 0;
                        $taxtotal = 0;
                        $discounttotal = 0;
                        $totalnettotal = 0;
                        $paidtotal=0;
                        $lefttotal=0;
                        @endphp
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
                            <td>{{ $tax = $sale->tax }}</td>
                            @php
                            $taxtotal += ($tax*$subtotal)/100;
                            @endphp
                            <td>{{ $discount = $sale->discount }}</td>
                            @php
                            $discounttotal += ($discount*$subtotal)/100;
                            @endphp
                            <td>

                                {{ $nettotal = $subtotal-($sale->discount*$subtotal)/100 + ($sale->tax*$subtotal)/100 }}


                            </td>

                            <td>{{ $paid = $sale->paid_amount }}</td>
                            <td>  {{ $left = $nettotal - $sale->paid_amount}} </td>
                            <td>{{ $sale->sale_date }}</td>
                            {{-- <td>{{ $sale->remark }}</td> --}}
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('salelist.view',$sale->id) }}"><i class="fas fa-eye text-success"></i></a>
                                @if(auth()->user()->role == 'admin')
                                <a href="{{ route('sale.edit',$sale->id) }}"><i class="fas fa-edit text-success"></i></a>
                                <a href="{{ route('sale.delete',$sale->id) }}"><i class="fas fa-trash-alt text-danger" onclick="return confirm('Are you sure to delete this sale')"></i></a>
                                @endif
                            </td>
                        </tr>
                        @php
                        $no++;
                        $totalsubtotal+= $subtotal;
                        $totalnettotal += $nettotal;
                        $paidtotal+= $paid;
                        $lefttotal+= $left;
                        @endphp
                        @endforeach
                        <tfoot>
                            {{-- <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>12000</td>
                                <td></td>
                                <td></td>
                            </tr> --}}
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!--sale dataTable-->
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="form-group">
            <label for="">Total Sub Amount</label>
            <input type="text" value="{{ $totalsubtotal }}" class="form-control" readonly>
            </div>

        </div>
        <div class="col-md-4">
        <div class="form-group">
            <label for="">Total Tax</label>
            <input type="text" value="{{ $taxtotal }}" class="form-control" readonly>
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            <label for="">Total Discount</label>
            <input type="text" value="{{ $discounttotal }}" class="form-control" readonly>
        </div>
        </div>
    <div class="row mt-2">
        <div class="col-md-4">
        <div class="form-group">
            <label for="">Total Net Amount</label>
            <input type="text" value="{{ $totalnettotal }}" class="form-control" readonly>
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            <label for="">Total Paid Amount</label>
            <input type="text" value="{{ $paidtotal }}" class="form-control" readonly>
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
             <label for="">Total Left Amount</label>
            <input type="text" value="{{ $lefttotal }}" class="form-control" readonly>
        </div>
        </div>
    </div>
  </div>
</div>
 </div>

<!--main content-->
@endsection

@section('script')
    <script>
        $('#myTable').DataTable({
            "orderFixed": [ 1, 'desc' ],
            dom: 'Bfrtip',
            buttons: [
            {
                extend:'excel',
                title: 'sale-list',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
            },
            {
                extend: 'print',
                title: '',
                footer:true,
                // pageSize: 'B2',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', 'inherit' )

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        // .css( 'margin-top', '500px' );

                }
            }
        ]
        })
    </script>
@endsection
