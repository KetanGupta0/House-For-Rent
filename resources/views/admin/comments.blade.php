<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">House For Rent User Comments</h5>

                        <!-- Table with stripped rows -->
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            <div class="datatable-container">
                                <table class="table" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="commentList">
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
{{-- Comment details modal --}}
<div class="modal fade" id="commentDetalsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="commentDetalsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="commentDetalsModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="commentDetalsModalBody"></div>
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

        function fetchComments() {
            $.ajax({
                url: "{{url('admin/fetch-comments')}}",
                type: "GET",
                async: false,
                success: function(res){
                    console.log(res);
                    $('#commentList').html(``);
                    $.each(res,function(key,value){
                        var formattedDate = moment(value.created_at, "YYYY-MM-DD HH:mm:ss").format("MMM D, YYYY");
                        $('#commentList').append(`
                            <tr>
                                <td>${key+1}</td>
                                <td>${value.commenter_name}</td>
                                <td>${value.commenter_email}</td>
                                <td>${formattedDate}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary view" data="${value.comment_id}">View</a>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function(err){
                    console.log(err);
                }
            });
        }
        fetchComments();
        $(document).on('click','.view',function(){
            let id = $(this).attr('data');
            $.post("{{url('admin/view-comment')}}",{id:id},function(res){
                $('#commentDetalsModalLabel').html(res.commenter_name);
                $('#commentDetalsModalBody').html(res.comment_msg);
                $('#commentDetalsModal').modal('show');
            });
        });
    });
</script>