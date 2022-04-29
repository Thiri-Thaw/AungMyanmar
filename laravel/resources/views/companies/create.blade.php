@extends('layouts.app')

@section('content')
<!--main content-->
<div class="container">

     <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Company List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Company List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-header -->



        @if(url()->previous() == route('purchase.create'))
            <div class="d-flex justify-content-between pt-4">
                <a href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> back</a>
                <button class="btn btn-info btn-sm mb-3 add_country">Add New Company</button>
            </div>
            @else
            <div class="d-flex justify-content-end pt-4">
                <button class="btn btn-info btn-sm mb-3 add_country">Add New Company</button>
            </div>

        @endif


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
      <div class="card-header bg-secondary text-white">Company Table</div>
      <div class="card-body">
        <span id="sucess_message"></span>
        <div class="table-responsive">
          <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
              <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Company Name</th>
            <th scope="col">Remark </th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
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

                           <div id="success_message"></div>

                            <h5 class="modal-title" id="addModalLabel">Add Company</h5>
                            <button type="button" class="close" onclick="modalClose()" >
                            <span>&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('company.store') }}" id="company_add">
                            @csrf
                            <div class="modal-body">

                               <ul id="saveForm_errList"></ul>

                                <div class="form-group">
                                    <label for="Name" class="col-form-label">Name*</label>
                                    <input type="text" class="form-control company_name" id="Name" name="company_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="Remark" class="col-form-label">Remark</label>
                                    <input type="text" class="form-control company_remark" id="Remark" name="company_remark">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="modalClose()" >Close</button>
                                <button type="submit" class="btn btn-primary add_company">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- add company model -->

        <!-- edit modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <form action="{{ route('company.update') }}" method="POST">
                  @csrf
                  <input type="hidden" id="company_id" name="company_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name*</label>
                        <input type="text" class="form-control" id="companyname" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="remark" class="col-form-label">Remark</label>
                        <input type="text" class="form-control" id="companyremark" name="remark">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="modalClose()">Close</button>
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
                        <button type="submit" class="btn btn-primary">Ok</button>
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
$('#myTable').DataTable({
    ajax : "{{route('companydetail.get')}}",
    columns:[
        {data: "DT_RowIndex", name: "DT_RowIndex"},
        {data:'name',name:'name'},
        {data:'remark',name:'remark'},
        {data:'action',name:'action'},
    ],
});
  $(document).ready(function () {
  $(document).on('click', '.edit_company',function () {
   var company_id = $(this).val();
    //   alert (company_id);
   $('#editModal').modal('show');

   $.ajax({
            type: "GET",
            url: "/edit-company/"+company_id,
            success: function (response){
                //  console.log(response.company.remark);
              $('#companyname').val(response.company.name);
              $('#companyremark').val(response.company.remark);
              $('#company_id').val(company_id);
            }
          });

  });

  $('.add_country').click(()=>$('#addModal').modal('show'));
  $(document).on('submit','#company_add',function(e){
      e.preventDefault();
      var form = $(this)[0];
      $.ajax({
                type: "post",
                url: "{{route('company.store')}}",
                data: new FormData(form),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend:function(data){

                },
                success: function(data){
                    toastr.success(data.msg);
                    $('#myTable').DataTable().ajax.reload(null,false);
                    $('#addModal').modal('hide');
                    $('#Name').val('');
                    $('#Remark').val('');
                }
            });
  })

 });

</script>

@endsection
