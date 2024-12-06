<?php
require_once("util-db.php");
require_once("model-instructors-with-courses.php");

$pageTitle = "Actors with Shows";
include "view-header.php";

if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case "Add":
            if (insertEpisode($_POST['iid'], $_POST['cid'], $_POST['titleepisode'], $_POST['seasonnumber'], $_POST['episodenumber'])) {
                echo '<div class="alert alert-success" role="alert">Episode Added Successfully</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error Adding Episode</div>';
            }
            break;
        case "Edit":
            if (updateEpisode($_POST['iid'], $_POST['cid'], $_POST['titleepisode'], $_POST['seasonnumber'], $_POST['episodenumber'], $_POST['sid'])) {
                echo '<div class="alert alert-success" role="alert">Episode Updated Successfully</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error Updating Episode</div>';
            }
            break;
        case "Delete":
            if (deleteEpisode($_POST['sid'])) {
                echo '<div class="alert alert-success" role="alert">Episode Deleted Successfully</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error Deleting Episode</div>';
            }
            break;
    }
}

$instructors = selectInstructors();
include "view-instructors-with-courses.php";
include "view-footer.php";
?>
