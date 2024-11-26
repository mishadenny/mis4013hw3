<?php
require_once("util-db.php");
require_once("model-instructors.php");

$pageTitle = "Actors";
include "view-header.php"; 

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

    <!-- Grid of Actors -->
    <div class="grid">
        <?php while ($actor = $instructors->fetch_assoc()) { ?>
            <div class="element-item" data-category="<?= $actor['actor_name'] ?>">
                <h2 class="name"><?= $actor['actor_name'] ?></h2>
                <p class="age"><?= $actor['age'] ?></p>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/isotope/3.0.6/isotope.pkgd.min.js"></script>
<script>
  // Initialize Isotope
  var $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
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
