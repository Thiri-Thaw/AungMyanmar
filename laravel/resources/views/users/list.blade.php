@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Admin List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Admin List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- content-header -->
    <div class="d-flex justify-content-end">
        <a href="{{route('user.create')}}" class="btn btn-info btn-sm mb-3" role="button" aria-pressed="true">Add New User</a>
    </div>

    <!-- Admin DataTable -->
    <div class="card mx-auto mb-4 border-info">
        <div class="card-header bg-secondary text-white">Admin Table</div>
        <div class="card-body">
            <span id="sucess_message"></span>
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    {{-- <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$id++}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    <a type="button" style="cursor:pointer" data-id='{{$user->id}}' class="user-edit-btn">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a type="button"  data-id="{{$user->id}}"  class="user-delete-btn">
                                        <i style="color:red;" class="fas fa-trash-alt ml-2 "></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody> --}}
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!--admins dataTable-->

    <!-- edit modal-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="btn" onclick="modal_close()">
                        &times;
                    </button>
                </div>
                <form id="editModalForm">
                        <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">
                                Name <span class='text-danger'></span>
                            </label>
                            <input type="hidden" name="id" id="editId">
                            <input type="text" class="form-control" id="editName" name="edit_name">
                            <span class="error-text text-danger edit_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">
                                Email <span class='text-danger'></span>
                            </label>
                            <input type="email" class="form-control" id="editEmail" name="edit_email">
                            <span class="error-text text-danger edit_email_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="Role" class="col-form-label">
                                Role <span class='text-danger'></span>
                            </label>
                            <select name="edit_role" id="editRole" class="form-select">
                                <option value="admin">admin</option>
                                <option value="casher">casher</option>
                                <option value="manager">manager</option>
                                <option value="" selected>select role ...</option>
                            </select>
                            <span class="error-text text-danger edit_role_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="Password" class="col-form-label">
                                Password <span class='text-danger'></span>
                            </label>
                            <input type="Password" class="form-control" id="editPassword" name="edit_password">
                            <span class="error-text text-danger edit_password_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="modal_close()">Close</button>
                        <button type="submit" class="btn btn-primary" id="user_edit_save_btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- edit modal-->


    <!--delete Modal -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLable">Delete</h5>
                    <button type="button" class="close"  onclick="modal_close()">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    Sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="modal_close()">Close</button>
                    <form action="" id="userDeleteForm">
                        <input type="hidden" name="id" id="deleteId">
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
                 ajax:"{{route('user.gettable')}}",
                 "pageLength":5,
                 "aLengthMenu":[[-1,5,10,25,50],['All',5,10,25,50]],
                 columns:[
                    //  {data:"id",name:"id"},
                    //  {data:"checkbox",name:"checkbox",orderable:false,searchable:false},
                     {data:"DT_RowIndex",name:"DT_RowIndex"},
                     {data:"name",name:"name"},
                     {data:"email",name:"email"},
                     {data:"role",name:"role"},
                     {data:"action",name:"action",orderable:false,searchable:false},
                 ]
    });
    let modal_close = ()=>{
        $('span').text('');
        $('input').val('');
        $('.modal').modal('hide');
    }
    $(document).on('click','.user-edit-btn',function(){
        $('#editModal').modal('show');
        var user_id = $(this).data('id');
        var form = $('#editModalForm')[0];
        $.post("{{route('user.get')}}", {user_id:user_id},
            function (data) {
                // console.log(data.user.name);
                $(form).find('input').val('')
                $(form).find('#editName').val(data.user.name);
                $(form).find('#editEmail').val(data.user.email);
                $(form).find('#editRole').val(data.user.role);
                $(form).find('#editId').val(data.user.id);
                // console.log(data.user);
            },
            "json"
        );

    })
    $(document).on('submit','#editModalForm',function(e){
        e.preventDefault();
        var form = $(this)[0];
        // console.log(form[0]);
        $.ajax({
            type: "post",
            url: "{{route('user.edit')}}",
            data: new FormData(form),
            processData:false,
            dataType: "json",
            contentType:false,
            beforeSend:function(data){
                var loading=`<div class="spinner-border" style="height: 15px;width:15px" role="status">
                </div>`;
                $(form).find('#user_edit_save_btn').html('Save Changes '+loading);
                $("#user_edit_save_btn").addClass('disabled');
            },
            success: function(data) {
                setTimeout(() => {
                        $(form).find('#user_edit_save_btn').html('Save Changes');
                        $(form).find('#user_edit_save_btn').removeClass('disabled');
                        $(form).find('span').text('');
                        $.each(data.error,function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                            var label_span = $(form).find('span.'+prefix+'_error').parents('div.form-group').find('label span');
                            label_span.text('*') ;
                        });
                        if(data.code == 1){
                            toastr.success(data.msg);
                            $('#editModal').modal('hide');
                            $('#myTable').DataTable().ajax.reload(null,false);
                        }

                    }, 500);

            },
        });
    })
    $(document).on('click','.user-delete-btn',function(){
        $('#delete').modal('show');
        var user_id = $(this).data('id');
        var form = $('#userDeleteForm')[0];
        $.post("{{route('user.get')}}", {user_id:user_id},
            function (data) {
                // console.log(data.user.name);
                $(form).find('input').val('');
                $(form).find('#deleteId').val(data.user.id);
            },
            "json"
        );
    })
    $(document).on('submit','#userDeleteForm',function(e){
        e.preventDefault();
        var form = $(this)[0];
        $.ajax({
            type: "post",
            url: "{{route('user.delete')}}",
            data: new FormData(form),
            processData:false,
            dataType: "json",
            contentType:false,
            beforeSend:function(data){
            },
            success: function(data) {
                setTimeout(() => {
                    $('#delete').modal('hide');
                    $('#myTable').DataTable().ajax.reload(null,false);
                    toastr.success(data.msg);
                    }, 500);

            },
        });

    });

</script>
@endsection
