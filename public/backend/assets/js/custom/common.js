let idleTime = 0;
// const idleLimit = 10 * 60 * 1000; // 10 minutes
const idleLimit = 10 * 1000; // 10 seconds


function resetIdleTimer() {
    clearTimeout(window.idleTimer);
    window.idleTimer = setTimeout(() => {
        // window.location.href = "/lock-screen-status"; // Redirect to lock screen
        myalert();
    }, idleLimit);
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
        },
        success: function (response) {
            // console.log('Lock status updated on server:', response);
        },
        error: function () {
            // console.error('Failed to update lock status on server.');
        }
    });

    // Show confirmation (unlock) popup
    $.confirm({
        title: '🔐 Screen Lock',
        content:
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<input type="password" placeholder="Your lock password" class="password form-control" required />' +
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
                        $.alert('Please enter your password');
                        return false;
                    }

                    var modal = this; // ✅ capture modal reference

                    $.ajax({
                        url: '/lock-screen-check',
                        method: 'POST',
                        data: {
                            password: password,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log('Lock status updated on server:', response);
                            if (response.status === true) {
                                modal.close(); // ✅ close the modal
                            } else {
                                $.alert(response.message || 'Incorrect password');
                            }
                        },
                        error: function () {
                            $.alert('Server error. Please try again.');
                        }
                    });

                    return false; // keep modal open until AJAX completes
                }
            }
        }
    });
}