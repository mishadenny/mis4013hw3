<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$pageTitle?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg" style="background-color: beige;">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="instructors.php">Actors</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="courses.php">Shows</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="instructors-with-courses.php">Actors with Shows</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="platform.php">Platforms</a>
              </li>
            </ul>
            <form class="d-flex" role="search" action="search.php" method="GET">
              <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <!-- Carousel -->
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
          require_once("util-db.php");
          require_once("model-courses.php");

          // Fetch shows and their images
          $shows = selectCourses();
          $isActive = true; // To set the first carousel item as active

          while ($show = $shows->fetch_assoc()) {
            if (!empty($show['image'])) {
              ?>
              <div class="carousel-item <?php echo $isActive ? 'active' : ''; ?>">
                <img src="<?php echo htmlspecialchars($show['image']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($show['show_title']); ?>">
              </div>
              <?php
              $isActive = false; // Only the first item should be active
            }
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- End of Carousel -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+ujIWd4Oj1BvKU7NfELRmY8XKjI4" crossorigin="anonymous"></script>
  </body>
</html>
