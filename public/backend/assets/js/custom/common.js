
let idleTime = 0;
// const idleLimit = 10 * 60 * 1000; // 10 minutes
const idleLimit = 10 * 1000; // 10 seconds
function resetIdleTimer() {
   let lockSession = sessionStorage.getItem("lockTriggered"); // Move inside
    if (lockSession === "active" || lockSession != null) {
        return; // Do not reset timer if lock is active
    } else {
        clearTimeout(window.idleTimer);
        window.idleTimer = setTimeout(() => {
            myalert();
            sessionStorage.setItem("lockTriggered", "active");
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
        title: '🔐 Screen Locked',
        content:
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<input type="password" placeholder="Enter your lock password" class="password form-control" required />' +
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
                            // console.log('Lock status updated on server:', response);
                            if (response.status === true) {
                                sessionStorage.removeItem("lockTriggered"); // session removed
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