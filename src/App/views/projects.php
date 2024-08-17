<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
</head>

<body>
    <?php include $this->resolve("partials/_header.php"); ?>
    <div class="container-scroller">
        <?php include $this->resolve("partials/_sidebar.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include $this->resolve("partials/_navbar.php"); ?>
            <?php include $this->resolve('partials/_csrf.php'); ?>
            <div class="main-panel">
                <br />
                <h2>Project Summary</h2>
                <div class="row">
                    <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0"><?php echo $project_status[0]['S']; ?></h3>
                                            <p class="text-success ml-2 mb-0 font-weight-medium">Not Started</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0"><?php echo $project_status[1]['P']; ?></h3>
                                            <p class="text-success ml-2 mb-0 font-weight-medium">In Progress</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0"><?php echo $project_status[2]['H']; ?></h3>
                                            <p class="text-success ml-2 mb-0 font-weight-medium">On Hold</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0"><?php echo $project_status[3]['C']; ?></h3>
                                            <p class="text-success ml-2 mb-0 font-weight-medium">Cancelled</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0"><?php echo $project_status[4]['F']; ?></h3>
                                            <p class="text-success ml-2 mb-0 font-weight-medium">Finished</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Filter Dropdown -->
                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="/projects" id="filterform"
                        method="POST">
                        <?php include $this->resolve('partials/_csrf.php'); ?>

                        <input type="text" name="s" value="<?php echo e($_POST['s'] ?? ''); ?>" class="form-control"
                            placeholder="Search...">
                        <button type="button" onclick="onSearch()" style="color: black;">
                            Search
                        </button>
                        <?php
                        // dd($viewproject);
                        $statusfilter = [];
                        if (array_key_exists('status', $_POST)) {
                            $status = array_merge($statusfilter, $_POST['status']);
                        }
                        ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                    id="filterDropdown" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="mdi mdi-filter-variant"></i> Filter
                                </button>

                                <div class="dropdown-menu" aria-labelledby="filterDropdown">

                                    <div class="sub-items">
                                        <?php
                                        $status = ['S' => 'Not Started', 'H' => 'On Hold', 'P' => 'In Progress', 'C' => 'Cancelled', 'F' => 'Finished'];
                                        ?>
                                        <?php foreach ($status as $s => $value):
                                            ?>
                                            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && in_array($s, $statusfilter)): ?>
                                                <label><input type="checkbox" name="status[]" value="<?php echo (string) $s;
                                                ?>" checked><?php echo (string) $value; ?></label>

                                            <?php else: ?>
                                                <label><input type="checkbox" name="status[]" value="<?php echo (string) $s;
                                                ?>">
                                                    <?php echo (string) $value; ?></label>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Add more items and sub-items as needed -->
                                    <button type="button" onclick="onFilter()" class="submit-btn">Apply Filters</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="search_input" name="search_input"
                            value="<?php echo e($_POST['s'] ?? ''); ?>" />
                        <input type="hidden" id="order_by" name="order_by" value="id" />
                        <input type="hidden" id="direction" name="direction" value="desc" />
                        <?php if (array_key_exists('status', $_POST)):
                            foreach ($_POST['status'] as $statusfilter): ?>
                                <input type="hidden" id="_filter_status_[]" name="_filter_status_[]"
                                    value="<?php echo e($status ?? ''); ?>">
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </form>
                    <?php //dd($viewproject); ?>
                    <div class="col-xl-11 col-sm-6 col-9 grid-margin stretch-card">
                        <div class="card corona-gradient-card">
                            <div class="card-body py-0 px-0 px-sm-3" style="background-color:#191C24;">
                                <div class="row align-items-center">

                                    <div class="row">
                                        <div class="col-12 grid-margin">
                                            <div class="card">
                                                <div class="card-body">

                                                    <h4 class="card-title">Projects</h4>
                                                    <div class="table-responsive">



                                                        <form id="form" action="" method="POST">
                                                            <?php include $this->resolve('partials/_csrf.php'); ?>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <div
                                                                                class="form-check form-check-muted m-0">
                                                                                <label class="form-check-label">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id="selectAll"
                                                                                        name="selectAll[]">
                                                                                </label>
                                                                            </div>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('name','asc')">▲</a>
                                                                            Project Name
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('name','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="#" class="sort-button"
                                                                                onclick="sortBy('description','asc')">
                                                                                ▲</a>
                                                                            Description
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('description','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('customer','asc')">▲</a>
                                                                            Customer
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('customer','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('project_tags_name','asc')">▲</a>
                                                                            Tags
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('project_tags_name','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('start_date','asc')">▲</a>
                                                                            Start Date
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('start_date','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('deadline','asc')">▲</a>
                                                                            Deadline
                                                                            <aa href="#" class="sort-button"
                                                                                onclick="sortBy('deadline','desc')">
                                                                                ▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('status','asc')">▲</a>
                                                                            Status
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('status','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('project_member_name','asc')">▲</a>
                                                                            Members
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('project_member_name','desc')">▼</a>
                                                                        </th>
                                                                        <th>Edit</th>
                                                                        <th>Delete</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($viewproject as $p): ?>
                                                                        <tr>
                                                                            <td>
                                                                                <div
                                                                                    class="form-check form-check-muted m-0">
                                                                                    <label class="form-check-label">
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input"
                                                                                            value="<?php echo $p['id']; ?>"
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

                                                                            <td><a
                                                                                    href="/editproject/<?php echo $p['id']; ?>">
                                                                                    <div
                                                                                        class="badge badge-outline-success">
                                                                                        Edit</div>
                                                                                </a></td>
                                                                            <input type="hidden" name="_METHOD"
                                                                                value="DELETE">
                                                                            <td><button type="button"
                                                                                    onclick="deleteproject(<?php echo $p['id']; ?>)"
                                                                                    name="delete"
                                                                                    class="badge badge-outline-danger"
                                                                                    style="background-color:transparent;">Delete
                                                                                </button></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                            <br>
                                                            <a href="/createproject">
                                                                <div class="badge badge-outline-success">Add New
                                                                    Project</div>
                                                            </a>
                                                            <?php if ($viewproject): ?>
                                                                <input type="hidden" name="_METHOD" value="DELETE">
                                                                <button type="button" onclick="deleteSelectedProjects()"
                                                                    name="deleteAll" class="badge badge-outline-danger"
                                                                    style="background-color:transparent;">Delete
                                                                    Selected Projects</button>
                                                            <?php endif; ?>

                                                            <br /><br />
                                                            <?php include $this->resolve("partials/_pagination.php") ?>
                                                            <?php //dd($nextPageQuery); ?>
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
                <?php include $this->resolve("partials/_footer.php"); ?>
            </div>
        </div>
    </div>
    </div>
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/misc.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/todolist.js"></script>
    <script src="/assets/js/dashboard.js"></script>
</body>
<style>
    .sort-button {
        background: transparent;
        color: white;
        border: none;
        cursor: pointer;
        padding: 0;
        margin: 0;
        font-size: 16px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#selectAll").click(function () {
            $("input[type='checkbox']").prop('checked', this.checked);
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

    const filterform = document.getElementById('filterform');

    function sortBy(order_by = 'id', direction = 'desc') {
        const field_order_by = document.getElementById('order_by');
        const field_direction = document.getElementById('direction');
        field_order_by.value = order_by;
        field_direction.value = direction;
        console.log(order_by, direction);
        filterform.submit();
    }
    function onSearch() {
        filterform.submit();
    }
    function onFilter() {
        filterform.submit();
    }

</script>

</html>