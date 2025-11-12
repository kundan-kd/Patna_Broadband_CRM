@extends('backend.admin.layouts.main')

@section('title', 'Custom Field')

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
                <div class="dropdown task-type-wrapper">
                  <button
                    class="btn btn-outline-light dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                    type="button"
                    id="task_primary_type"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span><i class="bi bi-journal-text me-2"></i>General</span>
                  </button>
                  <ul class="dropdown-menu w-100" aria-labelledby="task_primary_type">
                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-journal-text" data-value="general"><i class="bi bi-journal-text me-2"></i>General</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-geo-alt" data-value="Site Visit"><i class="bi bi-geo-alt me-2"></i>Site Visit</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-hammer" data-value="Installation"><i class="bi bi-hammer me-2"></i>Installation</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-person-badge" data-value="KYC Verification"><i class="bi bi-person-badge me-2"></i>KYC Verification</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-cloud-upload" data-value="KYC Upload"><i class="bi bi-cloud-upload me-2"></i>KYC Upload</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-cash-coin" data-value="Cash Collection"><i class="bi bi-cash-coin me-2"></i>Cash Collection</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-exclamation-diamond" data-value="Dead Connection"><i class="bi bi-exclamation-diamond me-2"></i>Dead Connection</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-three-dots" data-value="Other"><i class="bi bi-three-dots me-2"></i>Other</a></li>
                  </ul>
                </div>
                {{-- Task Type end --}}
                 <div class="task-status-wrappr dropdown">
                  <!-- Initial badge button -->
                  <span id="statusBadge" 
                        class="badge bg-light text-dark border dropdown-toggle badge-status" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false" 
                        role="button">
                    <span class="bg-secondary"></span>
                    <span id="statusText">TO DO</span>
                  </span>

                  <!-- Dropdown -->
                  <div class="dropdown-menu p-2 shadow">
                    <!-- Search -->
                    <div class="px-2 mb-2">
                      <input type="text" class="form-control form-control-sm" placeholder="Search..." id="statusSearch">
                    </div>

                    <!-- Not Started -->
                    <small class="text-muted px-3">Not started</small>
                    <button class="dropdown-item d-flex align-items-center" data-status="TO DO" data-color="secondary">
                      <span class="status-dot bg-secondary me-2"></span> TO DO
                    </button>

                    <hr class="my-1">

                    <!-- Active -->
                    <small class="text-muted px-3">Active</small>
                    <button class="dropdown-item d-flex align-items-center" data-status="IN PROGRESS" data-color="primary">
                      <span class="status-dot bg-primary me-2"></span> IN PROGRESS
                    </button>
                    <button class="dropdown-item d-flex align-items-center" data-status="COMPLETE" data-color="success">
                      <span class="status-dot bg-success me-2"></span> COMPLETE
                    </button>
                  </div>
                </div>
            </div>
          </div>
          <div class="card-body">
            <div class="card-wrapper border rounded-3">
              <div class="row g-3">
                <!-- Task Type, Priority, Label -->
                <div class="col-md-12">
                  <div class="d-flex flex-wrap align-items-center gap-3">
                    {{-- Priority start --}}
                    <div class="dropdown">
                      <button
                        class="btn btn-outline-light dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                        type="button"
                        id="priorityDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span><i class="bi bi-flag me-2"></i>Select Priority</span>
                      </button>

                      <ul class="dropdown-menu w-100" aria-labelledby="priorityDropdown">
                        <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-flag" data-value="Low"><i class="bi bi-flag me-2 text-success"></i>Low</a></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-flag-fill" data-value="Medium"><i class="bi bi-flag-fill me-2 text-warning"></i>Medium</a></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-exclamation-triangle" data-value="High"><i class="bi bi-exclamation-triangle me-2 text-danger"></i>High</a></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="#" data-icon="bi-lightning-charge" data-value="Urgent"><i class="bi bi-lightning-charge me-2 text-danger"></i>Urgent</a></li>
                      </ul>
                    </div>
                    {{-- Priority end --}}

                    {{-- Label start --}}
                    <div class="dropdown">
                      <button
                        class="btn btn-outline-light dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                        type="button"
                        id="labelDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span><i class="bi bi-tag me-2"></i>Select Label</span>
                      </button>

                      <ul class="dropdown-menu w-100" aria-labelledby="labelDropdown">
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
                    <input
                      type="text"
                      class="form-control font-control-sm custom-input"
                      placeholder="Task Name or type '/' for commands" />
                  </div>
                </div>

                <!-- Task Description -->
                <div class="col-12 mt-2">
                  <!-- View Mode -->
                  <div id="descView" class="desc-box">
                    <span id="descText">
                      <span class="me-2"><i class="bi bi-file-earmark-text"></i></span>
                      Add Task Description
                    </span>
                  </div>

                  <!-- Edit Mode -->
                  <div id="descEdit" class="d-none mt-2">
                    <textarea
                      id="descInput"
                      class="form-control mb-2"
                      rows="3"
                      placeholder="Enter description..."></textarea>
                  </div>
                </div>
                <div class="col-12 position-relative mt-4">
                  <h5 class="text-muted mb-3">Custom Fields</h5>
                  <table class="table table-bordered table-sm rounded-3">
                    <tr>
                      <td class="px-2 py-2">User Name</td>
                      <td class="px-2 py-2">
                        <input class="form-control" id="task_custom_1" name="task_custom_1" type="input" placeholder="Enter Name" style="background-image:none;" required="">
                      </td>
                    </tr>
                    <tr>
                      <td class="px-2 py-2">Contact Number</td>
                      <td class="px-2 py-2">
                        <input class="form-control" id="task_custom_2" name="task_custom_2" type="number" placeholder="Enter Contact Number" style="background-image:none;" required="">                      
                      </td>
                    </tr>
                    <tr>
                      <td class="px-2 py-2">Email ID</td>
                      <td class="px-2 py-2">
                        <input class="form-control" id="task_custom_12" name="task_custom_12" type="email" placeholder="Write email id" style="background-image:none;" required="">                      
                      </td>
                    </tr>
                    <tr>
                      <td class="px-2 py-2">Reply Needed</td>
                      <td class="px-2 py-2">
                        <div class="form-check checkbox checkbox-primary mb-0">
                            <input class="form-check-input" id="checkbox-primary-1" type="checkbox" checked="">
                            <label class="form-check-label" for="checkbox-primary-1"></label>
                          </div>                    
                      </td>
                    </tr>
                    <tr>
                      <td class="px-2 py-2">Radio</td>
                      <td class="px-2 py-2">
                        <div class="form-check radio radio-secondary">
                            <input class="form-check-input" id="radio22" type="radio" name="radio1" value="option1" checked="">
                            <label class="form-check-label" for="radio22"></label>
                        </div>                   
                      </td>
                    </tr>
                    <tr>
                      <td class="px-2 py-2">Text Color</td>
                      <td class="px-2 py-2">
                        <input class="form-control" type="color" id="task_custom_10" name="task_custom_10" style="width: 100px;">                    
                      </td>
                    </tr>
                    <tr>
                      <td class="px-2 py-2">Custom File Upload</td>
                      <td class="px-2 py-2">
                        <!-- Hidden file input -->
                          <input type="file" id="customFile" hidden>
                          <div class="d-flex align-items-center">
                          <!-- Custom button -->
                          <div id="uploadBtn" class="btn btn-outline-light btn-sm px-2">
                            <i class="bi bi-upload"></i>
                          </div>

                          <!-- Display selected file name -->
                          <div id="fileName" class="file-name ms-2">No file selected</div>
                          <div>                   
                      </td>
                    </tr>
                  </table>
                </div>
                
                <div class="col-12 border-top pt-3">
                  <div class="d-flex justify-content-end align-items-enter">
                    <!-- Assignee Button -->
                    <div class="dropdown assignee-wrapper me-3">
                      <button id="assigneeBtn" class="btn btn-sm py-1 px-2 btn-outline-light d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person me-1"></i> Assignee
                      </button>

                      <!-- Dropdown -->
                      <div class="dropdown-menu p-2 shadow">
                        <input type="text" class="search-input mb-2" placeholder="Search or enter email...">
                        <div id="userList">
                          <div class="user-item d-flex align-items-center gap-2" data-name="Me" data-initials="AK">
                            <div class="user-avatar"><span>AK</span><span class="online-dot"></span></div>
                            <span>Me</span>
                          </div>
                          <div class="user-item d-flex align-items-center gap-2" data-name="John Doe" data-initials="JD">
                            <div class="user-avatar bg-primary"><span>JD</span></div>
                            <span>John Doe</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary">Create Task</button>
                  <div>
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
  const taskAdd = "{{ route('admin-master-task.add') }}";
</script>
<script src="{{ asset('backend/assets/js/custom/master/task.js') }}"></script>
@endsection
