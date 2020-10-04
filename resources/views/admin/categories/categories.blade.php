@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"></li>
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
                <h3 class="card-title">categories</h3>
                <a href="{{ url('admin/add-edit-category') }}" style="max-width:150px;float:right;display:inline-block;" class="btn btn-block btn-success">Add Category</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Section</th>
                    <th>Parent Category</th>
                    <th>Name</th>
                    <th>Url</th>
                    <th>Status</th>
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ( $categories as $view_categories )
                        @if(!isset($category->parentcategory->category_name))
                          <?php $parent_category ="Root" ;?>
                         @else
                        <?php $parent_category=$view_categories->parentcategory->category_name;?>
                         @endif
                      <tr>
                        <td>{{ $view_categories->id }}</td>
                        <td>{{ $view_categories->section->name }}</td>
                        <td>{{$parent_category }}</td>
                        <td>{{ $view_categories->category_name }}</td>
                        <td>{{ $view_categories->url }}</td>
                        <td>
                          @if($view_categories->status ==1 )
                               <a class="UpdateCategoryStatus" id="category-{{$view_categories->id}}" category_id="{{$view_categories->id}}" href="javascript:void(0)">Active</a> 
                           @else 
                           <a class="UpdateCategoryStatus" id="category-{{$view_categories->id}}" category_id="{{$view_categories->id}}" href="javascript:void(0)">InActive</a> 

                           @endif
                           
                        </td>
                        <td>
                         <a href="{{ url('admin/add-edit-category') }}/{{ $view_categories->id }}">Edit</a>
                         &nbsp;&nbsp;
                         <a  href="javascript:void(0)" class="confirmDelete" record="category" recordid="{{$view_categories->id}}" >Delete</a>
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