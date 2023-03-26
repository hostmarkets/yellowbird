<?php
include("../config/config.php");

if (isset($_POST['submit'])) {
	$action = $_POST['submit'];
}
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

switch ($action) {
	case 'Submit':
		$menu_position = $_POST['menu_position'];
		$footermenu = $_POST['footermenu'];
		$pagemenu = $_POST['pagemenu'];
		$db->query("INSERT INTO `menus` SET `menu_position`='$menu_position', `footermenu`='$footermenu', `post_id`='$pagemenu'");
		$_SESSION['alert'] = '<div class="alert alert-primary">Menu added.</div>';
		header("Location: menus.php");
		break;
	case 'Update':
		$id = $_POST['id'];
		$menu_position = $_POST['menu_position'];
		$footermenu = $_POST['footermenu'];
		$pagemenu = $_POST['pagemenu'];
		$db->query("UPDATE `menus` SET `menu_position`='$menu_position', `footermenu`='$footermenu', `post_id`='$pagemenu' WHERE `id`='$id'");
		$_SESSION['alert'] = '<div class="alert alert-success">Menu updated.</div>';
		header("Location: menus.php");
		break;
	case 'delete':
		$id = $_GET['id'];
		$db->query("DELETE FROM `menus` WHERE `id`='$id'");
		$_SESSION['alert'] = '<div class="alert alert-danger">Menu deleted.</div>';
		header("Location: menus.php");
		break;
	default:
		$_SESSION['alert'] = '<div class="alert alert-danger">Something went wrong.</div>';
		header("Location: dashboard.php");
}