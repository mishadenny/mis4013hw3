<div class="row">
  <div class="col">
    <h1>Shows</h1>
  </div>
  <div class="col-auto">
  <?php
  include "view-shows-newform.php"
  ?>
  </div>
</div>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Genre</th>
      <th></th>
      <th></th>
      <th></th>
      </tr>
    </thead>
    <tbody>
  <?php 
    while ($course=$courses->fetch_assoc()) {
      ?>
      <tr>
        <td><?php echo $course['show_id']; ?></td>
        <td><?php echo $course['show_title'];?></td>
        <td><?php echo $course['genre'];?></td>
        <td>
      <?php
      include "view-shows-editform.php"
      ?>
        </td>
        <td>
          <form method="post" action="">
            <input type="hidden" name="cid" value="<?php echo $course['show_id']; ?>">
            <input type="hidden" name="actionType" value="Delete">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">
              Delete
            </button>
          </form>
        </td>
          <td>
            <form method="post" action="sections-by-course.php">
            <input type="hidden" name="cid" value="<?php echo $course['show_id']; ?>">
            <button type="submit" class="btn btn-primary">Sections</button>
            </form>
        </td>
      </tr>
      <?php
    }
  ?>
    </tbody>
  </table>
</div>
