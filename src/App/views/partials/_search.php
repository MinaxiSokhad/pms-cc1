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
            document.getElementById('p').value = 1;
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