<?php
include '../config/config.php';
include '../config/function.php';
if (isset($_POST['submit'])) {
    $action = $_POST['submit'];
}
switch ($action) {
    case 'Log in':
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $GetIp = getUserIP();
        $date = date("Y-m-d H:i:s");
        $otp = rand(1000, 9999);
        $query = $db->query("SELECT * FROM `user` WHERE `user_email`='$email' AND `user_password`='$password' AND `user_status`='1'");
        $num_rows = $query->num_rows;
        if ($num_rows > 0) {
            $row = $query->fetch_assoc();
            session_regenerate_id();
            $userId = $row["id"];
            $userEmail = $row["user_email"];
            $userName = $row["user_name"];
            $userType = $row["user_type"];
            $userPassword = $row["user_password"];
            $userStatus = $row["user_status"];
            $sessionId = session_id();
            $_SESSION['yb'] = $sessionId;
            $_SESSION['userId'] = $userId;
            $_SESSION['userEmail'] = $userEmail;
            $_SESSION['userName'] = $userName;
            $_SESSION['userType'] = $userType;
            $db->query("INSERT INTO `log_details` SET `session_id`='$sessionId', `user_id`='$userId', `user_ip`='$GetIp', `login_date_time`='$date', `logout_date_time`='', `whois`='$userName'");
            $_SESSION['alert'] = '<div class="alert alert-success">Welcome to Admin Panel.</div>';
            header("Location: dashboard.php");
        } else {
            $_SESSION['alert'] = '<div class="alert alert-danger">Username and Password do not match.</div>';
            header("Location: index.php");
        }
        break;
    default:
        $_SESSION['alert'] = '<div class="alert alert-danger">Something went wrong. Please try after some times.</div>';
        header("Location: index.php");

}