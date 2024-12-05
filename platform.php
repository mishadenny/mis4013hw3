<?php
require_once("util-db.php");
require_once("model-platform.php");

$pageTitle ="Platforms";
include "view-header.php"; 


if (isset($_POST['actionType'])) {
  switch ($_POST['actionType']) {
    case "Add":
      if (insertPlatform($_POST['pName'], $_POST['pHeadquarters'])) {
        echo '<div class="alert alert-success" role="alert">Platform Added </div>';
  } else {
    echo '<div class="alert alert-danger" role="alert">Error </div>';
      }
      break;
    case "Edit":
      if (updatePlatform($_POST['pName'], $_POST['pHeadquarters'], $_POST['cid'])) {
        echo '<div class="alert alert-success" role="alert">Platform updated </div>';
  } else {
    echo '<div class="alert alert-danger" role="alert">Error </div>';
      }
      break;
    case "Delete":
      if (deletePlatform($_POST['cid'])) {
        echo '<div class="alert alert-success" role="alert">Platform Deleted </div>';
  } else {
    echo '<div class="alert alert-danger" role="alert">Error </div>';
      }
      break;
  }
}
$platformWithCounts = selectPlatformWithShowCount();
$platforms = selectPlatform();
include "view-platform.php";
include "view-footer.php";
?>
