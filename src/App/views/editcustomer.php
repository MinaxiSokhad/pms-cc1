<?php include $this->resolve("partials/_header.php"); ?>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     <?php include $this->resolve("partials/_sidebar.php"); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <?php include $this->resolve("partials/_navbar.php"); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3" style="background-color:#191C24; ">
                    <div class="row align-items-center">
                    <!-- <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script> -->

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <!-- <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details" target="__blank">Profile</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-billing-page" target="__blank">Billing</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page" target="__blank">Security</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>
    </nav> -->
    <hr class="mt-0 mb-4">
    <div class="row"  style="color:white">
       
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4" >
                <div class="card-header">Customer Details</div>
                <div class="card-body">
                   <!-- Profile 2 form data -->
                    
                    
                    <div class="col-xl-8">
  <form id="profile" method="post" enctype="multipart/form-data">
  <?php include $this->resolve('partials/_csrf.php'); ?>
  <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
  <?php $err = [];
  foreach($errors as $error){
    if($error["0"] =="This field is required"){
        $err[] = $error;
}}
  
    if((sizeOf($err)) >= 5  ){
        
            echo e ("Please filll all the required fill * ");
            $errors = [];
    }

    
 ?></div>
 <div class="mb-3">
  <label class="small mb-1" for="company">Company Name<span style="color: red;"> * </span></label>
   
  <input class="form-control" type="text" value="<?php echo e($editcustomer['company'] ?? ''); ?>" id="company" name="company" >
    <div id="nameErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('company', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['company']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif;
            
            
            ?>
</div>
<div class="mb-3">
  <label class="small mb-1" for="website">Website<span style="color: red;"> * </span></label>
    <input class="form-control" type="text" value="<?php echo e($editcustomer['website'] ?? ''); ?>" id="website" name="website" >
    <div id="nameErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('website', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['website']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif;
            
            
            ?>
</div>
<div class="mb-3">
  <label class="small mb-1" for="email">Email<span style="color: red;"> * </span></label>
    <input class="form-control" type="text" value="<?php echo e($editcustomer['email'] ?? ''); ?>" id="email" name="email" >
    <div id="nameErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('email', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['email']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif;
            
            
            ?>
</div>
<div class="mb-3">
  <label class="small mb-1" for="phone">Phone Number<span style="color: red;"> * </span></label>
    <input class="form-control" type="text" value="<?php echo e($editcustomer['phone'] ?? ''); ?>" id="phone" name="phone" >
    <div id="nameErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('phone', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['phone']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif;
            
            
            ?>
</div>
<div class="mb-3">
  <label class="small mb-1" for="country">Country<span style="color: red;"> * </span></label>
    <input class="form-control" type="text" value="<?php echo e($editcustomer['country'] ?? ''); ?>" id="country" name="country" >
    <div id="nameErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('country', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['country'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif;
            
            
            ?>
</div>
<div class="mb-3">
<label for="address">Address <span style="color: red;"> * </span></label>
             <textarea id="address" name="address"><?php echo e($editcustomer['address'] ?? ''); ?></textarea>
                <?php if (array_key_exists('address', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['address'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif;
            
            
            ?>
</div>
    <button class="btn btn-primary" type="submit">Save Changes</button>
        
</form>

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

<style>
body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}

.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input , textarea {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
</style>