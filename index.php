<?php
$pageTitle ="Home";
include "view-header.php"; 
?>
<div class="container text-center mt-5">
    <h1>MIS 4013 Project</h1>
        <form class="d-flex justify-content-center mt-4" role="search" action="search.php" method="GET" style="max-width: 600px; margin: auto;">
        <input class="form-control me-2" type="search" name="q" placeholder="Search for Actors, Shows, or Platforms" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>
<?php
include "view-footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js"></script>
