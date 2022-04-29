@extends('layouts.app')


@section('content')
<!-- Main content -->
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Add User
                    </h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add User </li>
                    </ol>
                </div>
            </div>
        </div>
</div>

    <!--for add admin -->
      <form id="addUserForm">
         <div class="card-body">
             <div class="mb-4">
                 <a href="{{route('user.list')}}" class="btn float-end" >User List <i class="fas fa-arrow-right"></i></a>
             </div>
            <div class="form-group">
                <label for="Name"> Name</label>
                <input type="text" class="form-control" id="Name" name="user_name">
                <span class="user_name_error text-danger error-text"></span>
            </div>
            <div class="form-group">
                <label for="Role"> Role</label>
                {{-- <input type="text" class="form-control" id="Role" > --}}
                <select name="user_role" class="form-select" id="Role">
                    <option value="admin">
                        admin
                    </option>
                    <option value="manager">
                        manager
                    </option>
                    <option value="casher">
                        casher
                    </option>
                    <option value="" selected>
                        select role ...
                    </option>
                </select>
                <span class="user_role_error text-danger error-text"></span>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input name="user_email" type="email" class="form-control" id="Email" placeholder="Enter email">
                <span class="user_email_error text-danger error-text"></span>
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" class="form-control" id="Password" placeholder="Password" name="user_pass">
                <span class="user_pass_error text-danger error-text"></span>
            </div>

            <button type="submit" class="btn btn-success px-4" id="userAddBtn">
                Add</button>
            <button type="reset" class="btn btn-outline-danger">Cancel</button>

        </div>


      </form>
    <!--for add admin-->
<!--main content-->
@endsection
@section('script')
    {{-- Aung Min Khant Start --}}
    <script>
        // user
        // customer
        // aaccount
        $('#addUserForm').on('submit',function (e) {
            e.preventDefault();
            var form =this;
            $.ajax({
                type: "post",
                url: "{{route('user.add')}}",
                data: new FormData(form),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend:function(data){
                var loading=`<div class="spinner-border" style="height: 15px;width:15px" role="status">
                </div>`;
                $(form).find('#userAddBtn').html(loading);
                $(form).find('#userAddBtn').addClass('disabled');
                },
                success: function (data) {

                    setTimeout(() => {
                        $(form).find('#userAddBtn').html('Add');
                        $(form).find('#userAddBtn').removeClass('disabled');
                        $(form).find('span').text('');
                        $.each(data.error,function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                        if(data.code == 1){
                            toastr.success(data.msg);
                            $(form).find('input').val('');
                        }
                    }, 1000);

                }
            });

        })
    </script>
    {{-- Aung Min Khant End --}}
@endsection
