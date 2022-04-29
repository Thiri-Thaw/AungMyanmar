@extends('layouts.app')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Inventory</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Inventory</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->
        <!--search date-->
        <div class="col-md-12 d-flex justify-content-end">
            {{-- <div class=" col-md-5 pt-4">
                <a href="{{route('purchase.create')}}" class="btn btn-info  mb-3" role="button" aria-pressed="true">Add New Purchase</a>
            </div> --}}

            {{-- <div class="col-md-2  px-2 ">
                <span ><strong>Total</strong></span><br>
                <input type="text" class="form-control rounded" name="" id="" readonly>
            </div> --}}
            <form class="col-md-5 row" id="date-search" method="get" action="{{route('inventory.list')}}">
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
        <!-- inventory DataTable -->
        <div class="card mx-auto mb-4 border-info">
            <div class="card-header bg-secondary text-white">Inventory Table</div>
            <div class="card-body">
            <span id="sucess_message"></span>
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Open Stock</th>
                        <th scope="col">Purchase Stock</th>
                        <th scope="col">Sale Stock</th>
                        <th scope="col">Close Stock</th>
                        {{-- <th> Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                            @php
                                $op_storke = 0;
                            @endphp
                                @foreach ($op_p_items as $purchase_item)
                                    @if($purchase_item->item_id == $item->id)
                                        @php
                                            $op_storke+=$purchase_item->quantity;
                                        @endphp
                                    @endif
                                @endforeach
                                @foreach ($op_s_items as $sale_item)
                                    @if($sale_item->item_id == $item->id)
                                        @php
                                            $op_storke-=$sale_item->quantity;
                                        @endphp
                                    @endif
                                @endforeach
                                {{$op_storke}}
                            </td>
                            <td>
                                @php
                                    $p_storke = 0;
                                @endphp
                                @foreach ($purchase_items as $purchase_item)
                                    @if($purchase_item->item_id == $item->id)
                                        @php
                                            $p_storke+=$purchase_item->quantity;
                                        @endphp
                                    @endif
                                @endforeach
                                {{$p_storke}}
                            </td>
                            <td>
                                @php
                                    $sale_storke = 0;
                                @endphp
                                    @foreach ($sale_details as $sale_item)
                                    @if($sale_item->item_id == $item->id)
                                        @php
                                            $sale_storke+=$sale_item->quantity;
                                        @endphp
                                    @endif
                                @endforeach
                                    {{$sale_storke}}
                            </td>
                            <td>
                                {{$op_storke+$p_storke-$sale_storke}}
                            </td>
                        </tr>
                        @endforeach
                        <!-- <tr>
                            <th scope="row">1</th>
                            <td>Aung Aung</td>
                            <td>Mandalay</td>
                            <td>09-----</td>
                            <td>Lorem ipsum dolor sit, amet consectetur</td>
                            <td><i style="cursor:pointer" class="fas fa-user-edit" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"></i>
                            <i style="color:red;" class="fas fa-trash-alt ml-2" data-toggle="modal" data-target="#delete"></i></td>
                        </tr>  -->
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            </div>
        </div>
        <!--inventory dataTable-->
    </div>
@endsection
{{-- ajax:"{{route('inventory.get_item')}}",
            columns:[
            {data: "DT_RowIndex", name: "DT_RowIndex"},
            {data:'cat_name',name:'cat_name'},
            {data:'name',name:'name'},
            {data:'op_storke',name:'op_storke'},
            {data:'p_storke',name:'p_storke'},
            {data:'s_storke',name:'s_storke'},
            {data:'c_storke',name:'c_storke'},
            ] --}}
@section('script')
    <script>
        $('#myTable').DataTable({
            "pageLength":-1,
            "aLengthMenu":[[-1,5,10,25,50],['All',5,10,25,50]],

        });
        </script>
@endsection
{{-- $('#date-search').on('submit',function (e) {
    e.preventDefault();
    var form = $(this)[0];
    console.log(form);
    $.ajax({
        type: "post",
        url: "{{route('inventory.get_item_by_date')}}",
        data: new FormData(form),
        processData:false,
        dataType: "json",
        contentType:false,
        success: function (data) {
            // console.log(data);
            $('#myTable').DataTable().ajax.reload(null,false);

        }
    });
}) --}}
