<?php
function createArray($value)
{
    $array = [];
    foreach ($value as $v) {
        $array[] = $v;
    }
    return $array;
}
$value = range(1, 100);
$array = createArray($value);
foreach ($array as $v) {
}
?>
<?php $currentPage = $_GET['p'] ?? 1; ?>
<?php if ($currentPage > 1): ?>
    <a href=?p=1>
        << </a>
            <a href=?p=<?php echo ($currentPage - 1); ?>>
                < </a>
                <?php endif; ?>
                <?php foreach (range(3, 1, -1) as $r): ?>
                    <?php if ($currentPage - $r >= 1): ?>
                        <a href=?p=<?php echo ($currentPage - $r); ?>><?php echo ($currentPage - $r); ?></a>
                    <?php endif; endforeach; ?>

                <a href=?p=<?php echo ($currentPage); ?>><?php echo ($currentPage); ?></a>
                <?php if ($currentPage + 8 < $v): ?>
                    <a href=?p=<?php echo ($currentPage + 7);
                    echo " " . ($currentPage + 8); ?>><?php echo ($currentPage + 7);
                          echo " " . ($currentPage + 8); ?></a>
                <?php endif; ?>
                <?php if ($currentPage + 8 <= $v): ?>
                    <a href=?p=<?php echo ($v - 3) . " " . ($v - 2) . " " . ($v - 1);
                    ?>><?php echo ($v - 3) . " " . ($v - 2) . " " . ($v - 1);
                    ?></a>
                <?php endif; ?>
                <?php if ($currentPage < $v): ?>
                    <a href=?p=<?php echo ($currentPage + 1); ?>> > </a>
                    <a href=?p=<?php echo ($v); ?>> >> </a>
                <?php endif; ?>
                <form action="" method="POST" class="mt-2">
                    <label for="pageSelect" class="text-sm font-medium text-gray-700">Go to page:</label>
                    <select id="pageSelect" name="p" class="ml-2 p-1 border border-gray-300 rounded">
                        <?php for ($i = 1; $i <= $v; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo ($oldFormData[$i] ?? '') == ($i === $currentPage) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <button type="submit" class="ml-2 px-3 py-1 bg-indigo-500 text-black rounded">Go</button>
                    <?php dd($oldFormData[$i]); ?>
                </form>