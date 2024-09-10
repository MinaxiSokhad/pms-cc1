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
                    <div class="container">
                      <div class="main-body">
                        <div class="card-body">
                          <h2 style="color:white">User Profile</h2>
                        </div>
                        <div class="row gutters-sm">
                          <div class="col-md-4 mb-3">
                            <div class="card" style="color:white">
                              <div class="card-header">Profile Picture</div>
                              <div class="card-body">
                                <?php
                                //   $defaultImage = "https://bootdey.com/img/Content/avatar/avatar7.png";
                                $storage = "/storage/uploads/";
                                $defaultImage = "/storage/uploads/download.png";
                                // $url = "http://192.168.1.30/storage/uploads/";   
                                $profileImage = !empty($profile['image']) ? $storage . $profile['storage_filename'] : $defaultImage;
                                ?>
                                <div class="d-flex flex-column align-items-center text-center">
                                  <img src="<?php echo e($profileImage) ?>" alt="Admin" class="rounded-circle"
                                    width="150">
                                  <div class="mt-3">
                                    <h4><?php echo e($profile['name']); ?></h4>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8" style="color:white">
                            <div class="card mb-3">
                              <div class="card-header">Account Details</div>
                              <div class="card-body">

                                <div class="row">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <?php echo e($profile['name']); ?>
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <?php echo e($profile['email']); ?>
                                  </div>
                                </div>
                                <hr>
                                <?php if ($_SESSION['user_type'] == "A"): ?>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Country</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo e($profile['country']); ?>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">State</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo e($profile['state']); ?>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">City</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo e($profile['city']); ?>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo e($profile['address']); ?>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <?php
                                    if ($profile['gender'] === 'M') {
                                      $profile['gender'] = "Male";
                                    } else if ($profile['gender'] === 'F') {
                                      $profile['gender'] = "Female";
                                    } else if ($profile['gender'] === 'O') {
                                      $profile['gender'] = "Other";
                                    }
                                    ?>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo e($profile['gender']); ?>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Marital Status</h6>
                                    </div>
                                    <?php
                                    if ($profile['maritalStatus'] === 'S') {
                                      $profile['maritalStatus'] = "Single";
                                    } else if ($profile['maritalStatus'] === 'M') {
                                      $profile['maritalStatus'] = "Married";
                                    } else if ($profile['maritalStatus'] === 'W') {
                                      $profile['maritalStatus'] = "Widowed";
                                    } else if ($profile['maritalStatus'] === 'D') {
                                      $profile['maritalStatus'] = "Divorced";
                                    }
                                    ?>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo e($profile['maritalStatus']); ?>
                                    </div>
                                  </div>
                                <?php endif; ?>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile Number</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <?php echo e($profile['mobileNo']); ?>
                                  </div>
                                </div>
                                <hr>
                                <?php if ($_SESSION['user_type'] == "A"): ?>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Date Of Birth</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo e($profile['dob']); ?>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Hire Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo e($profile['hireDate']); ?>
                                    </div>
                                  </div>
                                <?php endif; ?>
                                <hr>
                                <?php if ($_SESSION['user_type'] == "A"): ?>
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <a class="btn btn-info "
                                        href="/admin/staff/editProfile/<?php echo e($profile['id']); ?>">Edit</a>
                                    </div>
                                  </div>
                                <?php endif; ?>
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