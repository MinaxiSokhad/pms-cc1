<?php include $this->resolve("partials/_header.php"); ?>
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
<?php include $this->resolve("partials/_footer.php"); ?>