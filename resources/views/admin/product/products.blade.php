@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                @if(Session::has('success_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 {{ Session::get('success_message') }}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               @endif
                <h3 class="card-title">Products</h3>
                <a href="{{ url('admin/add-edit-product') }}" style="max-width:150px;float:right;display:inline-block;" class="btn btn-block btn-success">Add Product</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Product  code</th>
                    <th>Product Color</th>
                    <th>Product image</th>
                    <th>category</th>
                    <th>section</th>
                    <th>Status</th>
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ( $products as $view_products)
                      <tr>
                          <td>{{ $view_products->id }}</td>
                        <td>{{ $view_products->product_name }}</td>
                        <td>{{ $view_products->product_code }}</td>
                        <td>{{ $view_products->product_color }}</td>
                        <td>
                          @if(!empty($view_products->main_image))
                          <img style="width:100px;" src="{{ asset('images/products_images/small/'.$view_products->main_image ) }}">
                         @else
                         <img style="width:100px;" src="{{ asset('images/products_images/small/no-image.png' ) }}">
                          @endif
                        </td>
                        <td>{{ $view_products->category_name }}</td>
                        <td>{{ $view_products->section->name }}</td>
                       
                        <td>
                          @if($view_products->status ==1 )
                               <a class="UpdateProductStatus" id="product-{{$view_products->id}}" product_id="{{$view_products->id}}" href="javascript:void(0)">Active</a> 
                           @else 
                           <a class="UpdateProductStatus" id="product-{{$view_products->id}}" product_id="{{$view_products->id}}" href="javascript:void(0)">InActive</a> 

                           @endif
                           
                        </td>
                        <td>
                         <a href="{{ url('admin/add-edit-product') }}/{{ $view_products->id }}">Edit</a></br>
                         <a href="javascript:void(0)"  class="confirmDelete" record="product" recordid="{{ $view_products->id }}">Delete</a>
                        </td>  
                      </tr> 
                      @endforeach
                   
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection