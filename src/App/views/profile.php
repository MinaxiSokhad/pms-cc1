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

                        <!-- Breadcrumb -->
                        <!-- <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav> -->
                        <div class="card-body">
                          <h2 style="color:white">User Profile</h2>
                        </div>

                        <!-- /Breadcrumb -->

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
                                    <!-- <p class="text-secondary mb-1">Full Stack Developer</p>
                      <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                      <button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button> -->
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                    <span class="text-secondary">https://bootdey.com</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                    <span class="text-secondary">@bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                </ul>
              </div> -->
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
                                <hr>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <a class="btn btn-info "
                                      href="/staff/editProfile/<?php echo e($_SESSION['user']); ?>">Edit</a>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->



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
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
              2020</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                templates</a> from Bootstrapdash.com</span>
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