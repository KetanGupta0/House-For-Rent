<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent|Houses</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/jquery.dataTables.min.css') }}">
</head>

<body>
    <!-- Navbar -->
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
                        <a class="nav-link" href="{{ url('/') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('owner-houses') }}">My Houses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('owner-profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('owner-contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- Add House --}}
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis"><span class="greeting"></span> <span class="username"></span></h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Let's start with a fresh house post from right here. Your newly posted house rent add
                will be under review or may take 24 hours to be active on our site. To start posting click the button
                below.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-primary btn-lg px-4 gap-3" data-bs-toggle="modal"
                    data-bs-target="#addHouseModal">Add your house</button>
            </div>
        </div>
    </div>
    {{-- Add House Modal --}}
    <div class="modal fade" id="addHouseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addHouseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addHouseModalLabel">Add your house</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-house" class="row g-3" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Title of your house">
                        </div>
                        <div class="col-md-4">
                            <label for="rooms" class="form-label">Rooms</label>
                            <input type="text" class="form-control" id="rooms" name="rooms"
                                placeholder="Ex- 1,2,3,etc...">
                        </div>
                        <div class="col-md-4">
                            <label for="bathrooms" class="form-label">Bathrooms</label>
                            <input type="text" class="form-control" id="bathrooms" name="bathrooms"
                                placeholder="Ex- 1,2,3,etc...">
                        </div>
                        <div class="col-md-4">
                            <label for="kitchens" class="form-label">Kitchens</label>
                            <input type="text" class="form-control" id="kitchens" name="kitchens"
                                placeholder="Ex- 1,2,3,etc...">
                        </div>
                        <div class="col-md-4">
                            <label for="size" class="form-label">Size in square feet</label>
                            <input type="text" class="form-control" id="size" name="size"
                                placeholder="Ex- 200,300,400,500,etc">
                        </div>
                        <div class="col-md-4">
                            <label for="rent" class="form-label">Rent Amount</label>
                            <input type="text" class="form-control" id="rent" name="rent"
                                placeholder="Ex- 200,300,400,500,etc">
                        </div>
                        <div class="col-md-4">
                            <label for="type" class="form-label">Rent Type</label><br>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select Rent Type</option>
                                <option value="daily">Daily</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Ex- Village, City, State, Country, pincode">
                        </div>
                        <div class="col-6">
                            <label for="description" class="form-label">House Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                        </div>
                        <div class="col-6 text-center">
                            <label for="images" class="form-label">Upload Images</label><br>
                            <input class="form-control" type="file" name="images[]" id="images" multiple accept="image/*"
                                max="5">
                        </div>
                        <div class="col-12 text-center">
                            <a id="post-house" class="btn btn-primary" style="cursor: pointer;">Post</a>
                            <button type="reset" class="btn btn-secondary">Clear</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <hr class="w-100">
    {{-- House Data Table --}}
    <div class="container">
        <h2 class="w-100 text-center">Your houses</h2>
        <table id="example" class="display table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>S.no.</th>
                    <th>Title</th>
                    <th>Rent Amount</th>
                    <th>Rent Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="house-list">

            </tbody>
        </table>
    </div>
    <hr class="w-100">
    {{-- House details modal --}}
    <div class="modal fade" id="houseDetalsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="houseDetalsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="houseDetalsModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="houseDetalsModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <x-footer />
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/sweetalert2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let fullname = "{{ Session::get('username') }}";
            let name = fullname.split(' ');
            $(".username").text(name[0]);

            var currentDate = new Date();
            var hour = currentDate.getHours();
            if (hour >= 0 && hour < 12) {
                $(".greeting").text('Good Morning,');
            } else if (hour >= 12 && hour < 17) {
                $(".greeting").text('Good Afternoon,');
            } else if (hour >= 17 && hour < 20) {
                $(".greeting").text('Good Evening,');
            } else if (hour >= 20 || hour < 0) {
                $(".greeting").text('Good Night,');
            }

            function loadHouseList() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('fetch-owner-houses') }}",
                    type: "POST",
                    success: function(res) {
                        // Clear the existing table data
                        $('#example').DataTable().destroy();
                        $('#house-list').html(``);
                        // Loop through the response data and append each record to the table
                        $.each(res, function(key, value) {
                            $('#house-list').append(`
                                <tr>
                                    <td>${key+1}</td>
                                    <td>${value.house_title}</td>
                                    <td>${value.house_rent}</td>
                                    <td style="text-transform: capitalize">${value.rent_type}</td>
                                    <td style="text-transform: capitalize">${value.house_status}</td>
                                    <td>
                                        <a class="view btn btn-sm btn-primary" data="${value.house_id}" style="cursor: pointer;">View</a>
                                        <a class="delete btn btn-sm btn-primary" data="${value.house_id}" style="cursor: pointer;">Delete</a>
                                    </td>
                                </tr>
                            `);
                        });

                        // Initialize the DataTable plugin on the table
                        $('#example').DataTable({
                            // Your DataTable options here
                        });
                    }
                });
            }
            loadHouseList();

            $(document).on('click', '.view', function() {
                let id = $(this).attr('data');
                $.ajax({
                    url: "{{ url('get-house-data') }}",
                    type: 'POST',
                    data: {
                        hid: id
                    },
                    success: function(res) {
                        let timestamp = new Date(res.info.created_at).getTime();
                        let now = Date.now();
                        let diff = now - timestamp;

                        let seconds = Math.floor(diff / 1000);
                        let minutes = Math.floor(seconds / 60);
                        let hours = Math.floor(minutes / 60);
                        let days = Math.floor(hours / 24);

                        let result;

                        if (days > 1) {
                            result = `${days} days ago`;
                        } else if (days === 1) {
                            result = `1 day ago`;
                        } else if (hours > 1) {
                            result = `${hours} hours ago`;
                        } else if (hours === 1) {
                            result = `1 hour ago`;
                        } else if (minutes > 1) {
                            result = `${minutes} minutes ago`;
                        } else if (minutes === 1) {
                            result = `1 minute ago`;
                        } else if (seconds > 5) {
                            result = `${seconds} seconds ago`;
                        } else {
                            result = `just now`;
                        }
                        $('#houseDetalsModalLabel').html(res.info.house_title);
                        $('#houseDetalsModalBody').html(``);
                        $('#houseDetalsModalBody').append(`
                            <div class="container-fluid">
                                <div id="current-house-images" class="w-100 d-flex flex-wrap">`);
                        $.each(res.images, function(key, value) {
                            $('#houseDetalsModalBody').append(
                                `<img src="{{ asset('public/img/house-img/${value.image_name}') }}" width="170" height="100" class="border mx-3">`
                                );
                        });
                        $('#houseDetalsModalBody').append(`</div>
                                <hr class="w-100">
                                <div>
                                    <h2 class="w-100 text-center my-3">House Information</h2>
                                    <table class="table">
                                        <tr>
                                            <th>Bed Rooms<th>
                                            <td>${res.info.house_rooms}<td>
                                        </tr>
                                        <tr>
                                            <th>Kitchens<th>
                                            <td>${res.info.house_kitchen}<td>
                                        </tr>
                                        <tr>
                                            <th>Bathrooms<th>
                                            <td>${res.info.house_bathrooms}<td>
                                        </tr>
                                        <tr>
                                            <th>Size in sq.f.<th>
                                            <td>${res.info.house_size}<td>
                                        </tr>
                                        <tr>
                                            <th>Rent Amount<th>
                                            <td>${res.info.house_rent}<td>
                                        </tr>
                                        <tr>
                                            <th>Rent Type<th>
                                            <td style="text-transform: capitalize">${res.info.rent_type}<td>
                                        </tr>
                                        <tr>
                                            <th>Address<th>
                                            <td>${res.info.house_address}<td>
                                        </tr>
                                        <tr>
                                            <th>Description<th>
                                            <td>${res.info.house_description}<td>
                                        </tr>
                                        <tr>
                                            <th>Posted At<th>
                                            <td>${result}<td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        `);
                        $('#houseDetalsModal').modal('show');
                    },
                });
            });

            $(document).on('click', '.delete', function() {
                let id = $(this).attr('data');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('delete-house-data') }}",
                            type: 'POST',
                            data: {
                                hid: id
                            },
                            success: function(res) {
                                if (res == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    loadHouseList();
                                } else {
                                    Swal.fire(
                                        'Not Deleted!',
                                        'Your file has not been deleted.',
                                        'fail'
                                    )
                                    loadHouseList();
                                }
                            }
                        });
                    }
                })
            });

            $('#post-house').on('click', function() {
                let title = $('#title').val();
                let size = $('#size').val();
                let rooms = $('#rooms').val();
                let bathrooms = $('#bathrooms').val();
                let kitchens = $('#kitchens').val();
                let address = $('#address').val();
                let description = $('#description').val();
                let rent = $('#rent').val();
                let type = $('#type').val();
                let files = $('#images')[0].files;
                let formData = new FormData();
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    formData.append('images[]', file, file.name);
                }
                formData.append('title', title);
                formData.append('size', size);
                formData.append('rooms', rooms);
                formData.append('bathrooms', bathrooms);
                formData.append('kitchens', kitchens);
                formData.append('address', address);
                formData.append('description', description);
                formData.append('type', type);
                formData.append('rent', rent);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('add-new-house') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 'success') {
                            $('#add-house')[0].reset();
                            $('#addHouseModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "New house post added successfully",
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                            loadHouseList();
                        } else if (response == 'imgerror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: "Error while uploading image!",
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            })
                        } else if (response == 'sessionerror') {
                            window.location.href = "{{ url('/') }}";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unknown',
                                text: "Unknown error while saving house details!",
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
