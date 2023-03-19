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
        $autho_name = test_input($_POST['autho_name']);
        /** Only allow letters, numbers, and dashes */
        $post_title_seo_url = preg_replace('/([^a-zA-Z0-9\-]+)/', '-', strtolower($autho_name));
        /** Replace multiple dashes with one dash */
        $post_title_seo_url = preg_replace('/-+/', '-', $post_title_seo_url);
        if (substr($post_title_seo_url, -1) === '-') { /** Remove - from end */
            $post_title_seo_url = substr($post_title_seo_url, 0, -1);
        }
        if (substr($post_title_seo_url, 0, 1) === '-') { /** Remove - from start */
            $post_title_seo_url = substr($post_title_seo_url, 1);
        }
        $autho_desgn = test_input($_POST['autho_desgn']);
        $autho_profile = test_input($_POST['autho_profile']);
        $autho_email = test_input($_POST['autho_email']);
        $autho_linkedin = test_input($_POST['autho_linkedin']);
        $autho_twitter = test_input($_POST['autho_twitter']);
        $alt_text = test_input($_POST['autho_name']);
        $date_time = date("Y-m-d H:i:s");
        $get_cat = $db->query("SELECT `autho_name` FROM `author` WHERE `autho_name`='$autho_name'");
        $get_num = $get_cat->num_rows;
        if ($get_num > 0) {
            $_SESSION['alert'] = '<div class="alert alert-warning">Author already exists.</div>';
            header("location:authors.php");
        } else {
            $db->query("INSERT INTO  `author` SET `autho_name`='$autho_name',`autho_seo_url`='$post_title_seo_url',`autho_desgn`='$autho_desgn',`autho_profile`='$autho_profile',`autho_email`='$autho_email',`autho_linkedin`='$autho_linkedin',`autho_twitter`='$autho_twitter',`alt_text`='$alt_text'");
            $lid = mysqli_insert_id($db);

            /** phpto upload */
            if ($_FILES["autho_img"]["size"] > 0) {
                $photo = $_FILES['autho_img']['name'];
                $randTime = rand(00, 99) . time();
                $photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($autho_name));
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
                    if ($_FILES["autho_img"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["autho_img"]["error"] . "<br>";
                    } else {
                        $new_photo = str_replace(" ", "-", strtolower($photo_name . "-" . $randTime . "." . $extension));
                        move_uploaded_file($_FILES["autho_img"]["tmp_name"], "../uploads/autho-images/" . $new_photo);

                        $db->query("UPDATE `author` SET `autho_img` = '$new_photo' WHERE `id`='$lid'");
                    }
                }
            }
            /** photo upload ends */
            $_SESSION['msg'] = '<div class="alert alert-primary">Author added.</div>';
            header("location: authors.php");
        }
        break;
    case 'Update':
        $autho_id = $_POST['id'];
        $autho_name = test_input($_POST['autho_name']);
        /** Only allow letters, numbers, and dashes */
        $post_title_seo_url = preg_replace('/([^a-zA-Z0-9\-]+)/', '-', strtolower($autho_name));
        /** Replace multiple dashes with one dash */
        $post_title_seo_url = preg_replace('/-+/', '-', $post_title_seo_url);
        if (substr($post_title_seo_url, -1) === '-') { /** Remove - from end */
            $post_title_seo_url = substr($post_title_seo_url, 0, -1);
        }
        if (substr($post_title_seo_url, 0, 1) === '-') { /** Remove - from start */
            $post_title_seo_url = substr($post_title_seo_url, 1);
        }
        $autho_desgn = test_input($_POST['autho_desgn']);
        $autho_profile = test_input($_POST['autho_profile']);
        $autho_email = test_input($_POST['autho_email']);
        $autho_linkedin = test_input($_POST['autho_linkedin']);
        $autho_twitter = test_input($_POST['autho_twitter']);
        $alt_text = test_input($_POST['autho_name']);
        $date_time = date("Y-m-d H:i:s");
        $db->query("UPDATE `author` SET `autho_name`='$autho_name',`autho_seo_url`='$post_title_seo_url',`autho_desgn`='$autho_desgn',`autho_profile`='$autho_profile',`autho_email`='$autho_email',`autho_linkedin`='$autho_linkedin',`autho_twitter`='$autho_twitter',`alt_text`='$alt_text' WHERE id = '$autho_id'");

        /** phpto upload */
        if ($_FILES["autho_img"]["size"] > 0) {
            $photo = $_FILES['autho_img']['name'];
            $randTime = rand(00, 99) . time();
            $photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($autho_name));
            $photo_name = preg_replace('/-+/', '-', $photo_name);
            if (substr($photo_name, -1) === '-') { /** Remove - from end */
                $photo_name = substr($photo_name, 0, -1);
            }
            if (substr($photo_name, 0, 1) === '-') { /** Remove - from start */
                $photo_name = substr($photo_name, 1);
            }
            $allowedExts = array("gif", "jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "webp");
            $temp = explode(".", $photo);
            $extension = strtolower(end($temp));
            if ((in_array($extension, $allowedExts))) {
                if ($_FILES["autho_img"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["autho_img"]["error"] . "<br>";
                } else {
                    $new_photo = str_replace(" ", "-", strtolower($photo_name . "-" . $randTime . "." . $extension));
                    move_uploaded_file($_FILES["autho_img"]["tmp_name"], "../uploads/autho-images/" . $new_photo);

                    $data = $db->query("SELECT `autho_img` FROM `author` WHERE id = '$autho_id'");
                    $value = $data->fetch_object();
                    if (empty($value->autho_img)) {
                        $db->query("UPDATE `author` SET `autho_img` = '$new_photo' WHERE id = '$autho_id'");
                    } else {
                        unlink('../uploads/autho-images/' . $value->autho_img); /** remove files */
                        $db->query("UPDATE `author` SET `autho_img` = '$new_photo' WHERE id = '$autho_id'");
                    }
                }
            }
        }
        $_SESSION['alert'] = '<div class="alert alert-success">Author updated.</div>';
        header("location: authors.php");
        break;
    default:
        $_SESSION['alert'] = '<div class="alert alert-danger">Something went wrong.</div>';
        header("location: dashboard.php");

}