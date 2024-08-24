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
                <div class="content-wrapper">
                    <!-- Filter Dropdown -->
                    <?php include $this->resolve("partials/_search.php"); ?>
                    <?php
                    $statusfilter = [];
                    if (array_key_exists('status', $_POST)) {
                        $statusfilter = array_merge($statusfilter, $_POST['status']);
                    }
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-filter-variant"></i> Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="filterDropdown">
                                <div class="dropdown-item">
                                    <input type="checkbox" name="selectStatus[]" value="status"> Status
                                    <div class="sub-items">
                                        <?php $status = ['S' => 'Not Started', 'H' => 'On Hold', 'P' => 'In Progress', 'C' => 'Cancelled', 'F' => 'Finished']; ?>
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
                                </div>

                                <!-- Add more items and sub-items as needed -->
                                <button type="button" onclick="form_submit()" class="submit-btn">Apply
                                    Filters</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="p" name="p" value="<?php echo e($_POST['p'] ?? 1); ?>">
                    <input type="hidden" id="search_input" name="search_input"
                        value="<?php echo e($_POST['s'] ?? ''); ?>" />
                    <input type="hidden" id="order_by" name="order_by" value="id" />
                    <input type="hidden" id="direction" name="direction" value="desc" />
                    <?php if (array_key_exists('statusfilter', $_POST)):
                        foreach ($_POST['statusfilter'] as $sts): ?>
                            <input type="hidden" id="_filter_status_[]" name="_filter_status_[]"
                                value="<?php echo e($sts ?? ''); ?>">
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- <input type="hidden" id="filter_status" name="filter_status"
                        value="<?php //echo e($_POST['statusfilter'] ?? ''); ?>"> -->
                    </form>
                    <?php ?>
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
<style>
    body {
        font-family: Arial, sans-serif;
        color: white;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-toggle {
        background-color: #3498db;
        color: white;
        padding: 10px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: black;
        min-width: 220px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        padding: 10px;
        border-radius: 5px;
    }

    .dropdown-item {
        display: block;
        padding: 8px 0;
        cursor: pointer;
        color: white;
    }

    .dropdown-item:hover {
        color: #3498db;
        /* Change this to your desired hover color */
        background-color: #444;
        /* Optional: Change background color on hover */
    }

    .sub-items {
        display: none;
        margin-left: 20px;
        background-color: #333;
        padding: 5px;
        border-radius: 5px;
    }

    .sub-items label {
        display: block;
        padding: 5px 0;
        cursor: pointer;
        color: white;
    }

    .submit-btn {
        background-color: #3498db;
        color: white;
        padding: 8px;
        border: none;
        cursor: pointer;
        margin-top: 10px;
        width: 100%;
        border-radius: 5px;
    }
</style>
<script>document.addEventListener('DOMContentLoaded', function () {
        // Toggle the sub-items when a dropdown-item is clicked
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        dropdownItems.forEach(item => {
            item.addEventListener('click', function (e) {
                e.stopPropagation(); // Prevent the event from bubbling up
                const subItems = this.querySelector('.sub-items');
                if (subItems) {
                    // Toggle the visibility of sub-items
                    const isVisible = subItems.style.display === 'block';
                    subItems.style.display = isVisible ? 'none' : 'block';
                }
            });
        });

        // Close the dropdown menu when clicking outside
        window.addEventListener('click', function (e) {
            dropdownItems.forEach(item => {
                const subItems = item.querySelector('.sub-items');
                if (subItems) {
                    subItems.style.display = 'none';
                }
            });
        });

        // Prevent the dropdown from closing when clicking inside it
        document.querySelector('.dropdown-menu').addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

</html>