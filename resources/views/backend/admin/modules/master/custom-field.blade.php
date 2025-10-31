@extends('backend.admin.layouts.main')

@section('title','Custom Field')
@section('extra-css')
<style>

</style>
@endsection
@section('main-container')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6 p-0">
          <h3>Custom Fields</h3>
        </div>
        <div class="col-12 col-sm-6 p-0">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">
                <svg class="stroke-icon">
                  <use href="{{asset('backend/assets/svg/icon-sprite.svg#breadcrumb-home')}}"></use>
                </svg>
              </a>
            </li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Custom Field</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="d-flex justify-content-between">
            <h3 class="ms-3 mt-3">Custom Fields</h3>
            <div class="float-end me-3 mt-3">
              <button class="btn btn-primary px-2 customFieldAdd" type="button" data-bs-toggle="modal" data-bs-target="#customFieldModel" onclick="resetData()">
                <span class="btn-icon"><i class="ri-add-line" style="font-size:14px;"></i></span> Add Custom Field
              </button>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="custom-field">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Placeholder</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Is Required</th>
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
      <!-- Zero Configuration Ends-->
    </div>
  </div>
  <!-- Container-fluid Ends-->

  <!-- Task Category modal start -->
  <div class="modal fade" id="customFieldModel" tabindex="-1" role="dialog" aria-labelledby="customFieldModel" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;" role="document">
      <div class="modal-content">
        <div class="modal-toggle-wrapper text-start dark-sign-up">
          <div class="modal-header">
            <h4 class="modal-title customFieldTitle">Add Custom Field</h4>
            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="" id="custom_field_form" class="needs-validation" novalidate>
            <div class="modal-body">
              <input type="hidden" id="custom_field_id">

              <div class="col-md-12 mb-3">
                <label class="form-label" for="custom_field_name">Field Name</label>
                <input class="form-control form-control-sm" id="custom_field_name" type="text" placeholder="Enter Custom Field Name" style="background-image: none;" required>
                {{-- <div class="invalid-feedback">Enter Custom Field Name</div> --}}
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-label" for="custom_field_place_holder">Placeholder</label>
                <input class="form-control form-control-sm" id="custom_field_place_holder" type="text" placeholder="Enter Custom Field Placeholder" style="background-image: none;">
                {{-- <div class="invalid-feedback">Enter Custom Field Placeholder</div> --}}
              </div>







              <div class="col-md-12 mb-3">
                <label class="form-label" for="custom_field">Select Custom Field</label>
                <select class="form-select form-select-sm" id="custom_field" style="background-image: none;" onchange="selectFieldType(this.value)" required>
                  <option value="">Select</option>
                  <option value="text">Text</option>
                  <option value="media">Media</option>
                  <option value="select">Selection</option>
                  <option value="link">Link</option>
                </select>
                {{-- <div class="invalid-feedback"> Select Field Type</div> --}}
                
              </div>
              <div class="col-md-12 mb-3 d-none custom-field-type">
                <label class="form-label" for="custom_field_type">Custom Field Type</label>
                <select class="form-select form-select-sm" id="custom_field_type" style="background-image: none;" onchange="fieldTypeData(this.value)" required>
                  <option value="">Select</option>
                  {{-- <option data-name="Input" value="input">Input</option>
                  <option data-name="Number" value="number">Number</option>
                  <option data-name="Textarea" value="textarea">Textarea</option>
                  <option data-name="Select" value="select">Select</option>
                  <option data-name="Checkbox" value="checkbox">Checkbox</option>
                  <option data-name="Radio" value="radio">Radio</option>
                  <option data-name="Switch Button" value="switch">Switch</option>
                  <option data-name="Upload Files" value="file">Upload Files</option>
                  <option data-name="Date Picker" value="date">Date Picker</option>
                  <option data-name="Color Picker" value="color">Color Picker</option>
                  <option data-name="Hyperlink" value="link">Hyperlink</option> --}}
                </select>
                {{-- <div class="invalid-feedback">Please select a Custom Field Type</div> --}}
              </div>


              <div class="col-md-12 mb-3 d-none custom-select-option">
                <label class="form-label" for="custom_field_option">Field Data</label>
                <div class="d-flex align-items-center gap-2 edit-append">
                  <input class="form-control form-control-sm me-1 primary-option" name="custom_field_option[]" style="background-image: none;" placeholder="Enter Field Type Data">
                  <i class="fa fa-plus-square-o" aria-hidden="true" title="Add More" style="cursor: pointer;color: #5378f1; font-size: 20px; font-weight: 100; opacity: 0.7;" onclick="addMore()"></i>
                </div>
                {{-- <div class="invalid-feedback">Select Custom Field Location</div> --}}
              </div>
              

              <div class="col-md-12 mb-3 d-none custom-location">
                <label class="form-label" for="custom_field_location">Field Location</label>
                <select class="form-select form-select-sm" id="custom_field_location" style="background-image: none;" required>
                   <option value="">Select</option>
                  <option value="creation">Task Creation</option>
                  <option value="submission">Task Submission</option>
                  <option value="both">Both</option>
                </select>
                {{-- <div class="invalid-feedback">Select Custom Field Location</div> --}}
              </div>

              <div class="col-md-12 mb-3 d-none custom-category">
                <label class="form-label" for="custom_field_category">Field Category</label>
                <select class="form-select form-select-sm" id="custom_field_category" style="background-image: none;" required>
                  <option value="">Select</option>
                  <option value="general" selected>General</option>
                </select>
                {{-- <div class="invalid-feedback">Select Custom Field Category</div> --}}
              </div>

              {{-- <div class="col-md-12 mb-3">
                <label class="form-label" for="custom_field_class">Custom Class</label>
                <input class="form-control form-control-sm" id="custom_field_class" type="text" placeholder="Enter Custom Field Class" style="background-image: none;">
                <div class="invalid-feedback">Enter Custom Field Class</div>
              </div> --}}

             <div class="row">
               <div class="form-check form-switch mb-0 ms-3">
                  <input class="form-check-input" type="checkbox" role="switch" id="is_required_checkbox">
                {{-- </div>
              <div class="col-md-6 mt-2"> --}}
                <label class="form-label mb-0 ms-1">This Field Is Required ?</label>
              </div>
              {{-- <div class="col-md-6 mt-2 d-flex justify-content-end align-items-center">
               
              </div> --}}
            </div>

            </div>

            <div class="modal-footer">
              <button class="btn btn-outline-warning" type="button" data-bs-dismiss="modal">Cancel</button>
              <button class="btn btn-primary customFieldSubmit" type="submit">Submit</button>
              <button class="btn btn-primary customFieldUpdate d-none" type="button" onclick="customFieldUpdate(document.getElementById('custom_field_id').value)" disabled>Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Task Category modal end -->
</div>
@endsection

@section('extra-js')
<script>
// const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': csrfToken
//     }
// });

  const customFieldAdd = "{{route('admin-master-customField.store')}}";
  const customFieldView = "{{route('admin-master-customField.view')}}";
  const customFieldPositionUpdate = "{{route('admin-master-customField.positionUpdate')}}";
  const undoCustomFieldPosition = "{{route('admin-master-customField.undoPosition')}}";
  const customFieldSwitch = "{{route('admin-master-customField.switch')}}";
  const getCustomFieldDetails = "{{route('admin-master-customField.getDetails')}}";
  const updateCustomField = "{{route('admin-master-customField.update')}}";
  const deleteCustomFields = "{{route('admin-master-customField.delete')}}";
</script>
  <script src="{{asset('backend/assets/js/custom/master/custom-field.js')}}"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
@endsection