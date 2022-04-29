@extends('layouts.app')

@section('content')
<!-- Main content -->
<div class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="m-0">
                                    Add Item
                                </h1>
                            </div><!-- /.col -->
                            
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Add Item </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
<!--for add item-->
                <form id="add-item" action="{{ route('item.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-md-4 ">
                                <label for="categories">Company*</label>
                                <select id="company" name="company" class="form-control" aria-label="categories">
                                    <option value="" selected>Choose Company</option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                    @if($errors->any())
                                    @foreach($errors->get('company') as $err)
                                    <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                     @endforeach
                                     @endif
                            </div> -->
                            <div class="col-md-6 ">
                                <label for="categories">Categories*</label>
                                <select id="category" name="category" class="form-control" aria-label="categories">
                                    <option value="" selected>Choose Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                    @if($errors->any())
                                    @foreach($errors->get('category') as $err)
                                    <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                     @endforeach
                                     @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Code*</label>
                                    <input type="text" class="form-control" id="code" name="code">
                                    @if($errors->any())
                                    @foreach($errors->get('code') as $err)
                                    <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                     @endforeach
                                     @endif
                                </div> 
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="itemName">Item Name*</label>
                                <input type="text" class="form-control" id="itemName" name="itemName">
                                @if($errors->any())
                                @foreach($errors->get('itemName') as $err)
                                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                @endforeach
                                @endif
                            </div>  
                            <div class="col-4">
                                <label for="unit">Unit*</label>
                                <input type="text" class="form-control" id="unit" name="unit">
                                @if($errors->any())
                                @foreach($errors->get('unit') as $err)
                                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                @endforeach
                                @endif
                            </div>                      
                            <div class="col-4">
                                <label for="purchase">Purchase Price*</label>
                                <input type="text" class="form-control" id="purchase" name="purchase">
                                @if($errors->any())
                                @foreach($errors->get('purchase') as $err)
                                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                @endforeach
                                @endif
                            </div> 
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="retail">Retail Price</label>
                                <input type="text" class="form-control" id="retail" name="retail">
                                @if($errors->any())
                                @foreach($errors->get('retail') as $err)
                                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                @endforeach
                                @endif
                            </div>
                            <div class="col-4">
                                <label for="wholesale">Wholesale Price </label>
                                <input type="text" class="form-control" id="wholesale" name="wholesale">
                                @if($errors->any())
                                @foreach($errors->get('wholesale') as $err)
                                <span style="color:red;" class="catname_error">{{ $err  }}</span>
                                @endforeach
                                @endif
                            </div>
                            <div class="col-4">
                                    <label for="remark">Remark </label>
                                    <textarea class="form-control" id="remark" name="remark"></textarea>
                            </div>
                        
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success px-4">Add</button>
                        <button type="reset" class="btn btn-outline-danger">Cancel</button>
                    </div>
                    
                    
                </form>
                <!--for add item-->
@endsection