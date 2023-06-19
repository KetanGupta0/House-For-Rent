<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent|Login</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <script>
        window.addEventListener('popstate', function(event) {
            if (document.cookie.indexOf('loggedin=true') === -1) {
                window.location.replace('/');
            }
        });
    </script>

</head>

<body class=" overflow-x-hidden">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">House For Rent</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('houses') }}">Houses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="d-flex align-items-center flex-column" style="height: auto;" id="main_body">

                </div>
            </div>
        </div>
    </div>

    <x-footer/>

    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/sweetalert2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loginLayout() {
                $('#main_body').html(`
                <h1 class="mb-5 fw-bold">Login Here</h1>
                <form id='login-form' style="width: 60%;">
                    <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control border border-primary" id="email" name="email">
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control border border-primary" id="password" name="password">
                    </div>
                    </div>
                    <div class="mb-3 text-center">
                        <a class="btn btn-primary login-submit" style="cursor: pointer;">Submit</a>
                        <button class="btn btn-secondary" type="reset">Clear</button>
                    </div>
                </form>
                <p>Don't have account? <a class="text-primary" id="signup-btn" style="cursor: pointer;">Click Here</a></p>
                `);
            }

            function signupLayout() {
                $('#main_body').html(`
                <h1 class="mb-3 fw-bold">Signup Here</h1>
                <form id='signup-form' style="width: 50%;" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full name</label>
                        <input type="text" class="form-control border border-primary" id="username" name="username" placeholder="Enter your full name here">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control border border-primary" id="email" name="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="aadhar" class="form-label">Aadhar</label>
                        <input type="text" class="form-control border border-primary" id="aadhar" name="aadhar" placeholder="xxxx xxxx xxxx">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control border border-primary" id="phone" name="phone" placeholder="xxxxx xxxxx">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-control border border-primary" id="country" name="country" disabled>
                            <option value="105" selected>India</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <select class="form-control border border-primary" id="state" name="state"></select>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select class="form-control border border-primary" id="city" name="city"></select>
                    </div>
                    <div class="mb-3 d-flex">
                        <input type="text" class="form-control me-2 border border-primary" id="pincode" name="pincode" placeholder="Area Pincode">
                        <select name="type" id="usertype" class="form-control border border-primary">
                            <option value="#">Account Type</option>
                            <option value="owner">House Owner</option>
                            <option value="renter">Renter</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Picture</label><br>
                        <input type="file" id="profile-pic" name="image" class="form-control border border-primary">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control border border-primary" id="password" name="passowrd" placeholder="Create new password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control border border-primary" id="confirmpassword" name="confirmpassword" placeholder="Retype your password">
                    </div>
                    <div class="mb-3"id="res-msg"></div>
                    <div class="mb-3 text-center">
                        <a class="btn btn-primary signup-submit" style="cursor: pointer;">Submit</a>
                        <button class="btn btn-secondary" type="reset">Clear</button>
                    </div>
                </form>
                <p>Already have account? <a class="text-primary" id="login-btn" style="cursor: pointer;">Click Here</a></p>
                `);

                $.ajax({
                    url: "{{ url('load-state-list') }}",
                    type: "POST",
                    data: {
                        cid: 105
                    },
                    success: function(res) {
                        $('#state').html(`<option value="">Choose</option>`);
                        $('#city').html(`<option value="">Choose</option>`);
                        $.each(res, function(key, value) {
                            $('#state').append(
                                `<option value="${value.id}">${value.name}</option>`);
                        });
                    },
                });
            }

            loginLayout();

            $(document).on('click', '#login-btn', function() {
                loginLayout();
            });
            $(document).on('click', '#signup-btn', function() {
                signupLayout();
            });

            $(document).on('change', '#state', function() {
                let sid = $(this).val();
                if (sid != '') {
                    $.ajax({
                        url: "{{ url('load-city-list') }}",
                        type: "POST",
                        data: {
                            sid: sid,
                        },
                        success: function(res) {
                            $('#city').html(`<option value="">Choose</option>`);
                            $.each(res, function(key, value) {
                                $('#city').append(
                                    `<option value="${value.id}">${value.city}</option>`
                                );
                            });
                        }
                    });
                } else {
                    $('#city').html(`<option value="">Choose</option>`);
                }
            });

            $(document).on('click', '.login-submit', function() {
                let email = $('#email').val();
                let password = $('#password').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "{{ url('login-page') }}",
                    data: {
                        email: email,
                        password: password,
                    },
                    success: function(res) {
                        if (res == 'owner' || res == 'renter' || res == 'admin') {
                            window.location.href = "{{ url('/') }}";
                        } else if (res == 'wrongpwd') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Wrong Password',
                                text: "You have typed an incorrect password!",
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                        } else if (res == 'nouser') {
                            Swal.fire({
                                icon: 'error',
                                title: 'User not found',
                                text: "If you are new here you can signup now!",
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                        } else if (res == 'blocked') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Blocked',
                                text: "Your account is blocked by admin!",
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                        }
                    },
                    error: function(e) {
                        Swal.fire({
                            icon: 'error',
                            text: e.responseJSON.message,
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                        })
                    }
                });
            })

            $(document).on('click', '.signup-submit', function() {
                let username = $("#username").val();
                let email = $("#email").val();
                let aadhar = $("#aadhar").val();
                let phone = $("#phone").val();
                let country = $("#country").val();
                let state = $("#state").val();
                let city = $("#city").val();
                let pincode = $("#pincode").val();
                let usertype = $("#usertype").val();
                let password = $("#password").val();
                let confirmpassword = $("#confirmpassword").val();
                let fileInput = $('#profile-pic')[0];
                let image = fileInput.files[0];
                let formData = new FormData();
                formData.append('username', username);
                formData.append('email', email);
                formData.append('aadhar', aadhar);
                formData.append('phone', phone);
                formData.append('country', country);
                formData.append('state', state);
                formData.append('city', city);
                formData.append('pincode', pincode);
                formData.append('usertype', usertype);
                formData.append('password', password);
                formData.append('confirmpassword', confirmpassword);
                formData.append('image', image);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "{{ url('signup-page') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res == 'success') {
                            loginLayout();
                            Swal.fire({
                                icon: 'success',
                                title: 'Account Created',
                                text: 'You can login now',
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Account Creation Failed',
                                text: 'Something went wrong from our side! Please try again later!',
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                        }
                    },
                    error: function(e) {
                        Swal.fire({
                            icon: 'error',
                            text: e.responseJSON.message,
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                        })
                    }
                });
            });
        });
    </script>
</body>

</html>
