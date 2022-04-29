@extends('layouts.app')

@section('content')
<!--main content-->
<div class="container">
    {{-- <div class="col-md-12 d-flex ">
        <div class=" col-md-5 pt-4 ">
            <a href="{{route('purchase.create')}}" class="btn btn-info  mb-3" role="button" aria-pressed="true">Add New Purchase</a>
        </div>

        <div class="col-md-2  px-2">
            <span ><strong>Total</strong></span><br>
            <input type="text" class="form-control rounded" name="" id="" readonly>
        </div>
    </div> --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vouncher id - {{$purchases->voucher_id}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Vouncher id - {{$purchases->voucher_id}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between m-2">

        <a href="{{ url()->previous() }}" class="text-black">
            <i class="fas fa-arrow-left"></i> back
        </a>
        <a href="{{url("/edit-purchase-voucher/$purchases->id")}}" class="text-black">
            edit Voucher <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    <table class="table table-bordered text-center" id="myTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Items Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Purchase price</th>
                <th scope="col">Total</th>
                <th scope="col">Item Code</th>
            </tr>
        </thead>
        <tbody>
                @php
                    $id = 0;
                    $total = 0;
                @endphp
                @foreach ($purchase_items as $purchase_item)
                    @php
                        $total +=$purchase_item->price * $purchase_item->quantity;
                        ++$id;
                    @endphp
                    <tr>
                        <td>{{$id}}</td>
                        <td>{{$purchase_item->category->name}}</td>
                        <td>{{$purchase_item->items->name}}</td>
                        <td>{{$purchase_item->quantity}}</td>
                        <td>{{$purchase_item->price}}</td>
                        <td>{{$purchase_item->price * $purchase_item->quantity}}</td>
                        <td>{{$purchase_item->items->code}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >sub total</td>
                    <td>{{$total}}</td>
                    <td>MMK</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >tax</td>
                    <td>{{$purchases->tax}}</td>
                    <td>%</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >discount</td>
                    <td>{{$purchases->discount}}</td>
                    <td>%</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >net total</td>
                    <td>{{$total = $total -($purchases->discount*$total)/100 + ($purchases->tax*$total)/100 }}</td>
                    <td>MMK</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >paid</td>
                    <td>{{$purchases->paid}}</td>
                    <td>MMK</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >left</td>
                    <td>{{$total - $purchases->paid}}</td>
                    <td>MMK</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Remind Date</td>
                    <td>{{$purchases->remind_date}}</td>
                    <td></td>
                    {{-- <td>MMK</td> --}}
                </tr>
        </tbody>
    </table>
    {{-- {{$id}} --}}
</div>
{{-- eidt modal --}}
<div class="modal fade" id="editModal" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-lg btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- eidt modal --}}
<!--main content-->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
        $('#myTable').DataTable({
            "orderFixed": [ 1, 'desc' ],
            "pageLength":-1,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend:'excel',
                },
                {
                    text: 'print',
                    attr: {class: 'datatablePrintBtn dt-button'},
                    action:function () {
                        window.location.replace('/print-purchase-list/'+'{{$purchases->voucher_id}}')
                    }
                }
            ]
        })
        @if(request()->print==true)
                $(document).find('.datatablePrintBtn').click();
        @endif


    })


    </script>
@endsection
