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
                                                    <h2 style="color:white">Task</h2>
                                                </div>
                                                <div class="row gutters-sm">
                                                    <!-- <div class="col-md-4 mb-3">
                            <div class="card" style="color:white">
                              <div class="card-header">Profile Picture</div>
                              <div class="card-body">
                                <?php
                                //   $defaultImage = "https://bootdey.com/img/Content/avatar/avatar7.png";
                                // $storage = "/storage/uploads/";
                                // $defaultImage = "/storage/uploads/download.png";
                                // $url = "http://192.168.1.30/storage/uploads/";   
                                //$profileImage = !empty($profile['image']) ? $storage . $profile['storage_filename'] : $defaultImage;
                                ?>
                                <div class="d-flex flex-column align-items-center text-center">
                                  <img src="<?php //echo e($profileImage) ?>" alt="Admin" class="rounded-circle"
                                    width="150">
                                  <div class="mt-3">
                                    <h4><?php //echo e($profile['name']); ?></h4>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> -->
                                                    <div class="col-md-8" style="color:white">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <!-- <h3>" <?php //echo e($userproject['name']); ?> "</h3> -->
                                                                <h3> Task
                                                                    Details</h3>
                                                            </div>
                                                            <div class="card-body">

                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Project Name</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        <?php echo e($usertask['project']); ?>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Task Name</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        <?php echo e($usertask['name']); ?>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Assigned To</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        <?php echo e($usertask['task_member_name']); ?>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Tags</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        <?php echo e($usertask['task_tags_name']); ?>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Start Date</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        <?php echo e($usertask['start_date']); ?>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Due Date</h6>
                                                                    </div>
                                                                    <div class="col-sm-9 text-secondary">
                                                                        <?php echo e($usertask['due_date']); ?>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Status</h6>
                                                                    </div>

                                                                    <div class="col-sm-9 text-secondary">
                                                                        <?php echo e($usertask['status']); ?>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <h6 class="mb-0">Priority</h6>
                                                                    </div>

                                                                    <div class="col-sm-9 text-secondary">
                                                                        <?php echo e($usertask['priority']); ?>
                                                                    </div>
                                                                </div>

                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <a class="btn btn-info "
                                                                            href="/admin/tasks">Back</a>
                                                                        <?php if ($_SESSION['user_type'] == "A"): ?>
                                                                            <a class="btn btn-info "
                                                                                href="/admin/edittask/<?php echo e($usertask['id']); ?>">Edit</a>
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