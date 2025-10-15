let idleTime = 0;
// const idleLimit = 10 * 60 * 1000; // 10 minutes
const idleLimit = 300 * 1000; // 600 seconds
function resetIdleTimer() {
   let lockSession = localStorage.getItem("lockTriggered"); // Move inside
    if (lockSession == "active" || lockSession != null) {
        return; // Do not reset timer if lock is active
    } else {
        clearTimeout(window.idleTimer);
        window.idleTimer = setTimeout(() => {
            myalert();
            localStorage.setItem("lockTriggered", "active");
        }, idleLimit);
    }

}

// Reset timer on user activity
['mousemove', 'keydown', 'scroll', 'click'].forEach(evt => {
    document.addEventListener(evt, resetIdleTimer, false);
});
    resetIdleTimer(); // Start timer on page load




const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
function myalert() {
    // Trigger the AJAX request immediately when lock is activated
    $.ajax({
        url: '/lock-screen-status',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Show confirmation (unlock) popup
    $.confirm({
        title: '🔐 Screen Locked',
        content:
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<input type="password" placeholder="Enter your lock PIN" class="password form-control" required />' +
            '</div>' +
            '</form>',
        theme: 'supervan',
        buttons: {
            submit: {
                text: 'Unlock',
                btnClass: 'btn-blue',
                action: function () {
                    var password = this.$content.find('.password').val();
                    if (!password) {
                        $.alert('Please enter your lock PIN');
                        return false;
                    }

                    var modal = this;

                    $.ajax({
                        url: '/lock-screen-check',
                        method: 'POST',
                        data: {
                            password: password,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status === true) {
                                localStorage.removeItem("lockTriggered");
                                resetIdleTimer();
                                modal.close();
                            } else {
                                $.alert(response.message || 'Incorrect lock PIN');
                            }
                        },
                        error: function () {
                            $.alert('Server error. Please try again.');
                        }
                    });

                    return false;
                },
                isDisabled: true // 🔒 Disable button initially
            }
        },
        onContentReady: function () {
            var modal = this;
            var input = this.$content.find('.password');

            input.on('input', function () {
                if ($(this).val().length >= 4) {
                    modal.buttons.submit.enable(); // ✅ Enable Unlock button
                } else {
                    modal.buttons.submit.disable(); // 🔒 Disable Unlock button
                }
            });

            // 🔑 Trigger Unlock on Enter key if button is enabled
            input.on('keydown', function (e) {
                if ((e.key === 'Enter' || e.keyCode === 13) && !modal.buttons.submit.isDisabled) {
                    modal.buttons.submit.action.call(modal);
                    e.preventDefault();
                }
            });
        }
    });
}

// Bootstrap Validation codes start
// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
// Bootstrap Validation codes ends

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// toast success alert start---------
function toastSuccessAlert(message){
  $('.toast-alert-success-msg').html('');
  $('.toast-alert-success-msg').html(message);
  var toastElement = document.getElementById('liveToastSuccessAlert');
  var toast = new bootstrap.Toast(toastElement);
  toast.show();
}
// toast alert ends---------
// toast warning alert start---------
function toastWarningAlert(message){
  $('.toast-alert-warning-msg').html('');
  $('.toast-alert-warning-msg').html(message);
  var toastElement = document.getElementById('liveToastWarningAlert');
  var toast = new bootstrap.Toast(toastElement);
  toast.show();
}
// toast alert ends---------
// toast failed alert start---------
function toastErrorAlert(message){
  $('.toast-alert-error-msg').html('');
  $('.toast-alert-error-msg').html(message);
  var toastElement = document.getElementById('liveToastErrorAlert');
  var toast = new bootstrap.Toast(toastElement);
  toast.show();
}
// toast alert ends---------