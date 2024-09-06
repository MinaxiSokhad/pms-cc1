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
                                                                $profileImage = !empty($editProfile['image']) ? $storage . $editProfile['storage_filename'] : $defaultImage;

                                                                ?>
                                                                <div
                                                                    class="d-flex flex-column align-items-center text-center">
                                                                    <img src="<?php echo e($profileImage) ?>"
                                                                        alt="Admin" class="rounded-circle" width="150">
                                                                    <div class="mt-3">
                                                                        <h4><?php echo e($editProfile['name']); ?></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-8" style="color:white">
                                                        <div class="card mb-3">
                                                            <div class="card-header">Account Details</div>
                                                            <div class="card-body">
                                                                <form id="profile" method="post"
                                                                    enctype="multipart/form-data">
                                                                    <?php include $this->resolve('partials/_csrf.php'); ?>
                                                                    <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                        style="color:red">
                                                                        <?php $err = [];
                                                                        foreach ($errors as $error) {
                                                                            if ($error["0"] == "This field is required") {
                                                                                $err[] = $error;
                                                                            }
                                                                        }

                                                                        if ((sizeOf($err)) >= 5) {

                                                                            echo e("Please filll all the required fill * ");
                                                                            $errors = [];
                                                                        }


                                                                        ?>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Full Name<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="text"
                                                                                value="<?php echo e($editProfile['name'] ?? ''); ?>"
                                                                                id="name" name="name">
                                                                            <div id="nameErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>
                                                                            <?php if (array_key_exists('name', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['name'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif;


                                                                            ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Email<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="text"
                                                                                value="<?php echo e($editProfile['email'] ?? ''); ?>"
                                                                                id="email" name="email">
                                                                            <div id="emailErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>
                                                                            <?php if (array_key_exists('email', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['email'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Password<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="password"
                                                                                id="password" name="password">
                                                                            <div id="passErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>

                                                                            <?php if (array_key_exists('password', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['password'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Country<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <select
                                                                                style="background-color:#2A3038; color:white;"
                                                                                id="country" name="country"
                                                                                class="form-control">
                                                                                <option value="USA" <?php echo ($editProfile['country'] ?? '') === 'USA' ? 'selected' : ''; ?>>
                                                                                    USA</option>
                                                                                <option value="Canada" <?php echo ($editProfile['country'] ?? '') === 'Canada' ? 'selected' : ''; ?>>
                                                                                    Canada</option>
                                                                                <option value="India" <?php echo ($editProfile['country'] ?? '') === 'India' ? 'selected' : ''; ?>>
                                                                                    India</option>
                                                                                <option value="Russia" <?php echo ($editProfile['country'] ?? '') === 'Russia' ? 'selected' : ''; ?>>
                                                                                    Russia</option>
                                                                                <option value="Mexico" <?php echo ($editProfile['country'] ?? '') === 'Mexico' ? 'selected' : ''; ?>>
                                                                                    Mexico</option>
                                                                                <option value="Invalid">Invalid Country
                                                                                </option>
                                                                            </select>
                                                                            <div id="countryErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>
                                                                            <?php if (array_key_exists('country', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['country'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">State<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="text"
                                                                                value="<?php echo e($editProfile['state'] ?? ''); ?>"
                                                                                id="state" name="state">
                                                                            <div id="stateErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>
                                                                            <?php if (array_key_exists('state', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['state'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">City<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="text"
                                                                                value="<?php echo e($editProfile['city'] ?? ''); ?>"
                                                                                id="city" name="city">
                                                                            <div id="cityErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>
                                                                            <?php if (array_key_exists('city', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['city'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Address<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <textarea
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" id="address"
                                                                                name="address"><?php echo e($editProfile['address'] ?? ''); ?></textarea>
                                                                            <?php if (array_key_exists('address', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['address'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Gender<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <select
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" id="gender"
                                                                                name="gender">
                                                                                <option value=""></option>
                                                                                <option value="M" <?php echo ($editProfile['gender'] ?? '') === 'M' ? 'selected' : ''; ?>>Male</option>
                                                                                <option value="F" <?php echo ($editProfile['gender'] ?? '') === 'F' ? 'selected' : ''; ?>>Female
                                                                                </option>
                                                                                <option value="O" <?php echo ($editProfile['gender'] ?? '') === 'O' ? 'selected' : ''; ?>>Others
                                                                                </option>
                                                                            </select>
                                                                            <div id="genderErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>
                                                                            <?php if (array_key_exists('gender', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['gender'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Marital Status<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <select
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" id="maritalStatus"
                                                                                name="maritalStatus">
                                                                                <option value=""></option>
                                                                                <option value="S" <?php echo ($editProfile['maritalStatus'] ?? '') === 'S' ? 'selected' : ''; ?>>
                                                                                    Single</option>
                                                                                <option value="M" <?php echo ($editProfile['maritalStatus'] ?? '') === 'M' ? 'selected' : ''; ?>>
                                                                                    Married</option>
                                                                                <option value="W" <?php echo ($editProfile['maritalStatus'] ?? '') === 'W' ? 'selected' : ''; ?>>
                                                                                    Widowed</option>
                                                                                <option value="D" <?php echo ($editProfile['maritalStatus'] ?? '') === 'D' ? 'selected' : ''; ?>>
                                                                                    Divorced</option>
                                                                            </select>
                                                                            <div id="maritalStatusErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>
                                                                            <?php if (array_key_exists('maritalStatus', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['maritalStatus'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Mobile Number<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="text"
                                                                                value="<?php echo e($editProfile['mobileNo'] ?? ''); ?>"
                                                                                id="mobileNo" name="mobileNo"
                                                                                placeholder="Enter 10-digit mobile number">
                                                                            <div id="numErr"
                                                                                class="mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                            </div>
                                                                            <?php if (array_key_exists('mobileNo', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['mobileNo']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Date Of Birth<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="date"
                                                                                value="<?php echo e($editProfile['dob'] ?? ''); ?>"
                                                                                id="dob" name="dob">
                                                                            <?php if (array_key_exists('dob', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['dob'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Hire Date<span
                                                                                    style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="date"
                                                                                id="hireDate"
                                                                                value="<?php echo e($editProfile['hireDate'] ?? ''); ?>"
                                                                                name="hireDate">
                                                                            <?php if (array_key_exists('hireDate', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['hireDate'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <h6 class="mb-0">Upload
                                                                                Image<span style="color: red;"> *
                                                                                </span></h6>
                                                                        </div>
                                                                        <div class="col-sm-9 text-secondary">
                                                                            <input
                                                                                style="background-color:#2A3038; color:white;"
                                                                                class="form-control" type="file"
                                                                                id="image" name="image">
                                                                            <?php if (array_key_exists('image', $errors)): ?>
                                                                                <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                    style="color:red">
                                                                                    <?php echo e($errors['image'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                        ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <button class="btn btn-primary"
                                                                                type="submit">Save
                                                                                Changes</button>
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
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                            bootstrapdash.com
                            2020</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap
                                admin
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