<?php
require_once("util-db.php");

$pageTitle = "Search Results";
include "view-header.php";

// Get search query
$query = isset($_GET['q']) ? $_GET['q'] : '';
$query = '%' . $query . '%';

// Query each table
$conn = get_db_connection();

// Actors
$actorsStmt = $conn->prepare("SELECT actor_id, actor_name FROM `mis4013-hw3`.actor WHERE actor_name LIKE ?");
$actorsStmt->bind_param("s", $query);
$actorsStmt->execute();
$actors = $actorsStmt->get_result();

// Shows
$showsStmt = $conn->prepare("SELECT show_id, show_title, genre FROM `mis4013-hw3`.show WHERE show_title LIKE ? OR genre LIKE ?");
$showsStmt->bind_param("ss", $query, $query);
$showsStmt->execute();
$shows = $showsStmt->get_result();

// Platforms
$platformsStmt = $conn->prepare("SELECT platform_id, platform_name FROM `mis4013-hw3`.platform WHERE platform_name LIKE ?");
$platformsStmt->bind_param("s", $query);
$platformsStmt->execute();
$platforms = $platformsStmt->get_result();
?>

<h1>Search Results for "<?= htmlspecialchars($_GET['q']) ?>"</h1>

<!-- Actors -->
<h2>Actors</h2>
<ul>
  <?php while ($actor = $actors->fetch_assoc()) { ?>
    <li><a href="courses-by-instructor.php?id=<?= $actor['actor_id'] ?>"><?= $actor['actor_name'] ?></a></li>
  <?php } ?>
</ul>

<!-- Shows -->
<h2>Shows</h2>
<ul>
  <?php while ($show = $shows->fetch_assoc()) { ?>
    <li><?= $show['show_title'] ?> (<?= $show['genre'] ?>)</li>
  <?php } ?>
</ul>

<!-- Platforms -->
<h2>Platforms</h2>
<ul>
  <?php while ($platform = $platforms->fetch_assoc()) { ?>
    <li><?= $platform['platform_name'] ?></li>
  <?php } ?>
</ul>

<?php
$conn->close();
include "view-footer.php";
?>
