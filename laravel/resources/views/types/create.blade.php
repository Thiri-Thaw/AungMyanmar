@extends('layouts.app')

@section('content')
<!--main content-->
<div class="container">

     <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Account Type Lists</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Acount Type List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-header -->

        
        <div class="d-flex justify-content-end pt-4">
        <button class="btn btn-info btn-sm mb-3" data-toggle="modal" data-target="#addModal" data-whatever="@getbootstrap">Add New Account Type</button>
    </div>

        
        <!--search date-->
                <!-- <div class="col-md-12 d-flex ">
                    <div class="col-md-7 pt-4 ">
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal" data-whatever="@getbootstrap">Add New Company</button>
                    </div>
                    
                    <div class=" col-md-2 px-2 ">
                        <span ><strong>From Date</strong></span><br>
                        <input type="date" class="form-control rounded" name="" id="">
                    </div>
                    <div class="col-md-2 px-2 pl-2">
                        <span ><strong>To Date</strong></span><br>
                        <input type="date" class="form-control rounded" name="" id="">
                    </div>

                    <div class="col-md-1  rounded py-2 my-3 ">
                            <button class="form-control btn-outline-secondary">
                            Search
                            </button>     
                    </div>
                </div> -->
                <!--search date-->
                @if(Session::has('status'))
               <div class="alert alert-dismissible" style="background-color:#90EE90">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                   {{ Session::get('status') }}
                </div>
                @endif
    <!-- company DataTable -->
    <div class="card mx-auto mb-4 border-info">
      <div class="card-header bg-secondary text-white">Account Type Table</div>
      <div class="card-body">
        <span id="sucess_message"></span>
        <div class="table-responsive">
          <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
              <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Remark</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($types as $type)
            <tr>
                <th scope="row">{{ $no }}</th>
                <td>{{ $type->name }}</td>
                <td>{{ $type->remark }}</td>
                <td>{{ $type->status }}</td>
                <td>
                <button type="button" class="btn edit_acctype" value="{{ $type->id }}" data-toggle="modal" data-whatever="@getbootstrap">
                    <i class="fas fa-user-edit"></i>
                </button>
                <a href="{{ route('accounttype.delete',$type->id) }}"><i style="color:red;" class="fas fa-trash-alt ml-2" data-toggle="modal" data-target="#delete" onclick="return confirm('Are you sure to delete this account type')"></i></a>
                </td>
            </tr>
            @php $no++; @endphp
            @endforeach
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <!--company dataTable-->

        <!-- add company model -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add Account Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('accounttype.store') }}" method="post">
                                @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <!-- @if($errors->any())
                                @foreach($errors->get('name') as $err)
                                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                @endforeach
                                @endif -->
                            </div>
                            <div class="form-group">
                                <label for="remark" class="col-form-label">Remark</label>
                                <textarea class="form-control" id="remark" name="remark"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status</label>
                                <select class="form-control form-select" id="status" name="status"  required>
                                    <option selected></option>
                                    <option value="income">Income</option>
                                    <option value="expend">Expend</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
            <!-- add company model -->

        <!-- edit modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Account Type</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="modalClose()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('accounttype.update') }}" method="post">
                 @csrf
                 <input type="hidden" id="acctype_id" name="acctype_id">
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                     <label for="remark" class="col-form-label">Remark</label>
                     <textarea class="form-control" id="remark" name="remark"></textarea>
                </div>
                <div class="form-group">
                     <label for="status" class="col-form-label">Status</label>
                     <select class="form-control" id="status" name="status"  required>
                        <option selected></option>
                        <option value="income">Income</option>
                        <option value="expend">Expend</option>
                     </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="modalClose()">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
            </div>
        </div>
        </div>


        <!--delete Modal -->
        <!-- <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLable" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteLable">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    Sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Ok</button>
                    </div>
                </div>
            </div>
        </div> -->
</div>
<!--main content-->
@endsection

@section('script')
<script>
let modalClose = ()=>{
        $('span').text('');
        $('input').val('');
        $('.modal').modal('hide');
  }

 $(document).ready(function () {
  $(document).on('click', '.edit_acctype',function () {
   var type_id = $(this).val();
    //  alert (type_id);
   $('#editModal').modal('show');

   $.ajax({
            type: "GET",
            url: "/edit-accounttype/"+type_id,
            success: function (response){
                   //console.log(response.accounttype);
                 //  console.log(response.accounttype.remark);
              $('input#name').val(response.accounttype.name);
              $('textarea#remark').val(response.accounttype.remark);
              $('select#status').val(response.accounttype.status);
              $('input#acctype_id').val(type_id);
            }
          });

  });

 });
</script>
@endsection