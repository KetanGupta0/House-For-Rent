<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent|House List</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <style>
        .card-text {
            max-height: 80px;
            /* adjust as needed */
            overflow: hidden;
        }
    </style>
</head>

<body>
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
                        <a class="nav-link active" aria-current="page" href="{{ url('houses') }}">Houses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact</a>
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
    <main>
        <section class="py-5 text-center container-fluid bg-dark text-light">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Search Your Dream House</h1>
                    <input class="form-control me-2 mt-5" type="search" placeholder="Search" aria-label="Search"><br>
                    <a class="btn btn-outline-success search-btn" type="submit">Search</a>
                </div>
            </div>
        </section>

        <div class="album py-5">
            <div class="container">
                <div class="d-flex justify-content-between flex-wrap" id="house-list">
                    {{-- Dynamic Data --}}
                </div>
            </div>
        </div>
    </main>
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

            function timeCalc(time) {
                let timestamp = new Date(time).getTime();
                let now = Date.now();
                let diff = now - timestamp;

                let seconds = Math.floor(diff / 1000);
                let minutes = Math.floor(seconds / 60);
                let hours = Math.floor(minutes / 60);
                let days = Math.floor(hours / 24);

                if (days > 1) {
                    return `${days} days ago`;
                } else if (days === 1) {
                    return `1 day ago`;
                } else if (hours > 1) {
                    return `${hours} hours ago`;
                } else if (hours === 1) {
                    return `1 hour ago`;
                } else if (minutes > 1) {
                    return `${minutes} minutes ago`;
                } else if (minutes === 1) {
                    return `1 minute ago`;
                } else if (seconds > 5) {
                    return `${seconds} seconds ago`;
                } else {
                    return `just now`;
                }
            }
            $.ajax({
                url: "{{ url('load-all-houses') }}",
                type: "POST",
                success: function(res) {
                    if (res != '') {
                        $('#house-list').html(``);
                        $.each(res, function(key, value) {
                            $('#house-list').append(`
                                <div class="cols p-0 my-5 border">
                                    <div class="card shadow-sm" style="max-width: 300px; min-width: 300px; height: 100%;">
                                        <img src="{{ asset('public/img/house-img/${value.image}') }}" class="bd-placeholder-img card-img-top" width="100%" height="225px">
                                        <div class="card-body overflow-hidden">
                                            <h4 class="">${value.house_title}</h4>
                                            <p class="card-text"><b>Rooms: </b>${value.house_rooms} <b>Kitchens: </b>${value.house_kitchen} <b>Bathrooms: </b>${value.house_bathrooms}</p>
                                            <p class="card-text"><b>Rent: </b>${value.house_rent} ${value.rent_type}</p>
                                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary chk-avlb" data="${value.house_id}">Check Availability</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary more-info" data="${value.house_id}">More Information</button>
                                                </div>
                                                <small class="text-body-secondary mt-2">${timeCalc(value.created_at)}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('#house-list').html(`
                  <i class="bi bi-building-fill-exclamation text-warning text-center w-100" style="font-size: 200px;"></i>
                  <div class="text-center fs-3 w-100">No record available!</div>
                  `);
                    }
                }
            });

            $(document).on('click', '.chk-avlb', function() {
                $.post("{{ url('check-available') }}", {
                    hid: $(this).attr('data')
                }, function(res) {
                    if (res) {
                        // alert('Available');
                        Swal.fire({
                            icon: 'success',
                            title: 'Available',
                            text: "This house is available for booking.",
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Not Available',
                            text: "This house is already booked.",
                        })
                    }
                });
            });

            $(document).on('click', '.more-info', function() {
                let id = $(this).attr('data');
                $.ajax({
                    url: "{{ url('get-house-data') }}",
                    type: 'POST',
                    data: {
                        hid: id
                    },
                    success: function(res) {
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
                                            <td>${timeCalc(res.info.created_at)}<td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        `);
                        $('#houseDetalsModal').modal('show');
                    },
                });
            });
            $(document).on('click', '.search-btn', function() {
                Swal.fire({
                    title: 'Feature not available!',
                    text: 'Sorry this feature is not available right now!',
                })
            });
        });
    </script>
</body>

</html>
