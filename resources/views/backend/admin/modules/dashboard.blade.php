@extends('backend.admin.layouts.main')
@section('title','Admin Dashboard')
@section('main-container')
 <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6 p-0">
                  <h3>
                     Default Dashboard </h3>
                </div>
                <div class="col-12 col-sm-6 p-0">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="{{asset('backend/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Default Dashboard </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
         
          <!-- Container-fluid Ends-->
        </div>
@endsection        