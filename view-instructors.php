<div class="row">
  <div class="col">
    <h1>Actors</h1>
  </div>
  <div class="col-auto">
    <?php include "view-actors-newform.php"; ?>
  </div>
</div>

<div class="button-group sort-by-button-group">
  <button class="button is-checked" data-sort-value="original-order">Original Order</button>
  <button class="button" data-sort-value="name">Name</button>
  <button class="button" data-sort-value="age">Age</button>
</div>

<div class="table-responsive">
  <table class="table grid">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Shows</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($instructor = $instructors->fetch_assoc()) { ?>
        <tr class="element-item" data-name="<?php echo $instructor['actor_name']; ?>" data-age="<?php echo $instructor['age']; ?>">
          <td><?php echo $instructor['actor_id']; ?></td>
          <td class="name"><?php echo $instructor['actor_name']; ?></td>
          <td class="age"><?php echo $instructor['age']; ?></td>
          <td>
            <?php include "view-actors-editform.php"; ?>
          </td>
          <td>
            <form method="post" action="">
              <input type="hidden" name="iid" value="<?php echo $instructor['actor_id']; ?>">
              <input type="hidden" name="actionType" value="Delete">
              <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Delete</button>
            </form>
          </td>
          <td><a href="courses-by-instructor.php?id=<?php echo $instructor['actor_id']; ?>">Shows</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
// Initialize Isotope on the table
var $grid = $('.grid').isotope({
  itemSelector: '.element-item', // Target the table rows
  layoutMode: 'vertical',        // Maintain vertical stacking
  getSortData: {
    name: '[data-name]',          // Sort by name attribute
    age: '[data-age parseInt]'    // Sort by age attribute as integer
  }
});

// Bind sorting buttons
$('.sort-by-button-group').on('click', 'button', function () {
  var sortValue = $(this).attr('data-sort-value');
  $grid.isotope({ sortBy: sortValue });
});

// Change active button class
$('.sort-by-button-group').on('click', 'button', function () {
  $('.sort-by-button-group .is-checked').removeClass('is-checked');
  $(this).addClass('is-checked');
});
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
