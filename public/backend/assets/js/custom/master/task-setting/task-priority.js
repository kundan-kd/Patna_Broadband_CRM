

 $('.taskPriorityAdd').on('click',function(e){
    e.preventDefault();
    $('#taskPriority_id').val('');
    $('#taskPriority_name').val('');
    $('#taskPriority_color').val('');
    $('.taskPriorityTitle').html('Add Task Priority');
    $('.taskPriorityUpdate').addClass('d-none');
    $('.taskPrioritySubmit').removeClass('d-none');
    $('.taskPrioritySubmit').prop('disabled',true);
    $('.needs-validation').removeClass('was-validated');
 });

let tastPriorityTable = $('#task-priority').DataTable({
    processing: false,
    serverSide: true,
    searching: false,     // disables the search box
    info: false,          // hides the "Showing X of Y entries" text
    paging: false,         // disables pagination
    ajax:{
        url:viewTaskPriority,
        type:"POST",
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
        $('#taskPriorityCard').removeClass('d-none');
    }
});

$('#taskPriority_name').on('keydown',function(){
    $('.taskPrioritySubmit').prop('disabled',false);
    $('.taskPriorityUpdate').prop('disabled',false);
});
$('#taskPriority_color').on('click',function(){
    $('.taskPrioritySubmit').prop('disabled',false);
    $('.taskPriorityUpdate').prop('disabled',false);
});

$('#taskPriority_form').on('submit',function(e){
    e.preventDefault();
    let name = $('#taskPriority_name').val();
    let color = $('#taskPriority_color').val();
    if(name == ''){
        $('.needs-validation').addClass('was-validated');
    }else{
        $.ajax({
            url: addTaskPriority,
            type:"POST",
            data:{name:name,color:color},
            success:function(response){
                if(response.success){
                     $('#task-priority').DataTable().ajax.reload();
                     $('#taskPriorityModel').modal('hide');
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
    $('#task-priority tbody').sortable({
        handle:'.handle', // drag only handle class 
        update: function( event, ui ) {
            var sortedData = [];
            $('#task-priority tbody tr').each(function(index) {
                var rowId = $(this).data('id');
                var page = tastPriorityTable.page();
                var pageSize = tastPriorityTable.page.info().length;
                // Only push rows that have a valid ID
                if (rowId !== undefined) {
                    sortedData.push({
                        id: rowId,
                        position: page * pageSize + index
                    });
                }
            });
            $.ajax({
                url: taskPriorityPositionUpdate,
                method: 'POST',
                data: {
                    order: sortedData,
                },
                success: function(data) {
                    if(data.success) {
                        $('#task-priority').DataTable().ajax.reload();
                        toastSuccessAlertUndo(data.success)
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

function taskPrioritySwitch(id){
    $.ajax({
        url: taskPriorityDataSwitch,
        type: "POST",
        data: {
            id: id
        },
        success: function(response) {
           if (response.success) {
                $('#task-priority').DataTable().ajax.reload();
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

function taskPriorityEdit(id) {
    $.ajax({
        url: getTaskPriorityDetails,
        type: "POST",
        data: { id: id },
        success: function (response) {
            if (response.success) {
                let data = response.getData[0];

                // Set form field values
                $('#taskPriority_id').val(data.id);
                $('#taskPriority_name').val(data.name);
                $('#taskPriority_color').val(data.color);

                // Remove old color history (if any)
                $('.color-history').remove();

                // Check and append color history (if exists)
                if (data.color_history) {
                    let colorArray = data.color_history.split(',');

                    // Build color history section
                    let colorHistoryDiv = `
                        <div class="color-history mt-2">
                            <label class="form-label">Color History</label>
                            <div class="d-flex align-items-center justify-content-center flex-wrap gap-1">
                                ${colorArray.map(color => `
                                    <input class="form-control form-input-color rounded-1"
                                        type="color" name="mycolor"
                                        style="width:50px; height:20px; padding:2px; cursor:pointer;"
                                        value="${color.trim()}" data-color="${color.trim()}">
                                `).join('')}
                                &nbsp;
                                <div onclick="document.getElementById('taskPriority_color').click()" style="cursor:pointer;">
                                    <span><i class="fa-solid fa-palette fa-2x"></i></span>
                                </div>
                            </div>
                        </div>
                    `;

                    // Append after color input field
                    $('#taskPriority_color').closest('.col-md-12').after(colorHistoryDiv);

                    // Bind click event to dynamically added color boxes
                    setTimeout(() => {
                        $('.form-input-color').on('click', function () {
                            const selectedColor = $(this).val();
                            $('#taskPriority_color').val(selectedColor);
                            $('.taskPrioritySubmit, .taskPriorityUpdate').prop('disabled', false);
                        });
                    }, 0);
                }

                // Update modal title and buttons
                $('.taskPriorityTitle').html('Update Task Priority');
                $('.taskPrioritySubmit').addClass('d-none');
                $('.taskPriorityUpdate').removeClass('d-none').prop('disabled', true);

                // Show modal
                $('#taskPriorityModel').modal('show');
            } else {
                alert("Error fetching task priority details");
            }
        }
    });
}


function taskPriorityUpdate(id){
   let name = $('#taskPriority_name').val();
    let color = $('#taskPriority_color').val();
    if(name == ''){
        $('.needs-validation').addClass('was-validated');
    }else{
        $.ajax({
            url: updateTaskPriority,
            type:"POST",
            data:{id:id,name:name,color:color},
            success:function(response){
                if(response.success){
                     $('#task-priority').DataTable().ajax.reload();
                     $('#taskPriorityModel').modal('hide');
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

function deleteTaskPriority(id) {
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
                        url: deleteTaskPrioritys,
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
                               $('#task-priority').DataTable().ajax.reload();
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
        url: undoTaskPriorityPosition, // ✅ Your undo route
        method: 'POST',
        success: function(data) {
            if (data.success) {
                $('#task-priority').DataTable().ajax.reload();
                toastSuccessAlert(data.success);
            } else if (data.error_success) {
                toastErrorAlert(data.error_success);
            } else {
                toastErrorAlert('Something went wrong!');
            }
        }
    });
});