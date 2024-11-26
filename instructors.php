<?php
require_once("util-db.php");
require_once("model-instructors.php");

$pageTitle ="Actors";
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

$instructors = selectInstructors();
include "view-instructors.php";
include "view-footer.php";
?>
