<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Boho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Boho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('backend/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" type="image/x-icon">
    <title>CRM Login</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/sweetalert2.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/custom.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('backend/assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/responsive.css') }}">
    <style>
        .invalid-feedback {
            color: #dc3545 !important;
        }
        .alert-icons svg {
            top: 12px !important;
        }
        .otp_success {
            color:#0f5132;
        }
        .magic_btn:hover, .submit_btn:hover{
            background-color:#005f3396 !important;
        }
        .magic_btn{
            border:none;
        }
        .magic_btn_link:hover{
            background-color:#005f3324 !important;
        }
        .alert-success {
        background-color: none !important; 
        border-color: none !important; 
        color: #0f5132 !important; 
}
    </style>
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div>
                            <a class="logo mb-2" href="#">
                                <img class="img-fluid for-light mb-3" src="{{ asset('backend/assets/images/logo/logo.svg') }}" alt="loginpage" style="height: 50px; width: 200px;">
                                <img class="img-fluid for-dark mb-3 mx-auto" src="{{ asset('backend/assets/images/logo/logo.svg') }}" alt="loginpage" style="height: 50px; width: 200px;">
                            </a>
                            
                        </div>
                        <div class="login-main">
                            <form class="theme-form needs-validation" action="" id="form_login" novalidate>
                                <h3>Sign in to account</h3>
                                <p>Enter your email & password to login</p>
                                    <div class="form-group">
                                        <label class="col-form-label">Email Address</label>
                                        <input class="form-control"placeholder="Enter your email" id="email"
                                            type="email" style="background-image: none;" required>
                                        <div class="invalid-feedback">
                                            Enter Valid Email ID
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <div class="form-input position-relative">
                                            <input class="form-control" placeholder="Enter your password" id="password"
                                                type="password" name="login[password]" style="background-image: none;"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Password
                                            </div>
                                            <div class="show-hide"><span class="show"></span></div>
                                            <div class="credentialError_msg d-none"></div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox p-0">
                                            <input id="checkbox1" type="checkbox">
                                            {{-- <label class="text-muted" for="checkbox1">Remember password</label> --}}
                                        </div>
                                        <a class="link" href="/forgot-password">Forgot password?</a>
                                        <div class="text-end mt-3">
                                            <button class="btn btn-primary btn-block w-100 submit_btn" type="submit"
                                                name="Submit">Log in</button>
                                                <button class="btn btn-primary w-100 spinn_btn" style="display:none;" type="button" disabled>
                                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                                    <span role="status">Please wait...</span>
                                                </button>
                                                <br>
                                                <button class="btn btn-light m-t-10 w-100 magic_btn_link"
                                                onclick="email_link()" type="button">Log in with email</button>
                                        </div>
                                    </div>
                            </form>
                            <form class="theme-form needs-validation" action="" id="form_magiclink" style="display: none;" novalidate>
                                <div class="alert alert-success magic_link_success d-none" role="alert">
                                    Magic Link Sent Successfully.
                                  </div>
                                <h2 class="title" data-cy="login-title">Log in without a password</h2>
                                <p class="text">Enter your email address and we'll send you a magic link for password-free sign in.</p>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control"placeholder="Enter your email" id="email_link"
                                        type="email" style="background-image: none;" required>
                                    <div class="invalid-feedback">
                                        Enter Valid Email ID
                                    </div>
                                    <div class="linkcredentialError_msg d-none"></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100 magic_btn" type="submit"
                                            name="Submit">Log in with email</button>
                                            <button class="btn btn-primary btn-block w-100 magic_spinn"
                                            style="display:none;" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm"
                                                aria-hidden="true"></span>
                                            <span role="status">Please wait...</span>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('backend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <!-- feather icon js-->
        <script src="{{ asset('backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="{{ asset('backend/assets/js/config.js') }}"></script>
        <!-- Plugins JS start-->
        <script src="{{ asset('backend/assets/js/sweet-alert/sweetalert.min.js') }}"></script>
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('backend/assets/js/script.js') }}"></script>
        <!-- Plugin used-->
        <!---ALL FUNCTIONS OF THIS PAGE--------->
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
        <script>
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

        </script>
        <script>
            $("#form_login").on("submit", function(event) {
            event.preventDefault();
            let email = $('#email').val();
            let password = $('#password').val();
            if(email == '' || password == ''){
                $('.needs-validation').addClass('was-validated');
            } else {
                $('.submit_btn').hide();
                $('.spinn_btn').show();
                    $.ajax({
                        url: "{{ route('auth.login') }}",
                        method: "POST",
                        data: {
                            email: email,
                            password: password
                        },
                        success: function(response) {
                            console.log(response);
                            $('.spinn_btn').hide();
                            $('.submit_btn').show();
                            if (response.success) {
                                localStorage.removeItem("lockTriggered"); // session removed
                                window.location.href = "{{ route('admin.dashboard') }}";
                            } else if (response.errors_validation) {
                                $('.credentialError_msg').html(data.errors_validation).css("color","#dc3545").removeClass('d-none');
                            } else if(response.error_success) {
                                $('.credentialError_msg').html(response.error_success).css("color","#dc3545").removeClass('d-none');
                                $('#email,#password').css("border-color","#dc3545");
                            }
                            else{
                                $('.credentialError_msg').html("something went wrong").css("color","#dc3545").removeClass('d-none');
                            }
                        }
                    });
                }
            });
            function email_link(){
                document.getElementById("form_login").style.display="none";
                document.getElementById("form_magiclink").style.display="block";
            }

            $("#form_magiclink").on("submit", function(event) {
            event.preventDefault();
            let email = $('#email_link').val();
            if(email==''){
                $('#email_link').focus();
            }
            // Check if form is valid before making AJAX call
            else if (this.checkValidity() === false) {
                event.stopPropagation();
            } else {
                $('.magic_btn').hide();
                $('.magic_spinn').show();
                $.ajax({
                    url: "{{ route('auth.magiclink') }}",
                    method: "POST",
                    data: {
                        email: email
                    },
                        success: function(data) {
                            console.log(data);
                            setTimeout(function(){
                                    $('.magic_spinn').hide();
                                    $('.magic_btn').show();
                                },200);
                            if (data.success) {
                            $('.magic_link_success').removeClass('d-none');
                              setTimeout(function() {
                                window.location.href = "{{ route('index') }}";
                            }, 5000);
                            } else if (data.errors_validation) {
                                $('.linkcredentialError_msg').html(data.errors_validation).css("color","#dc3545").removeClass('d-none');
                            } else if(data.error_success) {
                                $('.linkcredentialError_msg').html(data.error_success).css("color","#dc3545").removeClass('d-none');
                                $('#email_link').css("border-color","#dc3545");
                            }
                            else{
                                $('.linkcredentialError_msg').html("something went wrong").css("color","#dc3545").removeClass('d-none');
                            }
                        }
                    });
                }
            });
        </script>
    </div>
</body>

</html>
