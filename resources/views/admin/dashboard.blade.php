
<main id="main" class="main">


    <section class="section dashboard">
        <div class="row">

            <div class="col-md-12">
                <div class="row mt-3">
                    <div class="col-md-3 col-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mt-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                       <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5>House Owners</h5>
                                        <h6 class="owner">0</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mt-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5>Renters</h5>
                                        <h6 class="renter">0</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mt-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5>Active Ads</h5>
                                        <h6 class="activehouse">0</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mt-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5>Pending Ads</h5>
                                        <h6 class="pendinghouse">0</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
           
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    $(document).ready(function(){
        $.get("{{url('admin/dashboard-info')}}",function(res){
            $('.owner').html(res.owner);
            $('.renter').html(res.renter);
            $('.activehouse').html(res.activehouses);
            $('.pendinghouse').html(res.pendinghouses);
        });
    });
</script>