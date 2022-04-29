@extends('layouts.app')
@section('content')
<!--main content-->
<div class="container">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Customer List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <div class="d-flex justify-content-end">
        <a href="{{route('customer.create')}}" class="btn btn-info btn-sm mb-3" role="button" aria-pressed="true">Add New Customer</a>
    </div>

    <!-- customer DataTable -->
    <div class="card mx-auto mb-4 border-info">
      <div class="card-header bg-secondary text-white">Customer Table</div>
      <div class="card-bremark
      remarkody">
        <span id="sucess_message"></span>
        <div class="table-responsive">
          <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
              <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Phone-number</th>
            <th >Type</th>
            <th >Net Total</th>
            <th >Paid</th>
            <th >Left</th>
            <th >Remark</th>
            <th> Action</th>
            </tr>
        </thead>
        <tbody>
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
    <!--customer dataTable-->


    <!--edit modal-->
    <div class="modal fade" id="cusEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" onclick="modal_close()">
                    &times;
                    </button>
                </div>
                <form id="cusEditForm">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="cusName" class="col-form-label">Name  <span class='text-danger'></span></label>
                            <input type="hidden" class="form-control" id="cusId" name="id">
                            <input type="text" class="form-control" id="cusName" name="name">
                            <span class="name_error text-danger error-text"></span>
                        </div>
                        <div class="form-group">
                            <label for="cusAddress" class="col-form-label">Address  <span class='text-danger'></span></label>
                            <input type="text" class="form-control" id="cusAddress" name="address">
                            <span class="address_error text-danger error-text"></span>
                        </div>
                        <div class="form-group">
                            <label for="cusPhone" class="col-form-label">Phone Number  <span class='text-danger'></span></label>
                            <input type="phone" class="form-control" id="cusPhone" name="phone">
                            <span class="phone_error text-danger error-text"></span>
                        </div>
                        <div class="form-group">
                            <label for="cusType">Sale Type</label>
                            <select name="sale_type" id="cusType" class="form-select">
                                <option value="">Select Type....</option>
                                <option value="retail">Retail</option>
                                <option value="whole">Wholesale</option>
                            </select>
                            <span class="sale_type_error text-danger error-text"></span>
                        </div>
                        <div class="form-group">
                            <label for="cusRemark" class="col-form-label">Remark  <span class='text-danger'></span></label>
                            <input type="text" class="form-control" id="cusRemark" name="remark">
                            <span class="remark_error text-danger error-text"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="modal_close()">Close</button>
                        <button type="submit" class="btn btn-primary" id="customer_edit_save_btn">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--edit modal-->


    <!--delete Modal -->
    <div class="modal fade" id="deleteCusModal" tabindex="-1" aria-labelledby="deleteLable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLable">Delete</h5>
                    <button type="button" class="close" onclick="modal_close()">
                    &times;
                    </button>
                </div>
                <div class="modal-body">
                Sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="modal_close()">Close</button>
                    <form action="" id="cusDeleteForm">
                        <input type="hidden" name="id" id="cusDelete">
                        <button type="submit" class="btn btn-primary">Ok</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--delete modal-->
</div>
@endsection
@section('script')
    <script>
         $('#myTable').DataTable({
                 // processing:true,
                info:true,
                 ajax:"{{route('customer.get')}}",
                 "pageLength":5,
                 "aLengthMenu":[[-1,5,10,25,50],['All',5,10,25,50]],
                 columns:[
                    //  {data:"id",name:"id"},
                    //  {data:"checkbox",name:"checkbox",orderable:false,searchable:false},
                     {data:"DT_RowIndex",name:"DT_RowIndex"},
                     {data:"name",name:"name"},
                     {data:"address",name:"address"},
                     {data:"phone",name:"phone"},
                     {data:"sale_type",name:"sale_type"},
                     {data:"net",name:"net"},
                     {data:"paid",name:"paid"},
                     {data:"left",name:"left"},
                     {data:"remark",name:"remark"},
                     {data:"action",name:"action",orderable:false,searchable:false},
                 ]
    });
    let modal_close = ()=>{
        $('span').text('');
        $('input').val('');
        $('.modal').modal('hide');
    }
    $(document).on('click','.customer-edit-btn',function (e) {
        $('#cusEditModal').modal('show');
        var user_id = $(this).data('id');
        var form = $('#cusEditForm')[0];
        $.post("{{route('customer.getDetail')}}", {user_id:user_id},
            function (data) {
                // console.log(data.user.name);
                $(form).find('input').val('')
                $(form).find('#cusName').val(data.customer.name);
                $(form).find('#cusAddress').val(data.customer.address);
                $(form).find('#cusPhone').val(data.customer.phone);
                $(form).find('#cusRemark').val(data.customer.remark);
                $(form).find('#cusId').val(data.customer.id);
                $(form).find('#cusType').val(data.customer.sale_type);
                // console.log(data.user);
            },
            "json"
        );
    })
    $(document).on('submit','#cusEditForm',function (e) {
        e.preventDefault();
        var form = $(this)[0];
        // console.log(form);
        $.ajax({
            type: "post",
            url: "{{route('customer.edit')}}",
            data: new FormData(form),
            processData:false,
            dataType: "json",
            contentType:false,
            beforeSend:function(data){
                var loading=`<div class="spinner-border" style="height: 15px;width:15px" role="status">
                </div>`;
                $(form).find('#customer_edit_save_btn').html('Save Changes '+loading);
                $("#customer_edit_save_btn").addClass('disabled');
            },
            success: function(data) {
                setTimeout(() => {
                        $(form).find('#customer_edit_save_btn').html('Save Changes');
                        $(form).find('#customer_edit_save_btn').removeClass('disabled');
                        $(form).find('span').text('');
                        $.each(data.error,function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                            var label_span = $(form).find('span.'+prefix+'_error').parents('div.form-group').find('label span');
                            label_span.text('*') ;
                        });
                        if(data.code == 1){
                            toastr.success(data.msg);
                            $('#cusEditModal').modal('hide');
                            $('#myTable').DataTable().ajax.reload(null,false);
                        }

                    }, 500);

            },
        });
    })
    $(document).on('click','.customer-delete-btn',function (e) {
        $('#deleteCusModal').modal('show');
        var user_id = $(this).data('id');
        var form = $('#cusDeleteForm')[0];
        $(form).find('#cusDelete').val(user_id);
    })
    $(document).on('submit','#cusDeleteForm',function (e) {
        e.preventDefault();
        var form = $(this)[0];
        $.ajax({
            type: "post",
            url: "{{route('customer.delete')}}",
            data: new FormData(form),
            processData:false,
            dataType: "json",
            contentType:false,
            beforeSend:function(data){
            },
            success: function(data) {
                setTimeout(() => {
                    $('#deleteCusModal').modal('hide');
                    $('#myTable').DataTable().ajax.reload(null,false);
                    toastr.success(data.msg);
                    }, 500);

            },
        });
    })
    </script>
@endsection
