<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent|Contact</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-icons.css') }}">
</head>

<body class="">
    <nav class="navbar navbar-expand-lg bg-body-tertiary w-100">
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
                        <a class="nav-link active" aria-current="page" href="{{ url('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- Main Content --}}
    <div class="container d-flex align-items-center flex-column my-5">
        <h1 class="mb-3 fw-bold">Contact Us</h1>
        <form id="comment-form" style="width: 75%;">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="Your full name here">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="usermail" name="usermail"
                    placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Write your message here</label>
                <textarea class="form-control" id="comment" name="comment" rows="10" style="resize: none;"></textarea>
            </div>
            <div class="mb-3 text-center">
                <a class="btn btn-primary" id="comment-submit" style="cursor: pointer;">Submit</a>
                <button class="btn btn-secondary" type="reset">Clear</button>
            </div>
        </form>
    </div>
    {{-- Contact Info --}}
    <div class="container-fluid mb-0 pb-0">
        <div class="d-flex justify-content-around">
            <div class="border w-50 px-5 py-3">
                <h4 class="text-center">Contact Details</h4>
                <div class="mt-5">
                    <p><b>Chandra Kishore Gupta</b></p>
                    <p><b>Email:</b> ckg4155@gmail.com</p>
                    <p><b>Phone:</b> +918709250721, +918678861104</p>
                    <p><b>Address:</b> Phulwari Sharif Patna Bihar, 801505</p>
                </div>
            </div>
            <div class="border w-50 py-3">
                <h4 class="text-center">Follow Us</h4>
                <div class="text-center fs-1 mt-5">
                    <a href="https://www.linkedin.com/in/chandra-kishore-gupta-4044671bb" target="_blank" class="social-icon mx-3" style="text-decoration: none;">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="https://wa.me/918709250721" class="social-icon mx-3" style="text-decoration: none;">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://t.me/ketan00001" class="social-icon mx-3" style="text-decoration: none;">
                        <i class="bi bi-telegram"></i>
                    </a>
                </div>
            </div>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d115146.41914227768!2d85.13756449999997!3d25.5940947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1684046515631!5m2!1sen!2sin"
            width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <x-footer />

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
            $('#comment-submit').on('click', function() {
                let username = $('#username').val();
                let usermail = $('#usermail').val();
                let comment = $('#comment').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('send-comment') }}",
                    data: {
                        username: username,
                        usermail: usermail,
                        comment: comment,
                    },
                    success: function(res) {
                        if (res == 'success') {
                            $('#comment-form')[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "Your message sent successfully",
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: "Error while sending message!",
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                        }
                    },
                    error: function(e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
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
