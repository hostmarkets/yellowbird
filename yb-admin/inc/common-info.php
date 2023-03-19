<?php
if (!empty($_SESSION['yb'])) {
    if ($_SESSION['yb'] != session_id()) {
        header('Location: ' . AdminRoot . '');
        exit();
    }
} else {
    header('Location: ' . AdminRoot . '');
    exit();
}
$userIdCheck = $_SESSION['userId'];
$yb = $_SESSION['yb'];
$select = $db->query("SELECT * FROM `user` WHERE id='$userIdCheck' AND user_status='1'");
foreach ($select as $row):
    $user_id = $row['id'];
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_type = $row['user_type'];
    $user_pic = $row['user_pic'];
    if (!empty($user_pic)) {
        if (file_exists('../uploads/user-images/' . $user_pic)) {
            $user_pic = '../uploads/user-images/' . $user_pic;
        } else {
            $user_pic = '../images/yellowbird-logo.webp';
        }
    } else {
        $user_pic = '../images/yellowbird-logo.webp';
    }
    $user_date_time = $row['user_date_time'];
endforeach;