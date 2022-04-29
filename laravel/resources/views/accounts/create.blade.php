@extends('layouts.app')

@section('content')
<!-- Main content -->

<!--content-header-->
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Create Account
                    </h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Account </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--content-header-->

    <!--for create categories-->
    <form id="create-categories" method="post" action="{{ route('account.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="reason"> Reason*</label>
                <input type="text" class="form-control" id="reason" name="reason">
                @if($errors->any())
                @foreach($errors->get('reason') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <div class="form-group">
                <label for="amount"> Amount*</label>
                <input type="text" class="form-control" id="amount" name="amount">
                @if($errors->any())
                @foreach($errors->get('amount') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <div class="form-group">
                <label for="account_type"> Account_Type*</label>
                <select class="form-control" id="account_type" name="type">
                    <option value="" selected>Select Account Type</option>
                    @foreach($accounts as $account)
                     <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                </select>
                    @if($errors->any())
                    @foreach($errors->get('type') as $err)
                    <span style="color:red;" class="catname_error">{{ $err  }}</span>
                    @endforeach
                    @endif
            </div>
            <div class="form-group">
                <label for="enrolldate">Enroll Date</label>
                <input type="date" class="form-control" id="enrolldate" name="enroll_date">
                @if($errors->any())
                @foreach($errors->get('enroll_date') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <div class="form-group">
                <label for="remark"> Remark</label>
                <textarea class="form-control" id="remark" name="remark"></textarea>
            </div>
            <button type="submit" class="btn btn-success px-4">Add</button>
            <button type="reset" class="btn btn-outline-danger">Cancel</button>                  
        </div>
    </form>
    <!--for create categories-->
@endsection