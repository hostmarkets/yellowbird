<?php
include '../config/config.php';
include '../config/function.php';
if (isset($_POST['submit'])) {
    $action = $_POST['submit'];
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
switch ($action) {
    case 'Submit':
        $ban_name = test_input($_POST['ban_name']);
        $ban_link = test_input($_POST['ban_link']);
        $date_time = date("Y-m-d H:i:s");
        $query = $db->query("SELECT `ban_name` FROM `yb_banners` WHERE `ban_name`='$ban_name'");
        $num = $query->num_rows;
        if ($num > 0) {
            $_SESSION['alert'] = '<div class="alert alert-warning">Banner already exists.</div>';
            header("location:banners.php");
        } else {
            $db->query("INSERT INTO  `yb_banners` SET `ban_name`='$ban_name',`ban_link`='$ban_link',`date_time`='$date_time'");
            $lid = mysqli_insert_id($db);

            /** phpto upload */
            if ($_FILES["ban_img"]["size"] > 0) {
                $photo = $_FILES['ban_img']['name'];
                $randTime = rand(00, 99) . time();
                $photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($ban_name));
                $photo_name = preg_replace('/-+/', '-', $photo_name);
                if (substr($photo_name, -1) === '-') { // Remove - from end
                    $photo_name = substr($photo_name, 0, -1);
                }
                if (substr($photo_name, 0, 1) === '-') { // Remove - from start
                    $photo_name = substr($photo_name, 1);
                }
                $allowedExts = array("gif", "jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "webp");
                $temp = explode(".", $photo);
                $extension = strtolower(end($temp));
                if ((in_array($extension, $allowedExts))) {
                    if ($_FILES["ban_img"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["ban_img"]["error"] . "<br>";
                    } else {
                        $new_photo = str_replace(" ", "-", strtolower($photo_name . "-" . $randTime . "." . $extension));
                        move_uploaded_file($_FILES["ban_img"]["tmp_name"], "../uploads/ban-images/" . $new_photo);

                        $db->query("UPDATE `yb_banners` SET `ban_img` = '$new_photo' WHERE `id`='$lid'");
                    }
                }
            }
            /** photo upload ends */
            $_SESSION['msg'] = '<div class="alert alert-primary">Banner added.</div>';
            header("location: banners.php");
        }
        break;
    case 'Update':
        $ban_id = $_POST['id'];
        $ban_name = test_input($_POST['ban_name']);
        $ban_link = test_input($_POST['ban_link']);
        $date_time = date("Y-m-d H:i:s");
        $db->query("UPDATE `yb_banners` SET `ban_name`='$ban_name',`ban_link`='$ban_link' WHERE id = '$ban_id'");

        /** phpto upload */
        if ($_FILES["ban_img"]["size"] > 0) {
            $photo = $_FILES['ban_img']['name'];
            $randTime = rand(00, 99) . time();
            $photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($ban_name));
            $photo_name = preg_replace('/-+/', '-', $photo_name);
            if (substr($photo_name, -1) === '-') { // Remove - from end
                $photo_name = substr($photo_name, 0, -1);
            }
            if (substr($photo_name, 0, 1) === '-') { // Remove - from start
                $photo_name = substr($photo_name, 1);
            }
            $allowedExts = array("gif", "jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "webp");
            $temp = explode(".", $photo);
            $extension = strtolower(end($temp));
            if ((in_array($extension, $allowedExts))) {
                if ($_FILES["ban_img"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["ban_img"]["error"] . "<br>";
                } else {
                    $new_photo = str_replace(" ", "-", strtolower($photo_name . "-" . $randTime . "." . $extension));
                    move_uploaded_file($_FILES["ban_img"]["tmp_name"], "../uploads/ban-images/" . $new_photo);

                    $data = $db->query("SELECT `ban_img` FROM `yb_banners` WHERE id = '$ban_id'");
                    $value = $data->fetch_object();
                    if (empty($value->ban_img)) {
                        $db->query("UPDATE `yb_banners` SET `ban_img` = '$new_photo' WHERE id = '$ban_id'");
                    } else {
                        unlink('../uploads/ban-images/' . $value->ban_img); // remove files
                        $db->query("UPDATE `yb_banners` SET `ban_img` = '$new_photo' WHERE id = '$ban_id'");
                    }
                }
            }
        }
        $_SESSION['alert'] = '<div class="alert alert-success">Banner updated.</div>';
        header("location: banners.php");
        break;
    case 'trash':
        $ban_id = $_GET['id'];
        $db->query("UPDATE `yb_banners` SET `ban_status`='trash' WHERE `id` = '$ban_id'");
        $_SESSION['alert'] = '<div class="alert alert-warning">Banner trashed.</div>';
        header("location: banners.php");
        break;
    case 'restore':
        $ban_id = $_GET['id'];
        $db->query("UPDATE `yb_banners` SET `ban_status`='publish' WHERE `id` = '$ban_id'");
        $_SESSION['alert'] = '<div class="alert alert-success">Banner restored.</div>';
        header("location: banners.php");
        break;
    case 'delete':
        $ban_id = $_GET['id'];
        $data = $db->query("SELECT `ban_img` FROM `yb_banners` WHERE  `id` = '$ban_id'");
        $value = $data->fetch_object();
        $ban_img = $value->ban_img;
        if (empty($ban_img)) {
            $db->query("DELETE FROM `yb_banners` WHERE  `id` = '$ban_id'");
        }
        if (!empty($ban_img)) {
            unlink("../uploads/ban-images/" . $ban_img); //remove file 
            $db->query("DELETE FROM `yb_banners` WHERE  `id` = '$ban_id'");
        }
        $_SESSION['alert'] = '<div class="alert alert-success">Banner deleted.</div>';
        header("location: banners.php");
        break;
    default:
        $_SESSION['alert'] = '<div class="alert alert-danger">Something went wrong.</div>';
        header("location: dashboard.php");

}