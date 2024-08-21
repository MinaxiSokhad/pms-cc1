<!-- Previous Page Link -->
<div style="text-align: center;">
    <form action="" method="POST" class="mt-2">
        <!-- Preserve other query parameters in the form action -->
        <input type="hidden" name="<?php echo e($_POST); ?>" value="<?php echo e($_POST['p'] ?? 1); ?>">

        <?php if ($currentPage > 1): ?>
            <a href="?p=<?php echo $currentPage - 1; ?>"
                class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                Previous
            </a>
            <a href="?p=<?php echo $currentPage - 1; ?>"
                class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                <?php echo $currentPage - 1; ?>
            </a>
        <?php endif; ?>

        <a href="?p=<?php echo $currentPage; ?>"
            class="<?php echo $currentPage === $currentPage ? "border-indigo-500 text-indigo-600" : "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"; ?> inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium">
            <?php echo $currentPage; ?>
        </a>

        <!-- Next Page Link -->
        <?php if ($currentPage < $lastPage): ?>
            <a href="?p=<?php echo $currentPage + 1; ?>"
                class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                <?php echo $currentPage + 1; ?>
            </a>
            <a href="?p=<?php echo $currentPage + 1; ?>"
                class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                Next
            </a>
        <?php endif; ?>

        <select style="background-color:#191C24; color: white;" onchange="this.form.submit()" id="pageSelect" name="p"
            class="ml-2 p-1 border border-gray-300 rounded">
            <?php for ($i = 1; $i <= $lastPage; $i++): ?>
                <option name="p" value="<?php echo $i; ?>" <?php echo $i === $currentPage ? 'selected' : ''; ?>
                    style="background-color:#191C24; color: white;">
                    <?php echo $i; ?>
                </option>
            <?php endfor; ?>
        </select>
    </form>
    <?php //dd($_POST['p']); ?>
</div>