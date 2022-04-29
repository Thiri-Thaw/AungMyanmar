@extends('layouts.app')
@section('content')
<div class="container">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Categories List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->


    <div class="d-flex justify-content-end pt-4">
        <a href="{{ route('category.create') }}" class="btn btn-info btn-sm mb-3 " role="button"
            aria-pressed="true">Create New Categories</a>
    </div>

    <!--search date-->
    <!-- <div class="col-md-12 d-flex ">
                           <div class="col-md-6 pt-4 ">
                                <a href="create-categories.php" class="btn btn-info btn-sm mb-3" role="button" aria-pressed="true">Create New Categories</a>
                           </div>

                           <div class=" col-md-2 px-2 ">
                               <span ><strong>From Date</strong></span><br>
                               <input type="date" class="form-control rounded" name="" id="">
                           </div>
                           <div class="col-md-2 px-2">
                               <span ><strong>To Date</strong></span><br>
                               <input type="date" class="form-control rounded" name="" id="">
                           </div>

                          <div class="col-md-2 input-group rounded py-2 my-3 ">
                                   <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                           </div>
                       </div> -->
                       <!--search date-->

    @if(Session::has('status'))
    <div class="alert alert-dismissible" style="background-color:#90EE90">
       <button type="button" class="close" data-dismiss="alert">&times;</button>
       {{ Session::get('status') }}
    </div>
    @endif

       <!-- categories DataTable -->
       <div class="card mx-auto mb-4 border-info">
         <div class="card-header bg-secondary text-white">Categories Table</div>
         <div class="card-body">
           <span id="sucess_message"></span>
           <div class="table-responsive">
             <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th scope="col">Id</th>
                       <th scope="col">Name</th>
                       <th scope="col">Remark</th>
                       <th scope="col">Action</th>
                   </tr>
               </thead>
               <tbody>
                   @php $no=1 ; @endphp
                   @foreach($categories as $category)
                   <tr>
                       <th scope="row">{{ $no }}</th>
                       <td>{{ $category->name }}</td>
                       <td>{{ $category->remark }}</td>
                       <td>
                       <button type="button" class="btn edit_category" value="{{ $category->id }}">
                       <i class="fas fa-user-edit"></i>
                       </button>
                       <a href="{{ route('category.delete',$category->id) }}"><i style="color:red;" class="fas fa-trash-alt ml-2" onclick="return confirm('Are you sure to delete this category')"></i></a>
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
       <!--categories dataTable-->

       <!-- add category model -->
       <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add Category</h5>
                            <button type="button" class="close" data-dismiss="modal" onclick="modalClose()">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control name" id="name" name="catname" required>
                            </div>
                            <div class="form-group">
                                <label for="remark" class="col-form-label">Remark</label>
                                <input type="text" class="form-control remark" id="remark" name="remark" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remark" class="col-form-label">Remark</label>
                            <input type="text" class="form-control remark" id="remark" name="remark" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary add_category">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add category model -->

    <!--edit modal-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="modalClose()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.update') }}" method="POST">
                        @csrf
                        <input type="hidden" id="category_id" name="category_id">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control catname" id="catname" name="catname" required>
                            <span style="color:red;" class="catname_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="remark" class="col-form-label">Remark</label>
                            <input type="text" class="form-control remark" id="catremark" name="remark">
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
    <!--edit modal-->

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
                           <button type="button" class="btn btn-primary add_category">Ok</button>
                       </div>
                   </div>
               </div>
           </div> -->
    <!--delete Modal -->
</div>
@endsection

@section('script')
<script>
    let modalClose = ()=>{
        $('span').text('');
        $('input').val('');
        $('.modal').modal('hide');
  }
    $(document).ready(function () {
  $(document).on('click', '.edit_category',function () {
   var cat_id = $(this).val();
    //  alert (cat_id);
   $('#editModal').modal('show');

   $.ajax({
            type: "GET",
            url: "/edit-category/"+cat_id,
            success: function (response){
                //  console.log(response.category.remark);
              $('#catname').val(response.category.name);
              $('#catremark').val(response.category.remark);
              $('#category_id').val(cat_id);
            }
          });

  });

 });
</script>
@endsection
