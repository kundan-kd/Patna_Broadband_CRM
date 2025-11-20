  $(document).on('click', '.dropdown .dropdown-item', function (e) {
    e.preventDefault();

    let $item = $(this);
    let value = $item.data('value');
    let iconClass = $item.data('icon');
    let $dropdown = $item.closest('.dropdown');

    // Find button & hidden input inside same dropdown
    let $button = $dropdown.find('button.dropdown-toggle');
    let $hiddenInput = $dropdown.find('input[type="hidden"]');

    // Update button display
    let iconHtml = iconClass ? `<i class="bi ${iconClass} me-2"></i>` : '';
    $button.find('span').html(iconHtml + value);

    // Update hidden input value
    $hiddenInput.val(value);
  });

   


$('#taskForm').on('submit', function (e) {
    e.preventDefault();

    let isValid = true; // validation flag

    // Primary fields
    let task_type = $('#task_primary_type').val();
    let task_priority = $('#task_primary_priority').val();
     let task_badge = $('#task_primary_badge').val();
    let task_label = $('#task_primary_label').val();
    let assign_to = $('#userList').data('assign_to');
    if (assign_to) {
    $('.assigneeBtn')
        .css('border', '1px solid red')
        .css('border-radius', '4px');
}


    // Validate primary fields
    if (task_type === '' || task_priority === '' || task_label === '') {
        isValid = false;
    }

    // Validate custom fields
    $('[id^=custom_field_]').each(function () {
        let $field = $(this);
        let isRequired = $field.prop('required');
        let value = $field.val();

        // Handle checkbox validation
        if ($field.attr('type') == 'checkbox') {
            if (isRequired && !$field.is(':checked')) {
                isValid = false;
                $field.closest('.form-check').addClass('was-validated');
            } else {
                $field.closest('.form-check').removeClass('was-validated');
            }
        } else {
            if (isRequired && (value === '' || value === null)) {
                isValid = false;
                $field.addClass('is-invalid');
            } else {
                $field.removeClass('is-invalid');
            }
        }
    });

    // Show Bootstrap validation UI
    if (!isValid) {
        $('.needs-validation').addClass('was-validated');
        return; // stop submission
    }

    // Collect all custom fields dynamically
  let customFields = [];

$('[id^=custom_field_]').each(function () {
    let $field = $(this);
    let fieldId = $field.attr('id');
    let fieldValue;

    if ($field.attr('type') === 'checkbox') {
        fieldValue = $field.is(':checked') ? 1 : 0;
    } else {
        fieldValue = $field.val();
    }

    let customFieldId = $field.data('custom_field_id'); // Extract data-custom_field_id

    customFields.push({
        html_id: fieldId,
        custom_field_id: customFieldId,
        value: fieldValue
    });
});


    // Combine everything
    let formData = {
        task_type: task_type,
        task_priority: task_priority,
        task_badge: task_badge,
        task_label: task_label,
        custom_fields: customFields,
    };

    // Send AJAX request
    $.ajax({
        url: taskAdd,
        type: "POST",
        data: formData,
        success: function (response) {
            if (response.success) {
                toastSuccessAlert(response.success);
                $('#taskForm')[0].reset();
                $('.needs-validation').removeClass('was-validated');
                $('.is-invalid').removeClass('is-invalid');

                 //   after submit form these data be auto reset
              
              $('#taskForm').find('.dropdown').each(function () {
                let $dropdown = $(this);
                let $button = $dropdown.find('button.dropdown-toggle');
                let $hiddenInput = $dropdown.find('input[type="hidden"]');
                $button.find('span').html('Select an option');
                $hiddenInput.val('');
            });

              
            } else {
                toastErrorAlert(response.success);
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});
