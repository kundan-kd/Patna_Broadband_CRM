<?php require '../include/session.php'; ?>
<?php include '../include/header.php'; ?>
</head>

<body>
<?php include '../include/sidemenu.php'; ?>

<div class="page-content">
  <?php include '../include/topbar.php'; ?>

  <div class="page-header">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Task Settings</li>
    </ol>
  </div>

  <div class="main-container">
    <div class="row gutters">
      <div class="col-md-3">
        <?php include '../include/setting-menu.php'; ?>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <h5>Task Custom Fields 
              <span class="btn btn-primary float-right" id="addTaskSetting">Add New</span>
            </h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th><th>Name</th><th>Type</th><th>Options</th><th>Location</th>
                  <th>Required</th><th>Status</th><th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = mysqli_query($connect, "SELECT * FROM task_settings WHERE category='custom_fields' AND delete_status='0' ORDER BY position ASC");
                $i = 1;
                while($row = mysqli_fetch_assoc($query)):
                  $details = json_decode($row['details'])[0];
                ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $row['name'] ?></td>
                  <td><?= $details->name ?></td>
                  <td><?= $details->options ?></td>
                  <td><?= $details->location ?></td>
                  <td><?= $details->required == 'true' ? 'Yes' : 'No' ?></td>
                  <td><input type="checkbox" class="toggle-status" data-id="<?= $row['id'] ?>" <?= $row['status']?'checked':'' ?>></td>
                  <td>
                    <button class="btn btn-sm btn-info edit-btn" data-id="<?= $row['id'] ?>">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">Delete</button>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="taskModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 id="modalTitle"></h5></div>
      <div class="modal-body" id="modalBody"></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" id="saveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>
<script>
$(document).ready(function(){

  // Open add modal
  $('#addTaskSetting').click(function(){
    openModal('Add Custom Field');
  });

  // Open edit modal
  $('.edit-btn').click(function(){
    const id = $(this).data('id');
    $.post('function.php', { fetch_task_setting: 1, id }, function(res){
      if(res.status == 'success'){
        openModal('Edit Custom Field', res);
      }
    }, 'json');
  });

  // Delete record
  $('.delete-btn').click(function(){
    const id = $(this).data('id');
    if(confirm('Delete this record?')){
      $.post('function.php', { delete_task_setting: 1, id }, function(res){
        if(res.status == 'success') location.reload();
      }, 'json');
    }
  });

  // Toggle status
  $('.toggle-status').change(function(){
    const id = $(this).data('id');
    const status = $(this).is(':checked') ? 1 : 0;
    $.post('function.php', { task_setting_status: 1, id, status });
  });

  // Save (add/edit)
  $('#saveBtn').click(function(){
    const data = {
      id: $('#field_id').val(),
      name: $('#field_name').val(),
      type: $('#field_type').val(),
      location: $('#field_location').val(),
      options: $('#field_options').val(),
      required: $('#field_required').is(':checked')
    };
    $.post('function.php', { save_task_setting: 1, data }, function(res){
      if(res.status == 'success') location.reload();
    }, 'json');
  });

  // Modal creator
  function openModal(title, data={}){
    $('#modalTitle').text(title);
    $('#modalBody').html(`
      <input type="hidden" id="field_id" value="${data.id || ''}">
      <div class="form-group">
        <label>Name</label>
        <input id="field_name" class="form-control" value="${data.name || ''}">
      </div>
      <div class="form-group">
        <label>Type</label>
        <select id="field_type" class="form-control">
          <option value="input">Input</option>
          <option value="number">Number</option>
          <option value="select">Select</option>
        </select>
      </div>
      <div class="form-group">
        <label>Location</label>
        <select id="field_location" class="form-control">
          <option>Task Creation</option>
          <option>Task Submission</option>
        </select>
      </div>
      <div class="form-group">
        <label>Options (comma separated)</label>
        <input id="field_options" class="form-control" value="${data.options || ''}">
      </div>
      <div class="form-group">
        <label><input type="checkbox" id="field_required" ${data.required?'checked':''}> Required</label>
      </div>
    `);
    $('#taskModal').modal('show');
  }

});
</script>
