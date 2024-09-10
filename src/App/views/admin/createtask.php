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
                                                            <h2 class="card-title" >Add New Task</h2>
                                                            <hr style="background-color:grey;">
                                                            <h5> * Indicates required question</h5><br />
                                                            <form class="forms-sample" method="POST">
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
                                                                    <label for="project">Project<span
                                                                            style="color: red;"> * </span></label>
                                                                            
                                                                    <select class="js-example-basic-single"
                                                                        style="width: 100%;" name="project">
                                                                        <option value="" <?php echo ($oldFormData['project'] ?? '') === '' ? 'selected' : ''; ?>>Select Option</option>                                                              
                                                                        <?php foreach ($viewproject as $c): ?>
                                                                            <option value=<?php echo e($c['id']); ?> <?php echo ($oldFormData['project'] ?? '') == $c['id'] ? 'selected' : ''; ?>>
                                                                                <?php echo e($c['name']); ?>
                                                                            </option>                                                                           
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
                                                                        value="<?php echo e($oldFormData['name'] ?? ''); ?>"
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
                                                                    <label for="members">Assigned to<span
                                                                            style="color: red;"> * </span></label>
                                                                    <select class="js-example-basic-multiple"
                                                                        name="members[]" multiple="multiple"
                                                                        style="width:100%" id="members[]">
                                                                        <?php $member = array_values($oldFormData['members']?? []); ?>
                                                                        <?php foreach ($users as $u): ?>
                                                                            <?php if(in_array($u['id'], $member)): ?>
                                                                            <option value=<?php echo e($u['id']); ?> selected>
                                                                                <?php echo e($u['name']);
                                                                                echo ' ' . '(' . e($u['email']) . ')'; ?>
                                                                            </option>
                                                                            <?php else: ?>
                                                                                <option value=<?php echo e($u['id']); ?>>
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
                                                                        <?php  $tag = array_values($oldFormData['tags']?? []); ?>                                                                                           
                                                                        <?php foreach ($tags as $t):                                                                        
                                                                                if(in_array($t['id'],$tag)):
                                                                            ?>                                                                             
                                                                                <option value="<?php echo e($t['id']); ?>" selected>
                                                                                <?php echo e($t['name']); ?>
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
                                                                            value="<?php echo e($oldFormData['start_date'] ?? ''); ?>"
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
                                                                            value="<?php echo e($oldFormData['due_date'] ?? ''); ?>"
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
                                                                       

                                                                        <option value="P" <?php echo ($oldFormData['status'] ?? '') === 'P' ? 'selected' : ''; ?>>In Progress</option>
                                                                        <option value="S" <?php echo ($oldFormData['status'] ?? '') === 'S' ? 'selected' : ''; ?>>Not Started</option>
                                                                        <option value="C" <?php echo ($oldFormData['status'] ?? '') === 'C' ? 'selected' : ''; ?>>Complete</option>
                                                                        <option value="T" <?php echo ($oldFormData['status'] ?? '') === 'T' ? 'selected' : ''; ?>>Testing</option>
                                                                        
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
                                                                        <option value="M" <?php echo ($oldFormData['priority'] ?? '') === 'M' ? 'selected' : ''; ?>>Medium</option>
                                                                        <option value="H" <?php echo ($oldFormData['priority'] ?? '') === 'H' ? 'selected' : ''; ?>>High</option>
                                                                        <option value="L" <?php echo ($oldFormData['priority'] ?? '') === 'L' ? 'selected' : ''; ?>>Low</option>                                                                     
                                                                    </select>
                                                                    
                                                                    <?php if (array_key_exists('priority', $errors)): ?>
                                                                        <div class="bg-gray-100 mt-2 p-2 text-red-500"
                                                                            style="color:red">
                                                                            <?php echo e($errors['priority'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                                                                                ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                              
                                                                <button type="submit" name="projectsubmit"
                                                                    class="btn btn-primary mr-2">Submit</button>
                                                                <button type="reset" id="reset" class="btn btn-dark" name="reset">Cancel</button>
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
               <?php include $this->resolve("partials/_footer.php"); ?>
              
            </div>
           
        </div>    
    </div>
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script> 
    <script src="/assets/vendors/select2/select2.min.js"></script>
    <script src="/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/misc.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/todolist.js"></script>
    <script src="/assets/js/file-upload.js"></script>
    <script src="/assets/js/typeahead.js"></script>
    <script src="/assets/js/select2.js"></script>
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/assets/js/dashboard.js"></script>
</body>
</html>
<script>
    $('#reset').click(function(){
   $('input[type="text"]').val('');
   $('select[name="project"],select[name="tags"],select[name="status"],select[name="members"]').val('');
});
</script>