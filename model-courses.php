<?php
function selectCourses() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("select show_id, show_title, genre, link
from `mis4013-hw3`.show");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function InsertShow($sTitle, $sGenre) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `mis4013-hw3`.`show` (`show_title`, `genre`, `link`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $sTitle, $sGenre, $sLink);
        $success = $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function UpdateShow($sTitle, $sGenre, $cid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("update `mis4013-hw3`.`show` set `show_title`=?, `genre`=?, `link`=? where show_id=?");
        $stmt->bind_param("sssi", $sTitle, $sGenre, $sLink $cid);
        $success = $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function deleteShow($cid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("delete from `mis4013-hw3`.`show` where show_id=?");
        $stmt->bind_param("i", $cid);
        $success = $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>
