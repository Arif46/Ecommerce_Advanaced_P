@extends('layouts.admin_layout.admin_layout');
@section('content');


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sections</h1>
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
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="sections" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Status</th>
                    {{-- <th>Engine version</th>
                    <th>CSS grade</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ( $sections as $view_section )
                      <tr>
                        <td>{{ $view_section['id'] }}</td>
                        <td>{{ $view_section['name'] }}</td>
                        <td>
                          @if($view_section['status'] ==1 )
                               <a class="updateSectionStatus" id="section-{{$view_section['id']}}" section_id="{{$view_section['id']}}" href="javascript:void(0)">Active</a> 
                           @else 
                           <a class="updateSectionStatus" id="section-{{$view_section['id']}}" section_id="{{$view_section['id']}}" href="javascript:void(0)">InActive</a> 

                           @endif
                           
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