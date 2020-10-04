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
        <form name="categpryForm" id="productForm"  action="{{ url('admin/add-edit-product')}}"  method="post" enctype="multipart/form-data">
            {{-- <form name="categpryForm" id="productForm" @if(!empty($productdata['id'])) action="{{ url('admin/add-edit-product')}}" @endif action="{{ url('admin/add-edit-product'.$productdata['id'])}}"  method="post" enctype="multipart/form-data"> --}}
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
                    <label>Select Product</label>
                    <select name="category_id" id="category_id" class="form-control select2bs4" style="width: 100%;">
                      <option selected="selected">select</option>
                     @foreach ($categories as $section )
                       <optgroup label={{ $section['name'] }}></optgroup>
                       @foreach ($section['categories'] as $category )
                       <option value="{{ $category['id'] }}" @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) selected="" @elseif(!empty($productdata['category_id']) &&
                       $productdata['category_id']==$category['id'])  @endif>{{ $category['category_name'] }}</option> 
                        @foreach ($category['subcategories'] as $subcategory )
                            <option value="{{ $subcategory['id'] }}">{{ $subcategory['category_name'] }}</option>
                        @endforeach
                       @endforeach
                     @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label>product Name:</label>
                    <input type="text" name="product_name" id="product_name" class="form-control"   placeholder="Enter product Name"  @if(!empty($productdata['product_name'])) value="{{ $productdata['product_name'] }}"
                    @else value="{{ old('product_name') }}" @endif>
                  </div>
              </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_code">product code:</label>
                        <input type="text" name="product_code" id="product_code" class="form-control"   placeholder="Enter product Name"  @if(!empty($productdata['product_code'])) value="{{ $productdata['product_code'] }}"
                        @else value="{{ old('product_code') }}" @endif>
                      </div>
                      <div class="form-group">
                        <label for="product_color">product color:</label>
                        <input type="text" name="product_color" id="product_color" class="form-control"   placeholder="Enter product color"  @if(!empty($productdata['product_color'])) value="{{ $productdata['product_color'] }}"
                        @else value="{{ old('product_color') }}" @endif>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_price">product price:</label>
                        <input type="text" name="product_price" id="product_price" class="form-control"   placeholder="Enter product price"  @if(!empty($productdata['product_price'])) value="{{ $productdata['product_price'] }}"
                        @else value="{{ old('product_price') }}" @endif>
                      </div>
                      <div class="form-group">
                        <label for="product_discount">product Discount(%)</label>
                        <input type="text" name="product_discount" id="product_discount" class="form-control"   placeholder="Enter product discount"  @if(!empty($productdata['product_discount'])) value="{{ $productdata['product_discount'] }}"
                        @else value="{{ old('product_discount') }}" @endif>
                      </div>

                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_weight">product Weight:</label>
                        <input type="text" name="product_weight" id="product_weight" class="form-control"   placeholder="Enter product price"  @if(!empty($productdata['product_weight'])) value="{{ $productdata['product_weight'] }}"
                        @else value="{{ old('product_weight') }}" @endif>
                      </div>
                      <div class="form-group">
                        <label for="main_image">product main Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="main_image" name="main_image" >
                            <label class="custom-file-label" for="main_image">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div>
                        </div>
                      </div>

                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_video">product video</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="product_video" name="product_video" >
                            <label class="custom-file-label" for="product_video">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="description">product Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter ..."  @if(!empty($productdata['description'])) value="{{ $productdata['description'] }}"
                        @else value="{{ old('description') }}" @endif></textarea>
                      </div>
                 </div>
                 
               
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="wash_care">Wash Care</label>
                        <input type="text" name="wash_care" id="wash_care" class="form-control"   placeholder="Enter wash_care"  @if(!empty($productdata['wash_care'])) value="{{ $productdata['wash_care']}}"
                        @else value="{{ old('wash_care') }}" @endif>
                      </div>
                      <div class="form-group">
                        <label >Select Fabric(%)</label>
                        <select name="fabric" id="fabric" class="form-control select2bs4" style="width: 100%;">
                          <option value="selected" >select</option>
                          @foreach ($fabricArray as $fabric )
                          <option value="{{ $fabric }}" @if(!empty($productdata['fabric']) &&
                          $productdata['fabric']== $fabric) selected="" @endif>{{ $fabric }}</option>
                              
                          @endforeach
                        </select>
                      </div>

                 </div>
                   
                 <div class="col-md-6">
                  <div class="form-group">
                    <label >Select sleeve</label>
                    <select name="sleeve" id="sleeve" class="form-control select2bs4" style="width: 100%;">
                      <option value="selected">select</option>
                      @foreach ($sleeveArray as $sleeve )
                      <option value="{{ $sleeve }}" @if(!empty($productdata['sleeve']) &&
                      $productdata['sleeve']== $sleeve) selected="" @endif>{{ $sleeve }}</option>
                          
                      @endforeach
                    </select>
                  </div>
                  
                    <div class="form-group">
                      <label >Select pattern</label>
                      <select name="pattern" id="pattern" class="form-control select2bs4" style="width: 100%;">
                        <option value="selected">select</option>
                        @foreach ($patternArray as $pattern )
                        <option value="{{ $pattern }}" @if(!empty($productdata['pattern']) &&
                        $productdata['pattern']== $pattern) selected="" @endif >{{ $pattern }}</option>
                            
                        @endforeach
                      </select>
                    </div>

               </div>
               <div class="col-md-6">
                <div class="form-group">
                  <label >Select fit</label>
                  <select name="fit" id="fit" class="form-control select2bs4" style="width: 100%;">
                    <option value="selected">select</option>
                    @foreach ($fitArray as $fit )
                    <option value="{{ $fit }}" @if(!empty($productdata['fit']) &&
                    $productdata['fit']== $fit) selected="" @endif>{{ $fit }}</option>
                        
                    @endforeach
                  </select>
                </div>
               
                  <div class="form-group">
                    <label >Select occassion</label>
                    <select name="occassion" id="occassion" class="form-control select2bs4" style="width: 100%;">
                      <option value="selected">select</option>
                      @foreach ($occassionArray as $occassion )
                      <option value="{{ $occassion }}" @if(!empty($productdata['occassion']) &&
                      $productdata['occassion']== $occassion) selected="" @endif>{{ $occassion }}</option>
                          
                      @endforeach
                    </select>
                  </div>

             </div>
               
                
              
                <!-- /.form-group -->
                
                 
                <!-- /.form-group -->
             
              <!-- /.col -->
              

            
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputFile">product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="product_image" name="product_image" >
                        <label class="custom-file-label" for="product_image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                <!-- /.form-group -->
              
                    <div class="form-group">
                        <label for="product_discount">product Discount:</label>
                        <input type="text" id="product_discount" name="product_discount" class="form-control"   placeholder="Enter product Discount"  @if(!empty($productdata['product_discount'])) value="{{ $productdata['product_discount']}}"
                        @else value="{{ old('product_discount') }}" @endif>
                      </div>
                      <div class="form-group">
                        <label for="url">product Url</label>
                        <input type="text" id="url" name="url" class="form-control"   placeholder="Enter product URl"  @if(!empty($productdata['url'])) value="{{ $productdata['url'] }}"
                        @else value="{{ old('url') }}" @endif>
                      </div>
                      <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ..."  @if(!empty($productdata['meta_title'])) value="{{ $productdata['meta_title'] }}"
                        @else value="{{ old('meta_title') }}" @endif></textarea >
                      </div>
                      <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ..."  @if(!empty($productdata['meta_keywords'])) value="{{ $productdata['meta_keywords'] }}"
                        @else value="{{ old('meta_keywords') }}" @endif></textarea>
                      </div>

                      <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ..."  @if(!empty($productdata['meta_description'])) value="{{ $productdata['meta_description'] }}"
                        @else value="{{ old('meta_description') }}" @endif></textarea>
                      </div>
                      <div class="form-group">
                        <label for="meta_keywords">Featured Item</label>
                        <input type="checkbox" name="is_featured" id="is_featured" value="yes" @if(!empty($productdata['is_featured']) &&
                        $productdata['is_featured']== "yes") checked="" @endif > 
                      </div>

                      
                <!-- /.form-group -->
              </div>
            </div>
              <!-- /.col -->
         
            <!-- /.row -->
          
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