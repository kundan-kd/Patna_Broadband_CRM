$('#taskForm').on('submit', function (e) {
    e.preventDefault();

    let isValid = true; // validation flag

    // Primary fields
    let task_type = $('#task_primary_type').val();
    let task_priority = $('#task_primary_priority').val();
    let task_details = $('#task_primary_details').val();
    let task_label = $('#task_primary_label').val();

    // Validate primary fields
    if (task_type === '' || task_priority === '' || task_details === '' || task_label === '') {
        isValid = false;
    }

    // Validate custom fields
    $('[id^=task_custom_]').each(function () {
        let $field = $(this);
        let isRequired = $field.prop('required');
        let value = $field.val();

        // Handle checkbox validation
        if ($field.attr('type') === 'checkbox') {
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
    let customFields = {};
    $('[id^=task_custom_]').each(function () {
        let fieldId = $(this).attr('id');
        let fieldValue;

        if ($(this).attr('type') === 'checkbox') {
            fieldValue = $(this).is(':checked') ? 1 : 0;
        } else {
            fieldValue = $(this).val();
        }

        customFields[fieldId] = fieldValue;
    });

    // Combine everything
    let formData = {
        task_type: task_type,
        task_priority: task_priority,
        task_details: task_details,
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
            } else {
                toastErrorAlert(response.success);
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});
