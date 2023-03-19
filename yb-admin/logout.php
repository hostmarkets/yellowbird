<?php
include '../config/config.php';
if (isset($_GET['action']) and $_GET['action'] == md5("session_logout")) {
    $sessionId = session_id();
    $userId = $_SESSION['userId'];
    $date = date("Y-m-d H:i:s");
    $query = $db->query("SELECT * FROM `log_details` WHERE `session_id`='$sessionId' AND `user_id`='$userId'");
    $num_rows = $query->num_rows;
    if ($num_rows > 0) {
        $row = $query->fetch_assoc();
        $session_id = $row["session_id"];
        $user_id = $row["user_id"];
        $login_tym = $row["login_date_time"];
        $db->query("UPDATE `log_details` SET `logout_date_time`='$date' WHERE `session_id`='$session_id' AND `user_id`='$user_id' AND `login_date_time`='$login_tym'");
        unset($_SESSION['yb']);
        unset($_SESSION['userId']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['userName']);
        unset($_SESSION['userType']);
        session_destroy();
        $db->close();
        header("Location: index.php");
        exit();
    } else {
        $db->close();
        $_SESSION['alert'] = '<div class="alert alert-danger">User Login details not found.</div>';
        header("Location: dashboard.php");
        exit();
    }
} else {
    $db->close();
    $_SESSION['alert'] = '<div class="alert alert-danger">Something went wrong. Contact to support.</div>';
    header("Location: " . ROOT);
    exit();
}