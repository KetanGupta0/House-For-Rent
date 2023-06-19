<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">House For Rent Transactions</h5>

                        <!-- Table with stripped rows -->
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            <div class="datatable-container">
                                <table class="table" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>House Name</th>
                                            <th>Payment ID</th>
                                            <th>Payment Date</th>
                                            <th>Paid Amount</th>
                                            <th>Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="txnList">
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
{{-- Payment details modal --}}
<div class="modal fade" id="paymentDetalsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="paymentDetalsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="paymentDetalsModalLabel">Payment Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="container-fluid">
                        <div id="houseImages" class="w-100 d-flex flex-wrap">
                        </div>
                    </div>
                    <div class="row mt-3" id="paymentDetalsModalBody"></div>
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

        function fetchTxnList() {
            $.ajax({
                url: "{{ url('admin/fetch-txn') }}",
                type: "GET",
                async: false,
                success: function(res) {
                    $('#txnList').html(``);
                    $.each(res, function(key, value) {
                        var formattedDate = moment(value.payment_time,
                            "YYYY-MM-DD HH:mm:ss").format("MMM D, YYYY");
                        let status = value.payment_status == 1 ? 'Success' : 'Failed';
                        let color = value.payment_status == 1 ? 'success' : 'danger';
                        $('#txnList').append(`
                            <tr>
                                <td>${key+1}</td>
                                <td>${value.house_title}</td>
                                <td>${value.payment_id}</td>
                                <td>${formattedDate}</td>
                                <td>${value.paid_amount}</td>
                                <td class="text-${color}">${status}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary view" data="${value.payment_id}">View Details</a>
                                </td>
                            </tr>
                        `);
                    });
                },
            });
        }
        fetchTxnList();

        $(document).on('click', '.view', function() {
            let pid = $(this).attr('data');
            $.post("{{ url('admin/fetch-txn-info') }}", {
                pid: pid
            }, function(res) {
                console.log(res);
                var imageArray = res.images.split(',');
                $('#houseImages').html(``);
                $.each(imageArray,function(key,value){
                    $('#houseImages').append(`
                    <img src="{{ asset('public/img/house-img/${value}') }}" width="170" height="100" class="border mx-3">
                    `);
                });
                var formattedDate = moment(res.payment_time,"YYYY-MM-DD HH:mm:ss").format("MMM D, YYYY");
                var status = res.payment_status == 1 ? "Success" : "Fail";
                $('#paymentDetalsModalBody').html(`
                    <div class="col">
                        <h5 class="card-title text-center">Buyer Info</h5>
                        <ul class="list-group">
                            <li class="list-group-item border-0"><b>Buyer:</b> ${res.customer_name}</li>
                            <li class="list-group-item border-0"><b>House name:</b> ${res.house_title}</li>
                            <li class="list-group-item border-0"><b>Paid Amount:</b> ${res.paid_amount}</li>
                            <li class="list-group-item border-0"><b>Payment Mode:</b> Card</li>
                        </ul>
                    </div>
                    <div class="col">
                        <h5 class="card-title text-center">Card Info</h5>
                        <ul class="list-group">
                            <li class="list-group-item border-0"><b>Card Number:</b> ${res.card_number}</li>
                            <li class="list-group-item border-0"><b>Card Holder:</b> ${res.card_holder}</li>
                            <li class="list-group-item border-0"><b>Payment Time:</b> ${formattedDate}</li>
                            <li class="list-group-item border-0"><b>Payment ID:</b> ${res.payment_id}</li>
                            <li class="list-group-item border-0"><b>Payment Status:</b> ${status}</li>
                        </ul>
                    </div>
                `);
                $('#paymentDetalsModal').modal('show');
            });
        });
    });
</script>
