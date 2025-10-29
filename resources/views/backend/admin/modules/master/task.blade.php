@extends('backend.admin.layouts.main')

@section('title','Custom Field')

@section('main-container')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6 p-0">
          <h3>Task</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <form id="taskForm" class="row g-3 needs-validation" novalidate>
      <!-- Primary Fields on Left -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header card-no-border pb-0">
            <h3>Primary Fields</h3>
          </div>
          <div class="card-body">
            <div class="card-wrapper border rounded-3">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Task Type <span class="text-danger">*</span></label>
                  <select class="form-select" id="task_primary_type" style="background-image:none;" required>
                    <option value="">Select Task Type</option>
                    <option value="Site Visit">Site Visit</option>
                    <option value="Installnation">Installnation</option>
                    <option value="KYC Verification">KYC Verification</option>
                    <option value="KYC Upload">KYC Upload</option>
                    <option value="Cash Collection">Cash Collection</option>
                    <option value="Dead Connection">Dead Connection</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Priority <span class="text-danger">*</span></label>
                  <select class="form-select" id="tast_primary_priority" style="background-image:none;" required>
                    <option value="">Select Priority</option>
                    <option value="Low">Low</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="High">High</option>
                    <option value="Urgent">Urgent</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Details <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="task_primary_details" placeholder="Enter Task Details" style="background-image:none;" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Label <span class="text-danger">*</span></label>
                  <select class="form-select" id="task_primary_label" style="background-image:none;" required>
                    <option value="">Select Label</option>
                    <option value="Free">Free</option>
                    <option value="Billable" selected>Billable</option>
                    <option value="Special">Special</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Custom Fields on Right -->
      <div class="col-md-3">
        <div class="card mb-3">
          <div class="card-header card-no-border pb-0">
            <h3>Custom Fields</h3>
          </div>
          <div class="card-body">
            <div class="card-wrapper border rounded-3 p-3">
              <div class="row g-3">
                   @foreach ($custom_field as $fields)
                @if($fields->location == 'creation' || $fields->location == 'both')
                <div class="col-md-12">
                    <label class="form-label" for="task_custom_{{ $loop->index }}">{{ $fields->name }} {!! $fields->is_required == 1 ? ' <span class="text-danger">*</span>' : '' !!}</label>

                    @if($fields->type == 'textarea')
                    <textarea class="form-control" id="task_custom_{{ $loop->index }}" placeholder="{{ $fields->placeholder }}" style="background-image:none;" {{ $fields->is_required == 1 ? 'required' : '' }}></textarea>
                    @else
                    <input class="form-control" id="task_custom_{{ $loop->index }}" type="{{ $fields->type }}" placeholder="{{ $fields->placeholder }}" style="background-image:none;" {{ $fields->is_required == 1 ? 'required' : '' }}>
                    @endif

                </div>
                @endif
            @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header card-no-border pb-0">
            <h4>Allow Custom Fields For Task Submission</h4>
          </div>
        <div class="card-body">
        <div class="card-wrapper border rounded-3 p-3">
           <div class="row g-3">
  @foreach ($custom_field as $fields)
    @if($fields->location == 'submission' || $fields->location == 'both')
      <div class="col-md-12">
        @if($fields->type == 'textarea')
          <textarea
            class="form-control"
            id="task_custom_{{ $loop->index }}"
            name="task_custom_{{ $loop->index }}"
            placeholder="{{ $fields->placeholder }}"
            style="background-image:none;"
            {{ $fields->is_required == 1 ? 'required' : '' }}
          ></textarea>

        @elseif($fields->type == 'checkbox')
          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              id="task_custom_{{ $loop->index }}"
              name="task_custom_{{ $loop->index }}"
              {{ $fields->is_required == 1 ? 'required' : '' }}
            >
            <label class="form-check-label ms-1" for="task_custom_{{ $loop->index }}">
              {{ $fields->name }} {!! $fields->is_required == 1 ? ' <span class="text-danger">*</span>' : '' !!}
            </label>
          </div>

        @else
          <input
            class="form-control"
            id="task_custom_{{ $loop->index }}"
            name="task_custom_{{ $loop->index }}"
            type="{{ $fields->type }}"
            placeholder="{{ $fields->placeholder }}"
            style="background-image:none;"
            {{ $fields->is_required == 1 ? 'required' : '' }}
          >
        @endif
      </div>
    @endif
  @endforeach
</div>
        </div>
        </div>
        </div>
      </div>

      <!-- Unified Submit Button -->
      <div class="col-12 text-end mt-3">
        <button class="btn btn-primary" type="submit">Submit Task</button>
      </div>
    </form>
  </div>
  <!-- Container-fluid Ends-->
</div>
@endsection

@section('extra-js')
<script>
  const taskAdd = "{{route('admin-master-task.add')}}";
</script>
<script src="{{asset('backend/assets/js/custom/master/task.js')}}"></script>
@endsection