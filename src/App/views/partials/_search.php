<form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="" id="filterform" method="POST">
    <?php include $this->resolve('partials/_csrf.php'); ?>

    <input type="text" name="s" style="color:white;" value="<?php echo e($_POST['s'] ?? ''); ?>" class="form-control"
        placeholder="Search...">
    <button type="button" onclick="form_submit()" style="color: black;">
        Search
    </button>
    <script>
        const filterform = document.getElementById('filterform');
        function form_submit() {
            filterform.submit();
        }
        function setPageAndSubmit(page) {
            // Set the hidden input's value to the selected page
            document.getElementById('p').value = page;
            // Submit the form
            filterform.submit();
        }
        function sortBy(order_by = 'id', direction = 'desc') {
            const field_order_by = document.getElementById('order_by');
            const field_direction = document.getElementById('direction');
            field_order_by.value = order_by;
            field_direction.value = direction;
            console.log(order_by, direction);
            filterform.submit();
        }
    </script>