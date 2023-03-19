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
	case 'Add':
		$userType = $_POST['user_type'];
		$email = test_input($_POST['email']);
		$name = test_input($_POST['name']);
		$vpwd = test_input($_POST['password']);
		$password = md5($vpwd);
		$date = date("Y-m-d H:i:s");
		$query = $db->query("SELECT `user_email` FROM `user` WHERE `user_email`='$email'");
		$num_rows = $query->num_rows;
		if ($num_rows > 0) {
			$_SESSION['alert'] = '<div class="alert alert-warning">User already exists.</div>';
			header("location: users.php");
		} else {
			$db->query("INSERT INTO `user` SET `user_email`='$email',`user_name`='$name',`user_vpwd`='$vpwd',`user_password`='$password',`user_type`='$userType',`user_date_time`='$date'");
			$lid = mysqli_insert_id($db);

			/** user pic upload */
			if ($_FILES["user_pic"]["size"] > 0) {
				$photo = $_FILES['user_pic']['name'];
				$randTime = rand(00, 99) . time();
				$allowedExts = array("gif", "jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "webp");
				$temp = explode(".", $photo);
				$extension = strtolower(end($temp));
				if ((in_array($extension, $allowedExts))) {
					if ($_FILES["user_pic"]["error"] > 0) {
						echo "Return Code: " . $_FILES["user_pic"]["error"] . "<br>";
					} else {
						$new_photo = str_replace(" ", "-", strtolower($user_name . "-" . $randTime . "." . $extension));
						move_uploaded_file($_FILES["user_pic"]["tmp_name"], "../uploads/user-images/" . $new_photo);

						$db->query("UPDATE `user` SET `user_pic` = '$new_photo' WHERE `id`='$lid'");
					}
				}
			}
			/** photo upload ends */
			$_SESSION['alert'] = '<div class="alert alert-primary">New User added.</div>';
			header("location: users.php");
		}
		break;
	case 'Update':
		$id = $_POST['id'];
		$userType = $_POST['user_type'];
		$email = test_input($_POST['email']);
		$name = test_input($_POST['name']);
		$vpwd = test_input($_POST['password']);
		$password = md5($vpwd);
		$date = date("Y-m-d H:i:s");
		$db->query("UPDATE `user` SET `user_email`='$email',`user_name`='$name',`user_vpwd`='$vpwd',`user_password`='$password',`user_type`='$userType',`user_date_time`='$date' WHERE `id` = '$id'");

		/** phpto upload */
		if ($_FILES["user_pic"]["size"] > 0) {
			$photo = $_FILES['user_pic']['name'];
			$randTime = rand(00, 99) . time();
			$allowedExts = array("gif", "jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "webp");
			$temp = explode(".", $photo);
			$extension = end($temp);
			if ((in_array($extension, $allowedExts))) {
				if ($_FILES["user_pic"]["error"] > 0) {
					echo "Return Code: " . $_FILES["user_pic"]["error"] . "<br>";
				} else {
					$new_photo = str_replace(" ", "-", strtolower($user_name . "-" . $randTime . "." . $extension));
					move_uploaded_file($_FILES["user_pic"]["tmp_name"], "../uploads/user-images/" . $new_photo);

					$data = $db->query("SELECT `user_pic` FROM `user` WHERE `id` = '$id'");
					$value = $data->fetch_object();
					if (empty($value->user_pic)) {
						$db->query("UPDATE `user` SET `user_pic` = '$new_photo' WHERE `id` = '$id'");
					} else {
						if (file_exists("../uploads/user-images/" . $value->user_pic)) {
							unlink('../uploads/user-images/' . $value->user_pic); // remove files	
						}
						$db->query("UPDATE `user` SET `user_pic` = '$new_photo' WHERE `id` = '$id'");
					}
				}
			}
		}
		/** photo upload end */
		$_SESSION['alert'] = '<div class="alert alert-success">User updated.</div>';
		header("location: users.php");
		break;
	case 'disable':
		$id = $_GET['id'];
		$db->query("UPDATE `user` SET `user_status`='2' WHERE `id`='$id'");
		$_SESSION['alert'] = '<div class="alert alert-warning">User Disabled.</div>';
		header("location: users.php");
		break;
	case 'enable':
		$id = $_GET['id'];
		$db->query("UPDATE `user` SET `user_status`='1' WHERE `id`='$id'");
		$_SESSION['alert'] = '<div class="alert alert-success">User enabled.</div>';
		header("location: users.php");
		break;
	case 'delete':
		$id = $_GET['id'];
		$data = $db->query("SELECT `user_pic` FROM `user` WHERE  `id` = '$id'");
		$value = $data->fetch_object();
		$user_pic = $value->user_pic;
		if (!empty($user_pic)) {
			unlink("../uploads/user-images/" . $user_pic); //remove file 
			$db->query("DELETE FROM `user` WHERE  `id` = '$id'");
		} else {
			$db->query("DELETE FROM `user` WHERE  `id` = '$id'");
		}
		$_SESSION['alert'] = '<div class="alert alert-danger">User deleted.</div>';
		header("location: users.php");
		break;
	default:
		$_SESSION['alert'] = '<div class="alert alert-danger">Something went wrong.</div>';
		header("location: users.php");
}