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

<div class="container mt-5">
    <h1 class="text-center mb-4">Search Results for "<?= htmlspecialchars($_GET['q']) ?>"</h1>

    <div class="row">
        <!-- Actors Section -->
        <div class="col-12 mb-4">
            <h2>Actors</h2>
            <div class="row">
                <?php while ($actor = $actors->fetch_assoc()) { ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= $actor['actor_name'] ?></h5>
                                <a href="courses-by-instructor.php?id=<?= $actor['actor_id'] ?>" class="btn btn-primary">View Shows</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Shows Section -->
        <div class="col-12 mb-4">
            <h2>Shows</h2>
            <div class="row">
                <?php while ($show = $shows->fetch_assoc()) { ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= $show['show_title'] ?></h5>
                                <p class="card-text"><strong>Genre:</strong> <?= $show['genre'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Platforms Section -->
        <div class="col-12">
            <h2>Platforms</h2>
            <div class="row">
                <?php while ($platform = $platforms->fetch_assoc()) { ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= $platform['platform_name'] ?></h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
include "view-footer.php";
?>
