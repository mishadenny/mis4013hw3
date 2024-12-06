<div class="row">
  <div class="col">
    <h1>Actors with Shows</h1>
  </div>
  <div class="col-auto">
    <?php include "view-actors-with-shows-newform.php"; ?>
  </div>
</div>

<div class="card-group">
  <?php 
    while ($instructor = $instructors->fetch_assoc()) {
  ?>
    <div class="card" style="background-color: #f5f5dc; margin: 10px;"> <!-- Beige background -->
      <div class="card-body">
        <h5 class="card-title"><?php echo $instructor['actor_name']; ?></h5>
        <ul class="list-group">
          <?php
            $courses = selectCoursesByInstructors($instructor['actor_id']);
            while ($course = $courses->fetch_assoc()) {
          ?>
            <li class="list-group-item" style="background-color: #fff;"> <!-- White background for contrast -->
              Title: <?php echo $course['show_title']; ?> 
              Title Episode: <?php echo $course['title_episode']; ?> 
              Season: <?php echo $course['season_number']; ?> 
              Episode: <?php echo $course['episode_number']; ?>
            </li>
            <li class="list-group-item" style="background-color: #fff;">
              <?php include "view-actors-with-shows-editform.php"; ?>
            </li>
            <li class="list-group-item" style="background-color: #fff;">
              <form method="post" action="">
                <input type="hidden" name="sid" value="<?php echo $course['episode_id']; ?>">
                <input type="hidden" name="actionType" value="Delete">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">
                  Delete
                </button>
              </form>
            </li>
          <?php
            }
          ?>
        </ul>
        <p class="card-text">
          <small class="text-body-secondary">Age: <?php echo $instructor['age']; ?></small>
        </p>
      </div>
    </div>  
  <?php
    }
  ?>
</div>
