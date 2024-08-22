<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customers</title>
</head>

<body>
  <?php include $this->resolve("partials/_header.php"); ?>
  <div class="container-scroller">
    <?php include $this->resolve("partials/_sidebar.php"); ?>
    <div class="container-fluid page-body-wrapper">
      <?php include $this->resolve("partials/_navbar.php"); ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Filter Dropdown -->
          <?php include $this->resolve("partials/_search.php"); ?>
          <?php
          $companies = [];
          if (array_key_exists('company', $_POST)) {
            $companies = $_POST['company']; // Use companies from POST if available
          }

          $countries = [];
          if (array_key_exists('country', $_POST)) {
            $countries = $_POST['country'];
          } ?>
          <div class="d-flex justify-content-between align-items-center">
            <div class="dropdown">
              <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-filter-variant"></i> Filter
              </button>

              <div class="dropdown-menu" aria-labelledby="filterDropdown">
                <!-- Parent Item 1 -->
                <div class="dropdown-item">
                  <input type="checkbox" name="selectCustomers[]" value="cutomers"> Customers
                  <div class="sub-items">

                    <?php foreach ($customers as $c): ?>
                      <?php if (in_array($c['company'], $companies)): ?>
                        <label><input type="checkbox" name="company[]" value="<?php echo $c['company']; ?>"
                            checked><?php echo $c['company']; ?></label>
                      <?php else: ?>
                        <label><input type="checkbox" name="company[]"
                            value="<?php echo $c['company']; ?>"><?php echo $c['company']; ?></label>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- Parent Item 2 -->

                <div class="dropdown-item">
                  <input type="checkbox" name="selectCountries[]" value="country"> Country
                  <div class="sub-items">
                    <?php $country = ['India', 'USA', 'Canada', 'Russia', 'Maxico']; ?>
                    <?php foreach ($country as $o): ?>
                      <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && in_array($o, $countries)): ?>

                        <label><input type="checkbox" name="country[]" value="<?php echo (string) $o; ?>"
                            checked><?php echo (string) $o; ?></label>
                      <?php else: ?>
                        <label><input type="checkbox" name="country[]"
                            value="<?php echo (string) $o; ?>"><?php echo (string) $o; ?></label>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- Add more items and sub-items as needed -->
                <button type="button" onclick="form_submit()" class="submit-btn">Apply Filters</button>
              </div>
            </div>
          </div>
          <input type="hidden" id="p" name="p" value="<?php echo e($_POST['p'] ?? 1); ?>">
          <input type="hidden" id="search_input" name="search_input" value="<?php echo e($_POST['s'] ?? ''); ?>" />
          <input type="hidden" id="order_by" name="order_by" value="<?php echo e($_POST['order_by'] ?? 'id') ?>" />
          <input type="hidden" id="direction" name="direction" value="<?php echo e($_POST['direction'] ?? 'desc') ?>" />
          <input type="hidden" id="filter_company" name="filter_company"
            value="<?php echo e($_POST['company'] ?? ''); ?>">
          <input type="hidden" id="filter_country" name="filter_country"
            value="<?php echo e($_POST['country'] ?? ''); ?>">
          </form>
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
                                    <th>
                                      <a href="#" class="sort-button" onclick="sortBy('company','asc')">▲</a>
                                      Company Name
                                      <a href="#" class="sort-button" onclick="sortBy('company','desc')">▼</a>
                                    </th>
                                    <th> <a href="#" class="sort-button" onclick="sortBy('website','asc')">▲</a>
                                      Website
                                      <a href="#" class="sort-button" onclick="sortBy('website','desc')">▼</a>
                                    </th>
                                    <th><a href="#" class="sort-button" onclick="sortBy('email','asc')">▲</a>
                                      Email
                                      <a href="#" class="sort-button" onclick="sortBy('email','desc')">▼</a>
                                    </th>
                                    <th><a href="#" class="sort-button" onclick="sortBy('phone','asc')">▲</a>
                                      Phone
                                      <a href="#" class="sort-button" onclick="sortBy('phone','desc')">▼</a>
                                    </th>
                                    <th><a href="#" class="sort-button" onclick="sortBy('country','asc')">▲</a>
                                      Country
                                      <a href="#" class="sort-button" onclick="sortBy('country','desc')">▼</a>
                                    </th>
                                    <th><a href="#" class="sort-button" onclick="sortBy('address','asc')">▲</a>
                                      Address
                                      <a href="#" class="sort-button" onclick="sortBy('address','desc')">▼</a>
                                    </th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($viewcustomer as $p): ?>
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
                                      <td>
                                        <input type="hidden" id="_METHOD" name="_METHOD" value="DELETE">
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
                                <input type="hidden" id="_METHOD" name="_METHOD" value="DELETE">
                                <button type="button" onclick="deleteSelectedCustomers()" name="deleteAll"
                                  class="badge badge-outline-danger" style="background-color:transparent;">Delete
                                  Selected Customers
                                </button>
                              <?php endif; ?>
                            </form>
                            <br><br>
                            <?php include $this->resolve("partials/_pagination.php") ?>
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


  <script>
    $(document).ready(function () {
      // Select/Deselect all checkboxes
      $("#selectAll").click(function () {
        $("input[name='ids[]']").prop('checked', this.checked);
      });

      // Select/Deselect checkboxes in the Customers group
      $("input[name='selectCustomers[]']").click(function () {
        $("input[name='company[]']").prop('checked', this.checked);
      });

      // Select/Deselect checkboxes in the Countries group
      $("input[name='selectCountries[]']").click(function () {
        $("input[name='country[]']").prop('checked', this.checked);
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
  </script>

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

</html>