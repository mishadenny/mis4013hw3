<?php
function selectInstructors() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT actor_id, actor_name, age FROM `mis4013-hw3`.actor");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function selectCoursesByInstructors($iid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT e.episode_id, s.show_id, s.show_title, s.genre, e.title_episode, e.season_number, e.episode_number
            FROM `mis4013-hw3`.show s
            JOIN `mis4013-hw3`.episode e ON e.show_id = s.show_id 
            WHERE e.actor_id = ?
        ");
        $stmt->bind_param("i", $iid);
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function selectInstructorsForInput() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT actor_id, actor_name FROM `mis4013-hw3`.actor ORDER BY actor_name");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function selectCoursesForInput() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT show_id, CONCAT(show_id, ' - ', show_title) AS show_name
            FROM `mis4013-hw3`.show
            ORDER BY show_title
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}


function insertEpisode($iid, $cid, $titleepisode, $seasonnumber, $episodenumber) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `mis4013-hw3`.`episode` (`actor_id`, `show_id`, `title_episode`, `season_number`, `episode_number`) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $iid, $cid, $titleepisode, $seasonnumber, $episodenumber);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function updateEpisode($iid, $cid, $titleepisode, $seasonnumber, $episodenumber, $sid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            UPDATE `mis4013-hw3`.`episode`
            SET `actor_id` = ?, `show_id` = ?, `title_episode` = ?, `season_number` = ?, `episode_number` = ?
            WHERE `episode_id` = ?
        ");
        $stmt->bind_param("iisssi", $iid, $cid, $titleepisode, $seasonnumber, $episodenumber, $sid);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function deleteEpisode($sid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `mis4013-hw3`.`episode` WHERE `episode_id` = ?");
        $stmt->bind_param("i", $sid);
        $success = $stmt->execute();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>
