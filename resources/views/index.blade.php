<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .card-text {
            max-height: 80px;
            /* adjust as needed */
            overflow: hidden;
        }


        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }
    </style>
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
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
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
                        <a class="nav-link" href="{{ url('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- Carousel --}}
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('public/img/cp1.jpg') }}" class="d-block w-100" height="600px" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Find Your Dream House</h5>
                    <p>Now your dream house can be yours in just a few minutes.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('public/img/cp2.jpg') }}" class="d-block w-100" height="600px" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Easy Search</h5>
                    <p>Finding rentals in new cities becomes easy now.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('public/img/cp3.jpg') }}" class="d-block w-100" height="600px" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Most Trusted Platform</h5>
                    <p>Trusted by 1000+ people over the INDIA.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container text-center my-5">
        <h1 class="bg-primary-subtle rounded-3 py-3">Recently Posted House Ads</h1>
    </div>
    {{-- Main Content --}}
    <div class="container">
        <div class="container text-center">
            <div class="row my-3" id="house-list">

            </div>
        </div>
    </div>
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
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function timeCalc(time){
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
                url: "{{ url('load-houses') }}",
                type: "POST",
                success: function(response) {
                    if (response != '') {
                        $('#house-list').html(``);
                        $.each(response, function(key, value) {
                            let time = timeCalc(value.time)
                            $('#house-list').append(`
                            <div class="col my-3 mx-3">
                              <div class="card" style="width: 18rem;">
                                <img src="{{ asset('public/img/house-img/${value.image}') }}" class="card-img-top" height="225px" alt="">
                                <div class="card-body text-start">
                                  <h5 class="card-title">${value.house_title}</h5>
                                  <p class="card-text"><b>Rooms: </b>${value.house_rooms} <br> <b>Kitchens: </b>${value.house_kitchen}<br> <b>Bathrooms: </b>${value.house_bathrooms}</p>
                                  <p class="card-text"><b>Rent: </b>${value.house_rent} ${value.rent_type}</p>
                                  <a class="btn btn-primary view" data="${value.house_id}">View</a><span class="float-end"><b>Posted: </b><span class="text-muted">${time}</span></span>
                                </div>
                              </div>
                            </div>
                          `);
                        });
                    } else {
                        $('#house-list').html(`
                      <div class="text-center text-info" style="font-size: 100px;"><i class="bi bi-emoji-frown-fill"></i></div>
                      <div class="text-center fs-5">Sorry nothing to show</div>
                      `);
                    }
                },
            });
            $(document).on('click', '.view', function() {
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
        });
    </script>
</body>

</html>
