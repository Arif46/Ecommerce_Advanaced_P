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
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <!-- /.card -->

        <!-- SELECT2 EXAMPLE -->
        <form name="categpryForm" id="CategoryForm" @if(!empty($categorydata['id'])) action="{{ url('admin/add-edit-category')}}" @endif action="{{ url('admin/add-edit-category'.$categorydata['id'])}}"  method="post" enctype="multipart/form-data">
          @csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Category Name:</label>
                    <input type="text" name="category_name" id="category_name" class="form-control"   placeholder="Enter Category Name" required @if(!empty($categorydata->category_name)) value="{{ $categorydata->category_name }}"
                    @else value="{{ old('category_name') }}" @endif>
                  </div>
                <div class="form-group">
                  <label>Select Section</label>
                  <select name="section_id" id="section_id" class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">select</option>
                    @foreach ($getSections as $sections)
                    <option value="{{$sections->id }}" @if(!empty($categorydata->section_id)
                      && $categorydata->section_id==$sections->id) selected @endif>{{ $sections->name }}</option>   
                    @endforeach
                  </select>
                </div>
                <!-- /.form-group -->
              <div id="appendCategoryLevel">
                @include('admin.categories.append_categories_level')
              </div>
             


                <div class="form-group">
                    <label for="description">Category Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter ..."  @if(!empty($categorydata->description)) value="{{ $categorydata->description }}"
                    @else value="{{ old('description') }}" @endif></textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ..."  @if(!empty($categorydata->meta_description)) value="{{ $categorydata->meta_description}}"
                    @else value="{{ old('meta_description') }}" @endif></textarea>
                  </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputFile">Category Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="category_image" name="category_image" required>
                        <label class="custom-file-label" for="category_image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                <!-- /.form-group -->
              
                    <div class="form-group">
                        <label for="category_discount">Category Discount:</label>
                        <input type="text" id="category_discount" name="category_discount" class="form-control"   placeholder="Enter Category Discount" required @if(!empty($categorydata->category_discount)) value="{{ $categorydata->category_discount }}"
                        @else value="{{ old('category_discount') }}" @endif>
                      </div>
                      <div class="form-group">
                        <label for="url">Category Url</label>
                        <input type="text" id="url" name="url" class="form-control"   placeholder="Enter Category URl"  @if(!empty($categorydata->url)) value="{{ $categorydata->url }}"
                        @else value="{{ old('url') }}" @endif>
                      </div>
                      <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ..."  @if(!empty($categorydata->meta_title)) value="{{ $categorydata->meta_title }}"
                        @else value="{{ old('meta_title') }}" @endif></textarea >
                      </div>
                      <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ..."  @if(!empty($categorydata->meta_keywords)) value="{{ $categorydata->meta_keywords }}"
                        @else value="{{ old('meta_keywords') }}" @endif></textarea>
                      </div>
                      
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" btn-center class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
        <!-- /.card -->

       
        <!-- /.card -->

       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection