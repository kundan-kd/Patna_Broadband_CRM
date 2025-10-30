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
        { data: 'class', name: 'class' },
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

$('.customFieldAdd').on('click',function(e){
    $('#custom_field_id').val('');
    $('#custom_field_name').val('');
    $('#custom_field_place_holder').val('');
    $('#custom_field_type').val('');
    $('#custom_field_location').val('');
    $('#custom_field_category').val('');
    $('#custom_field_class').val('');
    $('#is_required_checkbox').prop('checked', false);
    $('#customFieldUpdate').addClass('d-none');
    $('#customFieldSubmit').removeClass('d-none');
    $('.needs-validation').removeClass('was-validated');
})
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
    $('#custom_field_type').prop('disabled',false).empty();
    if(type == 'text'){
        $('#custom_field_type').append(`<option data-name="Input" value="">Select</option>
            <option data-name="Input" value="input">Input</option>
            <option data-name="Number" value="number">Number</option>
            <option data-name="Textarea" value="textarea">Textarea</option>
            <option data-name="Hyperlink" value="link">Hyperlink</option>`);
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
   }else{
    $('#custom_field_type').append(`<option disabled selected value="">No custom field types available</option>`);
}
   
}
function fieldTypeData(data){
    
}












$('#custom_field_form').on('submit', function (e) {
  e.preventDefault();
  
  let isRequired = $('#is_required_checkbox').is(':checked') ? 1 : 0;
  let formData = {
    name: $('#custom_field_name').val(),
    placeholder: $('#custom_field_place_holder').val(),
    type: $('#custom_field_type').val(),
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
     if (response.success) {
        $('#custom-field').DataTable().ajax.reload();
        $('#customFieldModel').modal('hide');
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
    $.ajax({
        url: getCustomFieldDetails, // Make sure this route is defined
        type: "POST",
        data: { id: id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                let data = response.getData[0];

                // Populate form fields
                $('#custom_field_id').val(data.id);
                $('#custom_field_name').val(data.name);
                $('#custom_field_place_holder').val(data.placeholder);
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
                is_required: isRequired
            },
            success: function (response) {
                if (response.success) {
                    $('#custom-field').DataTable().ajax.reload();
                    $('#customFieldModel').modal('hide');
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
