<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
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

                <div class="row">

                </div>
                <div class="content-wrapper">
                    <!-- Filter Dropdown -->
                    <?php include $this->resolve("partials/_search.php"); ?>
                    <?php
                    $countryfilter = [];
                    if (array_key_exists('country', $_POST)) {
                        $countryfilter = array_merge($countryfilter, $_POST['country']);
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
                                    <input type="checkbox" name="selectCountry[]" value="country"> Country
                                    <div class="sub-items">
                                        <?php $country = ['India', 'USA', 'Canada', 'Russia', 'Maxico']; ?>
                                        <?php foreach ($country as $o): ?>
                                            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && in_array($o, $countryfilter)): ?>

                                                <label><input type="checkbox" name="country[]"
                                                        value="<?php echo (string) $o; ?>"
                                                        checked><?php echo (string) $o; ?></label>
                                            <?php else: ?>
                                                <label><input type="checkbox" name="country[]"
                                                        value="<?php echo (string) $o; ?>"><?php echo (string) $o; ?></label>
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
                    <?php if (array_key_exists('countryfilter', $_POST)):
                        foreach ($_POST['countryfilter'] as $sts): ?>
                            <input type="hidden" id="_filter_country_[]" name="_filter_country_[]"
                                value="<?php echo e($sts ?? ''); ?>">
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </form>

                    <div class="col-xl-11 col-sm-6 col-9 grid-margin stretch-card">
                        <div class="card corona-gradient-card">
                            <div class="card-body py-0 px-0 px-sm-3" style="background-color:#191C24;">
                                <div class="row align-items-center">
                                    <div class="row">
                                        <div class="col-12 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Members</h4>
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
                                                                        <th>User Profile</th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('name','asc')">▲</a>
                                                                            User Name
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('name','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('email','asc')">▲</a>
                                                                            Email
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('email','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a href="#" class="sort-button"
                                                                                onclick="sortBy('country','asc')">
                                                                                ▲</a>
                                                                            Country
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('country','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('state','asc')">▲</a>
                                                                            State
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('state','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('city','asc')">▲</a>
                                                                            City
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('city','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('gender','asc')">▲</a>
                                                                            Gender
                                                                            <aa href="#" class="sort-button"
                                                                                onclick="sortBy('gender','desc')">
                                                                                ▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('maritalStatus','asc')">▲</a>
                                                                            Marital Status
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('maritalStatus','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('mobileNo','asc')">▲</a>
                                                                            Mobile No.
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('mobileNo','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('address','asc')">▲</a>
                                                                            Address
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('address','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('dob','asc')">▲</a>
                                                                            Date of Birth
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('dob','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('hireDate','asc')">▲</a>
                                                                            HireDate
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('hireDate','desc')">▼</a>
                                                                        </th>
                                                                        <th>
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('status','asc')">▲</a>
                                                                            Status
                                                                            <a a href="#" class="sort-button"
                                                                                onclick="sortBy('status','desc')">▼</a>
                                                                        </th>
                                                                        <th>Edit</th>
                                                                        <th>Delete</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($viewmember as $t): ?>
                                                                        <tr>
                                                                            <td>
                                                                                <div
                                                                                    class="form-check form-check-muted m-0">
                                                                                    <label class="form-check-label">
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input"
                                                                                            value="<?php echo $t['id']; ?>"
                                                                                            name="ids[]">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <?php
                                                                            if ($t['gender'] === 'M') {
                                                                                $t['gender'] = "Male";
                                                                            } else if ($t['gender'] === 'F') {
                                                                                $t['gender'] = "Female";
                                                                            } else if ($t['gender'] === 'O') {
                                                                                $t['gender'] = "Other";
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                            if ($t['maritalStatus'] === 'S') {
                                                                                $t['maritalStatus'] = "Single";
                                                                            } else if ($t['maritalStatus'] === 'M') {
                                                                                $t['maritalStatus'] = "Married";
                                                                            } else if ($t['maritalStatus'] === 'W') {
                                                                                $t['maritalStatus'] = "Widowed";
                                                                            } else if ($t['maritalStatus'] === 'D') {
                                                                                $t['maritalStatus'] = "Divorced";
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                            //   $defaultImage = "https://bootdey.com/img/Content/avatar/avatar7.png";
                                                                            $storage = "/storage/uploads/";
                                                                            $defaultImage = "/storage/uploads/download.png";
                                                                            // $url = "http://192.168.1.30/storage/uploads/";   
                                                                            $profileImage = !empty($t['image']) ? $storage . $t['storage_filename'] : $defaultImage;
                                                                            ?>
                                                                            <td><a
                                                                                    href="/profile/<?php echo e($t['id']) ?>">
                                                                                    <img src="<?php echo e($profileImage) ?>"
                                                                                        alt="Admin" class="rounded-circle"
                                                                                        width="150"></a></td>
                                                                            <td><?php echo e($t['name']); ?></td>
                                                                            <td><?php echo e($t['email']); ?></td>
                                                                            <td><?php echo e($t['country']); ?>
                                                                            </td>
                                                                            <td><?php echo e($t['state']); ?></td>
                                                                            <td><?php echo e($t['city']); ?></td>
                                                                            <td><?php echo e($t['gender']); ?></td>
                                                                            <td><?php echo e($t['maritalStatus']); ?>
                                                                            <td><?php echo e($t['mobileNo']); ?>
                                                                            <td><?php echo e($t['address']); ?>
                                                                            <td><?php echo e($t['dob']); ?>
                                                                            <td><?php echo e($t['hireDate']); ?>
                                                                            <?php if ($t['status'] === '1') : ?>
                                                                <td>
                                                                    <div class="badge badge-outline-primary">Active</div>
                                                                </td>
                                                            <?php else : ?>
                                                                <td>
                                                                    <div class="badge badge-outline-danger">Not Active</div>
                                                                </td>
                                                            <?php endif; ?>
                                                                            
                                                                            </td>

                                                                            <td><a
                                                                                    href="/admin/staff/editProfile/<?php echo $t['id']; ?>">
                                                                                    <div
                                                                                        class="badge badge-outline-success">
                                                                                        Edit</div>
                                                                                </a></td>
                                                                            <input type="hidden" name="_METHOD"
                                                                                value="DELETE">
                                                                            <td><button type="button"
                                                                                    onclick="deletemember(<?php echo $t['id']; ?>)"
                                                                                    name="delete"
                                                                                    class="badge badge-outline-danger"
                                                                                    style="background-color:transparent;">Delete
                                                                                </button></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                            <br>
                                                            <a href="/admin/register">
                                                                <div class="badge badge-outline-success">Add New
                                                                    Member</div>
                                                            </a>
                                                            <?php if ($viewmember): ?>
                                                                <input type="hidden" name="_METHOD" value="DELETE">
                                                                <button type="button" onclick="deleteSelectedMembers()"
                                                                    name="deleteAll" class="badge badge-outline-danger"
                                                                    style="background-color:transparent;">Delete
                                                                    Selected Members</button>
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
        $("input[name='selectCountry[]']").click(function () {
            $("input[name='country[]']").prop('checked', this.checked);
        });
    });

    function deleteSelectedMembers() {
        var form = document.getElementById('form');
        var selectedCheckboxes = document.querySelectorAll("input[name^='ids']:checked");
        if (selectedCheckboxes.length === 0) {
            alert("No Members selected");

            form.action = "/admin/members";
        }
        else {
            if (confirm('Are you sure you want to delete selected members?')) {
                <?php $id[0] = [0]; ?>
                form.action = "/admin/deletemember/<?php echo e($id[0][0]); ?>";
                form.submit();
            }
        }

    }
    function deletemember(userid) {
        if (confirm('Are you sure you want to delete this member ?')) {
            <?php $id[0] = [0]; ?>
            form.action = "/admin/deletemember/" + userid;
            form.submit();
        }
    }



</script>

</html>