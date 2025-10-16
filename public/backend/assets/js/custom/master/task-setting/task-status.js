 $('.taskStatusAdd').on('click',function(e){
    e.preventDefault();
    $('#taskStatus_id').val('');
    $('#taskStatus_name').val('');
    $('#taskLabel_color').val('');
    $('.taskStatusTitle').html('Add Task Status');
    $('.taskStatusUpdate').addClass('d-none');
    $('.taskStatusSubmit').removeClass('d-none');
    $('.needs-validation').removeClass('was-validated');
 });

let tastStatusTable = $('#task-status').DataTable({
    processing: false,
    serverSide: true,
    searching: false,     // disables the search box
    info: false,          // hides the "Showing X of Y entries" text
    paging: false,         // disables pagination
    ajax:{
        url:viewTaskStatus,
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
            name: 'DT_RowIndex'

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
    }
});

$('#taskStatus_form').on('submit',function(e){
    e.preventDefault();
    let name = $('#taskStatus_name').val();
    let color = $('#taskStatus_color').val();
    if(name == ''){
        $('.needs-validation').addClass('was-validated');
    }else{
        $.ajax({
            url: addTaskStatus,
            type:"POST",
            data:{name:name,color:color},
            success:function(response){
                if(response.success){
                     $('#task-status').DataTable().ajax.reload();
                     $('#taskStatusModel').modal('hide');
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
    $('#task-status tbody').sortable({
        update: function( event, ui ) {
            var sortedData = [];
            $('#task-status tbody tr').each(function(index) {
                var rowId = $(this).data('id');
                var page = tastStatusTable.page();
                var pageSize = tastStatusTable.page.info().length;
                // Only push rows that have a valid ID
                if (rowId !== undefined) {
                    sortedData.push({
                        id: rowId,
                        position: page * pageSize + index
                    });
                }
            });
            $.ajax({
                url: taskStatusPositionUpdate,
                method: 'POST',
                data: {
                    order: sortedData,
                },
                success: function(data) {
                    if (data.success) {
                        $('#task-status').DataTable().ajax.reload();
                        toastSuccessAlert(data.success)
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

function taskStatusSwitch(id){
    $.ajax({
        url: taskStatusDataSwitch,
        type: "POST",
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                $('#task-status').DataTable().ajax.reload();
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

function taskStatusEdit(id){
    $.ajax({
        url: getTasStatuskDetails,
        type: "POST",
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                let data = response.getData[0];
                $('#taskStatus_id').val(data.id);
                $('#taskStatus_name').val(data.name);
                $('#taskStatus_color').val(data.color);
                $('.taskStatusTitle').html('Update Task Status');
                $('.taskStatusSubmit').addClass('d-none');
                $('.taskStatusUpdate').removeClass('d-none');
                $('#taskStatusModel').modal('show');
            } else {
                alert("error");
            }
        }
    });
}

function taskStatusUpdate(id){
   let name = $('#taskStatus_name').val();
    let color = $('#taskStatus_color').val();
    if(name == ''){
        $('.needs-validation').addClass('was-validated');
    }else{
        $.ajax({
            url: updateTaskStatus,
            type:"POST",
            data:{id:id,name:name,color:color},
            success:function(response){
                if(response.success){
                     $('#task-status').DataTable().ajax.reload();
                     $('#taskStatusModel').modal('hide');
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

function deleteTaskStatus(id) {
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
                        url: deleteTaskStatuss,
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
                                $('#task-status').DataTable().ajax.reload();
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