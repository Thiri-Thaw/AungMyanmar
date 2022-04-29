@extends('layouts.app')

@section('content')
 <div class="container">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sale List </h1>
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
    <div class="col-md-12 d-flex ">
        <div class="col-md-7 pt-4 ">
                <a href="{{route('sale.create')}}" class="btn btn-info  mb-3" role="button" aria-pressed="true">Add New Sale</a>
        </div>
        <!-- <div class="col-md-2  px-2 ">
            <span ><strong>Total</strong></span><br>
            <input type="text" class="form-control rounded" name="" id="" readonly>
        </div> -->
        {{-- <div class=" col-md-2 px-2 ">
            <span ><strong>From Date</strong></span><br>
            <input type="date" class="form-control rounded" name="fromDate" id="">
        </div>
        <div class="col-md-2 px-2">
            <span ><strong>To Date</strong></span><br>
            <input type="date" class="form-control rounded" name="toDate" id="">
        </div>

        <div class="col-md-1  rounded py-2 my-3 ">
            <button class="form-control btn-outline-secondary">
              Search
            </button>
        </div> --}}
    </div>
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
            <!-- <div class="mb-4">
                <a href="{{route('sale.list')}}" class="btn float-end" >Sale List <i class="fas fa-arrow-right"></i></a>
            </div> -->
            <div class="d-flex justify-content-between m-2">

              <a href="{{route('sale.list')}}" class="text-black">
                 <i class="fas fa-arrow-left"></i> back
              </a>
              @if (auth()->user()->role == 'admin')
              <a href="{{ route('sale.edit',$sale->id) }}" class="text-black">
                   edit Voucher <i class="fas fa-arrow-right"></i>
              </a>
              @endif
            </div>
            <span id="sucess_message"></span>
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Category Name</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">Sale Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
                            <!-- <th scope="col">Action</th> -->
                            <!-- <th scope="col">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; $total=0; @endphp
                        @foreach($sale_details as $detail)
                        @php
                        $total+= $detail->sale_price * $detail->quantity;
                        @endphp
                        <tr>
                            <th scope="row">{{ $no }}</th>
                            <td>{{ $detail->category->name }}</td>
                            <td>{{ $detail->item->name }}</td>
                            <td>{{ $detail->item->code }}</td>
                            <td>{{ $detail->sale_price }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->sale_price * $detail->quantity }}</td>
                            <!-- <td class="justify-content-between">
                                <a href="{{ route('saledetail.edit',$detail->id) }}"><i class="fas fa-edit text-success"></i></a>
                            </td> -->
                        </tr>
                        @php $no++; @endphp
                        @endforeach
                        @php $nettotal = 0; @endphp
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td>Sub Total</td>
                           <td>{{ $total }} MMK</td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td>Tax%</td>
                           <td>{{ $detail->sale->tax }} %</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                           <td>Discount%</td>
                           <td>{{ $detail->sale->discount }} %</td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td>Net Total</td>
                           <td>{{ $nettotal = $total - ($total*($detail->sale->discount)/100) + ($total*($detail->sale->tax)/100) }} MMK</td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td>Paid Amount</td>
                           <td>{{ $detail->sale->paid_amount }} MMK</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                           <td>Left Amount</td>
                           <td>{{ $nettotal - $detail->sale->paid_amount }} MMK</td>
                        </tr>
                    </tbody>
                    {{-- <tfoot> --}}
                    {{-- </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
    <!--sale dataTable-->


</div>
 </div>

<!--main content-->
@endsection

@section('script')
    <script>
        $('#myTable').DataTable({
            "orderFixed": [ 1, 'desc' ],
            "pageLength":-1,
            dom: 'Bfrtip',
            buttons: [
            {
                extend:'excelHtml5',
                // title: 'sale-list',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
            },
            {
                    text: 'print',
                    attr: {class: 'datatablePrintBtn dt-button'},
                    action:function () {
                        window.location.replace('/print-sale-list/'+'{{$sale->voucher_id}}')
                    }
                }
        ]
        })
        $(document).ready(()=>{
            @if(Session::has('save'))
                let yes = confirm('print voucher?');
                if(yes){
                $(document).find('.datatablePrintBtn').click();
                }

            @endif
        })
    </script>
@endsection
