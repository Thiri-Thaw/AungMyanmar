@extends('layouts.app')

@section('content')
<!-- Main content -->
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Add Customer
                    </h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Customer </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--for add customer-->
    <form id="addCustomerForm">
        <div class="card-body">

            @if(url()->previous() == route('sale.create'))
            <div class="d-flex justify-content-between pt-4">
            <a style="color:black;" href="{{ url()->previous() }}" id='saleback'><i class="fas fa-arrow-left"></i> Back</a>
                <!-- <a style="color:black;" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> back</a> -->
                <a href="{{route('customer.list')}}" class="btn float-end" >Customer List <i class="fas fa-arrow-right"></i></a>
            </div>
            @else
            <div class="d-flex justify-content-end pt-4">
            <a href="{{route('customer.list')}}" class="btn float-end" >Customer List <i class="fas fa-arrow-right"></i></a>
            </div>

            @endif

            <div class="form-group">
                <label for="customerName"> Name</label>
                <input type="text" class="form-control" id="customerName" name="name" >
                <span class="name_error text-danger error-text"></span>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
                <span class="address_error text-danger error-text"></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone">
                <span class="phone_error text-danger error-text"></span>
            </div>
            <div class="form-group">
                <label for="s_type">Sale Type</label>
                <select name="sale_type" id="s_type" class="form-select">
                    <option value="">Select Type....</option>
                    <option value="retail">Retail</option>
                    <option value="whole">Wholesale</option>
                </select>
                <span class="sale_type_error text-danger error-text"></span>
            </div>
            <div class="form-group">
                <label>Remark</label>
                <textarea class="form-control" rows="3" id="addCusRemark" name="remark"></textarea>
                <span class="remark_error text-danger error-text"></span>
            </div>
            <button type="submit" class="btn btn-success px-4" id="customerAddBtn">Add</button>
            <button type="reset" class="btn btn-outline-danger">Cancel</button>
        </div>
    </form>
    <!--for add customer-->
<!--main content-->
@endsection
@section('script')
<script>

    $('#addCustomerForm').on('submit',function (e) {
        e.preventDefault();
        var form =this;
        // console.log(form);
        $.ajax({
                type: "post",
                url: "{{route('customer.add')}}",
                data: new FormData(form),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend:function(data){
                var loading=`<div class="spinner-border" style="height: 15px;width:15px" role="status">
                </div>`;
                $(form).find('#customerAddBtn').html('Add '+loading);
                $(form).find('#customerAddBtn').addClass('disabled');
                },
                success: function (data) {

                    setTimeout(() => {
                        $(form).find('#customerAddBtn').html('Add');
                        $(form).find('#customerAddBtn').removeClass('disabled');
                        $(form).find('span').text('');
                        $.each(data.error,function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                        if(data.code != 0){
                            toastr.success(data.msg);
                        $(form).find('input').val('');
                        }
                    }, 1000);

                }
            });
    })


    $(document).on('click','#saleback',function(){
        $.cookie('back','back')
        window.location.href = "{{route('sale.create')}}";
    })
</script>
@endsection
