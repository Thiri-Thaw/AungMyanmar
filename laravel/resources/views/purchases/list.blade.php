@extends('layouts.app')

@section('content')
<!--main content-->
<div class="container">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Purchase Table</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Purchase Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!--search date-->
                    <div class="col-md-12 d-flex justify-content-between">
                        <div class=" col-md-5   pt-4">
                            <a href="{{route('purchase.create')}}" class="btn btn-info  mb-3" role="button" aria-pressed="true">Add New Purchase</a>
                        </div>
                        <form action="{{ route('purchase.list') }}" class="col-md-7 row" id="" method="get">
                        @php
                           $from = date('Y-m-d');$to =date('Y-m-d');
                           if(isset($_GET['fromDate'])){
                            $from = $_GET['fromDate'];
                               }
                           if(isset($_GET['toDate'])){
                             $to = $_GET['toDate'];
                                }
                        @endphp
                            <div class="col-md-5  px-2">
                                <span ><strong>From Date</strong></span><br>
                                <input type="date" class="form-control rounded" name="fromDate" id="" value="{{ $from }}">
                            </div>
                            <div class="col-md-5 px-2">
                                <span ><strong>To Date</strong></span><br>
                                <input type="date" class="form-control rounded" name="toDate" id="" value="{{ $to }}">
                            </div>

                <div class="col-md-2 rounded py-2 my-3 px-0">
                    <input type="submit" class="form-control btn-outline-secondary" value="Search" name="search">
                </div>
                {{-- <div class="col-md-2 py-2 my-3 px-1">
                    <a href="{{ url('/inventory-get-item') }}" class="form-control btn btn-outline-info print" >
                        Print
                    </a>
                </div> --}}
            </form>
        </div>
    <!--search date-->



    <!-- purchase DataTable -->
    <div class="card mx-auto mb-4 border-info">
        <div class="card-header bg-secondary text-white">Purchase Table</div>
        <div class="card-body">
            <span id="sucess_message"></span>
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vouncher Id</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Tax</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Left</th>
                            <th scope="col">Date</th>
                            <th scope="col">Remind Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 0;
                        $totalsubtotal = 0;
                        $taxtotal = 0;
                        $discounttotal = 0;
                        $totalnettotal = 0;
                        $paidtotal=0;
                        $lefttotal=0;
                        @endphp
                        <tr>
                        @foreach ($purchases as $purchase)
                        @php
                                $id++;
                                $subtotal = 0;
                                @endphp
                        @foreach ($purchase->purchase_items as $purchase_item)
                        @php
                                $subtotal +=$purchase_item->price * $purchase_item->quantity;
                                @endphp
                        @endforeach
                            <th>{{$id}}</th>
                            <td>{{$purchase->voucher_id}}</td>
                            <td>{{$purchase->company->name}}</td>
                            <td>{{$subtotal}}</td>
                            <td>{{$tax = $purchase->tax}}</td>
                            @php
                            $taxtotal += ($tax*$subtotal)/100;
                            @endphp
                            <td>{{$discount = $purchase->discount}}</td>
                            @php
                            $discounttotal += ($discount*$subtotal)/100;
                            @endphp
                            <td>

                                {{$nettotal = $subtotal-($purchase->discount*$subtotal)/100 + ($purchase->tax*$subtotal)/100}}
                                {{-- $purchase->sub_total; --}}
                            </td>
                            <td>  {{$paid = $purchase->paid}} </td>
                            <td>  {{$left = $nettotal - $purchase->paid}} </td>
                            <td>  {{$purchase->date}} </td>
                            <td>  {{$purchase->remind_date}} </td>
                            <td class="d-flex justify-content-center">
                                <a href="{{url("/list-purchase/$purchase->voucher_id")}}">
                                    <i class="fas fa-eye" style="cursor: pointer"></i>
                                </a>
                                <a href="{{url("/edit-purchase-voucher/$purchase->id")}}">
                                    <i class="fas fa-edit ml-2 text-success" style="cursor: pointer"></i>
                                </a>
                                <a href="{{url("/delete-purchase-voucher/$purchase->id")}}">
                                    <i class="fas fa-trash-alt ml-2 text-danger" style="cursor: pointer"></i>
                                </a>
                            </td>
                        </tr>
                        @php
                        $totalsubtotal+= $subtotal;
                        $totalnettotal += $nettotal;
                        $paidtotal+= $paid;
                        $lefttotal+= $left;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>

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
    <!--purchased dataTable-->

    <!--edit modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
            <div class="form-group">
                <label for="recipient-cname" class="col-form-label">Company Name</label>
                <input type="text" class="form-control" id="recipient-cname">
            </div>
            <div class="form-group">
                <label for="recipient-item" class="col-form-label">Item</label>
                <input type="text" class="form-control" id="recipient-item">
            </div>
            <div class="form-group">
                <label for="recipient-pamount" class="col-form-label">Purchase Amount</label>
                <input type="text" class="form-control" id="recipient-pamount">
            </div>
            <div class="form-group">
                <label for="recipient-discount" class="col-form-label">Discount</label>
                <input type="text" class="form-control" id="recipient-discount">
            </div>
            <div class="form-group">
                <label for="recipient-pdate" class="col-form-label">Purchase Date</label>
                <input type="date" class="form-control" id="recipient-pdate">
            </div>
            <div class="form-group">
                <label for="recipient-remark" class="col-form-label">Remark</label>
                <input type="text" class="form-control" id="recipient-remark">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save Change</button>
        </div>
        </div>
    </div>
    </div>
    <!--edit modal-->


    <!--delete Modal -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteLable">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Sure?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Ok</button>
        </div>
        </div>
    </div>
    </div>
    <!--delete modal-->
</div>
<!--main content-->
@endsection
@section('script')
    <script>

$(document).ready(function () {







        $('.print').printPage();
        $('#myTable').DataTable({
            // "orderFixed": [ 1, 'desc' ],
            dom: 'Bfrtip',
            buttons: [
            {
                extend:'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                    },
            },
            {
                extend: 'print',
                title: '',
                // pageSize: 'B2',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
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
    })
    </script>
@endsection
