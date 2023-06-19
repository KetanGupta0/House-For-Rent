<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">House For Rent Admin List</h5>

                        <!-- Table with stripped rows -->
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            <div class="datatable-container">
                                <table class="table" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Name</th>
                                            <th>Joining</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="adminList">
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
{{-- Admin details modal --}}
<div class="modal fade" id="adminDetalsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="adminDetalsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="adminDetalsModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-5">
                    <div class="row" id="adminDetalsModalBody">
                        
                    </div>
                </div>
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

        function fetchAdminList() {
            $.ajax({
                url: "{{ url('admin/fetch-admins') }}",
                type: "GET",
                async: false,
                success: function(res) {
                    $('#adminList').html(``);
                    $.each(res, function(key, value) {
                        var formattedDate = moment(value.created_at, "YYYY-MM-DD HH:mm:ss")
                            .format("MMM D, YYYY");
                        if (value.user_status == 1) {
                            $('#adminList').append(`
                                <tr>
                                    <td>${key+1}</td>
                                    <td>${value.user_name}</td>
                                    <td>${formattedDate}</td>
                                    <td class="text-primary">Active</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary view" data="${value.user_id}">View</a>
                                        <a class="btn btn-sm btn-danger block" data="${value.user_id}">Block</a>
                                    </td>
                                </tr>
                            `);
                        } else if (value.user_status == 0) {
                            $('#adminList').append(`
                                <tr>
                                    <td>${key+1}</td>
                                    <td>${value.user_name}</td>
                                    <td>${formattedDate}</td>
                                    <td class="text-danger">Blocked</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary view" data="${value.user_id}">View</a>
                                        <a class="btn btn-sm btn-success unblock" data="${value.user_id}">Unblock</a>
                                        <a class="btn btn-sm btn-danger delete" data="${value.user_id}">Delete</a>
                                    </td>
                                </tr>
                            `);
                        }
                    });
                },
            });
        }

        fetchAdminList();

        $(document).on('click', '.view', function() {
            let id = $(this).attr('data');
            $.post("{{ url('admin/fetch-user-info') }}", {
                id: id
            }, function(res) {
                $('#adminDetalsModalBody').html(`
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{asset('public/img/profile-pic/${res.user_picture}')}}" class="card-img-top" alt="Profile Picture" height="400" width="150">
                            <div class="card-body">
                                <h5 class="card-title">${res.user_name}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Details</h5>
                                <div class="row">
                                    <div class="col">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0">Email: ${res.user_email}</li>
                                            <li class="list-group-item border-0">Phone: +91 ${res.user_phone}</li>
                                            <li class="list-group-item border-0">Location: ${res.city} ${res.state}, India - ${res.user_pincode}</li>
                                            <li class="list-group-item border-0">Aadhar: ${res.user_aadhar}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                $('#adminDetalsModal').modal('show');
            });
        });

        $(document).on('click', '.block', function() {
            let id = $(this).attr('data');
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, block it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/block-user') }}",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            if (res) {
                                Swal.fire(
                                    'Blocked!',
                                    'User blocked successfully!',
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
                            fetchAdminList();
                            $('#mytable').DataTable().draw();
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                }
            })
        });

        $(document).on('click', '.unblock', function() {
            let id = $(this).attr('data');
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, unblock it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/unblock-user') }}",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            if (res) {
                                Swal.fire(
                                    'Unblocked!',
                                    'User unblocked successfully!',
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
                            fetchAdminList();
                            $('#mytable').DataTable().draw();
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                }
            })
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
                        url: "{{ url('admin/delete-user') }}",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            if (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'User deleted successfully!',
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
                            fetchAdminList();
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
