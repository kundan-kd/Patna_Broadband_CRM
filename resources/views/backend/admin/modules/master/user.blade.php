@extends('backend.admin.layouts.main')
@section('title','Users')
@section('main-container')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6 p-0">
                  <h3>Users</h3>
                </div>
                <div class="col-12 col-sm-6 p-0">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="{{asset('backend/assets/svg/icon-sprite.svg#breadcrumb-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Master</li>
                    <li class="breadcrumb-item active">User</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border">
                    <h3>Admin Users</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>Sr.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($users as $user)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td> 
                                <ul class="action"> 
                                  <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                  <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                </ul>
                              </td>
                            </tr> 
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
@endsection        
@section('extra-js')
<script>
    $('#basic-1').dataTable();
</script>
@endsection