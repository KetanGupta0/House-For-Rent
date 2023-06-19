
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <b>Click Ok To Logout The Session!!</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CLOSE</button>
          <a href="{{url('logout')}}">
              <button type="button" class="btn btn-primary">OK</button>
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <footer id="footer" class="footer">
      <div class="copyright">
          &copy; Copyright 2023 All Rights Reserved
      </div>
      <div class="credits">
  
          Designed & Developed by <strong><span><a href="{{url('chandra-kishore-gupta')}}">CHANDRA KISHORE GUPTA</a></span></strong>
      </div>
  </footer><!-- End Footer -->
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
          class="bi bi-arrow-up-short"></i></a>
  
  <!-- Vendor JS Files -->
  <script src="{{ asset('public/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('public/admin/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('public/admin/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('public/admin/vendor/quill/quill.min.js') }}"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  
  
  <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="{{ asset('public/admin/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('public/admin/vendor/php-email-form/validate.js') }}"></script>
  
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('public/admin/js/main.js') }}"></script>
  <script>
    $(document).ready( function(){
      $('#mytable').dataTable({
        "lengthMenu" : [[5,10,20,50,100,-1], ["5","10","20","50","100","All"]]
      });
    });
    </script>
  
  
  </body>
  
  </html>
  
  
  