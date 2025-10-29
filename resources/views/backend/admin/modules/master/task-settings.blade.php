@extends('backend.admin.layouts.main')
@section('title','Task Setting')
@section('main-container')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
      </div>
    </div>
  </div>


  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card d-none" id="taskCategoryCard">
          <div class="d-flex justify-content-between">
              <h3 class="ms-3 mt-3">Custom Field Category</h3>
              <div class="float-end me-3 mt-3">
                      <button class="btn btn-primary px-2 taskCategoryAdd" type="button" data-bs-toggle="modal"
                          data-bs-target="#taskCategoryModel"><span class="btn-icon"><i class="ri-add-line" style="font-size:14px;"></i></span>
                          Add Category</button>
              </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="task-category">
                <thead>
                  <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

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
   <!-- Task Category modal start -->
    <div class="modal fade" id="taskCategoryModel" tabindex="-1" role="dialog" aria-labelledby="taskCategoryModel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-toggle-wrapper  text-start dark-sign-up">
                    <div class="modal-header">
                        <h4 class="modal-title taskCategoryTitle">Add Custom FIeld Category</h4>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="taskCategory_form" class="needs-validation" novalidate="">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <input type="hidden" id="taskCategory_id">
                                <label class="form-label" for="taskCategory_name">Category Name</label>
                                <input class="form-control form-control-sm" id="taskCategory_name" type="text" placeholder="Enter Custom Field Category Name" style="background-image: none;"
                                    required>
                                <div class="invalid-feedback">
                                    Enter Custom Field Category Name
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label" for="taskCategory_color">Color</label>
                                <input class="form-control form-control-sm" id="taskCategory_color" type="color" style="background-image: none;"
                                    required>
                                <div class="invalid-feedback">
                                    Choose Color
                                </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button class="btn btn-outline-warning" type="button"
                                    data-bs-dismiss="modal" onclick="resetmodel()">Cancel</button>
                                <button class="btn btn-primary taskCategorySubmit" type="submit" disabled>Submit</button>
                                <button class="btn btn-primary taskCategoryUpdate d-none" type="button"
                                    onclick="taskCategoryUpdate(document.getElementById('taskCategory_id').value)" disabled>Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Task Category modal end-->









  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card d-none" id="taskLabelCard">
          <div class="d-flex justify-content-between">
              <h3 class="ms-3 mt-3">Task Label</h3>
              <div class="float-end me-3 mt-3">
                      <button class="btn btn-primary px-2 taskLabelAdd" type="button" data-bs-toggle="modal"
                          data-bs-target="#taskLabelModel"><span class="btn-icon"><i class="ri-add-line" style="font-size:14px;"></i></span>
                          Add Task Label</button>
              </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="task-label">
                <thead>
                  <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

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
 <!-- Task Label modal start -->
    <div class="modal fade" id="taskLabelModel" tabindex="-1" role="dialog" aria-labelledby="taskLabelModel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-toggle-wrapper  text-start dark-sign-up">
                    <div class="modal-header">
                        <h4 class="modal-title taskLabelTitle">Add Task Label</h4>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="taskLabel_form" class="needs-validation" novalidate="">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <input type="hidden" id="taskLabel_id">
                                <label class="form-label" for="taskLabel_name">Task Label Name</label>
                                <input class="form-control form-control-sm" id="taskLabel_name" type="text" placeholder="Enter Task Label Name" style="background-image: none;"
                                    required>
                                <div class="invalid-feedback">
                                    Enter Task Label Name
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label" for="taskLabel_color">Color</label>
                                <input class="form-control form-control-sm" id="taskLabel_color" type="color" style="background-image: none;"
                                    required>
                                <div class="invalid-feedback">
                                    Choose Color
                                </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button class="btn btn-outline-warning" type="button"
                                    data-bs-dismiss="modal" onclick="resetmodel()">Cancel</button>
                                <button class="btn btn-primary taskLabelSubmit" type="submit" disabled>Submit</button>
                                <button class="btn btn-primary taskLabelUpdate d-none" type="button"
                                    onclick="taskLabelUpdate(document.getElementById('taskLabel_id').value)" disabled>Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Task Label modal end-->
<div class="container-fluid">
    <div class="page-title">
      <div class="row">
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card d-none" id="taskStatusCard">
          <div class="d-flex justify-content-between">
              <h3 class="ms-3 mt-3">Task Status</h3>
              <div class="float-end me-3 mt-3">
                      <button class="btn btn-primary px-2 taskStatusAdd" type="button" data-bs-toggle="modal"
                        data-bs-target="#taskStatusModel"><span class="btn-icon"><i class="ri-add-line" style="font-size:14px;"></i></span>
                        Add Task Status</button>
              </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="task-status">
                <thead>
                  <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
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
    <!-- Task Status modal start -->
    <div class="modal fade" id="taskStatusModel" tabindex="-1" role="dialog" aria-labelledby="taskStatusModel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-toggle-wrapper  text-start dark-sign-up">
                    <div class="modal-header">
                        <h4 class="modal-title taskStattusTitle">Add Task Status</h4>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="taskStatus_form" class="needs-validation" novalidate="">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <input type="hidden" id="taskStatus_id">
                                <label class="form-label" for="taskStatus_name">Task Status Name</label>
                                <input class="form-control form-control-sm" id="taskStatus_name" type="text" placeholder="Enter Task Status Name" style="background-image: none;"
                                    required>
                                <div class="invalid-feedback">
                                    Enter Task Status Name
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label" for="taskStatus_color">Color</label>
                                <input class="form-control form-control-sm" id="taskStatus_color" type="color" style="background-image: none;"
                                    required>
                                <div class="invalid-feedback">
                                    Choose Color
                                </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button class="btn btn-outline-warning" type="button"
                                    data-bs-dismiss="modal" onclick="resetmodel()">Cancel</button>
                                <button class="btn btn-primary taskStatusSubmit" type="submit" disabled>Submit</button>
                                <button class="btn btn-primary taskStatusUpdate d-none" type="button"
                                    onclick="taskStatusUpdate(document.getElementById('taskStatus_id').value)" disabled>Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Task Status modal end-->
<div class="container-fluid">
    <div class="page-title">
      <div class="row">
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card d-none" id="taskPriorityCard">
          <div class="d-flex justify-content-between">
              <h3 class="ms-3 mt-3">Task Priority</h3>
              <div class="float-end me-3 mt-3">
                      <button class="btn btn-primary px-2 taskPriorityAdd" type="button" data-bs-toggle="modal"
                        data-bs-target="#taskPriorityModel"><span class="btn-icon"><i class="ri-add-line" style="font-size:14px;"></i></span>
                        Add Task Priority</button>
              </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="task-priority">
                <thead>
                  <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
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
 <!-- Task Status modal start -->
    <div class="modal fade" id="taskPriorityModel" tabindex="-1" role="dialog" aria-labelledby="taskPriorityModel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-toggle-wrapper  text-start dark-sign-up">
                    <div class="modal-header">
                        <h4 class="modal-title taskPriorityTitle">Add Task Priority</h4>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="taskPriority_form" class="needs-validation" novalidate="">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <input type="hidden" id="taskPriority_id">
                                <label class="form-label" for="taskPriority_name">Task Priority Name</label>
                                <input class="form-control form-control-sm" id="taskPriority_name" type="text" placeholder="Enter Task Priority Name" style="background-image: none;"
                                    required>
                                <div class="invalid-feedback">
                                    Enter Task Priority Name
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label" for="taskPriority_color">Color</label>
                                <input class="form-control form-control-sm" id="taskPriority_color" type="color" style="background-image: none;"
                                    required>
                                <div class="invalid-feedback">
                                    Choose Color
                                </div>
                            </div>
                        </div>
                        {{-- <div class="color-history"></div> --}}
                            <div class="modal-footer">
                                <button class="btn btn-outline-warning" type="button"
                                    data-bs-dismiss="modal" onclick="resetmodel()">Cancel</button>
                                <button class="btn btn-primary taskPrioritySubmit" type="submit" disabled>Submit</button>
                                <button class="btn btn-primary taskPriorityUpdate d-none" type="button"
                                    onclick="taskPriorityUpdate(document.getElementById('taskPriority_id').value)" disabled>Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Task Status modal end-->
</div>

@endsection        
@section('extra-js')
<script>
    
    const addTaskCategory = "{{route('admin-master-taskCategory-add')}}";
    const viewTaskCategory = "{{route('admin-master-taskCategory-view')}}";
    const taskCategoryPositionUpdate = "{{route('admin-master-taskCategory-positionUpdate')}}";
    const taskCategorySwitch = "{{route('admin-master-taskCategory-switch')}}";
    const getTaskCategoryDetails = "{{route('admin-master-taskCategory-getDetails')}}";
    const updateTaskCategory = "{{route('admin-master-taskCategory-update')}}";
    const deleteTaskCategory = "{{route('admin-master-taskCategory-delete')}}";
    const undoTaskCategoryPosition = "{{route('undoTaskCategoryPosition')}}";

    
    const addTaskLabel = "{{route('admin-master-taskLabel-add')}}";
    const viewTaskLabel = "{{route('admin-master-taskLabel-view')}}";
    const taskLabelPositionUpdate = "{{route('admin-master-taskLabel-positionUpdate')}}";
    const taskLabelSwitch = "{{route('admin-master-taskLabel-switch')}}";
    const getTaskDetails = "{{route('admin-master-taskLabel-getDetails')}}";
    const updateTaskLabel = "{{route('admin-master-taskLabel-update')}}";
    const deleteTaskLabel = "{{route('admin-master-taskLabel-delete')}}";
    const undoTaskLabelPosition = "{{route('undoTaskLabelPosition')}}";

    const viewTaskStatus = "{{route('admin-master-taskStatus-view')}}";
    const addTaskStatus = "{{route('admin-master-taskStatus-add')}}";
    const taskStatusPositionUpdate = "{{route('admin-master-taskSetting-positionUpdate')}}";
    const taskStatusDataSwitch = "{{route('admin-master-taskSetting-switch')}}";
    const getTaskStatusDetails = "{{route('admin-master-taskSetting-getDetails')}}";
    const updateTaskStatus = "{{route('admin-master-taskSetting-update')}}";
    const deleteTaskStatuss = "{{route('admin-master-taskSetting-delete')}}";
    const undoTaskStatusPosition = "{{route('undoTaskStatusPosition')}}";
    
    const viewTaskPriority = "{{route('admin-master-taskPriority-view')}}";
    const addTaskPriority = "{{route('admin-master-taskPriority-add')}}";
    const taskPriorityPositionUpdate = "{{route('admin-master-taskPriority-positionUpdate')}}";
    const taskPriorityDataSwitch = "{{route('admin-master-taskPriority-switch')}}";
    const getTaskPriorityDetails = "{{route('admin-master-taskPriority-getDetails')}}";
    const updateTaskPriority = "{{route('admin-master-taskPriority-update')}}";
    const deleteTaskPrioritys = "{{route('admin-master-taskPriority-delete')}}";
    const undoTaskPriorityPosition = "{{route('undoTaskPriorityPosition')}}";

</script>
    <script src="{{asset('backend/assets/js/custom/master/task-setting/task-category.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom/master/task-setting/task-label.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom/master/task-setting/task-status.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom/master/task-setting/task-priority.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
@endsection