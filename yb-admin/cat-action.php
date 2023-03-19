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
		$cat_name = test_input($_POST['cat_name']);
		/** Only allow letters, numbers, and dashes */
		$post_title_seo_url = preg_replace('/([^a-zA-Z0-9\-]+)/', '-', strtolower($cat_name));
		/** Replace multiple dashes with one dash */
		$post_title_seo_url = preg_replace('/-+/', '-', $post_title_seo_url);
		if (substr($post_title_seo_url, -1) === '-') { /** Remove - from end */
			$post_title_seo_url = substr($post_title_seo_url, 0, -1);
		}
		if (substr($post_title_seo_url, 0, 1) === '-') { /** Remove - from start */
			$post_title_seo_url = substr($post_title_seo_url, 1);
		}
		$cat_descp = test_input($_POST['cat_descp']);
		$page_title = test_input($_POST['metaTitle']);
		$meta_keywords = test_input($_POST['metaKeywords']);
		$meta_description = test_input($_POST['metaDesc']);
		$alt_text = test_input($_POST['cat_name']);
		$cat_date_time = date("Y-m-d H:i:s");
		$get_cat = $db->query("SELECT `cat_name` FROM `yb_category` WHERE `cat_name`='$cat_name'");
		$get_num = $get_cat->num_rows;
		if ($get_num > 0) {
			$_SESSION['alert'] = '<div class="alert alert-warning">Category already exists.</div>';
			header("location:categories.php");
		} else {
			$db->query("INSERT INTO  `yb_category` SET `cat_name`='$cat_name',`cat_seo_url`='$post_title_seo_url',`cat_descp`='$cat_descp',`cat_meta_title`='$page_title',`cat_meta_keyword`='$meta_keywords',`cat_meta_descp`='$meta_description',`cat_img_alt_text`='$alt_text'");
			$lid = mysqli_insert_id($db);

			/** phpto upload */
			if ($_FILES["cat_img"]["size"] > 0) {
				$photo = $_FILES['cat_img']['name'];
				$randTime = rand(00, 99) . time();
				$photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($cat_name));
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
					if ($_FILES["cat_img"]["error"] > 0) {
						echo "Return Code: " . $_FILES["cat_img"]["error"] . "<br>";
					} else {
						$new_photo = str_replace(" ", "-", strtolower($photo_name . "-" . $randTime . "." . $extension));
						move_uploaded_file($_FILES["cat_img"]["tmp_name"], "../uploads/cat-images/" . $new_photo);

						$db->query("UPDATE `yb_category` SET `cat_img` = '$new_photo' WHERE `id`='$lid'");
					}
				}
			}
			/** photo upload ends */
			$_SESSION['msg'] = '<div class="alert alert-primary">Category added.</div>';
			header("location: categories.php");
		}
		break;
	case 'Update':
		$cat_id = $_POST['id'];
		$cat_name = test_input($_POST['cat_name']);
		/** Only allow letters, numbers, and dashes */
		$post_title_seo_url = preg_replace('/([^a-zA-Z0-9\-]+)/', '-', strtolower($cat_name));
		/** Replace multiple dashes with one dash */
		$post_title_seo_url = preg_replace('/-+/', '-', $post_title_seo_url);
		if (substr($post_title_seo_url, -1) === '-') { /** Remove - from end */
			$post_title_seo_url = substr($post_title_seo_url, 0, -1);
		}
		if (substr($post_title_seo_url, 0, 1) === '-') { /** Remove - from start */
			$post_title_seo_url = substr($post_title_seo_url, 1);
		}
		$cat_descp = test_input($_POST['cat_descp']);
		$page_title = test_input($_POST['metaTitle']);
		$meta_keywords = test_input($_POST['metaKeywords']);
		$meta_description = test_input($_POST['metaDesc']);
		$alt_text = test_input($_POST['cat_name']);
		$cat_date_time = date("Y-m-d H:i:s");
		$db->query("UPDATE `yb_category` SET `cat_name`='$cat_name',`cat_seo_url`='$post_title_seo_url',`cat_descp`='$cat_descp',`cat_meta_title`='$page_title',`cat_meta_keyword`='$meta_keywords',`cat_meta_descp`='$meta_description',`cat_img_alt_text`='$alt_text' WHERE id = '$cat_id'");

		/** phpto upload */
		if ($_FILES["cat_img"]["size"] > 0) {
			$photo = $_FILES['cat_img']['name'];
			$randTime = rand(00, 99) . time();
			$photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($cat_name));
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
				if ($_FILES["cat_img"]["error"] > 0) {
					echo "Return Code: " . $_FILES["cat_img"]["error"] . "<br>";
				} else {
					$new_photo = str_replace(" ", "-", strtolower($photo_name . "-" . $randTime . "." . $extension));
					move_uploaded_file($_FILES["cat_img"]["tmp_name"], "../uploads/cat-images/" . $new_photo);

					$data = $db->query("SELECT `cat_img` FROM `yb_category` WHERE id = '$cat_id'");
					$value = $data->fetch_object();
					if (empty($value->cat_img)) {
						$db->query("UPDATE `yb_category` SET `cat_img` = '$new_photo' WHERE id = '$cat_id'");
					} else {
						unlink('../uploads/cat-images/' . $value->cat_img); // remove files
						$db->query("UPDATE `yb_category` SET `cat_img` = '$new_photo' WHERE id = '$cat_id'");
					}
				}
			}
		}
		$_SESSION['alert'] = '<div class="alert alert-success">Category updated.</div>';
		header("location: categories.php");
		break;
	default:
		$_SESSION['alert'] = '<div class="alert alert-danger">Something went wrong.</div>';
		header("location: dashboard.php");

}