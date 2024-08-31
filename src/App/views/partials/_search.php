<form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="" id="filterform" method="POST">
    <?php include $this->resolve('partials/_csrf.php'); ?>
    <?php $select_limit = isset($_POST['select_limit']) ? $_POST['select_limit'] : 3; ?>

    <select name="select_limit" id="select_limit" onchange="limit_submit(this.value)"
        class="ml-2 p-1 btn btn-outline-secondary">
        <option value="3" <?php echo $select_limit == 3 ? 'selected' : ''; ?>>3</option>
        <option value="5" <?php echo $select_limit == 5 ? 'selected' : ''; ?>>5</option>
        <option value="10" <?php echo $select_limit == 10 ? 'selected' : ''; ?>>10</option>
        <option value="0" <?php echo $select_limit == 0 ? 'selected' : ''; ?>>All</option>
    </select>
    <input style="margin-left: 10px; width:500px;" type="text" name="s" style="color:white;"
        value="<?php echo e($_POST['s'] ?? ''); ?>" class="form-control" placeholder="Search...">
    <button style="margin-right: 10px;width:90px;" type="button" onclick="form_submit()" style="color: black;">
        Search
    </button>
    <script>
        const filterform = document.getElementById('filterform');
        function form_submit() {
            document.getElementById('p').value = 1;
            filterform.submit();
        }
        function limit_submit() {

            filterform.submit();
        }
        function setPageAndSubmit(page = 1) {
            // Set the hidden input's value to the selected page
            // document.getElementById('p').value = page;
            // Submit the form
            // Select all hidden elements
            // Log all hidden element values to the console
            const hiddenElements = document.querySelectorAll('input[type="hidden"]');
            hiddenElements.forEach(element => {
                if (element.name == "p") {
                    element.value = page;
                } else {
                    console.log(element.name + ": " + element.value);
                }
            });
            filterform.submit();
        }
        function sortBy(order_by = 'id', direction = 'desc') {
            document.getElementById('p').value = 1;
            const field_order_by = document.getElementById('order_by');
            const field_direction = document.getElementById('direction');
            field_order_by.value = order_by;
            field_direction.value = direction;
            console.log(order_by, direction);
            filterform.submit();
        }
    </script>