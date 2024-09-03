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
                                                            <h4 class="card-title">Edit Task</h4>
                                                            <hr>
                                                            <h5> * Indicates required question</h5><br />
                                                            <form class="forms-sample" method="POST" name="edittask">
                                                                <?php include $this->resolve('partials/_csrf.php'); ?>
                                                                <div class="form-group">
                                                                    <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                        style="color:red">
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
                                                                    <?php //dd($viewproject); ?>
                                                                    <label for="project">Project<span
                                                                            style="color: red;"> * </span></label>
                                                                            
                                                                    <select class="js-example-basic-single"
                                                                        style="width: 100%;" name="project">
                                                                        <?php foreach ($viewproject as $c): ?>
                                                                           <?php if($c['name']==$edittask['project']) :?>
                                                                           <option value="<?php echo e($c['id']); ?>" selected>
                                                                           <?php echo e($c['name']); ?>
                                                                           </option>
                                                                           <?php else : ?>
                                                                            <option value="<?php echo e($c['id']); ?>">
                                                                            <?php echo e($c['name']); ?>
                                                                            <?php endif; ?>
                                                                       <?php endforeach; ?>
                                                                    </select>
                                                                    <?php if (array_key_exists('project', $errors)): ?>
                                                                        <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                            style="color:red">
                                                                            <?php echo e($errors['project'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                   
                                                                </div>
                                                                <div class="form-group">
                                                                <label for="name">Task Name<span
                                                                            style="color: red;"> * </span></label>
                                                                    <input type="text" class="form-control" id="name"
                                                                        name="name" placeholder="Task Name"
                                                                        value="<?php echo e($edittask['name'] ?? ''); ?>"
                                                                        style="background:black; color:white;">
                                                                    <?php if (array_key_exists('name', $errors)): ?>
                                                                        <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                            style="color:red">
                                                                            <?php echo e($errors['name'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="members">Members<span
                                                                            style="color: red;"> * </span></label>
                                                                            
                                                                    <select class="js-example-basic-multiple"
                                                                        name="members[]" multiple="multiple"
                                                                        style="width:100%" id="members[]">
                                                                    
                                                                        <?php foreach ($users as $u): ?>

                                                                            <?php if (in_array($u['name'], explode(",",$edittask['task_member_name']))) :?>
                                                                            <option value="<?php echo e($u['id']); ?>" selected>
                                                                                <?php echo e($u['name']);
                                                                                echo ' ' . '(' . e($u['email']) . ')'; ?>
                                                                            </option>
                                                                            <?php else : ?>
                                                                                <option value="<?php echo e($u['id']); ?>">
                                                                                <?php echo e($u['name']);
                                                                                echo ' ' . '(' . e($u['email']) . ')'; ?>
                                                                            </option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <?php if (array_key_exists('members[]', $errors)): ?>
                                                                        <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                            style="color:red">
                                                                            <?php echo e($errors['members[]'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tags">Tags<span style="color: red;"> *
                                                                        </span></label>
                                                                        
                                                                    <select class="js-example-basic-multiple"
                                                                        name="tags[]" multiple="multiple"
                                                                        style="width:100%" id="tags[]">
                                                                        <?php 
                                                                        $task_tags = $edittask['task_tags_name'];
                                                                        $edittask['task_tags_name'] = explode(",",$task_tags);
                                                                         foreach ($tags as $t):  ?>
                                                                            <?php 
                                                                             if (in_array($t['name'],$edittask['task_tags_name'])):?>
                                                                            <option value="<?php echo e($t['id']);  ?>" selected>
                                                                            <?php echo e($t['name']);?>
                                                                            </option>
                                                                           
                                                                        <?php else: ?>
                                                                                    <option value="<?php echo e($t['id']); ?>" >
                                                                            <?php echo e($t['name']); ?>
                                                                            </option>
                                                                              <?php endif;?> 
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <?php if (array_key_exists('tags[]', $errors)): ?>
                                                                        <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                            style="color:red">
                                                                            <?php echo e($errors['tags[]'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="start_date">Start Date<span
                                                                            style="color: red;"> * </span></label>
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control"
                                                                            name="start_date"
                                                                            value="<?php echo e($edittask['start_date'] ?? ''); ?>"
                                                                            style="background:black; color:white;" />
                                                                        <?php if (array_key_exists('start_date', $errors)): ?>
                                                                            <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                                <?php echo e($errors['start_date'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                    ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="due_date">Due Date</label>
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control"
                                                                            name="due_date"
                                                                            value="<?php echo e($edittask['due_date'] ?? ''); ?>"
                                                                            style="background:black; color:white;" />
                                                                        <?php if (array_key_exists('due_date', $errors)): ?>
                                                                            <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                                style="color:red">
                                                                                <?php echo e($errors['due_date'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                    ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Status<span
                                                                            style="color: red;"> * </span></label>
                                                                            
                                                                    <select class="js-example-basic-single"
                                                                        name="status"
                                                                        style="width: 100%; height: 40px;">
                                                                       
                                                                        <option value="S" <?php echo e($edittask['status'][0] ?? '') === 'N' ? 'selected' : ''; ?>>Not Started</option>
                                                                        <option value="P" <?php echo e($edittask['status'][0] ?? '') === 'I' ? 'selected' : ''; ?>>In Progress</option>
                                                                        <option value="C" <?php echo e($edittask['status'][0] ?? '') === 'C' ? 'selected' : ''; ?>>Complete</option>
                                                                        <option value="T" <?php echo e($edittask['status'][0] ?? '') === 'T' ? 'selected' : ''; ?>>Testing</option>
                                                                   
                                                                    </select>
                                                                    <?php if (array_key_exists('status', $errors)): ?>
                                                                        <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                            style="color:red">
                                                                            <?php echo e($errors['status'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="priority">Priority<span
                                                                            style="color: red;"> * </span></label>
                                                                            
                                                                    <select class="js-example-basic-single"
                                                                        name="priority"
                                                                        style="width: 100%; height: 40px;">
                                                                       
                                                                        <option value="M" <?php echo e($edittask['priority'][0] ?? '') === 'M' ? 'selected' : ''; ?>>Medium</option>
                                                                        <option value="H" <?php echo e($edittask['priority'][0] ?? '') === 'H' ? 'selected' : ''; ?>>High</option>
                                                                        <option value="L" <?php echo e($edittask['priority'][0] ?? '') === 'L' ? 'selected' : ''; ?>>Low</option>
                                                                        
                                                                    </select>
                                                                    <?php if (array_key_exists('status', $errors)): ?>
                                                                        <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                            style="color:red">
                                                                            <?php echo e($errors['status'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <button type="submit" name="tasksubmit"
                                                                    class="btn btn-primary mr-2">Edit Task</button>
                                                                <button class="btn btn-dark" type="reset" name="reset" >Cancel</button>
                                                            </form>
<?php                                                            
?>
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
                
                <?php 
                ?>

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include $this->resolve("partials/_footer.php"); ?>
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
    <script src="/assets/vendors/select2/select2.min.js"></script>
    <script src="/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/misc.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/assets/js/file-upload.js"></script>
    <script src="/assets/js/typeahead.js"></script>
    <script src="/assets/js/select2.js"></script>
    <!-- End custom js for this page -->
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->

    <!-- End plugin js for this page -->
    
    <!-- Custom js for this page -->
    <script src="/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
<script>
    document.getElementById("edittask").reset();
</script>