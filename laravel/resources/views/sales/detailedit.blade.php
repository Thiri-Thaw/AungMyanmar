@extends('layouts.app')

@section('content')
<!-- Main content -->
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Edit Sale
                    </h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Sale</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--for edit sale-->
    <div>
        <a href="{{ route('sale.list') }}" class="btn float-end" >Sale List <i class="fas fa-arrow-right"></i></a>
    </div>
    <form action="{{ route('saledetail.update',$sale_details->id) }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="customerName"> Item Name</label>
                <select name="item" id="" class="form-select"> 
                @foreach($items as $item)
                <option value="{{ $item->id }}"
                @if($sale_details->item_id == $item->id)
                    selected
                @endif
                >{{ $item->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Sale Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $sale_details->sale_price }}">
                @if($errors->any())
                @foreach($errors->get('price') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="text" class="form-control" id="qty" name="qty" value="{{ $sale_details->quantity }}">
                @if($errors->any())
                @foreach($errors->get('qty') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <input type="hidden" value="{{ $sale_details->sale_id }}" name="sale_id"> 
            <input type="submit" class="btn btn-success px-4" id="customerAddBtn" value="Update">
            <button type="reset" class="btn btn-outline-danger">Cancel</button>
        </div>
    </form>
    <!--for edit sale-->
<!--main content-->
@endsection

