<?php
require_once("util-db.php");
require_once("model-instructors.php");

$pageTitle = "Actors";
include "view-header.php"; 

if (isset($_POST['actionType'])) {
  switch ($_POST['actionType']) {
    case "Add":
      if (insertActor($_POST['aName'], $_POST['aAge'])) {
        echo '<div class="alert alert-success" role="alert">Actor Added </div>';
      } else {
        echo '<div class="alert alert-danger" role="alert">Error </div>';
      }
      break;
    case "Edit":
      if (updateActor($_POST['aName'], $_POST['aAge'], $_POST['iid'])) {
        echo '<div class="alert alert-success" role="alert">Actor updated </div>';
      } else {
        echo '<div class="alert alert-danger" role="alert">Error </div>';
      }
      break;
    case "Delete":
      if (deleteActor($_POST['iid'])) {
        echo '<div class="alert alert-success" role="alert">Actor Deleted </div>';
      } else {
        echo '<div class="alert alert-danger" role="alert">Error </div>';
      }
      break;
  }
}

// Fetch actors
$instructors = selectInstructors();
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Actors</h1>

    <!-- Sorting Buttons -->
    <div class="button-group sort-by-button-group mb-4 text-center">
        <button class="btn btn-primary is-checked" data-sort-value="original-order">Original Order</button>
        <button class="btn btn-primary" data-sort-value="name">Name</button>
        <button class="btn btn-primary" data-sort-value="age">Age</button>
    </div>

    <!-- Actors Table -->
    <div class="grid">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="name">Name</th>
                    <th class="age">Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($actor = $instructors->fetch_assoc()) { ?>
                    <tr class="element-item" data-category="<?= $actor['actor_name'] ?>">
                        <td class="name"><?= $actor['actor_name'] ?></td>
                        <td class="age"><?= $actor['age'] ?></td>
                        <td>
                            <!-- Action Buttons -->
                            <form method="post" style="display: inline-block;">
                                <input type="hidden" name="iid" value="<?= $actor['actor_id'] ?>">
                                <input type="hidden" name="actionType" value="Edit">
                                <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                            </form>
                            <form method="post" style="display: inline-block;">
                                <input type="hidden" name="iid" value="<?= $actor['actor_id'] ?>">
                                <input type="hidden" name="actionType" value="Delete">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/isotope/3.0.6/isotope.pkgd.min.js"></script>
<script>
  // Initialize Isotope
  var $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'vertical',
    getSortData: {
      name: '.name', // Sort by name
      age: '.age parseInt' // Sort by age
    }
  });

  // Bind sort button click
  $('.sort-by-button-group').on('click', 'button', function () {
    var sortValue = $(this).attr('data-sort-value');
    $grid.isotope({ sortBy: sortValue });
  });

  // Change is-checked class on buttons
  $('.button-group').each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on('click', 'button', function () {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $(this).addClass('is-checked');
    });
  });
</script>

<?php
include "view-footer.php";
?>
