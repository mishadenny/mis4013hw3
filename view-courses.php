<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .btn-beige {
      background-color: #f5f5dc; /* Beige color */
      color: #000; /* Black text */
      border: 1px solid #ddd; /* Subtle border */
    }
    .btn-beige:hover {
      background-color: #e6e6cc; /* Slightly darker beige on hover */
    }
  </style>
</head>
<body>

<div class="row">
  <div class="col">
    <h1>Shows</h1>
  </div>
  <div class="col-auto">
    <?php include "view-shows-newform.php"; ?>
  </div>
</div>

<!-- Filters -->
<div class="row mb-4">
  <div class="col-md-4">
    <input id="filterTitle" type="text" class="form-control" placeholder="Filter by Title" onkeyup="filterCards()">
  </div>
  <div class="col-md-4">
    <input id="filterGenre" type="text" class="form-control" placeholder="Filter by Genre" onkeyup="filterCards()">
  </div>
  <div class="col-md-4">
    <input id="filterID" type="number" class="form-control" placeholder="Filter by ID" onkeyup="filterCards()">
  </div>
</div>

<div class="row" id="showsContainer">
  <?php 
  while ($course = $courses->fetch_assoc()) {
  ?>
    <div class="col-md-4 show-card" 
         data-title="<?php echo htmlspecialchars($course['show_title']); ?>" 
         data-genre="<?php echo htmlspecialchars($course['genre']); ?>" 
         data-id="<?php echo htmlspecialchars($course['show_id']); ?>">
      <div class="card" style="width: 18rem; margin-bottom: 20px; background-color: #f5f5dc;">
        <img src="<?php echo htmlspecialchars($course['image'] ?: 'default-image.jpg'); ?>" 
             class="card-img-top" 
             alt="<?php echo htmlspecialchars($course['show_title']); ?>">

        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($course['show_title']); ?></h5>
          <p class="card-text">Genre: <?php echo htmlspecialchars($course['genre']); ?></p>
          <p class="card-text">ID: <?php echo htmlspecialchars($course['show_id']); ?></p>
          <div class="d-flex justify-content-between">
            <div>
              <?php include "view-shows-editform.php"; ?>
            </div>
            <form method="post" action="" style="display:inline;">
              <input type="hidden" name="cid" value="<?php echo $course['show_id']; ?>">
              <input type="hidden" name="actionType" value="Delete">
              <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
            </form>
            <form method="post" action="sections-by-course.php" style="display:inline;">
              <input type="hidden" name="cid" value="<?php echo $course['show_id']; ?>">
              <button type="submit" class="btn btn-info">Episodes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>

<script>
function filterCards() {
  const titleFilter = document.getElementById('filterTitle').value.toLowerCase();
  const genreFilter = document.getElementById('filterGenre').value.toLowerCase();
  const idFilter = document.getElementById('filterID').value;

  const cards = document.querySelectorAll('.show-card');
  
  cards.forEach(card => {
    const title = card.dataset.title.toLowerCase();
    const genre = card.dataset.genre.toLowerCase();
    const id = card.dataset.id;

    // Check if card matches filters
    const matchesTitle = title.includes(titleFilter);
    const matchesGenre = genre.includes(genreFilter);
    const matchesID = !idFilter || id === idFilter;

    if (matchesTitle && matchesGenre && matchesID) {
      card.style.display = ''; // Show the card
    } else {
      card.style.display = 'none'; // Hide the card
    }
  });
}
</script>

</body>
</html>
