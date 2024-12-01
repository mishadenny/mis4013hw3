<?php
require_once("util-db.php");
require_once("model-courses.php");

$pageTitle = "Shows";
include "view-header.php";

if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case "Add":
            if (InsertShow($_POST['sTitle'], $_POST['sGenre'], $_POST['sLink'])) {
                echo '<div class="alert alert-success" role="alert">Show Added</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error Adding Show</div>';
            }
            break;

        case "Edit":
            if (UpdateShow($_POST['sTitle'], $_POST['sGenre'], $_POST['sLink'], $_POST['cid'])) {
                echo '<div class="alert alert-success" role="alert">Show Updated</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error Updating Show</div>';
            }
            break;

        case "Delete":
            if (deleteShow($_POST['cid'])) {
                echo '<div class="alert alert-success" role="alert">Show Deleted</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error Deleting Show</div>';
            }
            break;
    }
}

$courses = selectCourses();
include "view-courses.php";
include "view-footer.php";
?>
