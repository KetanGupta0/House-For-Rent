<main id="main" class="main">
    <!-- Picture Update Modal -->
    <div class="modal fade" id="updatePicture" tabindex="-1" aria-labelledby="updatePictureLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updatePictureLabel">Update Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="profilePicUpdateForm" enctype="multipart/form-data">
                        <input type="file" name="picture"  accept="image/*" id="new-profile-pic">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update-picture">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Profile Section --}}
    <section class="section profile mb-5">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" id="profile-pic">

                    </div>
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <a class="btn btn-outline-primary update-new-profile-pic-btn" data-bs-toggle="modal"
                            data-bs-target="#updatePicture">Update
                            picture</a>
                    </div>
                </div>

            </div>

            <div class="col-xl-7">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                    aria-selected="true" role="tab">Overview</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                    aria-selected="false" tabindex="-1" role="tab">Edit Profile</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"
                                    aria-selected="false" tabindex="-1" role="tab">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview"
                                role="tabpanel">

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8 user-name">{{ Session::get('username') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8 user-email">{{ Session::get('usermail') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Aadhar</div>
                                    <div class="col-lg-9 col-md-8 user-aadhar">{{ Session::get('useraadhar') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Mobile</div>
                                    <div class="col-lg-9 col-md-8 user-phone">{{ Session::get('userphone') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8 user-country">India</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8 user-address">{{ Session::get('usercity') }},
                                        {{ Session::get('userstate') }}, {{ Session::get('userpincode') }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                                <!-- Profile Edit Form -->
                                <form id="update-profile">

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                            Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fullName" type="text" class="form-control"
                                                id="fullName">
                                            <div class="text-danger mt-1 err-name"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email"
                                                disabled>
                                            <div class="text-danger mt-1 err-email"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control"
                                                id="Phone">
                                            <div class="text-danger mt-1 err-phone"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="aadhar" class="col-md-4 col-lg-3 col-form-label">Aadhar</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="aadhar" type="text" class="form-control" id="aadhar"
                                                disabled>
                                            <div class="text-danger mt-1 err-aadhar"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="state" class="col-md-4 col-lg-3 col-form-label">State</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="state" type="text" class="form-control"
                                                id="state"></select>
                                            <div class="text-danger mt-1 err-state"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="city" type="text" class="form-control"
                                                id="City"></select>
                                            <div class="text-danger mt-1 err-city"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="pincode" class="col-md-4 col-lg-3 col-form-label">Area
                                            Pin</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="pincode" type="text" class="form-control"
                                                id="pincode">
                                            <div class="text-danger mt-1 err-pincode"></div>
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <a class="btn btn-primary update-profile-btn">Save Changes</a>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                <!-- Change Password Form -->
                                <form id="update-password-form">

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control"
                                                id="currentPassword">
                                            <div class="text-danger mt-1 old-pwd-err"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control"
                                                id="newPassword">
                                            <div class="text-danger mt-1"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                            New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword">
                                            <div class="text-danger mt-1"></div>
                                        </div>
                                    </div>

                                    <div class="text-center update-password"></div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadProfileData() {
                // Load user profile information
                $.post("{{ url('get-user-profile-info') }}", {
                    email: "{{ Session::get('usermail') }}"
                }, function(res) {
                    // Set profile picture
                    $('#profile-pic').html(
                        `<img class="border" src="{{ asset('public/img/profile-pic/${res.image}') }}" width="150px" height="200px">`
                    );
                    // Set input field values
                    $('#fullName').val(res.name);
                    $('#Email').val(res.email);
                    $('#Phone').val(res.phone);
                    $('#aadhar').val(res.aadhar);
                    $('#pincode').val(res.pincode);
                    // Set user state ID and city ID attributes
                    $('#City').attr('user-city', res.cid);
                    $('#state').attr('user-state', res.sid);
                }).done(function() {
                    // Load state and city lists
                    loadStateList();
                    loadCityList();
                });
            }

            // Load state list
            function loadStateList() {
                $.post("{{ url('load-state-list') }}", {
                    cid: 105
                }, function(res) {
                    $('#state').html(`<option value="">Choose</option>`);
                    $.each(res, function(key, value) {
                        if (value.id == $('#state').attr('user-state')) {
                            $('#state').append(
                                `<option value="${value.id}" selected>${value.name}</option>`);
                        } else {
                            $('#state').append(
                                `<option value="${value.id}">${value.name}</option>`);
                        }
                    });
                });
            }

            // Load city list
            function loadCityList() {
                $.post("{{ url('load-city-list') }}", {
                    sid: $('#state').attr('user-state')
                }, function(res) {
                    $('#City').html(`<option value="">Choose</option>`);
                    $.each(res, function(key, value) {
                        if (value.id == $('#City').attr('user-city')) {
                            $('#City').append(
                                `<option value="${value.id}" selected>${value.city}</option>`);
                        } else {
                            $('#City').append(`<option value="${value.id}">${value.city}</option>`);
                        }
                    });
                });
            }

            $('#state').on('change', function() {
                $('#City').html(`<option value="">Choose</option>`);
                $.post("{{ url('load-city-list') }}", {
                    sid: $('#state').val()
                }, function(res) {
                    $.each(res, function(key, value) {
                        $('#City').append(
                            `<option value="${value.id}">${value.city}</option>`);
                    });
                });
            });

            loadProfileData();

            $('.update-profile-btn').on('click', function() {
                if ($('#fullName').val() == '' || $('#Phone').val() == '' || $('#state').val() == '' || $(
                        '#City').val() == '' || $('#pincode').val() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error! All fields are required',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Your information will changed!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Confirm!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ url('/update-profile-process') }}",
                                type: "POST",
                                data: {
                                    name: $('#fullName').val(),
                                    phone: $('#Phone').val(),
                                    state: $('#state').val(),
                                    city: $('#City').val(),
                                    pincode: $('#pincode').val(),
                                },
                                success: function(res) {
                                    if (res == 'pass') {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Your profile is updated',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        loadProfileData();
                                        $('.u-name').html($('#fullName').val());
                                        $('.user-name').html($('#fullName').val());
                                        $('.user-phone').html($('#Phone').val());
                                        $('.user-address').html($(
                                                '#state option:selected').html() +
                                            ', ' +
                                            $('#City option:selected').html() +
                                            ', ' + $('#pincode')
                                            .val());

                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error! Cannot update your profile',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        loadProfileData();
                                    }
                                },
                                error: function(err) {
                                    console.log(err);
                                }
                            });
                        }
                    })
                }
            });

            $('#currentPassword').on('input', function() {
                if ($(this).val() == '') {
                    $('.old-pwd-err').html(``);
                } else {
                    $.post("{{ url('typing-check-password') }}", {
                        oldpwd: $(this).val()
                    }, function(res) {
                        if (res == 'pass') {
                            $('.old-pwd-err').html(``);
                            $('.update-password').html(
                                `<a class="btn btn-primary update-password-btn">Change Password</a>`
                            );
                        } else {
                            $('.old-pwd-err').html(`Incorrect password`);
                            $('.update-password').html(``);
                        }
                    });
                }
            });
            $('#currentPassword').on('blur', function() {
                if ($(this).val() == '') {
                    $('.old-pwd-err').html(``);
                } else {
                    $.post("{{ url('typing-check-password') }}", {
                        oldpwd: $(this).val()
                    }, function(res) {
                        if (res == 'pass') {
                            $('.old-pwd-err').html(``);
                            $('.update-password').html(
                                `<a class="btn btn-primary update-password-btn">Change Password</a>`
                            );
                        } else {
                            $('.old-pwd-err').html(`Incorrect password`);
                            $('.update-password').html(``);
                        }
                    });
                }
            });
            $('#currentPassword').on('focus', function() {
                if ($(this).val() == '') {
                    $('.old-pwd-err').html(``);
                } else {
                    $.post("{{ url('typing-check-password') }}", {
                        oldpwd: $(this).val()
                    }, function(res) {
                        if (res == 'pass') {
                            $('.old-pwd-err').html(``);
                            $('.update-password').html(
                                `<a class="btn btn-primary update-password-btn">Change Password</a>`
                            );
                        } else {
                            $('.old-pwd-err').html(`Incorrect password`);
                            $('.update-password').html(``);
                        }
                    });
                }
            });

            $(document).on('click', '.update-password-btn', function() {
                if ($('#newPassword').val() == '' || $('#renewPassword').val() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error! All fields are required',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else if ($('#newPassword').val() != $('#renewPassword').val()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Passwords not matched!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else if ($('#newPassword').val() === $('#renewPassword').val()) {
                    $.post("{{ url('update-user-password') }}", {
                        pwd: $('#newPassword').val(),
                        cpwd: $('#renewPassword').val(),
                        oldpwd: $('#currentPassword').val()
                    }, function(res) {
                        if (res == 'pass') {
                            $('#update-password-form')[0].reset();
                            $('.update-password').html(``);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Password updated',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else if (res == 'nomatch') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Wrong old password!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Please try again later!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            });
            $(document).on('click', '.update-new-profile-pic-btn', function() {
                $('#profilePicUpdateForm')[0].reset();
            });
            $(document).on('click', '.update-picture', function() {
                console.log('clicked update-picture');
                let fileInput = $('#new-profile-pic')[0].files[0];
                console.log(fileInput);
                if (!fileInput) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select an image first!',
                    });
                    return;
                }
                let formData = new FormData();
                formData.append('image', fileInput);
                $.ajax({
                    type: 'POST',
                    url: '{{ url('update-profile-picture') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'pass') {
                            $('#profile-pic').html(
                                `<img class="border" src="{{ asset('public/img/profile-pic') }}/${res.image}" width="150px" height="200px">`
                            );
                            $('.u-picture').attr('src', "{{asset('public/img/profile-pic')}}" + '/' + res.image);
                            $('#updatePicture').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Profile updated successfully',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        console.log(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: xhr.responseJSON.errors.image[0],
                        });
                    }
                });
            });

        });
    </script>