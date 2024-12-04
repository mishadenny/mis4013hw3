<?php
function selectCourses() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT show_id, show_title, genre, link FROM `mis4013-hw3`.show");

        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function InsertShow($sTitle, $sGenre, $sLink) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `mis4013-hw3`.show (show_title, genre, link) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $sTitle, $sGenre, $sLink);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function UpdateShow($sTitle, $sGenre, $sLink, $cid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `mis4013-hw3`.show SET show_title=?, genre=?, link=? WHERE show_id=?");
        $stmt->bind_param("sssi", $sTitle, $sGenre, $sLink, $cid);
        $success = $stmt->execute();
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
        $stmt = $conn->prepare("DELETE FROM `mis4013-hw3`.show WHERE show_id=?");
        $stmt->bind_param("i", $cid);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>
