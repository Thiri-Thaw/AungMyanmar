@extends('layouts.app')
@section('content')
<div class="container">

    <!-- Content Header (Page header) -->
               <div class="content-header">
                   <div class="container-fluid">
                       <div class="row mb-2">
                           <div class="col-sm-6">
                            <h1>Account List</h1>
                           </div><!-- /.col -->
                           <div class="col-sm-6">
                               <ol class="breadcrumb float-sm-right">
                                   <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                   <li class="breadcrumb-item active">Account List</li>
                               </ol>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- /.content-header -->

               <!-- <div class="d-flex justify-content-end pt-4">
                   <a href="{{ route('account.create') }}" class="btn btn-info btn-sm mb-3" role="button" aria-pressed="true">Create New Account</a>
               </div> -->

                    <!--search date-->
    <form action="{{ route('account.list') }}" method="get">
    <div class="col-md-12 d-flex ">
        <div class="col-md-6 pt-4 ">
                <a href="{{route('account.create')}}" class="btn btn-info  mb-3" role="button" aria-pressed="true">Add New Account</a>
        </div>
        <!-- <div class="col-md-2  px-2 ">
            <span ><strong>Total</strong></span><br>
            <input type="text" class="form-control rounded" name="" id="" readonly>
        </div> -->
        @php
        $from = date('Y-m-d');$to =date('Y-m-d');
        if(isset($_GET['fromDate'])){
            $from = $_GET['fromDate'];
        }
        if(isset($_GET['toDate'])){
            $to = $_GET['toDate'];
        }
        @endphp
        
        <div class=" col-md-2 px-2 ">
            <span ><strong>From Date</strong></span><br>
            <input type="date" class="form-control rounded" name="fromDate" id="" value="{{ $from }}">
        </div>
        <div class="col-md-2 px-2">
            <span ><strong>To Date</strong></span><br>
            <input type="date" class="form-control rounded" name="toDate" id="" value="{{ $to }}">
        </div>

        <div class="col-md-1  rounded py-2 my-3 ">
            <input type="submit" name='search' class="btn form-control btn-outline-secondary" value="Search">
        </div>
    </div>
  </form>
    <!--search date-->

                @if(Session::has('status'))
               <div class="alert alert-dismissible" style="background-color:#90EE90">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                   {{ Session::get('status') }}
                </div>
                @endif

       <!-- categories DataTable -->
       <div class="card mx-auto mb-4 border-info">
         <div class="card-header bg-secondary text-white">Account Table</div>
         <div class="card-body">
           <span id="sucess_message"></span>
           <div class="table-responsive">
             <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th scope="col">Id</th>
                       <th scope="col">Reason</th>
                       <th scope="col">Amount</th>
                       <th scope="col">Account Type</th>
                       <th scope="col">Enroll Date</th>
                       <th scope="col">Remark</th>
                       <th scope="col">Action</th>
                   </tr>
               </thead>
               <tbody>
                   @php $no = 1; @endphp
                   @foreach($accounts as $account)
                   <tr>
                       <th scope="row">{{ $no }}</th>
                       <td>{{ $account->reason }}</td>
                       <td>{{ $account->amount }}</td>
                       <td>{{ $account->type->name }}</td>
                       <td>{{ $account->enroll_date }}</td>
                       <td>{{ $account->remark }}</td>
                       <td>
                       <button type="button" class="btn edit_account" value="{{ $account->id }}"><i class="fas fa-user-edit"></i></button>
                       <a href="{{ route('account.delete',$account->id) }}"><i style="color:red;" class="fas fa-trash-alt ml-2" onclick="return confirm('Are you sure to delete this account')"></i></a>
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

       <!--edit modal-->
           <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                           <button type="button" class="close" data-dismiss="modal" onclick="modalClose()">
                           <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <form action="{{ route('account.update') }}" method="post">
                               @csrf
                               <input type="hidden" id="account_id" name="account_id">
                               <div class="form-group">
                                   <label for="reason" class="col-form-label">Reason*</label>
                                   <input type="text" class="form-control" id="reason" name="reason" required>
                               </div>
                               <div class="form-group">
                                   <label for="amount" class="col-form-label">Amount*</label>
                                   <input type="text" class="form-control" id="amount" name="amount" required>
                               </div>
                               <div class="form-group">
                                  <label for="type" class="col-form-label">Account Type*</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <!-- <option value="" selected>Select Account Type</option> -->
                                         @foreach($accounttypes as $accounttype)
                                        <option value="{{ $accounttype->id }}">{{ $accounttype->name }}</option>
                                         @endforeach
                                     </select> 
                               </div>
                               <div class="form-group">
                                  <label for="enrolldate">Enroll Date</label>
                                  <input type="date" class="form-control" id="enrolldate" name="enroll_date" required>
                                </div>
                                <div class="form-group">
                                   <label for="remark"> Remark</label>
                                   <textarea class="form-control" id="remark" name="remark"></textarea>
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
  $(document).on('click', '.edit_account',function () {
   var account_id = $(this).val();
    //  alert (account_id);
   $('#editModal').modal('show');

   $.ajax({
            type: "GET",
            url: "/edit-account/"+account_id,
            success: function (response){
                //    console.log(response.account);
                 //  console.log(response.account.reason);
              $('input#reason').val(response.account.reason);
              $('input#amount').val(response.account.amount);
              $('input#enrolldate').val(response.account.enroll_date);
              $('textarea#remark').val(response.account.remark);
              $('select#type').val(response.account.type_id);
              $('input#account_id').val(account_id);
            }
          });

  });

 });
</script>
@endsection
