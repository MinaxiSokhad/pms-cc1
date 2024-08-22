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
                                        <div class="container-xl px-4 mt-4">
                                            <hr class="mt-0 mb-4">
                                            <div class="row" style="color:white">
                                                <div class="col-xl-4">
                                                    <!-- Profile picture card-->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <div class="card-header">Profile Picture</div>
                                                        <?php
                                                        //   $defaultImage = "https://bootdey.com/img/Content/avatar/avatar7.png";
                                                        $storage = "/storage/uploads/";
                                                        $defaultImage = "/storage/uploads/download.png";
                                                        // $url = "http://192.168.1.30/storage/uploads/";   
                                                        $profileImage = !empty($profile['image']) ? $storage . $profile['storage_filename'] : $defaultImage;
                                                        ?>

                                                        <div class="card-body text-center">
                                                            <!-- Profile picture image-->
                                                            <img class="img-account-profile rounded-circle mb-2"
                                                                src="<?php echo e($profileImage) ?>" />
                                                            <!-- Profile picture help block-->
                                                            <div class="card-header" style="color:white">
                                                                <?php echo e($profile['name']); ?>
                                                            </div>
                                                            <!-- Profile picture upload button-->
                                                            <!-- <button class="btn btn-primary" type="button">Upload new image</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <!-- Account details card-->
                                                    <div class="card mb-4">
                                                        <div class="card-header">Account Details</div>
                                                        <div class="card-body">
                                                            <!-- Profile 2 form data -->


                                                            <div class="col-xl-8">
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
                                                                    <div class="mb-3">
                                                                        <label class="small mb-1" for="name">Full
                                                                            Name<span style="color: red;"> *
                                                                            </span></label>
                                                                        <input
                                                                            style="background-color:#2A3038; color:white;"
                                                                            class="form-control" type="text"
                                                                            value="<?php echo e($editProfile['name'] ?? ''); ?>"
                                                                            id="name" name="name">
                                                                        <div id="nameErr" class="mt-2 p-2 text-red-500"
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
                                                                    <!-- Form Row-->
                                                                    <div class="row gx-3 mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1" for="email">Email
                                                                                <span style="color: red;"> *
                                                                                </span></label>
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
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1"
                                                                                for="password">Password <span
                                                                                    style="color: red;"> *
                                                                                </span></label>
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
                                                                    <!-- Form Row        -->
                                                                    <div class="row gx-3 mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1"
                                                                                for="country">Country <span
                                                                                    style="color: red;"> *
                                                                                </span></label>
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
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1" for="state">State
                                                                                <span style="color: red;"> *
                                                                                </span></label>
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
                                                                    <div class="row gx-3 mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1" for="city">City
                                                                                <span style="color: red;"> *
                                                                                </span></label>
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
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1"
                                                                                for="address">Address <span
                                                                                    style="color: red;"> *
                                                                                </span></label>
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
                                                                    <div class="row gx-3 mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1"
                                                                                for="gender">Gender <span
                                                                                    style="color: red;"> *
                                                                                </span></label>
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
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1"
                                                                                for="maritalStatus">Marital Status <span
                                                                                    style="color: red;"> *
                                                                                </span></label>
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
                                                                    <!-- Form Row        -->
                                                                    <div class="row gx-3 mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1"
                                                                                for="mobileNo">Mobile Number <span
                                                                                    style="color: red;"> *
                                                                                </span></label>
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
                                                                    <div class="row gx-3 mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1" for="dob">Date of
                                                                                Birth <span style="color: red;"> *
                                                                                </span></label>
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
                                                                        <div class="col-md-6">
                                                                            <label class="small mb-1"
                                                                                for="hire_date">Hire Date <span
                                                                                    style="color: red;"> *
                                                                                </span></label>
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
                                                                    <div class="mb-3">

                                                                        <label class="small mb-1" for="image">Upload
                                                                            Image <span style="color: red;"> *
                                                                            </span></label>
                                                                        <input
                                                                            style="background-color:#2A3038; color:white;"
                                                                            class="form-control" type="file" id="image"
                                                                            name="image">
                                                                        <?php if (array_key_exists('image', $errors)): ?>
                                                                            <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                                <?php echo e($errors['image'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                    ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                    </div>
                                                                    <button class="btn btn-primary" type="submit">Save
                                                                        Changes</button>

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
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                            bootstrapdash.com 2020</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap
                                admin templates</a> from Bootstrapdash.com</span>
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
    body {
        margin-top: 20px;
        background-color: #f2f6fc;
        color: #69707a;
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

    .form-control,
    .dataTable-input {
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