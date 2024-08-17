<!-- Previous Page Link -->
<?php if ($currentPage > 1): ?>
    <a href="?<?php echo e($previousPageQuery); ?>"
        class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
        Previous
    </a>
    <a href="?<?php echo e($previousPageQuery); ?>"
        class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
        <?php echo e($currentPage - 1); ?>
    </a>
<?php endif; ?>


<a href="?<?php echo e($currentPage); ?>"
    class="<?php echo $currentPage === $currentPage ? "border-indigo-500 text-indigo-600" : "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"; ?> inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium">
    <?php echo $currentPage; ?>
</a>

<!-- Next Page Link -->
<?php if ($currentPage < $lastPage): ?>
    <a href="?<?php echo e($nextPageQuery); ?>"
        class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
        <?php echo e($currentPage + 1); ?>
    </a>
    <a href="?<?php echo e($nextPageQuery); ?>"
        class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
        Next
    </a>
<?php endif; ?>

<!-- Dropdown for Page Numbers 
<form action="/projects" method="POST" class="mt-2">
    <label for="pageSelect" class="text-sm font-medium text-gray-700">Go to page:</label>
    <select id="pageSelect" name="page" class="ml-2 p-1 border border-gray-300 rounded">
        <?php //for ($i = 1; $i <= $lastPage; $i++): ?>
            <option value="<? php// echo $i; ?>" <? php// echo $i === $currentPage ? 'selected' : ''; ?>>
                Page <?php //echo $i; ?>
            </option>
        <?php //endfor; ?>
    </select>
    <button type="submit" class="ml-2 px-3 py-1 bg-indigo-500 text-black rounded">Go</button>
</form>-->