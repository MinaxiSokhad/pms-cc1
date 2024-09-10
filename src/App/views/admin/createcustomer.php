<?php include $this->resolve("partials/_header.php"); ?>
<style>
    h5 {
        color: red;     
    }
</style>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <?php include $this->resolve("partials/_sidebar.php"); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <?php include $this->resolve("partials/_navbar.php"); ?>
            <!-- partial -->
            <?php include $this->resolve('partials/_csrf.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card corona-gradient-card">
                                <div class="card-body py-0 px-0 px-sm-3" style="background-color:#191C24; ">
                                    <div class="row align-items-center">
                                        <div class="container">
                                            <div class="main-body">
                                                <div class="col-12 grid-margin stretch-card">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 class="card-title" >Add New Customer</h2>
                                                            <hr style="background-color:grey;">
                                                            <h5> * Indicates required question</h5><br />
                                                            <form class="forms-sample" method="POST">
                                                                <?php include $this->resolve('partials/_csrf.php'); ?>
                                                                <div class="form-group">
                                                                  <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                                                                       <h5>
                                                                               <?php $err = [];
                                                                                   foreach ($errors as $error) {
                                                                                      if ($error["0"] == "This field is required") {
                                                                                             $err[] = $error;
                                                                                            }
                                                                                       }

                                                                                      if ((sizeOf($err)) >= 3) {

                                                                                           echo e("Please filll all the required fill * ");
                                                                                              $errors = [];
                                                                                     }


                                                                                    ?>
                                                                              </h5>
                                                                        </div>
                <label for="company">Company<span style="color: red;"> * </span></label>
                <input class="form-control" style="background-color:black;color:white;" type="text" id="company" name="company" value="<?php echo e($oldFormData['company'] ?? ''); ?>">
                <?php if (array_key_exists('company', $errors)): ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                        <?php echo e($errors['company'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="website">Website<span style="color: red;"> * </span></label>
                <input class="form-control" style="background-color:black;color:white;" type="url" id="website" name="website" value="<?php echo e($oldFormData['website'] ?? ''); ?>">
                <?php if (array_key_exists('website', $errors)): ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                        <?php echo e($errors['website'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email<span style="color: red;"> * </span></label>
                <input class="form-control" style="background-color:black;color:white;" type="email" id="email" name="email" value="<?php echo e($oldFormData['email'] ?? ''); ?>">
                <?php if (array_key_exists('email', $errors)): ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                        <?php echo e($errors['email'][0]);?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone<span style="color: red;"> * </span></label>
                <input class="form-control" style="background-color:black;color:white;" type="tel" id="phone" name="phone" value="<?php echo e($oldFormData['phone'] ?? ''); ?>">
                <?php if (array_key_exists('phone', $errors)): ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                        <?php echo e($errors['phone'][0]);?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">Country<span style="color: red;"> * </span></label>
                <select style="background-color:black;color:white;" class="form-control" id="country" name="country"
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="USA">USA</option>
                    <option value="Canada" <?php echo ($oldFormData['country'] ?? '') === 'Canada' ? 'selected' : ''; ?>>
                        Canada</option>
                    <option value="India" <?php echo ($oldFormData['country'] ?? '') === 'India' ? 'selected' : ''; ?>>
                        India</option>
                    <option value="Russia" <?php echo ($oldFormData['country'] ?? '') === 'Russia' ? 'selected' : ''; ?>>
                        Russia</option>
                    <option value="Mexico" <?php echo ($oldFormData['country'] ?? '') === 'Mexico' ? 'selected' : ''; ?>>
                        Mexico</option>
                    <option value="Invalid">Invalid Country</option>
                </select>
                <?php if (array_key_exists('country', $errors)): ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                        <?php echo e($errors['country'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="address">Address <span style="color: red;"> * </span></label>
                <textarea style="background-color:black;color:white;" class="form-control" id="address" name="address"><?php echo e($oldFormData['address'] ?? ''); ?></textarea>
                <?php if (array_key_exists('address', $errors)): ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                        <?php echo e($errors['address'][0]);?>
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Add Customer</button>
                                                                
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
               </div>
               </div>
               <?php include $this->resolve("partials/_footer.php"); ?>
               
            
       
</body>
</html>