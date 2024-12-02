<select class="form-select" id="cid" name="cid">
<?php
while ($showItem = $showList->fetch_assoc()) {
    $selText = "";
    if ($selectedShow == $showItem['show_id']) {
        $selText = "selected";
    }
?>
    <option value="<?php echo $showItem['show_id']; ?>" <?=$selText?>><?php echo $showItem['show_name']; ?></option>
<?php
}
?>
</select>
