// $('#task-setting').dataTable();

// let table = new DataTable('#bed-table');
 $('.taskCategoryAdd').on('click',function(e){
    e.preventDefault();
    $('#taskCategory_id').val('');
    $('#taskCategory_name').val('');
    $('#taskCategory_color').val('');
    $('.taskCategoryTitle').html('Add Custom Field Category');
    $('.taskCategoryUpdate').addClass('d-none');
    $('.taskCategorySubmit').removeClass('d-none');
    $('.taskCategorySubmit').prop('disabled',true);
    $('.needs-validation').removeClass('was-validated');
 });
let tastCategoryTable = $('#task-category').DataTable({
    processing: false,
    serverSide: true,
    searching: false,     // disables the search box
    info: false,          // hides the "Showing X of Y entries" text
    paging: false,         // disables pagination
    ajax:{
        url:viewTaskCategory,
        type:"POST",
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
           },
        error: function(xhr,error,thrown){
            console.log(xhr.responseText);
            alert('Error: ' + thrown);
        }
    },
    columns:[
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            render: function(data, type, row, meta) {
            return `<i class="ri-draggable handle me-4" style="cursor:move;"></i>${data}`;
            }
        },

        {
            data:'name',
            name:'name'
        },
        {
            data:'color',
            name:'color'
        },
        {
            data:'status',
            name:'status',
            orderable: false,
            searchable: true
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
      createdRow: function(row, data, dataIndex) {
        $(row).attr('data-id', data.id); // Assuming `id` is part of your server response to pass it to sortable
    },
      initComplete: function(settings, json) {
        $('#taskCategoryCard').removeClass('d-none');
    }
});
$('#taskCategory_name ').on('keydown',function(){
    $('.taskCategorySubmit').prop('disabled',false);
    $('.taskCategoryUpdate').prop('disabled',false);
});
$('#taskCategory_color').on('click',function(){
    $('.taskCategorySubmit').prop('disabled',false);
    $('.taskCategoryUpdate').prop('disabled',false);
});
$('#taskCategory_form').on('submit',function(e){
    e.preventDefault();
    let name = $('#taskCategory_name').val();
    let color = $('#taskCategory_color').val();
    if(name == ''){
        $('.needs-validation').addClass('was-validated');
    }else{
        $.ajax({
            url: addTaskCategory,
            type:"POST",
            data:{name:name,color:color},
            success:function(response){
                if(response.success){
                     $('#task-category').DataTable().ajax.reload();
                     $('#taskCategoryModel').modal('hide');
                     toastSuccessAlert(response.success);
                }else if(response.error_success){
                    toastErrorAlert(response.error_success);
                }else if(response.error_validation){
                    toastErrorAlert(response.error_validation);
                }else if(response.already_found){
                    toastErrorAlert(response.already_found);
                }else{
                    toastErrorAlert('something went wrong!');
                }
            }
        })
    }
});

$(document).ready(function() {
    $('#task-category tbody').sortable({
        handle: '.handle', // 👈 Only allow dragging from elements with class "handle"
        update: function( event, ui ) {
            var sortedData = [];
            $('#task-category tbody tr').each(function(index) {
                var rowId = $(this).data('id');
                var page = tastCategoryTable.page();
                var pageSize = tastCategoryTable.page.info().length;
                // Only push rows that have a valid ID
                if (rowId !== undefined) {
                    sortedData.push({
                        id: rowId,
                        position: page * pageSize + index
                    });
                }
            });
            $.ajax({
                url: taskCategoryPositionUpdate,
                method: 'POST',
                data: {
                    order: sortedData,
                },
                success: function(data) {
                    if (data.success) {
                        $('#task-category').DataTable().ajax.reload();
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

function taskCateSwitch(id){
    $.ajax({
        url: taskCategorySwitch,
        type: "POST",
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                $('#task-category').DataTable().ajax.reload();
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

// function taskEdit(id){
//     $.ajax({
//         url: getTaskDetails,
//         type: "POST",
//         data: {
//             id: id
//         },
//         success: function(response) {
//             if (response.success) {
//                 let data = response.getData[0];
//                 $('#taskCategory_id').val(data.id);
//                 $('#taskCategory_name').val(data.name);
//                 $('#taskCategory_color').val(data.color);
//                 $('.taskCategoryTitle').html('Update Task Label');
//                 $('.taskCategorySubmit').addClass('d-none');
//                 $('.taskCategoryUpdate').removeClass('d-none').prop('disabled',true);
//                 $('#taskCategoryModel').modal('show');
//             } else {
//                 alert("error");
//             }
//         }
//     });
// }

function taskCategoryEdit(id) {
    $.ajax({
        url: getTaskCategoryDetails,
        type: "POST",
        data: { id: id },
        success: function (response) {
            console.log(response);
            if (response.success) {
                let data = response.getData[0];

                // Set form field values
                $('#taskCategory_id').val(data.id);
                $('#taskCategory_name').val(data.name);
                $('#taskCategory_color').val(data.color);

                // Remove old color history (if any)
                $('.color-history').remove();

                // Check and append color history (if exists)
                if (data.color_history) {
                    let colorArray = data.color_history.split(',');
                    let colorHistoryDiv = `
                        <div class="color-history mt-2">
                            <label class="form-label">Color History</label>
                            <div class="d-flex align-items-center justify-content-center flex-wrap gap-1">
                                ${colorArray.map(color => `
                                    <input class="form-control form-input-color rounded-1"
                                        type="color" name="mycolor"
                                        style="width:50px; height:20px; padding:2px;"
                                        value="${color.trim()}" data-color="${color.trim()}"
                                        onclick="$('#taskCategory_color').val('${color.trim()}');">
                                `).join('')}
                                &nbsp;
                                <div onclick="document.getElementById('taskCategory_color').click()">
                                    <span><i class="fa-solid fa-palette fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#taskCategory_color').closest('.col-md-12').after(colorHistoryDiv);

                    // Bind click event to dynamically added inputs
                    setTimeout(() => {
                        $('.form-input-color').on('click', function () {
                            const selectedColor = $(this).val();
                            $('#taskCategory_color').val(selectedColor);
                            $('.taskCategorySubmit, .taskCategoryUpdate').prop('disabled', false);
                        });
                    }, 0);
                }

                // Update modal title and buttons
                $('.taskCategoryTitle').html('Update Task Label');
                $('.taskCategorySubmit').addClass('d-none');
                $('.taskCategoryUpdate').removeClass('d-none').prop('disabled', true);

                // Show modal
                $('#taskCategoryModel').modal('show');
            } else {
                alert("Error fetching task details");
            }
        }
    });
}



function taskCategoryUpdate(id){
    let name = $('#taskCategory_name').val();
    let color = $('#taskCategory_color').val();
    if(name == ''){
        $('.needs-validation').addClass('was-validated');
    }else{
        $.ajax({
            url: updateTaskCategory,
            type:"POST",
            data:{id:id,name:name,color:color},
            success:function(response){
                if(response.success){
                     $('#task-category').DataTable().ajax.reload();
                     $('#taskCategoryModel').modal('hide');
                     toastSuccessAlert(response.success);
                }else if(response.error_success){
                    toastErrorAlert(response.error_success);
                }else if(response.already_found){
                    toastErrorAlert(response.already_found);
                }else{
                    toastErrorAlert('something went wrong!');
                }
            }
        })
    }
}

function taskCategoryDelete(id) {
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
                        url: deleteTaskCategory,
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
                                $('#task-category').DataTable().ajax.reload();
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

$(document).on('click', '#liveToastSuccessAlert a', function(e) {
    e.preventDefault();
    $.ajax({
        url: undoTaskCategoryPosition, // ✅ Your undo route
        method: 'POST',
        success: function(data) {
            if (data.success) {
                $('#task-category').DataTable().ajax.reload();
                toastSuccessAlert(data.success);
            } else if (data.error_success) {
                toastErrorAlert(data.error_success);
            } else {
                toastErrorAlert('Something went wrong!');
            }
        }
    });
});