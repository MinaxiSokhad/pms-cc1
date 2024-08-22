<!-- Previous Page Link -->

<!-- Preserve other query parameters in the form action -->

<input type="hidden" id="p" name="p" value="<?php echo e($currentPage); ?>">
<?php if ($currentPage > 1): ?>
    <a href="#" onclick="setPageAndSubmit(<?php echo $currentPage - 1; ?>)" class="btn btn-outline-secondary">
        Previous
    </a>
    <a href="#" onclick="setPageAndSubmit(<?php echo $currentPage - 1; ?>)" class="btn btn-outline-secondary">
        <?php echo $currentPage - 1; ?>
    </a>
<?php endif; ?>

<a href="#" onclick="setPageAndSubmit(<?php echo $currentPage; ?>)" class="btn btn-outline-secondary">
    <?php echo $currentPage; ?>

</a>

<!-- Next Page Link -->
<?php if ($currentPage < $lastPage): ?>
    <a href="#" onclick="setPageAndSubmit(<?php echo $currentPage + 1; ?>)" class="btn btn-outline-secondary">
        <?php echo $currentPage + 1; ?>
    </a>
    <a href="#" onclick="setPageAndSubmit(<?php echo $currentPage + 1; ?>)" class="btn btn-outline-secondary">
        Next
    </a>
<?php endif; ?>

<select style="background-color:#191C24; color: white;" onchange="setPageAndSubmit(this.value)" id="p" name="p"
    class="ml-2 p-1 border border-gray-300 rounded">
    <?php for ($i = 1; $i <= $lastPage; $i++): ?>
        <option value="<?php echo $i; ?>" <?php echo $i === $currentPage ? 'selected' : ''; ?>
            style="background-color:#191C24; color: white;">
            <?php echo $i; ?>
        </option>
    <?php endfor; ?>
</select>
</form>
</div>
<script>

</script>