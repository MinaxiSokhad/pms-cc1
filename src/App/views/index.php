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
                <div class="card-body py-0 px-0 px-sm-3">
                  <div class="row align-items-center">


                  </div>
                </div>
              </div>
            </div>
          </div>
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
                  <h4 class="mb-0"><?php echo e(count($project_count)); ?></h4>
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
                  <h4 class="mb-0"><?php echo e(count($task_count)); ?></h4>
                </div>
              </div>
            </div>
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
          </div>
          <div class="row">

          </div>
          <div class="row">


          </div>
          <div class="row ">
            <!-- <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order Status</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </th>
                          <th> Client Name </th>
                          <th> Order No </th>
                          <th> Product Cost </th>
                          <th> Project </th>
                          <th> Payment Mode </th>
                          <th> Start Date </th>
                          <th> Payment Status </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td>
                            <img src="/assets/images/faces/face1.jpg" alt="image" />
                            <span class="pl-2">Henry Klein</span>
                          </td>
                          <td> 02312 </td>
                          <td> $14,500 </td>
                          <td> Dashboard </td>
                          <td> Credit card </td>
                          <td> 04 Dec 2019 </td>
                          <td>
                            <div class="badge badge-outline-success">Approved</div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td>
                            <img src="/assets/images/faces/face2.jpg" alt="image" />
                            <span class="pl-2">Estella Bryan</span>
                          </td>
                          <td> 02312 </td>
                          <td> $14,500 </td>
                          <td> Website </td>
                          <td> Cash on delivered </td>
                          <td> 04 Dec 2019 </td>
                          <td>
                            <div class="badge badge-outline-warning">Pending</div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td>
                            <img src="/assets/images/faces/face5.jpg" alt="image" />
                            <span class="pl-2">Lucy Abbott</span>
                          </td>
                          <td> 02312 </td>
                          <td> $14,500 </td>
                          <td> App design </td>
                          <td> Credit card </td>
                          <td> 04 Dec 2019 </td>
                          <td>
                            <div class="badge badge-outline-danger">Rejected</div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td>
                            <img src="/assets/images/faces/face3.jpg" alt="image" />
                            <span class="pl-2">Peter Gill</span>
                          </td>
                          <td> 02312 </td>
                          <td> $14,500 </td>
                          <td> Development </td>
                          <td> Online Payment </td>
                          <td> 04 Dec 2019 </td>
                          <td>
                            <div class="badge badge-outline-success">Approved</div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td>
                            <img src="/assets/images/faces/face4.jpg" alt="image" />
                            <span class="pl-2">Sallie Reyes</span>
                          </td>
                          <td> 02312 </td>
                          <td> $14,500 </td>
                          <td> Website </td>
                          <td> Credit card </td>
                          <td> 04 Dec 2019 </td>
                          <td>
                            <div class="badge badge-outline-success">Approved</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Latest Projects</h4>
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
                            <th>Edit</th>
                            <th>Delete</th>
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
                                    <td><?php echo e($p['name']); ?></td>
                                    <td><?php echo e($p['description']); ?></td>
                                    <td><?php echo e($p['customer']); ?></td>
                                    <td><?php echo e($p['project_tags_name']); ?>
                                    </td>
                                    <td><?php echo e($p['start_date']); ?></td>
                                    <td><?php echo e($p['deadline']); ?></td>
                                    <td><?php echo e($p['status']); ?></td>
                                    <td><?php echo e($p['project_member_name']); ?>
                                    </td>

                                    <td><a href="/editproject/<?php echo $p['id']; ?>">
                                        <div class="badge badge-outline-success">
                                          Edit</div>
                                      </a></td>
                                    <input type="hidden" name="_METHOD" value="DELETE">
                                    <td><button type="button" onclick="deleteproject(<?php echo $p['id']; ?>)" name="delete"
                                        class="badge badge-outline-danger" style="background-color:transparent;">Delete
                                      </button></td>
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
                  <h4 class="card-title">Latest Tasks</h4>
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
                            <th>Edit</th>
                            <th>Delete</th>
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
                                    <td><?php echo e($t['project']); ?></td>
                                    <td><?php echo e($t['name']); ?></td>
                                    <td><?php echo e($t['task_member_name']); ?>
                                    </td>
                                    <td><?php echo e($t['task_tags_name']); ?>
                                    </td>
                                    <td><?php echo e($t['start_date']); ?></td>
                                    <td><?php echo e($t['due_date']); ?></td>
                                    <td><?php echo e($t['status']); ?></td>
                                    <td><?php echo e($t['priority']); ?>
                                    </td>

                                    <td><a href="/edittask/<?php echo $t['id']; ?>">
                                        <div class="badge badge-outline-success">
                                          Edit</div>
                                      </a></td>
                                    <input type="hidden" name="_METHOD" value="DELETE">
                                    <td><button type="button" onclick="deletetask(<?php echo $t['id']; ?>)" name="delete"
                                        class="badge badge-outline-danger" style="background-color:transparent;">Delete
                                      </button></td>
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
</body>

</html>