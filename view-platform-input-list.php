<select class="form-select" id="platform_id" name="platform_id">
<?php
while ($platformItem = $platformList->fetch_assoc()) {
    $selText = "";
    if (isset($selectedPlatform) && $selectedPlatform == $platformItem['platform_id']) {
        $selText = "selected";
    }
?>
    <option value="<?php echo $platformItem['platform_id']; ?>" <?= $selText ?>>
        <?php echo htmlspecialchars($platformItem['platform_name']); ?>
    </option>
<?php
}
?>
</select>
