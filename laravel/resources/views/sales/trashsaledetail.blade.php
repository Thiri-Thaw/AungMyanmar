@extends('layouts.app')

@section('content')
 <div class="container">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trash Sale List </h1>
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
    <div class="col-md-12 d-flex ">
        <div class="col-md-5 pt-4 ">
                <a href="{{route('sale.create')}}" class="btn btn-info  mb-3" role="button" aria-pressed="true">Add New Sale</a>
        </div>
        <!-- <div class="col-md-2  px-2 ">
            <span ><strong>Total</strong></span><br>
            <input type="text" class="form-control rounded" name="" id="" readonly>
        </div> -->
        <div class=" col-md-2 px-2 ">
            <span ><strong>From Date</strong></span><br>
            <input type="date" class="form-control rounded" name="" id="">
        </div>
        <div class="col-md-2 px-2">
            <span ><strong>To Date</strong></span><br>
            <input type="date" class="form-control rounded" name="" id="">
        </div>

        <div class="col-md-1  rounded py-2 my-3 ">
            <button class="form-control btn-outline-secondary">
            Search
            </button>
        </div>
    </div>
    <!--search date-->

    <!-- Sale DataTable -->
    <div class="card mx-auto mb-4 border-info">
        <div class="card-header bg-secondary text-white">Sale Table</div>
        <div class="card-body">
            <div>
                <a href="{{route('saletrash.list')}}" class="btn float-end" >Sale Trash List <i class="fas fa-arrow-right"></i></a>
            </div>
            <span id="sucess_message"></span>
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item Name</th>
                            <th>Category Name</th>
                            <th scope="col">Sale Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
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
                            <td>{{ $detail->item->name }}</td>
                            <td>{{ $detail->category->name }}</td>
                            <td>{{ $detail->sale_price }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->sale_price * $detail->quantity }}</td>
                            <!-- <td class="justify-content-between">
                                <a href=""><i class="fas fa-eye text-success"></i></a>
                                <a href=""><i class="fas fa-trash-alt ml-2 text-danger"></i></a>
                            </td> -->
                        </tr>
                        @php $no++; @endphp
                        @endforeach
                        @php $nettotal = 0; @endphp
                    </tbody>
                    <tfoot>
                    <tr>
                       <td colspan="4" style="border:0px" ></td>
                       <td>Sub Total</td>
                       <td>{{ $total }} MMK</td>
                       
                    </tr>
                    <tr>
                       <td colspan="4" style="border:0px" ></td>
                       <td>Tax</td>
                       <td>{{ $detail->sale->tax }} %</td>
                        
                    </tr>
                    <tr>
                        <td colspan="4" style="border:0px" ></td>
                       <td>Discount</td>
                       <td>{{ $detail->sale->discount }} %</td>
                       
                    </tr>
                    <tr>
                       <td colspan="4" style="border:0px" ></td>
                       <td>Net Total</td>
                       <td>{{ $nettotal = $total - ($total*($detail->sale->discount)/100) + ($total*($detail->sale->tax)/100) }} MMK</td>
                       
                    </tr>
                    <tr>
                       <td colspan="4" style="border:0px" ></td>
                       <td>Paid Amount</td>
                       <td>{{ $detail->sale->paid_amount }} MMK</td>
                        
                    </tr>
                    <tr>
                        <td colspan="4" style="border:0px" ></td>
                       <td>Left Amount</td>
                       <td>{{ $nettotal - $detail->sale->paid_amount}} MMK</td>
                      
                    </tr>
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
