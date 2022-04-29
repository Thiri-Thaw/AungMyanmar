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
    <form id="addCustomerForm" action="{{ route('sale.update',$sale->id) }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="customerName"> Customer</label>
                <select name="customer" id="" class="form-select"> 
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}"
                @if($sale->customer_id == $customer->id)
                    selected
                @endif
                >{{ $customer->name }}</option>
                @endforeach
                </select>
            </div>
            <!-- <div class="form-group">
                <label for="subtotal">Sub Total</label>
                <input type="text" class="form-control" id="subtotal" name="subtotal" value="{{ $sale->sub_total }}">
                @if($errors->any())
                @foreach($errors->get('subtotal') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div> -->
            <div class="form-group">
                <label for="tax">Tax</label>
                <input type="text" class="form-control" id="tax" name="tax" value="{{ $sale->tax }}">
                @if($errors->any())
                @foreach($errors->get('tax') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="text" class="form-control" id="discount" name="discount" value="{{ $sale->discount }}">
                @if($errors->any())
                @foreach($errors->get('discount') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <div class="form-group">
                <label for="paid">Paid Amount</label>
                <input type="text" class="form-control" id="paid" name="paid" value="{{ $sale->paid_amount }}">
                @if($errors->any())
                @foreach($errors->get('paid') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <!-- <div class="form-group">
                <label for="left">Left Amount</label>
                <input type="text" class="form-control" id="left" name="left" value="{{ $sale->left_amount }}">
                @if($errors->any())
                @foreach($errors->get('left') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div> -->
            <div class="form-group">
                <label>Remark</label>
                <textarea class="form-control" rows="3" id="remark" name="remark">{{ $sale->remark }}</textarea>
                <span class="remark_error text-danger error-text"></span>
            </div>
            <input type="submit" class="btn btn-success px-4" id="customerAddBtn" value="Update">
            <button type="reset" class="btn btn-outline-danger">Cancel</button>
        </div>
    </form>
    <!--for edit sale-->
<!--main content-->
@endsection

