@extends('layouts.app')

@section('content')
<!-- Main content -->

<!--content-header-->
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Create Categories
                    </h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Categories </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--content-header-->
    
    
    <!--for create categories-->
    <form action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="catname"> Name*</label>
                <input type="text" class="form-control name" id="name" name="catname">
                @if($errors->any())
                @foreach($errors->get('catname') as $err)
                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                @endforeach
                @endif
            </div>
            <div class="form-group">
                <label for="remark">Remark</label>
                <input type="text" class="form-control" id="remark" name="remark">
                <span style="color:red;" class="remark_error"></span>
            </div>
            <input type="submit" class="btn btn-success px-4 add" value="Add"></button>
            <button type="reset" class="btn btn-outline-danger">Cancel</button>                 
        </div>
    </form>
    <!--for create categories-->
@endsection

@section('script')
<script>
    // $(catname) catname_error
    // $('.add').on('click',function(e){
    //     e.preventDefault();
    //     // alert($('#catname').val());
    //     if($('#name').val() == ''){
    //         $('.catname_error').html('Category Name Must Not Be Empty!');
    //     }

    // })
    // $(catname) catname_error
    // $('#store').on('submit',function(e){
    //     e.preventDefault();
    //     // alert($('#catname').val());
    //     if($('#remark').val() == ''){
    //         $('.remark_error').html('Remark Must Not Be Empty!');
    //     }

    // })
</script>
@endsection
