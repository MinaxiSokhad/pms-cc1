<form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="" id="filterform" method="POST">
    <?php include $this->resolve('partials/_csrf.php'); ?>
    <?php $select_limit = isset($_POST['select_limit']) ? $_POST['select_limit'] : 3; ?>

    <select name="select_limit" id="select_limit" onchange="limit_submit(this.value)"
        class="ml-2 p-1 btn btn-outline-secondary">
        <option value="3" <?php echo $select_limit == "3" ? 'selected' : ''; ?>>3</option>
        <option value="5" <?php echo $select_limit == "5" ? 'selected' : ''; ?>>5</option>
        <option value="10" <?php echo $select_limit == "10" ? 'selected' : ''; ?>>10</option>
        <option value="1" <?php echo $select_limit == "1" ? 'selected' : ''; ?>>All</option>
    </select>
    <input style="margin-left: 10px; width:500px;color:white;" type="text" name="s"
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
            const hiddenElements = document.querySelectorAll('input[type="hidden"]');
            hiddenElements.forEach(element => {
                if (element.name == "p") {
                    element.value = page;
                } else {
                    console.log(element.name + ": " + element.value);
                }
            });
            // const order_by = document.querySelector('input[name="order_by"]').value;
            // const direction = document.querySelector('input[name="direction"]').value;

            // const hiddenElements = filterform.querySelectorAll('input[type="hidden"]');
            // hiddenElements.forEach(element => {
            //     if (element.name === "p") {
            //         element.value = page;  // Update page number
            //     } else if (element.name === "order_by") {
            //         element.value = order_by;  // Preserve sorting parameter
            //     } else if (element.name === "direction") {
            //         element.value = direction;  // Preserve sorting parameter
            //     }
            // });

            // console.log('Submitting form with:', {
            //     page,
            //     order_by,
            //     direction
            // });
            filterform.submit();
        }
        function sortBy(order_by = 'id', direction = 'desc') {

            const field_order_by = document.getElementById('order_by');
            const field_direction = document.getElementById('direction');
            field_order_by.value = order_by;
            field_direction.value = direction;
            console.log(order_by, direction);
            document.getElementById('p').value = 1;
            // const field_order_by = filterform.querySelector('input[name="order_by"]');
            // const field_direction = filterform.querySelector('input[name="direction"]');
            // const field_page = filterform.querySelector('input[name="p"]');

            // if (field_order_by) field_order_by.value = order_by;
            // if (field_direction) field_direction.value = direction;
            // if (field_page) field_page.value = 1;  // Reset page to 1

            // console.log('Sorting by:', {
            //     order_by,
            //     direction
            // });
            filterform.submit();
        }
    </script>