<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Active Post</h5>

                        <!-- Table with stripped rows -->
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            <div class="datatable-container">
                                <table class="table" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Username</th>
                                            <th>Posted</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="activeAdsList">
                                        {{-- List --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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

        function fetchActivePosts() {
            $.ajax({
                url: "{{ url('admin/fetch-active-posts') }}",
                type: "GET",
                async: false,
                success: function(res) {
                    $('#activeAdsList').html(``);
                    $.each(res, function(key, value) {
                        var formattedDate = moment(value.posted, "YYYY-MM-DD HH:mm:ss")
                            .format("MMM D, YYYY");
                        $('#activeAdsList').append(`
                            <tr>
                                <td>${value.title}</td>
                                <td>${value.username}</td>
                                <td>${formattedDate}</td>
                                <td style="text-transform: capitalize;" class="text-success">${value.status}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary view" data="${value.id}">View</a>
                                    <a class="btn btn-sm btn-warning expire" data="${value.id}">Expire</a>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }
        fetchActivePosts();
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

        $(document).on('click', '.expire', function() {
            let id = $(this).attr('data');
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, expire it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/expire-post') }}",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            if (res) {
                                Swal.fire(
                                    'Expired!',
                                    'House expired successfully!',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Pleas try after sometimes!',
                                    'fail'
                                )
                            }
                            $('#mytable').DataTable().destroy();
                            fetchActivePosts();
                            $('#mytable').DataTable().draw();
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                }
            })
        });
    });
</script>
