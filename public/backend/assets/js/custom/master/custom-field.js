   let customFieldTable = $('#custom-field').DataTable({
    processing: false,
    serverSide: true,
    searching: false,     // disables the search box
    info: false,          // hides the "Showing X of Y entries" text
    paging: false,        // disables pagination
    ajax: {
        url: customFieldView, // Define this route in your Blade or JS
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(xhr, error, thrown) {
            console.log(xhr.responseText);
            alert('Error: ' + thrown);
        }
    },
    columns: [
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            render: function(data, type, row, meta) {
                return `<i class="ri-draggable handle me-4" style="cursor:move;"></i>${data}`;
            }
        },
        { data: 'name', name: 'name' },
        { data: 'placeholder', name: 'placeholder' },
        { data: 'type', name: 'type' },
        { data: 'location', name: 'location' },
        { data: 'category', name: 'category' },
        { data: 'is_required', name: 'is_required', orderable: false, searchable: false },
        { data: 'status', name: 'status', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    createdRow: function(row, data, dataIndex) {
        $(row).attr('data-id', data.id); // Useful for drag/drop or inline actions
    },
    initComplete: function(settings, json) {
        $('#customFieldCard').removeClass('d-none'); // Reveal container after load
    }
});

// $('.customFieldAdd').on('click',function(e){
function resetData(){    
    $('#custom_field_id').val('');
    $('#custom_field_name').val('');
    $('#custom_field_place_holder').val('');
    $('#custom_field_type').val('');
    $('.custom-select-option').addClass('d-none');
    $('.custom-field-type').addClass('d-none');
    $('.custom-location').addClass('d-none');
    $('.custom-category').addClass('d-none');
    $('#custom_field').val('');
    $('#custom_field_location').val('');
    $('#custom_field_category').val('');
    $('#custom_field_class').val('');
    $('#is_required_checkbox').prop('checked', false);
    $('.customFieldUpdate').addClass('d-none');
    $('.customFieldSubmit').removeClass('d-none');
    $('.needs-validation').removeClass('was-validated');
    // $('#custom_field_form')[0].reset();
};
$('#custom_field_type').on('change',function(e){
    $('.custom-location').removeClass('d-none');
});
$('#custom_field_location').on('change',function(e){
    $('.custom-category').removeClass('d-none');
});


$(document).ready(function() {
    $('#custom-field tbody').sortable({
        handle: '.handle', // 👈 Only allow dragging from elements with class "handle"
        update: function( event, ui ) {
            var sortedData = [];
            $('#custom-field tbody tr').each(function(index) {
                var rowId = $(this).data('id');
                var page = customFieldTable.page();
                var pageSize = customFieldTable.page.info().length;
                // Only push rows that have a valid ID
                if (rowId !== undefined) {
                    sortedData.push({
                        id: rowId,
                        position: page * pageSize + index
                    });
                }
            });
            $.ajax({
                url: customFieldPositionUpdate,
                method: 'POST',
                data: {
                    order: sortedData,
                },
                success: function(data) {
                    if (data.success) {
                        $('#custom-field').DataTable().ajax.reload();
                        toastSuccessAlertUndo(data.success); // for undo position change
                    } else if (data.error_success) {
                        toastErrorAlert(data.error_success);
                    } else {
                        toastErrorAlert('something went wrong!');
                    }
                }
            });
        }
    });
});

$(document).on('click', '#liveToastSuccessAlert a', function(e) {
    e.preventDefault();
    $.ajax({
        url: undoCustomFieldPosition, // ✅ Your undo route
        method: 'POST',
        success: function(data) {
            if (data.success) {
                $('#custom-field').DataTable().ajax.reload();
                toastSuccessAlert(data.success);
            } else if (data.error_success) {
                toastErrorAlert(data.error_success);
            } else {
                toastErrorAlert('Something went wrong!');
            }
        }
    });
});

function selectFieldType(type){
    $('.custom-field-type').removeClass('d-none');
    $('#custom_field_type').prop('disabled',false).empty();
    if(type == 'text'){
        $('#custom_field_type').append(`<option data-name="Input" value="">Select</option>
            <option data-name="Input" value="input">Input</option>
            <option data-name="Number" value="number">Number</option>
            <option data-name="Textarea" value="textarea">Textarea</option>`);
    }else if(type == 'media'){
        $('#custom_field_type').append(`<option data-name="Input" value="">Select</option>
            <option data-name="Upload Files" value="file">Upload Files</option>`);
    }else if(type == 'select'){
         $('#custom_field_type').append(`<option data-name="Input" value="">Select</option>
            <option data-name="Select" value="select">Select</option>
            <option data-name="Checkbox" value="checkbox">Checkbox</option>
            <option data-name="Radio" value="radio">Radio</option>
            <option data-name="Switch Button" value="switch">Switch</option>
            <option data-name="Date Picker" value="date">Date Picker</option>
            <option data-name="Color Picker" value="color">Color Picker</option>`);
    }else if(type == 'link'){
        $('#custom_field_type').append(`<option data-name="Input" value="">Select</option>
            <option data-name="Email" value="email">Email</option>
            <option data-name="Url Link" value="url">Url Link</option>`);
   }else{
    $('#custom_field_type').append(`<option disabled selected value="">No custom field types available</option>`);
    $('.custom-field-type').addClass('d-none');
}
   
}
function fieldTypeData(data) {
  if (data == 'select' || data == 'radio') {
    $('.primary-option').prop('required', true);
    $('.custom-select-option').removeClass('d-none');
  } else {
    $('.primary-option').prop('required', false);
    $('.custom-select-option').addClass('d-none');
  }
}


function addMore(){
    $('.custom-select-option').append(` <div class="d-flex align-items-center gap-2 mt-1">
                  <input class="form-control form-control-sm " id="custom_field_option" name="custom_field_option[]" style="background-image: none;">
                  <i class="icon-trash text-danger" id="delete_option" title="Remove" style="cursor: pointer;font-size: 20px; font-weight: 100; opacity: 0.7;" onclick="removeRow(this)"></i>
                </div>`);
}

function removeRow(x){
    $(x).closest('div').remove();
}








$('#custom_field_form').on('submit', function (e) {
  e.preventDefault();
   
    let field_option = $('input[name="custom_field_option[]"]').map(function(){return $(this).val()}).get().filter(val=>val !== '');
    let isRequired = $('#is_required_checkbox').is(':checked') ? 1 : 0;
    let fieldType = $('#custom_field_type').val();
    if(fieldType == 'select' || fieldType == 'radio'){
        if(field_option.length<=0){
            $('.needs-validation').addClass('was-validated');
            return;
        }
    }
    // console.log(fieldType);
    // console.log(field_option);
    let formData = {
    name: $('#custom_field_name').val(),
    placeholder: $('#custom_field_place_holder').val(),
    custom_field: $('#custom_field').val(),
    type: $('#custom_field_type').val(),
    field_option:field_option,
    location: $('#custom_field_location').val(),
    category: $('#custom_field_category').val(),
    class: $('#custom_field_class').val(),
    is_required: isRequired,
    _token: $('meta[name="csrf-token"]').attr('content')
  };
// Check for empty fields except 'class'
let hasEmpty = Object.entries(formData).some(([key, value]) => {
  return key !== 'class' && key !== 'placeholder' && value === '';
});


  if (hasEmpty) {
    $('.needs-validation').addClass('was-validated');
    return; // Stop submission
  } 


  $.ajax({
    url: customFieldAdd,
    method: "POST",
    data: formData,
    success: function (response) {
        console.log(response);
     if (response.success) {
        $('#custom-field').DataTable().ajax.reload();
        $('#customFieldModel').modal('hide');
        $('#custom_field_form')[0].reset();
        resetData();
        toastSuccessAlert(response.success);
    } else if (response.error_success) {
        toastErrorAlert(response.error_success);
    } else if (response.already_found) {
        toastErrorAlert(response.already_found);
    } else {
        toastErrorAlert('Something went wrong!');
    }
    },
    error: function (xhr) {
      alert('Something went wrong. Please check your input.');
      console.log(xhr.responseText);
    }
  });
});
 
function switchCustomField(id){
    $.ajax({
        url: customFieldSwitch,
        type: "POST",
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                $('#custom-field').DataTable().ajax.reload();
                toastSuccessAlert(response.success);
            } else {
                toastErrorAlert("something went wrong!");
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert("An error occurred: " + error);
        }
    });
}

function editCustomField(id) {
    $('#custom_field_form')[0].reset();
    $('#custom_field_type').empty();
    // $('.custom-select-option').empty();
    $.ajax({
        url: getCustomFieldDetails, // Make sure this route is defined
        type: "POST",
        data: { id: id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response);
            if (response.success) {
                let data = response.getData[0];
                if(data.custom_field == 'text'){
                    $('#custom_field_type').append(`
                        <option data-name="Input" value="input" ${data.type == 'input' ? 'selected':''}>Input</option>
                        <option data-name="Number" value="number" ${data.type == 'number' ? 'selected':''}>Number</option>
                        <option data-name="Textarea" value="textarea" ${data.type == 'textarea' ? 'selected':''}>Textarea</option>`);
                    $('.custom-field-type').removeClass('d-none');    
                }else if(data.custom_field == 'link'){
                    $('#custom_field_type').append(`
                        <option data-name="Email" value="email" ${data.type == 'email' ? 'selected':''}>Email</option>
                        <option data-name="Url Link" value="url" ${data.type == 'url' ? 'selected':''}>Url Link</option>`);
                    $('.custom-field-type').removeClass('d-none');
                }else if(data.custom_field == 'media'){
                    $('#custom_field_type').append(`<option data-name="Upload Files" value="file" ${data.type == 'file' ? 'selected':''}>Upload Files</option>`);
                    $('.custom-field-type').removeClass('d-none');
                }else if(data.custom_field == 'select'){
                    $('#custom_field_type').append(`
                        <option data-name="Select" value="select" ${data.type == 'select' ? 'selected':''}>Select</option>
                        <option data-name="Checkbox" value="checkbox" ${data.type == 'checkbox' ? 'selected':''}>Checkbox</option>
                        <option data-name="Radio" value="radio" ${data.type == 'radio' ? 'selected':''}>Radio</option>
                        <option data-name="Switch Button" value="switch" ${data.type == 'switch' ? 'selected':''}>Switch</option>
                        <option data-name="Date Picker" value="date" ${data.type == 'date' ? 'selected':''}>Date Picker</option>
                        <option data-name="Color Picker" value="color" ${data.type == 'color' ? 'selected':''}>Color Picker</option>`);
                    $('.custom-field-type').removeClass('d-none');
                        if(data.type == 'select' || data.type == 'radio'){
                            let optionArray = data.type_option.split(",");
                           $('.edit-append').html(''); // Clear existing options

                        optionArray.forEach(function(element) {
                        $('.edit-append').append(`
                            <div class="d-flex align-items-center gap-2 mt-1">
                            <input class="form-control form-control-sm primary-option" 
                                    name="custom_field_option[]" 
                                    value="${element}" 
                                    style="background-image: none;" placeholder="Enter Field Type Data">
                            <i class="fa fa-trash text-danger" 
                                title="Remove" 
                                style="cursor: pointer; font-size: 20px; font-weight: 100; opacity: 0.7;" 
                                onclick="removeRow(this)"></i>
                            </div>
                        `);
                        });









                            $('.custom-select-option').removeClass('d-none');
                        }else{
                            $('.custom-select-option').addClass('d-none');
                        }
                 }else{
                     $('.custom-field-type').addClass('d-none');
                 }
                // Populate form fields
                $('#custom_field_id').val(data.id);
                $('#custom_field_name').val(data.name);
                $('#custom_field_place_holder').val(data.placeholder);
                $('#custom_field').val(data.custom_field);
                $('#custom_field_type').val(data.type);
                $('#custom_field_location').val(data.location);
                $('#custom_field_category').val(data.category);
                $('#custom_field_class').val(data.class);
                $('#is_required_checkbox').prop('checked', data.is_required == 1);

                // Update modal title and buttons
                $('.customFieldTitle').html('Update Custom Field');
                $('.custom-location').removeClass('d-none');
                $('.custom-category').removeClass('d-none');
                $('.customFieldSubmit').addClass('d-none');
                $('.customFieldUpdate').removeClass('d-none').prop('disabled', false);

                // Show modal
                $('#customFieldModel').modal('show');
            } else {
                alert("Error fetching custom field details");
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert("Server error while fetching custom field");
        }
    });
}

function customFieldUpdate(id) {
    let name = $('#custom_field_name').val();
    let placeholder = $('#custom_field_place_holder').val();
    let type = $('#custom_field_type').val();
    let location = $('#custom_field_location').val();
    let category = $('#custom_field_category').val();
    let className = $('#custom_field_class').val();
    let isRequired = $('#is_required_checkbox').is(':checked') ? 1 : 0;
     let field_option = $('input[name="custom_field_option[]"]').map(function(){return $(this).val()}).get().filter(val=>val !== '');

    if (name == '' || type == '') {
        $('.needs-validation').addClass('was-validated');
    } else {
        $.ajax({
            url: updateCustomField, // Define this route in your Blade or JS
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                name: name,
                placeholder: placeholder,
                type: type,
                location: location,
                category: category,
                class: className,
                is_required: isRequired,
                field_option:field_option
            },
            success: function (response) {
                if (response.success) {
                    $('#custom-field').DataTable().ajax.reload();
                    $('#customFieldModel').modal('hide');
                    resetData();
                    toastSuccessAlert(response.success);
                } else if (response.error_success) {
                    toastErrorAlert(response.error_success);
                } else if (response.already_found) {
                    toastErrorAlert(response.already_found);
                } else {
                    toastErrorAlert('Something went wrong!');
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                toastErrorAlert('Server error occurred!');
            }
        });
    }
}

function deleteCustomField(id){
    $.confirm({
        title: 'Are you sure?',
        content: "You won't be able to revert this!",
        type: 'red',
        buttons: {
            confirm: {
                text: 'Yes, delete it!',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: deleteCustomFields,
                        type: "POST",
                        data: { id: id },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                $.alert({
                                    title: 'Deleted!',
                                    content: response.success,
                                    type: 'green'
                                });
                                $('#custom-field').DataTable().ajax.reload();
                            } else {
                                $.alert({
                                    title: 'Error!',
                                    content: 'Error occurred while deleting.',
                                    type: 'red'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            $.alert({
                                title: 'Error!',
                                content: 'An error occurred: ' + error,
                                type: 'red'
                            });
                        }
                    });
                }
            },
            cancel: function () {
                // Optional: do nothing or show a message
            }
        }
    });
}
