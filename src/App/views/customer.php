<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customers</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      $("#selectAll").click(function () {
        $("input[type='checkbox']").prop('checked', this.checked);
      });
    });

    function deleteSelectedCustomers() {
      var form = document.getElementById('form');
      var selectedCheckboxes = document.querySelectorAll("input[name^='ids']:checked");
      if (selectedCheckboxes.length === 0) {
        alert("No customers selected");
        form.action = "/customer";
      }
      else {
        if (confirm('Are you sure you want to delete this customers?')) {
          <?php $id[0] = [0]; ?>
          form.action = "/deletecustomer/<?php echo e($id[0][0]); ?>";
          form.submit();
        }
      }

    }
    function deletecustomer(customerid) {
      if (confirm('Are you sure you want to delete this customer?')) {
        <?php $id[0] = [0]; ?>
        form.action = "/deletecustomer/" + customerid;
        form.submit();
      }
    }
    // function handleDelete(actionType, customerId = null) {
    //   var form = document.getElementById('form');
    //   var selectedCheckboxes = document.querySelectorAll("input[name^='ids']:checked");

    //   if (actionType === 'deleteselected') {
    //     if (selectedCheckboxes.length === 0) {
    //       alert("No records selected");
    //       return;
    //     }
    //     form.action = "/deletecustomer/";
    //   } else if (actionType === 'deleteSingle' && customerId !== null) {
    //     form.action = "/deletecustomer/" + customerId;
    //   }

    //   form.submit();
    // } 
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
        <div class="content-wrapper">
          <div class="row">
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
              <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
              </button>
              <ul class="navbar-nav w-90">
                <li class="nav-item w-90">
                  <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET">

                    <input type="text" name="s" value="<?php echo e((string) $searchTerm); ?>" class="form-control"
                      placeholder="Search...">
                    <button type="submit" style="color: black;">
                      Search
                    </button>
                  </form>
                </li>
              </ul>
            </div>
            <?php //dd($oldFormData); ?>
            <!-- Filter Dropdown -->
            <form id="filterForm" action="/customer/<?php echo "AllCustomers"; ?>" method="GET">
              <div class="d-flex justify-content-between align-items-center">
                <div class="dropdown">
                  <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-filter-variant"></i> Filter
                  </button>
                  <div class="dropdown-menu" aria-labelledby="filterDropdown">
                    <!-- Parent Item 1 -->
                    <div class="dropdown-item">
                      <input type="checkbox" name="company[]" value="cutomers"> Customers
                      <div class="sub-items">
                        <?php $customer = array_values($oldFormData['company'] ?? []);
                        ?>
                        <?php foreach ($customers as $p): ?>
                          <?php if (in_array($p['id'], $customer)): ?>
                            <label><input type="checkbox" name="company[]" value="<?php echo $p['id']; ?>"
                                checked><?php echo $p['company']; ?></label>
                          <?php else: ?>
                            <label><input type="checkbox" name="company[]"
                                value="<?php echo $p['id']; ?>"><?php echo $p['company']; ?></label>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <!-- Parent Item 2 -->
                    <div class="dropdown-item">
                      <input type="checkbox" name="country[]" value="country"> Country
                      <div class="sub-items">
                        <?php foreach ($country as $p): ?>
                          <label><input type="checkbox" name="country[]"
                              value="<?php echo $p['id']; ?>"><?php echo $p['country']; ?></label>
                        <?php endforeach; ?>
                      </div>
                    </div>
                    <style>
                      body {
                        font-family: Arial, sans-serif;
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

                      .sub-items {
                        display: none;
                        margin-left: 20px;
                        background-color: #333;
                        padding: 5px;
                        border-radius: 5px;
                      }

                      .dropdown-item:hover .sub-items {
                        display: block;
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

                      .submit-btn:hover {
                        background-color: #2980b9;
                      }
                    </style>
                    <!-- Add more items and sub-items as needed -->

                    <button type="submit" class="submit-btn">Apply Filters</button>
                  </div>
                </div>
              </div>
            </form>
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
            <div class="col-12 grid-margin stretch-card">
              <div class="card corona-gradient-card position-relative">
                <div class="card-body py-0 px-0 px-sm-3" style="background-color:#191C24;">

                  <div class="row align-items-center">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Customers</h4>
                            <div class="table-responsive">

                              <form id="form" method="POST">
                                <?php include $this->resolve('partials/_csrf.php'); ?>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>
                                        <div class="form-check form-check-muted m-0">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" id="selectAll"
                                              name="selectAll[]">
                                          </label>
                                        </div>
                                      </th>
                                      <th> <a href="/customer/company_asc" class="sort-button" type="submit" name="sort"
                                          value="company_asc">▲</a>
                                        Company Name
                                        <a href="/customer/company_desc" class="sort-button" type="submit" name="sort"
                                          value="company_desc">▼</a>
                                      </th>
                                      <th> <a href="/customer/website_asc" class="sort-button" type="submit" name="sort"
                                          value="website_asc">▲</a>
                                        Website
                                        <a href="/customer/website_desc" class="sort-button" type="submit" name="sort"
                                          value="website_desc">▼</a>
                                      </th>
                                      <th><a href="/customer/email_asc" class="sort-button" type="submit" name="sort"
                                          value="email_asc">▲</a>
                                        Email
                                        <a href="/customer/email_desc" class="sort-button" type="submit" name="sort"
                                          value="email_desc">▼</a>
                                      </th>
                                      <th><a href="/customer/phone_asc" class="sort-button" type="submit" name="sort"
                                          value="phone_asc">▲</a>
                                        Phone
                                        <a href="/customer/phone_desc" class="sort-button" type="submit" name="sort"
                                          value="phone_desc">▼</a>
                                      </th>
                                      <th><a href="/customer/country_asc" class="sort-button" type="submit" name="sort"
                                          value="country_asc">▲</a>
                                        Country
                                        <a href="/customer/country_desc" class="sort-button" type="submit" name="sort"
                                          value="country_desc">▼</a>
                                      </th>
                                      <th><a href="/customer/address_asc" class="sort-button" type="submit" name="sort"
                                          value="address_asc">▲</a>Address
                                        <a href="/customer/address_desc" class="sort-button" type="submit" name="sort"
                                          value="address_desc">▼</a>
                                      </th>
                                      <th>Edit</th>
                                      <th>Delete</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php

                                    foreach ($viewcustomer as $p): ?>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-muted m-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input"
                                                value="<?php echo $p['id']; ?>" name="ids[]">
                                            </label>
                                          </div>
                                        </td>
                                        <?php foreach ($p as $field => $value): ?>
                                          <?php if ($field != "id" && $field != "created_at" && $field != "updated_at"): ?>
                                            <td><?php echo e($value); ?></td>
                                          <?php endif; ?>
                                        <?php endforeach; ?>
                                        <td><a href="/editcustomer/<?php echo $p['id']; ?>">
                                            <div class="badge badge-outline-success">Edit</div>
                                          </a></td>
                                        <input type="hidden" name="_METHOD" value="DELETE">
                                        <td>
                                          <button type="button" onclick="deletecustomer(<?php echo $p['id']; ?>)"
                                            name="delete" class="badge badge-outline-danger"
                                            style="background-color:transparent;">Delete
                                          </button>
                                        </td>
                                      </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                                <br>
                                <a href="/createcustomer">
                                  <div class="badge badge-outline-success">Add New Customers</div>
                                </a>
                                <?php if ($viewcustomer): ?>
                                  <input type="hidden" name="_METHOD" value="DELETE">
                                  <button type="button" onclick="deleteSelectedCustomers()" name="deleteAll"
                                    class="badge badge-outline-danger" style="background-color:transparent;">Delete
                                    Selected Customers
                                  </button>
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
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
                2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                  href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
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