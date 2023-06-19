<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent|Bookings</title>
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
                        <a class="nav-link active" aria-current="page" href="{{ url('renter-bookings') }}">My
                            Bookings</a>
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
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis"><span class="greeting"></span> <span class="username"></span>
        </h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">In this area you can easily manage your house bookings and check updates of your
                current house booking. Users are advised to beware form fraud deals. Don't make payment from any other
                insecure platform. Use our secure payment platform and we will take care of everything for you.</p>
        </div>
    </div>
    <div class="container">
        <h2 class="w-100 text-center">Your Bookings</h2>
        <table id="example" class="display table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%;">S.no.</th>
                    <th style="width: 35%;">Title</th>
                    <th style="width: 10%;">Rent Amount</th>
                    <th style="width: 10%;">Payment Status</th>
                    <th style="width: 10%;">Booking Status</th>
                    <th style="width: 30%;">Action</th>
                </tr>
            </thead>
            <tbody id="house-list">

            </tbody>
        </table>
    </div>
    {{-- Payment Receipt Modal --}}
    <div class="modal fade" id="paymentReceiptModal" tabindex="-1" aria-labelledby="paymentReceiptModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paymentReceiptModalLabel">House For Rent</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="paymentReceiptBody">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card mt-5">
                                    <div class="card-header">
                                        <h5 class="card-title">Payment Receipt</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Renter Name:</label>
                                            <input type="text" class="form-control" id="name" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Property Name:</label>
                                            <input type="text" class="form-control" id="propertyName" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount:</label>
                                            <input type="text" class="form-control" id="amount" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date:</label>
                                            <input type="text" class="form-control" id="date" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="transaction-id">Transaction ID:</label>
                                            <input type="text" class="form-control" id="transaction-id" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printReceipt()">Print Receipt</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Footer --}}
    <x-footer />
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/sweetalert2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        function printReceipt() {
            window.print();
        }
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
                    url: "{{ url('fetch-renter-bookings') }}",
                    type: "POST",
                    success: function(res) {
                        $('#example').DataTable().destroy();
                        $('#house-list').html(``);
                        $.each(res, function(key, value) {
                            let paymentStatus = '';
                            let bookingStatus = '';
                            if (value.payment_status == 1) {
                                paymentStatus = 'Complete';
                            } else {
                                paymentStatus = 'Incomplete';
                            }

                            if (value.booking_status == 1) {
                                bookingStatus = 'Active';
                            } else if (value.booking_status == 2) {
                                bookingStatus = 'Expired';
                            } else if (value.booking_status == 3) {
                                bookingStatus = 'Cancelled';
                            } else {
                                bookingStatus = 'Inactive';
                            }

                            if(bookingStatus == 'Active'){
                                $('#house-list').append(`
                                    <tr>
                                        <td>${key+1}</td>
                                        <td>${value.house_title}</td>
                                        <td>${value.house_rent}</td>
                                        <td style="text-transform: capitalize">${paymentStatus}</td>
                                        <td style="text-transform: capitalize">${bookingStatus}</td>
                                        <td>
                                            <a class="payment-receipt btn btn-sm btn-primary" data="${value.payment_id}" style="cursor: pointer;">Payment receipt</a>
                                            <a class="cancel-booking btn btn-sm btn-danger" data="${value.payment_id}" style="cursor: pointer;">Cancel booking</a>
                                        </td>
                                    </tr>
                                `);
                            } else {
                                $('#house-list').append(`
                                    <tr>
                                        <td>${key+1}</td>
                                        <td>${value.house_title}</td>
                                        <td>${value.house_rent}</td>
                                        <td style="text-transform: capitalize">${paymentStatus}</td>
                                        <td style="text-transform: capitalize">${bookingStatus}</td>
                                        <td>
                                            <a class="payment-receipt btn btn-sm btn-primary" data="${value.payment_id}" style="cursor: pointer;">Payment receipt</a>
                                        </td>
                                    </tr>
                                `);
                            }

                        });
                        $('#example').DataTable({});
                    }
                });
            }
            loadHouseList();

            $(document).on('click', '.payment-receipt', function() {
                let pid = $(this).attr('data');
                $.ajax({
                    url: "{{ url('get-payment-info') }}",
                    type: "POST",
                    data: {
                        pid: pid
                    },
                    success: function(res) {
                        var formattedDate = moment(res.date, "YYYY-MM-DD HH:mm:ss").format("MMM D, YYYY");
                        $('#name').val(res.name);
                        $('#propertyName').val(res.propertyName);
                        $('#email').val(res.email);
                        $('#amount').val(res.amount);
                        $('#date').val(formattedDate);
                        $('#transaction-id').val(res.transaction);
                        $('#paymentReceiptModal').modal('show');
                    }
                });
            });

            $(document).on('click', '.cancel-booking', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will get no refunds!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("{{ url('cancel-booking') }}", {
                            pid: $(this).attr('data')
                        }, function(res) {
                            if (res) {
                                loadHouseList();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Cancled',
                                    text: 'Booking cancelled successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                loadHouseList();
                                Swal.fire({
                                    icon: 'error',
                                    title: "error",
                                    text: "Can't cancel right now!"
                                })
                            }
                        }).fail(function(err) {
                            console.log(err);
                            Swal.fire({
                                icon: 'error',
                                title: "error",
                                text: err.responseJSON.message
                            })
                        });
                    }
                })
            });
        });
    </script>
</body>

</html>
