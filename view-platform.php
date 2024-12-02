<div class="row">
  <div class="col">
<h1>Platforms</h1>
</div>
  <div class="col-auto">
  <?php
  include "view-platform-newform.php"
    ?>
  </div>
</div>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Headquarters</th>
      <th></th>
      <th></th>
      <th></th>
      </tr>
    </thead>
    <tbody>
  <?php 
    while ($platform=$platforms->fetch_assoc()) {
      ?>
      <tr>
        <td><?php echo $platform['platform_id']; ?></td>
        <td><?php echo $platform['platform_name'];?></td>
        <td><?php echo $platform['headquarters'];?></td>
        <td>
        <?php
      include "view-platform-editform.php"
      ?>
        </td>
        <td>
          <form method="post" action="">
            <input type="hidden" name="cid" value="<?php echo $platform['platform_id']; ?>">
            <input type="hidden" name="actionType" value="Delete">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">
                Delete
            </button>
          </form>
        </td>
          <td>
          <form method="post" action="shows-by-platform.php">
            <input type="hidden" name="cid" value="<?php echo $platform['platform_id']; ?>">
            <button type="submit" class="btn btn-info">Shows</button>
          </form>
        </td>
      </tr>
      <?php
    }
  ?>
    </tbody>
  </table>
</div>
