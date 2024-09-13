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
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">

                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0">Total Projects</h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success ">
                      <!-- <span class="mdi mdi-arrow-top-right icon-item"></span> -->
                    </div>
                  </div>
                </div>
                <?php if ($_SESSION['user_type'] == "A"): ?>
                  <h4 class="mb-0"><?php echo e(count($project_count)); ?></h4>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <h3 class="mb-0">Total Tasks</h3>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-success ">
                      <!-- <span class="mdi mdi-arrow-top-right icon-item"></span> -->
                    </div>
                  </div>
                </div>
                <?php if ($_SESSION['user_type'] == "A"): ?>
                  <h4 class="mb-0"><?php echo e(count($task_count)); ?></h4>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php if ($_SESSION['user_type'] == "A"): ?>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">Total Customers</h3>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="icon icon-box-success ">
                        <!-- <span class="mdi mdi-arrow-top-right icon-item"></span> -->
                      </div>
                    </div>
                  </div>
                  <h4 class="mb-0"><?php echo e(count($customer_count)); ?></h4>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($_SESSION['user_type'] == "A"): ?>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">Total Members</h3>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="icon icon-box-success ">
                        <!-- <span class="mdi mdi-arrow-top-right icon-item"></span> -->
                      </div>
                    </div>
                  </div>
                  <h4 class="mb-0"><?php echo e(count($user_count)); ?></h4>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <?php if ($_SESSION['user_type'] == "A"): ?>
                  <h4 class="card-title">Latest Projects</h4>
                <?php else: ?>
                  <h4 class="card-title">My Projects</h4>
                <?php endif; ?>
                <div class="table-responsive">
                  <form id="form" action="" method="POST">
                    <?php include $this->resolve('partials/_csrf.php'); ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="selectAll" name="selectAll[]">
                              </label>
                            </div>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('name','asc')">▲</a>
                            Project Name
                            <a a href="#" class="sort-button" onclick="sortBy('name','desc')">▼</a>
                          </th>
                          <th>
                            <a href="#" class="sort-button" onclick="sortBy('description','asc')">
                              ▲</a>
                            Description
                            <a a href="#" class="sort-button" onclick="sortBy('description','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('customer','asc')">▲</a>
                            Customer
                            <a a href="#" class="sort-button" onclick="sortBy('customer','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('project_tags_name','asc')">▲</a>
                            Tags
                            <a a href="#" class="sort-button" onclick="sortBy('project_tags_name','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('start_date','asc')">▲</a>
                            Start Date
                            <a a href="#" class="sort-button" onclick="sortBy('start_date','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('deadline','asc')">▲</a>
                            Deadline
                            <aa href="#" class="sort-button" onclick="sortBy('deadline','desc')">
                              ▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('status','asc')">▲</a>
                            Status
                            <a a href="#" class="sort-button" onclick="sortBy('status','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('project_member_name','asc')">▲</a>
                            Members
                            <a a href="#" class="sort-button" onclick="sortBy('project_member_name','desc')">▼</a>
                          </th>
                          <?php if ($_SESSION['user_type'] == "A"): ?>
                            <th>Edit</th>
                            <th>Delete</th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php //dd($project); ?>
                        <?php if (is_array($project)): ?>
                          <?php foreach ($project as $pro): ?>
                            <?php if (is_array($pro)): ?>
                              <?php foreach ($pro as $p): ?>
                                <tr>
                                  <td>
                                    <div class="form-check form-check-muted m-0">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="<?php echo $p['id']; ?>"
                                          name="ids[]">
                                      </label>
                                    </div>
                                  </td>
                                  <?php if ($_SESSION['user_type'] == "A"): ?>
                                    <td><a href="/admin/project/<?php echo e($p['id']); ?>">
                                        <?php echo e($p['name']); ?></a></td>
                                  <?php else: ?>
                                    <td><a href="/admin/project/<?php echo e($p['id']); ?>">
                                        <?php echo e($p['name']); ?></a></td>
                                  <?php endif; ?>
                                  <td><?php echo e($p['description']); ?></td>
                                  <td><?php echo e($p['customer']); ?></td>
                                  <td><?php echo e($p['project_tags_name']); ?>
                                  </td>
                                  <td><?php echo e($p['start_date']); ?></td>
                                  <td><?php echo e($p['deadline']); ?></td>
                                  <td><?php echo e($p['status']); ?></td>
                                  <td><?php echo e($p['project_member_name']); ?>
                                  </td>
                                  <?php if ($_SESSION['user_type'] == "A"): ?>
                                    <td><a href="/admin/editproject/<?php echo $p['id']; ?>">
                                        <div class="badge badge-outline-success">
                                          Edit</div>
                                      </a></td>
                                    <input type="hidden" name="_METHOD" value="DELETE">
                                    <td><button type="button" onclick="deleteproject(<?php echo $p['id']; ?>)" name="delete"
                                        class="badge badge-outline-danger" style="background-color:transparent;">Delete
                                      </button></td>
                                  <?php endif; ?>
                                </tr>

                              <?php endforeach; ?>
                            <?php endif; endforeach; endif; ?>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <?php if ($_SESSION['user_type'] == "A"): ?>
                  <h4 class="card-title">Latest Tasks</h4>
                <?php else: ?>
                  <h4 class="card-title">My Tasks</h4>
                <?php endif; ?>
                <div class="table-responsive">
                  <form id="form" action="" method="POST">
                    <?php include $this->resolve('partials/_csrf.php'); ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="selectAll" name="selectAll[]">
                              </label>
                            </div>
                          </th>
                          <!-- <th>
                              <a a href="#" class="sort-button" onclick="sortBy('name','asc')">▲</a>
                              Project Name
                              <a a href="#" class="sort-button" onclick="sortBy('name','desc')">▼</a>
                            </th> -->
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('name','asc')">▲</a>
                            Task Name
                            <a a href="#" class="sort-button" onclick="sortBy('name','desc')">▼</a>
                          </th>
                          <th>
                            <a href="#" class="sort-button" onclick="sortBy('task_member_name','asc')">
                              ▲</a>
                            Assigned to
                            <a a href="#" class="sort-button" onclick="sortBy('task_member_name','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('task_tags_name','asc')">▲</a>
                            Tags
                            <a a href="#" class="sort-button" onclick="sortBy('task_tags_name','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('start_date','asc')">▲</a>
                            Start Date
                            <a a href="#" class="sort-button" onclick="sortBy('start_date','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('due_date','asc')">▲</a>
                            Due Date
                            <aa href="#" class="sort-button" onclick="sortBy('due_date','desc')">
                              ▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('status','asc')">▲</a>
                            Status
                            <a a href="#" class="sort-button" onclick="sortBy('status','desc')">▼</a>
                          </th>
                          <th>
                            <a a href="#" class="sort-button" onclick="sortBy('priority','asc')">▲</a>
                            Priority
                            <a a href="#" class="sort-button" onclick="sortBy('priority','desc')">▼</a>
                          </th>
                          <?php if ($_SESSION['user_type'] == "A"): ?>
                            <th>Edit</th>
                            <th>Delete</th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (is_array($task)): ?>
                          <?php foreach ($task as $ta): ?>
                            <?php if (is_array($ta)): ?>
                              <?php foreach ($ta as $t): ?>
                                <tr>
                                  <td>
                                    <div class="form-check form-check-muted m-0">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="<?php echo $t['id']; ?>"
                                          name="ids[]">
                                      </label>
                                    </div>
                                  </td>
                                  <td> <?php if ($_SESSION['user_type'] == "A"): ?>
                                      <a href="/admin/task/<?php echo $t['id']; ?>">
                                        <?php echo e($t['name']); ?></a><br><br><?php echo e("# " . $t['project']); ?>
                                    <?php else: ?>
                                      <a href="/admin/task/<?php echo $t['id']; ?>">
                                        <?php echo e($t['name']); ?></a><br><br><?php echo e("# " . $t['project']); ?>
                                    <?php endif; ?>
                                  </td>
                                  <td><?php echo e($t['task_member_name']); ?>
                                  </td>
                                  <td><?php echo e($t['task_tags_name']); ?>
                                  </td>
                                  <td><?php echo e($t['start_date']); ?></td>
                                  <td><?php echo e($t['due_date']); ?></td>
                                  <td><?php echo e($t['status']); ?></td>
                                  <td><?php echo e($t['priority']); ?>
                                  </td>
                                  <?php if ($_SESSION['user_type'] == "A"): ?>
                                    <td><a href="/admin/edittask/<?php echo $t['id']; ?>">
                                        <div class="badge badge-outline-success">
                                          Edit</div>
                                      </a></td>
                                    <input type="hidden" name="_METHOD" value="DELETE">
                                    <td><button type="button" onclick="deletetask(<?php echo $t['id']; ?>)" name="delete"
                                        class="badge badge-outline-danger" style="background-color:transparent;">Delete
                                      </button></td>
                                  <?php endif; ?>
                                </tr>
                              <?php endforeach; ?>
                            <?php endif; endforeach; endif; ?>
                      </tbody>
                    </table>
                  </form>

                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-12">

          </div>
        </div>
      </div>
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



<script>
  $(document).ready(function () {
    // Select/Deselect all checkboxes
    $("#selectAll").click(function () {
      $("input[name='ids[]']").prop('checked', this.checked);
    });

    // Select/Deselect checkboxes in the Customers group
    $("input[name='selectStatus[]']").click(function () {
      $("input[name='status[]']").prop('checked', this.checked);
    });
  });

  function deleteSelectedProjects() {
    var form = document.getElementById('form');
    var selectedCheckboxes = document.querySelectorAll("input[name^='ids']:checked");
    if (selectedCheckboxes.length === 0) {
      alert("No projects selected");

      form.action = "/projects";
    }
    else {
      if (confirm('Are you sure you want to delete selected projects?')) {
        <?php $id[0] = [0]; ?>
        form.action = "/deleteproject/<?php echo e($id[0][0]); ?>";
        form.submit();
      }
    }

  }
  function deleteproject(projectid) {
    if (confirm('Are you sure you want to delete this project ?')) {
      <?php $id[0] = [0]; ?>
      form.action = "/deleteproject/" + projectid;
      form.submit();
    }
  }



</script>