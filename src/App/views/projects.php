<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
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
                <?php $id[0] = [0]; ?>
                form.action = "/deleteproject/<?php echo e($id[0][0]); ?>";
                form.submit();
            }

        }
        function deleteproject(projectid) {
            <?php $id[0] = [0]; ?>
            form.action = "/deleteproject/" + projectid;
            form.submit();
        }
    </script>
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

                    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>
                        <ul class="navbar-nav w-90">
                            <li class="nav-item w-90">
                                <form id="search_form" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search"
                                    method="GET">
                                    <input type="text" value="<?php echo e((string) $searchTerm); ?>"
                                        class="form-control" placeholder="Search..." name="s">
                                    <button type="submit" style="color: black;">
                                        Search
                                    </button>

                            </li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" style="margin-right:10%">
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-filter-variant"></i> Filter
                            </button>


                            <div class="dropdown-menu" aria-labelledby="filterDropdown">
                                <a class="dropdown-item" href="/projects/<?php echo "AllProjects"; ?>">All</a>
                                <a onclick="search_project('/S')" class="dropdown-item" s>Not
                                    Started</a>
                                <a class="dropdown-item" href="/projects/<?php echo "P"; ?>">In
                                    Progress</a>
                                <a class="dropdown-item" href="/projects/<?php echo "H"; ?>">On Hold</a>
                                <a class="dropdown-item" href="/projects/<?php echo "C"; ?>">Cancelled</a>
                                <a class="dropdown-item" href="/projects/<?php echo "F"; ?>">Finished</a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_searched" value="<?php echo e($_GET['s'] ?? ''); ?>">

                    <input type="hidden" name="_filter" value="<?php echo e($oldFormData); ?>">

                    </form>
                    <script>
                        function search_project(route) {
                            const form = document.getElementById('search_form');
                            form.action = "/project/"
                            document.write(form.action)

                            form.submit();

                        }
                    </script>
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


                                                        <?php ?>
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
                                                                            <a href="/projects/name_asc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="name_asc">▲</a>
                                                                            Project Name
                                                                            <a href="/projects/name_desc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="name_desc">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="/projects/description_asc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort"
                                                                                value="description_asc">▲</a>
                                                                            Description
                                                                            <a href="/projects/description_desc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort"
                                                                                value="description_desc">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="/projects/customer_asc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="customer_asc">▲</a>
                                                                            Customer
                                                                            <a href="/projects/customer_desc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="customer_desc">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="/projects/tags_asc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="tags_asc">▲</a>
                                                                            Tags
                                                                            <a href="/projects/tags_desc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="tags_desc">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="/projects/startdate_asc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="startdate_asc">▲</a>
                                                                            Start Date
                                                                            <a href="/projects/startdate_desc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="startdate_desc">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="/projects/deadline_asc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="deadline_asc">▲</a>
                                                                            Deadline
                                                                            <a href="/projects/deadline_desc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="deadline_desc">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="/projects/status_asc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="status_asc">▲</a>
                                                                            Status
                                                                            <a href="/projects/status_desc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="status_desc">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="/projects/members_asc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="members_asc">▲</a>
                                                                            Members
                                                                            <a href="/projects/members_desc"
                                                                                class="sort-button" type="submit"
                                                                                name="sort" value="members_desc">▼</a>
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

</html>