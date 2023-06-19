<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <style>
        .search-bar {
            margin-top: 2vh;
            margin-bottom: 5vh;
        }

        .search-header {
            margin-top: 10vh;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 100%;
            border: none;
            border-bottom: 1px solid #ccc;
        }

        .search-bar input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        .search-bar input[type="submit"]:hover {
            background-color: #45a049;
        }

        .card-columns {
            margin-top: 20px;
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
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('renter-bookings') }}">My Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('renter-profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('renter-contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Search Bar -->
    <div class="container">
        <div class="row">
            <h1 class="text-center search-header">Find your dream house now</h1>
            <div class="col-md-6 offset-md-3 search-bar">
                <form action="#" method="get">
                    <div class="input-group mb-3 flex-nowrap">
                        <input type="text" class="form-control" placeholder="Enter city, state, or ZIP code">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Default View -->
    <div class="container">
        <h2>Popular Rentals</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 house-list">
            {{-- Dynamic Data --}}
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
                    <button type="button" class="btn btn-primary book-house">Book Now</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="booking-modal" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="booking-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="booking-modalLabel">Modal title</h1>
                    <button type="button" class="btn-close close-payment" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="booking-modal-body">
                    {{-- Dynamic --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-payment"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
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

            function onpageload() {
                $.ajax({
                    url: "{{ url('load-all-houses-for-renter') }}",
                    type: "POST",
                    success: function(res) {
                        $('.house-list').html(``);
                        if (res.length == 0) {
                            $('.house-list').html(`
                            <h1 class="w-100 text-center">No adss</h1>
                            `);
                        }
                        $.each(res, function(key, value) {
                            if (value.booking == 1) {
                                $('.house-list').append(`
                            <div class="col">
                              <div class="card h-100">
                                  <img src="{{ asset('public/img/house-img/${value.image}') }}" class="card-img-top" alt="house-${value.house_id}" height="250px">
                                  <div class="card-body">
                                      <h5 class="card-title">${value.house_title}</h5>
                                      <span class="card-text"><strong>Rooms:</strong> ${value.house_rooms}</span><br>
                                      <span class="card-text"><strong>Price:</strong> ${value.house_rent}</span><br><br>
                                      <a href="{{ url('renter-bookings') }}" class="btn btn-primary goto-bookings">Goto Bookings</a>
                                  </div>
                              </div>
                            </div>
                        `);
                            } else {
                                $('.house-list').append(`
                            <div class="col">
                              <div class="card h-100">
                                  <img src="{{ asset('public/img/house-img/${value.image}') }}" class="card-img-top" alt="house-${value.house_id}" height="250px">
                                  <div class="card-body">
                                      <h5 class="card-title">${value.house_title}</h5>
                                      <span class="card-text"><b>Rooms:</b> ${value.house_rooms} <b>Kitchens: </b>${value.house_kitchen} <b>Bathrooms: </b>${value.house_bathrooms}</span><br>
                                      <span class="card-text"><b>Rent: </b>${value.house_rent} ${value.rent_type}</span><br><br>
                                      <a class="btn btn-primary book-this-house" data="${value.house_id}">Book Now</a>
                                      <a class="btn btn-primary view-house" data="${value.house_id}">View Details</a>
                                  </div>
                              </div>
                            </div>
                        `);
                            }
                        });
                    }
                });
            }

            onpageload();

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

            $(document).on('click', '.view-house', function() {
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
                        $('.book-house').attr('data', res.info.house_id);
                        $('#houseDetalsModal').modal('show');
                    },
                });
            });

            $(document).on('click', '.book-house', function() {
                let hid = $(this).attr('data');
                $.ajax({
                    url: "{{ url('get-house-for-booking') }}",
                    type: "POST",
                    data: {
                        hid: hid
                    },
                    success: function(res) {
                        $('#booking-modalLabel').text(res.house_title);
                        $('#booking-modal-body').html(`
                          <div class="container mt-5">
                            <div class="row justify-content-center">
                              <div class="col-lg-6">
                                <div class="card">
                                  <div class="card-body">
                                    <h5 class="card-title">Confirm Payment</h5>
                                    <hr>
                                    <form id="payment_form">
                                      <div class="form-group">
                                        <label for="name">Name on Card<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="John Doe">
                                        <div class="text-danger errors error-name"></div>
                                      </div>
                                      <div class="form-group">
                                        <label for="card">Card Number<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="card" placeholder="1234 5678 9012 3456">
                                        <div class="text-danger errors error-card"></div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="expiry">Expiry Date<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="expiry" placeholder="MM/YY">
                                          <div class="text-danger errors error-expiry"></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="cvv">CVV<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="cvv" placeholder="123">
                                          <div class="text-danger errors error-cvv"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="amount">Amount<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="amount" data="${res.house_id}" value="${res.house_rent}"><br>
                                      </div>
                                      <a class="btn btn-primary btn-block pay-now">Pay Now</a>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        `);
                        $('#houseDetalsModal').modal('hide');
                        $('#booking-modal').modal('show');
                    }
                });
            });
            $(document).on('click', '.book-this-house', function() {
                let hid = $(this).attr('data');
                $.ajax({
                    url: "{{ url('get-house-for-booking') }}",
                    type: "POST",
                    data: {
                        hid: hid
                    },
                    success: function(res) {
                        $('#booking-modalLabel').text(res.house_title);
                        $('#booking-modal-body').html(`
                          <div class="container mt-5">
                            <div class="row justify-content-center">
                              <div class="col-lg-6">
                                <div class="card">
                                  <div class="card-body">
                                    <h5 class="card-title">Confirm Payment</h5>
                                    <hr>
                                    <form id="payment_form">
                                      <div class="form-group">
                                        <label for="name">Name on Card<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="John Doe">
                                        <div class="text-danger errors error-name"></div>
                                      </div>
                                      <div class="form-group">
                                        <label for="card">Card Number<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="card" placeholder="1234 5678 9012 3456">
                                        <div class="text-danger errors error-card"></div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="expiry">Expiry Date<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="expiry" placeholder="MM/YY">
                                          <div class="text-danger errors error-expiry"></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="cvv">CVV<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" id="cvv" placeholder="123">
                                          <div class="text-danger errors error-cvv"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="amount">Amount<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="amount" data="${res.house_id}" value="${res.house_rent}"><br>
                                      </div>
                                      <a class="btn btn-primary btn-block pay-now">Pay Now</a>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        `);
                        $('#houseDetalsModal').modal('hide');
                        $('#booking-modal').modal('show');
                    }
                });
            });

            // Check name 
            $(document).on('input', '#name', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-name').html('Name is required!');
                } else {
                    $('.error-name').html('');
                }
            });

            $(document).on('focus', '#name', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-name').html('Name is required!');
                } else {
                    $('.error-name').html('');
                }
            });

            $(document).on('blur', '#name', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-name').html('Name is required!');
                } else {
                    $('.error-name').html('');
                }
            });

            // Check expiry 
            $(document).on('input', '#expiry', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-expiry').html('Expiry date is required!');
                } else {
                    $('.error-expiry').html('');
                }
                if (data.length == 2) {
                    $(this).val(data + '/');
                    if (data.indexOf("/") !== -1) {
                        $(this).val(data.slice(0, -1));
                    }
                }
            });

            $(document).on('focus', '#expiry', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-expiry').html('Expiry date is required!');
                } else {
                    $('.error-expiry').html('');
                }
            });

            $(document).on('blur', '#expiry', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-expiry').html('Expiry date is required!');
                } else {
                    $('.error-expiry').html('');
                }
            });

            // Check card number 
            $(document).on('input', '#card', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-card').html('Card number is required!');
                } else if (!$.isNumeric(data)) {
                    $('.error-card').html('Invalid card number!');
                } else {
                    $('.error-card').html('');
                }
            });

            $(document).on('focus', '#card', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-card').html('Card number is required!');
                } else if (!$.isNumeric(data)) {
                    $('.error-card').html('Invalid card number!');
                } else {
                    $('.error-card').html('');
                }
            });

            $(document).on('blur', '#card', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-card').html('Card number is required!');
                } else if (!$.isNumeric(data)) {
                    $('.error-card').html('Invalid card number!');
                } else if (data.length != 16) {
                    $('.error-card').html('Invalid card number!');
                } else {
                    $('.error-card').html('');
                }
            });

            // Check cvv number 
            $(document).on('input', '#cvv', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-cvv').html('cvv number is required!');
                } else if (!$.isNumeric(data)) {
                    $('.error-cvv').html('Invalid cvv number!');
                } else if (data.length != 3) {
                    $('.error-cvv').html('Invalid cvv number!');
                } else {
                    $('.error-cvv').html('');
                }
            });

            $(document).on('focus', '#cvv', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-cvv').html('cvv number is required!');
                } else if (!$.isNumeric(data)) {
                    $('.error-cvv').html('Invalid cvv number!');
                } else {
                    $('.error-cvv').html('');
                }
            });

            $(document).on('blur', '#cvv', function() {
                let data = $(this).val();
                if ($.isEmptyObject(data)) {
                    $('.error-cvv').html('cvv number is required!');
                } else if (!$.isNumeric(data)) {
                    $('.error-cvv').html('Invalid cvv number!');
                } else {
                    $('.error-cvv').html('');
                }
            });

            $(document).on('click', '.pay-now', function() {
                let name = $('#name').val();
                let card = $('#card').val();
                let expiry = $('#expiry').val();
                let cvv = $('#cvv').val();
                let amount = $('#amount').val();
                let hid = $('#amount').attr('data');

                let exp = expiry.split('/');
                let expMonth = parseInt(exp[0]);
                let expYear = 2000 + parseInt(exp[1]);

                let currentYear = new Date().getFullYear();
                let currentMonth = new Date().getMonth() + 1;

                if ($.isEmptyObject(name) || $.isEmptyObject(card) || $.isEmptyObject(expiry) || $
                    .isEmptyObject(cvv) || $.isEmptyObject(amount)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Empty Fields found!',
                    })
                } else if (expMonth > 12 || expMonth <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Wrong expiry month!',
                    })
                    $('.error-expiry').html('Wrong expiry month!');
                } else if (expYear < currentYear) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Card Expired!',
                    })
                    $('.error-expiry').html('Card Expired!');
                } else if (!$.isNumeric(card)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid card number!',
                    })
                    $('.error-card').html('Invalid card number!');
                } else if (card.length != 16) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid card number!',
                    })
                    $('.error-card').html('Invalid card number!');
                } else if (!$.isNumeric(cvv)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid cvv number!',
                    })
                    $('.error-cvv').html('Invalid cvv number!');
                } else if (cvv.length != 3) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid cvv number!',
                    })
                    $('.error-cvv').html('Invalid cvv number!');
                } else {
                    if (expYear == currentYear) {
                        if (expMonth >= currentMonth) {
                            $.ajax({
                                url: "{{ url('make-payment') }}",
                                type: "POST",
                                data: {
                                    name: name,
                                    card: card,
                                    amount: amount,
                                    hid: hid,
                                    expMonth: expMonth,
                                    expYear: expYear,
                                    cvv: cvv,
                                },
                                success: function(res) {
                                    if (res == 'pass') {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Booking Successful',
                                            showConfirmButton: false,
                                            timer: 3000
                                        })
                                        $('#booking-modal').modal('hide');
                                        onpageload();
                                    } else if (res == 'booked') {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'House is already booked!',
                                        })
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Booking failed!',
                                        })
                                    }
                                },
                                error: function(err) {
                                    console.log(err);
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Card expired!',
                            })
                            $('.error-expiry').html('Card Expired!');
                        }
                    } else if (expYear > currentYear) {
                        $.ajax({
                            url: "{{ url('make-payment') }}",
                            type: "POST",
                            data: {
                                name: name,
                                card: card,
                                amount: amount,
                                hid: hid,
                                expMonth: expMonth,
                                expYear: expYear,
                                cvv: cvv,
                            },
                            success: function(res) {
                                if (res == 'pass') {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Booking Successful',
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                    $('#booking-modal').modal('hide');
                                    onpageload();
                                } else {
                                    console.log(res);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Booking failed!',
                                    })
                                }
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        });
                    }
                }
            });

        });
    </script>
</body>

</html>
