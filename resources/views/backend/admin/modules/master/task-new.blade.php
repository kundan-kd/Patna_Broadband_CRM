@extends('backend.admin.layouts.main')

@section('title', 'Custom Field')
{{-- @section('extra-css')
<style>
  .checkbox-switch-case {
      margin-top: 10px none !important;
  }
</style>
@endsection --}}

@section('main-container')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6 p-0">
          <h3>Task New</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- ===================== Container-fluid starts ===================== -->
  <div class="container-fluid">
    <form id="taskForm" class="row g-3 needs-validation" novalidate>

      <!-- ===================== LEFT SECTION (Primary Fields) ===================== -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-no-border pb-0">
            <div class="d-flex align-items-center gap-3">
              <h3>Create Task</h3>

              {{-- Task Type start --}}
            <!-- ================== TASK TYPE ================== -->
<div class="dropdown task-type-wrapper">
  <button class="btn btn-outline-light dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
          type="button" id="task_primary_type_btn"
          data-bs-toggle="dropdown" aria-expanded="false">
    <span><i class="bi bi-journal-text me-2"></i>General</span>
  </button>
  <input type="hidden" id="task_primary_type" value="General">
  <ul class="dropdown-menu w-100" aria-labelledby="task_primary_type_btn">
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-journal-text" data-value="General"><i class="bi bi-journal-text me-2"></i>General</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-geo-alt" data-value="Site Visit"><i class="bi bi-geo-alt me-2"></i>Site Visit</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-hammer" data-value="Installation"><i class="bi bi-hammer me-2"></i>Installation</a></li>
  </ul>
</div>
              {{-- Task Type end --}}

              {{-- Task Status start --}}

              <div class="dropdown task-status-wrapper">
  <button class="btn btn-outline-light dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
          type="button" id="task_primary_badge_btn"
          data-bs-toggle="dropdown" aria-expanded="false">
    <span><i class="bi bi-circle me-2 text-secondary"></i>TO DO</span>
  </button>
  <input type="hidden" id="task_primary_badge" value="TO DO">
  <ul class="dropdown-menu w-100" aria-labelledby="task_primary_badge_btn">
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-circle" data-color="text-secondary" data-value="TO DO">
      <i class="bi bi-circle me-2 text-secondary"></i>TO DO</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-play-circle" data-color="text-primary" data-value="DOING">
      <i class="bi bi-play-circle me-2 text-primary"></i>DOING</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-check-circle" data-color="text-success" data-value="DONE">
      <i class="bi bi-check-circle me-2 text-success"></i>DONE</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-check-circle" data-color="text-success" data-value="HOLD">
      <i class="bi bi-check-circle me-2 text-success"></i>HOLD</a></li>
  </ul>
</div>
              {{-- <div class="task-status-wrappr dropdown">
                <span id="statusBadge"
                      class="badge bg-light text-dark border dropdown-toggle badge-status"
                      data-bs-toggle="dropdown" aria-expanded="false" role="button">
                  <span class="bg-secondary"></span>
                  <span id="statusText">TO DO</span>
                </span>

                <div class="dropdown-menu p-2 shadow">
                  <div class="px-2 mb-2">
                    <input type="text" class="form-control form-control-sm d-none" placeholder="Search..." id="statusSearch">
                  </div>
                  <small class="text-muted px-3">Not started</small>
                  <button class="dropdown-item d-flex align-items-center" data-status="TO DO" data-color="secondary">
                    <span class="status-dot bg-secondary me-2"></span> TO DO
                  </button>

                  <hr class="my-1">

                  <small class="text-muted px-3">Active</small>
                  <button class="dropdown-item d-flex align-items-center" data-status="IN PROGRESS" data-color="primary">
                    <span class="status-dot bg-primary me-2"></span> IN PROGRESS
                  </button>
                  <button class="dropdown-item d-flex align-items-center" data-status="COMPLETE" data-color="success">
                    <span class="status-dot bg-success me-2"></span> COMPLETE
                  </button>
                </div>
              </div> --}}
              {{-- Task Status end --}}
            </div>
          </div>

          <div class="card-body">
            <div class="card-wrapper border rounded-3 p-3">
              <div class="row g-3">

                <!-- Priority + Label -->
                <div class="col-md-12">
                  <div class="d-flex flex-wrap align-items-center gap-3">
                    {{-- Priority start --}}
                   <!-- ================== PRIORITY ================== -->
<div class="dropdown task-priority-wrapper">
  <button class="btn btn-outline-light dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
          type="button" id="task_primary_priority_btn"
          data-bs-toggle="dropdown" aria-expanded="false">
    <span><i class="bi bi-flag me-2"></i>Select Priority</span>
  </button>
  <input type="hidden" id="task_primary_priority" value="">
  <ul class="dropdown-menu w-100" aria-labelledby="task_primary_priority_btn">
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-flag" data-value="CRITICAL"><i class="bi bi-flag me-2 text-success"></i>CRITICAL</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-flag-fill" data-value="HIGH"><i class="bi bi-flag-fill me-2 text-warning"></i>HIGH</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-exclamation-triangle" data-value="MEDIUM"><i class="bi bi-exclamation-triangle me-2 text-danger"></i>MEDIUM</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-lightning-charge" data-value="LOW"><i class="bi bi-lightning-charge me-2 text-danger"></i>LOW</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-lightning-charge" data-value="NO PRIORITY"><i class="bi bi-lightning-charge me-2 text-danger"></i>NO PRIORITY</a></li>
  </ul>
</div>

                    {{-- Priority end --}}

                    {{-- Label start --}}
                  <!-- ================== LABEL ================== -->
<div class="dropdown task-label-wrapper">
  <button class="btn btn-outline-light dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
          type="button" id="task_primary_label_btn"
          data-bs-toggle="dropdown" aria-expanded="false">
    <span><i class="bi bi-tag me-2"></i>Select Label</span>
  </button>
  <input type="hidden" id="task_primary_label" value="">
  <ul class="dropdown-menu w-100" aria-labelledby="task_primary_label_btn">
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-tag" data-value="Free"><i class="bi bi-tag me-2 text-success"></i>Free</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-currency-rupee" data-value="Billable"><i class="bi bi-currency-rupee me-2 text-primary"></i>Billable</a></li>
    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-star" data-value="Special"><i class="bi bi-star me-2 text-warning"></i>Special</a></li>
  </ul>
</div>
                    {{-- Label end --}}
                  </div>
                </div>

                <!-- Task Name -->
                <div class="col-12 mt-2">
                  <div class="custom-input-wrapper">
                    <input type="text" class="form-control custom-input" style="background-image: none;"
                           placeholder="Task Name or type '/' for commands" required>
                  </div>
                </div>

                <!-- Task Description -->
                <div class="col-12 mt-2">
                  <div id="descView" class="desc-box">
                    <span id="descText">
                      <i class="bi bi-file-earmark-text me-2"></i>Add Task Description
                    </span>
                  </div>

                  <div id="descEdit" class="d-none mt-2">
                    <textarea id="descInput" class="form-control mb-2" rows="3" style="background-image: none;"
                              placeholder="Enter description..." required></textarea>
                  </div>
                </div>

                <!-- Custom Fields Creation-->
                <div class="col-12 position-relative mt-4">
                  <table class="table table-bordered table-sm rounded-3">
                    <h5 class="text-muted mb-3">Custom Fields (Creation)</h5>
                    @foreach($custom_field as $fields)
                      @if($fields->location == 'creation' || $fields->location == 'both')
                        @switch($fields->type)
                        @case('input')
                         <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control" type="text" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" placeholder="Enter Name" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                            @break
                        @case('textarea')
                         <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                 <textarea class="form-control" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" placeholder="Enter Description" {{ $fields->is_required ? 'required' : '' }}></textarea>
                              </td>
                            </tr>
                            @break
                        @case('select')
                        @php $options = explode(",", $fields->type_option); @endphp
                         <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                 <select class="form-select" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" {{ $fields->is_required ? 'required' : '' }} style="background-image: none;">
                                    <option value="">Select</option>
                                    @foreach($options as $opt)
                                      <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                  </select>
                              </td>
                            </tr>
                            @break
                          @case('number')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control" type="number" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}"
                                      style="background-image: none;" placeholder="Enter Contact Number" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                            @break

                          @case('email')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control" type="email" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}"
                                      style="background-image: none;" placeholder="Write email id" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                            @break

                          @case('checkbox')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <div class="form-check checkbox checkbox-primary">
                                  <input class="form-check-input" type="checkbox" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" {{ $fields->is_required ? 'required' : '' }}>
                                  <label class="form-check-label" style="margin-top: 1px;" for="custom_field_{{$fields->name_slug}}"></label>
                                </div>
                              </td>
                            </tr>
                            @break

                          @case('radio')
                          @php $radios = explode(",", $fields->type_option); @endphp
                         <tr>
                            <td class="px-2 py-2">
                              {{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
                            </td>
                            <td class="px-2 py-2">
                              @foreach ($radios as $key => $radio)
                                <div class="form-check form-check-inline">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    id="custom_field_{{$fields->name_slug}}_{{ $key }}"
                                    name="custom_field[{{$fields->name_slug}}]"
                                    value="{{ $radio }}"
                                    data-custom_field_id="{{$fields->id}}"
                                    {{ $key == 0 ? 'checked' : '' }}
                                    {{ $fields->is_required ? 'required' : '' }}
                                  >
                                  <label
                                    class="form-check-label"
                                    for="custom_field_{{$fields->name_slug}}_{{ $key }}"
                                  >
                                    {{ $radio }}
                                  </label>
                                </div>
                              @endforeach
                            </td>
                          </tr>
                            @break

                          @case('switch')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" {{ $fields->is_required ? 'required' : '' }}>
                                          <label class="form-check-label" for="custom_field_{{$fields->name_slug}}">
                                            {{ $fields->placeholder }}
                                          </label>
                                        </div>


                              </td>
                            </tr>
                            @break
                          @case('color')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control form-control-color" type="color" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}"
                                       style="width: 100px;" style="background-image: none;" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                            @break
                          @case('date')
                           <tr>
                              <td class="px-2 py-2">
                                {{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
                              </td>
                              <td class="px-2 py-2">
                                <input
                                  class="form-control"
                                  type="date"
                                  id="custom_field_{{$fields->name_slug}}"
                                  data-custom_field_id="{{$fields->id}}"
                                  style="width: 140px; background-image: none;"
                                  {{ $fields->is_required ? 'required' : '' }}
                                >
                              </td>
                            </tr>
                            @break

                            @case('file')
                            <tr>
                              <td class="px-2 py-2">{{ $fields->name }} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <!-- Hidden file input -->
                                <input type="file" id="custom_field_{{ $fields->name_slug }}" data-custom_field_id="{{$fields->id}}" style="display: none;" onchange="updateFileName('{{ $fields->name_slug }}')">

                                <div class="d-flex align-items-center">
                                  <!-- Custom upload button -->
                                  <button type="button" class="btn btn-outline-secondary btn-sm px-2" onclick="document.getElementById('custom_field_{{ $fields->name_slug }}').click();">
                                    <i class="bi bi-upload"></i>
                                  </button>

                                  <!-- Display selected file name -->
                                  <div id="fileName_{{ $fields->name_slug }}" class="file-name ms-2 text-muted">
                                    No file selected
                                  </div>
                                </div>
                              </td>
                            </tr>
                            @break



                          @default
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control" type="text" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" placeholder="Enter Name" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                        @endswitch
                      @endif
                    @endforeach
                  </table>
                </div>





                    <!-- Custom Fields Submission-->
                <div class="col-12 position-relative mt-4">
                  <table class="table table-bordered table-sm rounded-3">
                    <h5 class="text-muted mb-3">Custom Fields (Submission)</h5>
                    @foreach($custom_field as $fields)
                      @if($fields->location == 'submission' || $fields->location == 'both')
                        @switch($fields->type)
                        @case('input')
                         <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control" type="text" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" placeholder="Enter Name" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                            @break
                        @case('textarea')
                         <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                 <textarea class="form-control" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" placeholder="Enter Description" {{ $fields->is_required ? 'required' : '' }}></textarea>
                              </td>
                            </tr>
                            @break
                        @case('select')
                        @php $options = explode(",", $fields->type_option); @endphp
                         <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                 <select class="form-select" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" {{ $fields->is_required ? 'required' : '' }}>
                                    <option value="">Select</option>
                                    @foreach($options as $opt)
                                      <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                  </select>
                              </td>
                            </tr>
                            @break
                          @case('number')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control" type="number" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;"
                                       placeholder="Enter Contact Number" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                            @break

                          @case('email')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control" type="email" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;"
                                       placeholder="Write email id" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                            @break

                          @case('checkbox')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <div class="form-check mb-0">
                                  <input class="form-check-input" type="checkbox"  id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" {{ $fields->is_required ? 'required' : '' }}>
                                  <label class="form-check-label" for="custom_field_{{$fields->name_slug}}">Yes</label>
                                </div>
                              </td>
                            </tr>
                            @break

                          @case('radio')
                          @php $radios = explode(",", $fields->type_option); @endphp
                           <tr>
                              <td class="px-2 py-2">
                                {{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
                              </td>
                              <td class="px-2 py-2">
                                @foreach ($radios as $key => $radio)
                                  <div class="form-check form-check-inline">
                                    <input
                                      class="form-check-input"
                                      type="radio"
                                      id="custom_field_{{$fields->name_slug}}_{{ $key }}"  
                                      name="custom_field[{{$fields->name_slug}}]"
                                      value="{{ $radio }}"
                                      data-custom_field_id="{{$fields->id}}"
                                      {{ $key == 0 ? 'checked' : '' }}
                                      {{ $fields->is_required ? 'required' : '' }}
                                    >
                                    <label
                                      class="form-check-label"
                                      for="custom_field_{{$fields->name_slug}}_{{ $key }}"
                                    >
                                      {{ $radio }}
                                    </label>
                                  </div>
                                @endforeach
                              </td>
                            </tr>
                            @break

                          @case('switch')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="background-image: none;" {{ $fields->is_required ? 'required' : '' }}>
                                          <label class="form-check-label">
                                            {{ $fields->placeholder }}
                                          </label>
                                        </div>
                              </td>
                            </tr>
                            @break
                          @case('color')
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control form-control-color" type="color" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" style="width: 100px;" style="background-image: none;" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                            @break
                          @case('date')
                            <tr>
                              <td class="px-2 py-2">
                                {{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
                              </td>
                              <td class="px-2 py-2">
                                <input
                                  class="form-control"
                                  type="date"
                                  id="custom_field_{{$fields->name_slug}}"
                                  data-custom_field_id="{{$fields->id}}"
                                  style="width: 140px; background-image: none;"
                                  {{ $fields->is_required ? 'required' : '' }}
                                >
                              </td>
                            </tr>
                            @break

                          @case('file')
                            <tr>
                              <td class="px-2 py-2">{{ $fields->name }} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <!-- Hidden file input -->
                                <input type="file" id="custom_field_{{ $fields->name_slug }}" data-custom_field_id="{{$fields->id}}" style="display: none;" onchange="updateFileName('{{ $fields->name_slug }}')">

                                <div class="d-flex align-items-center">
                                  <!-- Custom upload button -->
                                  <button type="button" class="btn btn-outline-secondary btn-sm px-2" onclick="document.getElementById('custom_field_{{ $fields->name_slug }}').click();">
                                    <i class="bi bi-upload"></i>
                                  </button>

                                  <!-- Display selected file name -->
                                  <div id="fileName_{{ $fields->name_slug }}" class="file-name ms-2 text-muted">
                                    No file selected
                                  </div>
                                </div>
                              </td>
                            </tr>
                            @break

                          @default
                            <tr>
                              <td class="px-2 py-2">{{$fields->name}} {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}</td>
                              <td class="px-2 py-2">
                                <input class="form-control" type="text" style="background-image: none;" placeholder="Enter Name" id="custom_field_{{$fields->name_slug}}" data-custom_field_id="{{$fields->id}}" {{ $fields->is_required ? 'required' : '' }}>
                              </td>
                            </tr>
                        @endswitch
                      @endif
                    @endforeach
                  </table>
                </div>
                <!-- Footer Buttons -->
                <div class="col-12 border-top pt-3 d-flex justify-content-end align-items-center">
                  <div class="dropdown assignee-wrapper me-3 assigneeBtn">
                    <button id=""
                            class="btn btn-sm py-1 px-2 btn-outline-light d-flex align-items-center"
                            data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-person me-1"></i> Assignee
                    </button>
                    <div class="dropdown-menu p-2 shadow">
                      <input type="text" class="search-input mb-2" placeholder="Search or enter email...">
                      <div>
                        @foreach ($users as $user)
                          <div class="user-item d-flex align-items-center gap-2" id="userList" data-assign_to="{{ $user->id }}" data-initials="@">
                            <div class="user-avatar"><span>@</span><span class="online-dot"></span></div>
                            <span>{{ $user->name }}</span>
                          </div>
                        @endforeach
                        {{-- <div class="user-item d-flex align-items-center gap-2" data-name="John Doe" data-initials="JD">
                          <div class="user-avatar bg-primary"><span>JD</span></div>
                          <span>John Doe</span>
                        </div> --}}
                      </div>
                    </div>
                  </div>

                  <button class="btn btn-primary" type="submit">Create Task</button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </form>
  </div>
  <!-- ===================== Container-fluid Ends ===================== -->
</div>
@endsection

@section('extra-js')
<script>
//   document.addEventListener('DOMContentLoaded', () => {
//   const slug = '{{ $fields->name_slug }}'; // Blade variable injected into JS
//   const uploadBtn = document.getElementById(`uploadBtn_${slug}`);
//   const fileInput = document.getElementById(`customFile_${slug}`);
//   const fileName = document.getElementById(`fileName_${slug}`);

//   uploadBtn.addEventListener('click', () => {
//     fileInput.click(); // Trigger hidden file input
//   });

//   fileInput.addEventListener('change', () => {
//     if (fileInput.files.length > 0) {
//       fileName.textContent = fileInput.files[0].name;
//       uploadBtn.classList.remove('btn-outline-primary');
//       uploadBtn.classList.add('btn-success');
//       uploadBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> File Selected';
//     } else {
//       fileName.textContent = 'No file selected';
//     }
//   });
// });
  const taskAdd = "{{ route('admin-master-task.add') }}";
</script>
<script>

</script>
<script src="{{ asset('backend/assets/js/custom/master/task.js') }}"></script>
@endsection
