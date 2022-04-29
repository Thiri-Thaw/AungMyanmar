@extends('layouts.app')
@section('content')
<!--main content-->
<div class="container">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Item List</h1>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Item List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <div class=" pt-4 ">
        <div class="d-flex justify-content-end">
        <a href="{{route('item.create')}}" class="btn btn-info btn-sm mb-3" role="button" aria-pressed="true">Add New Item</a>
        </div>
    </div>

        <!--search date-->
        <!--<div class="col-md-12 d-flex ">
                <div class="col-md-6 pt-4 ">
                        <a href="add-item.php" class="btn btn-info btn-sm mb-3" role="button" aria-pressed="true">Add New Item</a>
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
    <!-- Item DataTable -->
    <div class="card mx-auto mb-4 border-info">
        <div class="card-header bg-secondary text-white">Item Table</div>
        <div class="card-body">
            <span id="sucess_message"></span>
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Category</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Purchase Price</th>
                        <th scope="col">Retail%</th>
                        <th scope="col">Wholesale%</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Description</th>
                        <!-- <th scope="col">Description</th> -->
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($items as $item)
                        <tr>
                            <th scope="row">{{ $no }}</th>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->purchase_price }}</td>
                            <td>{{ $item->retail_price }}</td>
                            <td>{{ $item->wholesale_price }}</td>
                            <td>{{ $item->remark}}</td>
                            <td>{{ $item->description}}</td>
                            <!-- <td>{{ $item->description }}</td> -->
                            <td>
                            <button type="button" class="btn edit_item" value="{{ $item->id }}"><i style="cursor:pointer" class="fas fa-user-edit" data-toggle="modal" data-whatever="@getbootstrap"></i></button>
                            <a href="{{ route('item.delete',$item->id) }}"><i style="color:red;" class="fas fa-trash-alt ml-2" data-toggle="modal" data-target="#delete" onclick="return confirm('Are you sure to delete this item')"></i></a>
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
    <!--item dataTable-->

        <!--edit modal-->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="modalClose()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('item.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" id="item_id">
                <div class="form-group">
                    <label for="categories">Categories*</label>
                        <select id="category" name="category" id="category" class="form-control" aria-label="categories">
                            <!-- <option value="" selected>Choose Category</option> -->
                             @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                </div>
                <div class="form-group">
                    <label for="itemname" class="col-form-label">Name*</label>
                    <input type="text" class="form-control" id="itemname" name="itemname" required>
                </div>
                <div class="form-group">
                    <label for="itemcode" class="col-form-label">Code*</label>
                    <input type="text" class="form-control" id="itemcode" name="itemcode" required>
                </div>
                <div class="form-group">
                    <label for="itemunit" class="col-form-label">Unit*</label>
                    <input type="text" class="form-control" id="itemunit" name="itemunit" required>
                </div>
                <div class="form-group">
                    <label for="purchase" class="col-form-label">Purchase Price*</label>
                    <input type="text" class="form-control" id="purchase" name="purchase" required>
                </div>
                <div class="form-group">
                    <label for="retail" class="col-form-label">Retail Price%</label>
                    <input type="text" class="form-control" id="retail" name="retail" required>
                </div>
                <div class="form-group">
                    <label for="wholesale" class="col-form-label">Wholesale Price%</label>
                    <input type="text" class="form-control" id="wholesale" name="wholesale" required>
                </div>
                <div class="form-group">
                    <label for="remark" class="col-form-label">Remark</label>
                    <textarea class="form-control" id="remark" name="remark"></textarea>
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
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
                <button type="button" class="btn btn-primary">Ok</button>
            </div>
            </div>
        </div>
        </div> -->
        <!--delete modal-->
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
  $(document).on('click', '.edit_item',function () {
   var item_id = $(this).val();
    //   alert (item_id);
    $('#editModal').modal('show');

    $.ajax({
            type: "GET",
            url: "/edit-item/"+item_id,
            success: function (response){
                //  console.log(response.category.remark);
              $('#category').val(response.item.category_id);
              $('#itemname').val(response.item.name);
              $('#itemcode').val(response.item.code);
              $('#itemunit').val(response.item.unit);
              $('#purchase').val(response.item.purchase_price);
              $('#retail').val(response.item.retail_price);
              $('#wholesale').val(response.item.wholesale_price);
              $('#remark').val(response.item.remark);
              $('#description').val(response.item.description);
              $('#item_id').val(item_id);
            }
          });

  });
  });
</script>
@endsection
