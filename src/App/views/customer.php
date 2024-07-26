
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $("#selectAll").click(function(){
    $("input[type='checkbox']").prop('checked',this.checked);
  });
});
</script>



<?php
// dd($profile);
include $this->resolve("partials/_header.php"); 
 ?>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     <?php include $this->resolve("partials/_sidebar.php"); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper" >
        <!-- partial:partials/_navbar.html -->
        <?php include $this->resolve("partials/_navbar.php");
   
         ?>
         <?php include $this->resolve('partials/_csrf.php'); ?>
        <!-- partial -->
        <div class="main-panel" >
          <div class="content-wrapper" >
            <div class="row" >
              <div class="col-12 grid-margin stretch-card" >
                <div class="card corona-gradient-card" >
                  <div class="card-body py-0 px-0 px-sm-3" style="background-color:#191C24; ">
                    <div class="row align-items-center">
                   
                    <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Customers</h4>
                    <div class="table-responsive">
                    
                    <!-- <div id="deleteForm" > -->
                      <table class="table">
                        <thead>                      
                          <tr>
                            <th> 
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="selectAll" name="selectAll">
                                </label>
                              </div>
                            </th>
                            <th> Company Name </th>
                            <th> Website </th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Country </th>
                            <th> Address </th>
                            <!-- <th> Payment Status </th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($viewcustomer as $p): ?>
                          <tr>
                            <td>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" value=<?php $p['id']; ?> name="ids[]">
                                </label>
                              </div>
                            </td>
                            <?php  foreach($p as $field => $value):                               
                                if($field != "id"): ?>
                                      <td><?php echo e($value); ?></td>
                                <?php endif;?>
                            <?php endforeach; ?>
          <td><a href="/editcustomer/<?php echo $p['id']; ?>"> <div class="badge badge-outline-success">Edit</div></a></td>
                            <form action="/deletecustomer/<?php echo $p['id']; ?>" method="POST">
                                <?php include $this->resolve('partials/_csrf.php'); ?>
                                <input type="hidden" name="_METHOD" value="DELETE" />
                                <td><button type="submit" name="delete" class="badge badge-outline-danger" style="background-color:transparent;">Delete</button></td>
                            </form>
                        </div>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                        <td><a href="/createcustomer"> <div class="badge badge-outline-success">Add New Customers</div></a></td>
                      <form <?php if(isset($_POST['deleteAll'])): ?>action="/deletecustomers"<?php endif; ?> method="POST">
                      <?php include $this->resolve('partials/_csrf.php'); ?>
                      <input type="hidden" name="_METHOD" value="DELETE" />
                      <td><button type="submit" name="deleteAll" class="badge badge-outline-danger" style="background-color:transparent;">Delete Selected Customers</button></td>                     
                    </form>
                      </table>
                      <br>
                      
                      
                    </div>                 
                  </div>
                </div>
              </div>
            </div>
          
                    </div>
                  </div>
                </div>
              </div>
            </div>
       
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/misc.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>