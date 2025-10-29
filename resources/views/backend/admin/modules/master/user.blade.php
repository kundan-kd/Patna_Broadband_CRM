@extends('backend.admin.layouts.main')
@section('title','Users')
@section('main-container')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row align-items-center">
        <div class="col-12 d-flex justify-content-between align-items-center">
          <h3 class="mb-0">Admin Users</h3>
          {{-- <button class="btn btn-primary px-2 waiter_add" type="button" data-bs-toggle="modal" data-bs-target="#waiterModel">
            <span class="btn-icon"><i class="ri-add-line"></i></span> Add User
          </button> --}}
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
                    {{-- <h3>Admin Users</h3> --}}
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