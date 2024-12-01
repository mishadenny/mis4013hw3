<div class="row">
  <div class="col">
    <h1>Shows</h1>
  </div>
  <div class="col-auto">
    <?php include "view-shows-newform.php"; ?>
  </div>
</div>

<div class="row">
  <?php 
  while ($course = $courses->fetch_assoc()) {
  ?>
    <div class="col-md-4">
      <div class="card" style="width: 18rem; margin-bottom: 20px;">
        <img src="path/to/image/<?php echo $course['show_id']; ?>.jpg" class="card-img-top" alt="Show Image">
        <div class="card-body">
          <h5 class="card-title"><?php echo $course['show_title']; ?></h5>
          <p class="card-text">Genre: <?php echo $course['genre']; ?></p>
          <div class="d-flex justify-content-between">
            <div>
              <?php include "view-shows-editform.php"; ?>
            </div>
            <form method="post" action="" style="display:inline;">
              <input type="hidden" name="cid" value="<?php echo $course['show_id']; ?>">
              <input type="hidden" name="actionType" value="Delete">
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
            </form>
            <form method="post" action="sections-by-course.php" style="display:inline;">
              <input type="hidden" name="cid" value="<?php echo $course['show_id']; ?>">
              <button type="submit" class="btn btn-primary btn-sm">Episodes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>
