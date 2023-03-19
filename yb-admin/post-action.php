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
	case "Publish":

		$postTitle = test_input($_POST['postTitle']);
		$permaLink = isset($_POST['permaLink']) ? test_input($_POST['permaLink']) : '';
		// Only allow letters, numbers, and dashes
		$postTitleSeoUrl = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($postTitle));
		// Replace multiple dashes with one dash
		$postTitleSeoUrl = preg_replace('/-+/', '-', $postTitleSeoUrl);
		if (substr($postTitleSeoUrl, -1) === '-') { // Remove - from end
			$postTitleSeoUrl = substr($postTitleSeoUrl, 0, -1);
		}
		if (substr($postTitleSeoUrl, 0, 1) === '-') { // Remove - from start
			$postTitleSeoUrl = substr($postTitleSeoUrl, 1);
		}

		if ($postTitleSeoUrl == "home") {
			$postTitleSeoUrl = "";
		}

		if (empty($permaLink)) {
			$postTitleSeoUrl = strtolower($postTitleSeoUrl);
		} else {
			// Only allow letters, numbers, and dashes
			$postTitleSeoUrl = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($permaLink));
			// Replace multiple dashes with one dash
			$postTitleSeoUrl = preg_replace('/-+/', '-', $postTitleSeoUrl);
			if (substr($postTitleSeoUrl, -1) === '-') { // Remove - from end
				$postTitleSeoUrl = substr($postTitleSeoUrl, 0, -1);
			}
			if (substr($postTitleSeoUrl, 0, 1) === '-') { // Remove - from start
				$postTitleSeoUrl = substr($postTitleSeoUrl, 1);
			}
		}
		$postTitleSeoUrl = rtrim($postTitleSeoUrl, '/');
		$postContent = test_input($_POST['postContent']);
		$postType = test_input($_POST['postType']);
		$metaTitle = test_input($_POST['metaTitle']);
		$metaDesc = test_input($_POST['metaDesc']);
		$metaKeywords = test_input($_POST['metaKeywords']);
		$metaIndex = test_input($_POST['metaIndex']);
		$metaFollow = test_input($_POST['metaFollow']);
		$sitemap = test_input($_POST['sitemap']);
		$postDateTime = date("Y-m-d H:i:s");
		$sortOrder = test_input($_POST['sortOrder']);
		if ($postType == 'blog') {
			$postTitleSeoUrl = "blog/" . $postTitleSeoUrl;
		} elseif ($postType == 'news') {
			$postTitleSeoUrl = "news/" . $postTitleSeoUrl;
		}
		$altText = isset($_POST['altText']) ? test_input($_POST['altText']) : '';
		$catId = isset($_POST['cat_id']) ? test_input($_POST['cat_id']) : '';
		$authoId = isset($_POST['autho_id']) ? test_input($_POST['autho_id']) : '';

		if (empty($postTitle) || empty($metaTitle) || empty($metaDesc)) {
			$_SESSION['alert'] = '<div class="alert alert-warning">Please fill all required fields.</div>';
			header('Location: post-new.php?post_type=' . $postType);

		} else {
			$query = $db->query("SELECT * FROM `yb_posts` WHERE `post_title`='$postTitle' AND `post_title_seo_url`='$postTitleSeoUrl' AND `post_type`='$postType' AND `post_status`='publish'");
			if ($query->num_rows > 0) {
				echo '<div class="alert alert-warning">Data already exists.</div>';
			} else {
				$sql = $db->query("INSERT INTO yb_posts SET post_title='$postTitle',post_title_seo_url='$postTitleSeoUrl',post_content='$postContent',post_type='$postType',cat_id='$catId',autho_id='$authoId',meta_title='$metaTitle',meta_description='$metaDesc',meta_keywords='$metaKeywords',meta_index='$metaIndex',meta_follow='$metaFollow',sitemap='$sitemap',post_date_time='$postDateTime',sort_order='$sortOrder'");
				$lid = mysqli_insert_id($db);

				//post image upload
				if ($_FILES["featuredImage"]["size"] > 0) {
					$photo = $_FILES['featuredImage']['name'];
					$randTime = rand(00, 99) . time();
					$photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($postTitle));
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
						if ($_FILES["featuredImage"]["error"] > 0) {
							echo "Return Code: " . $_FILES["featuredImage"]["error"] . "<br>";
						} else {
							$new_photo = str_replace(" ", "-", strtolower($photo_name . "-" . $randTime . "." . $extension));

							// Location

							$location = "../uploads/post-images/" . $new_photo;

							// move file to folder

							move_uploaded_file($_FILES["featuredImage"]["tmp_name"], $location);

							$db->query("UPDATE yb_posts SET post_img = '$new_photo', post_img_alt_text = '$altText' WHERE id='$lid'");
						}
					}
				}
				//post image upload ends

				if ($sql === TRUE) {
					$_SESSION['alert'] = '<div class="alert alert-primary">Data successfully inserted.</div>';
					header('Location: post.php?id=' . $lid . '&post_type=' . $postType . '&action=edit');

				} else {
					$_SESSION['alert'] = '<div class="alert alert-danger">Data not inserted.</div>';
					header('Location: post-new.php?post_type=' . $postType);

				}
			}
		}
		break;
	case "Update":
		$postId = $_POST['post_id'];
		$postTitle = test_input($_POST['postTitle']);
		$permaLink = isset($_POST['permaLink']) ? test_input($_POST['permaLink']) : '';
		// Only allow letters, numbers, and dashes
		$postTitleSeoUrl = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($postTitle));
		// Replace multiple dashes with one dash
		$postTitleSeoUrl = preg_replace('/-+/', '-', $postTitleSeoUrl);
		if (substr($postTitleSeoUrl, -1) === '-') { // Remove - from end
			$postTitleSeoUrl = substr($postTitleSeoUrl, 0, -1);
		}
		if (substr($postTitleSeoUrl, 0, 1) === '-') { // Remove - from start
			$postTitleSeoUrl = substr($postTitleSeoUrl, 1);
		}

		if ($postTitleSeoUrl == "home") {
			$postTitleSeoUrl = "";
		}

		if (empty($permaLink)) {
			$postTitleSeoUrl = strtolower($postTitleSeoUrl);
		} else {
			// Only allow letters, numbers, and dashes
			$postTitleSeoUrl = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($permaLink));
			// Replace multiple dashes with one dash
			$postTitleSeoUrl = preg_replace('/-+/', '-', $postTitleSeoUrl);
			if (substr($postTitleSeoUrl, -1) === '-') { // Remove - from end
				$postTitleSeoUrl = substr($postTitleSeoUrl, 0, -1);
			}
			if (substr($postTitleSeoUrl, 0, 1) === '-') { // Remove - from start
				$postTitleSeoUrl = substr($postTitleSeoUrl, 1);
			}
		}
		$postTitleSeoUrl = rtrim($postTitleSeoUrl, '/');
		$postContent = test_input($_POST['postContent']);
		$postType = test_input($_POST['postType']);
		$metaTitle = test_input($_POST['metaTitle']);
		$metaDesc = test_input($_POST['metaDesc']);
		$metaKeywords = test_input($_POST['metaKeywords']);
		$metaIndex = test_input($_POST['metaIndex']);
		$metaFollow = test_input($_POST['metaFollow']);
		$sitemap = test_input($_POST['sitemap']);
		$postDateTime = date("Y-m-d H:i:s");
		$sortOrder = test_input($_POST['sortOrder']);
		if ($postType == 'blog') {
			$expo = explode("blog/", $postTitleSeoUrl);
			$expo = $expo[1];
			$postTitleSeoUrl = "blog/" . $expo;
		} elseif ($postType == 'news') {
			$expo = explode("news/", $postTitleSeoUrl);
			$expo = $expo[1];
			$postTitleSeoUrl = "news/" . $expo;
		}
		$altText = isset($_POST['altText']) ? test_input($_POST['altText']) : '';
		$catId = isset($_POST['cat_id']) ? test_input($_POST['cat_id']) : '';
		$authoId = isset($_POST['autho_id']) ? test_input($_POST['autho_id']) : '';

		if (empty($postTitle) || empty($metaTitle) || empty($metaDesc)) {
			$_SESSION['alert'] = '<div class="alert alert-warning">Please fill all required field.</div>';
			header('Location: post.php?id=' . $postId . '&post_type=' . $postType . '&action=edit');
		} else {

			$sql = $db->query("UPDATE yb_posts SET post_title='$postTitle',post_title_seo_url='$postTitleSeoUrl',post_content='$postContent',post_type='$postType',cat_id='$catId',autho_id='$authoId',meta_title='$metaTitle',meta_description='$metaDesc',meta_keywords='$metaKeywords',meta_index='$metaIndex',meta_follow='$metaFollow',sitemap='$sitemap',post_date_time='$postDateTime',sort_order='$sortOrder' WHERE id='$postId'");


			//post image upload
			if ($_FILES["featuredImage"]["size"] > 0) {
				$photo = $_FILES['featuredImage']['name'];
				$randTime = rand(00, 99) . time();
				$photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($postTitle));
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
					if ($_FILES["featuredImage"]["error"] > 0) {
						echo "Return Code: " . $_FILES["featuredImage"]["error"] . "<br>";
					} else {
						$new_photo = str_replace(" ", "-", strtolower($photo_name . "-" . $randTime . "." . $extension));

						// Location

						$location = "../uploads/post-images/" . $new_photo;

						// move file to folder

						move_uploaded_file($_FILES["featuredImage"]["tmp_name"], $location);



						$data = $db->query("SELECT `post_img` FROM `yb_posts` WHERE `id` = '$postId'");
						$value = $data->fetch_object();
						if (empty($value->post_img)) {
							$db->query("UPDATE `yb_posts` SET `post_img` = '$new_photo',post_img_alt_text = '$altText' WHERE `id` = '$postId'");
						} else {
							unlink('../uploads/post-images/' . $value->post_img); // remove files	
							$db->query("UPDATE `yb_posts` SET `post_img` = '$new_photo',post_img_alt_text = '$altText' WHERE `id` = '$postId'");
						}
					}
				}
			}
			//post image upload ends

			if ($sql === TRUE) {
				$_SESSION['alert'] = '<div class="alert alert-primary">Data successfully updated.</div>';
				header('Location: post.php?id=' . $postId . '&post_type=' . $postType . '&action=edit');

			} else {
				$_SESSION['alert'] = '<div class="alert alert-danger">Data not updated.</div>';
				header('Location: post.php?id=' . $postId . '&post_type=' . $postType . '&action=edit');

			}

		}
		break;
	case 'trash':
		$post_id = $_GET['id'];
		$query_select = $db->query("SELECT `post_type` FROM `yb_posts` WHERE `id` = '$post_id'");
		$query_fetch = $query_select->fetch_object();
		$post_type = $query_fetch->post_type;
		$db->query("UPDATE `yb_posts` SET `post_status`='trash' WHERE `id` = '$post_id'");
		$_SESSION['alert'] = '<div class="alert alert-warning">Data trashed.</div>';
		header("location:edit.php?post_type=" . $post_type . "");
		break;
	case 'restore':
		$post_id = $_GET['id'];
		$query_select = $db->query("SELECT `post_type` FROM `yb_posts` WHERE `id` = '$post_id'");
		$query_fetch = $query_select->fetch_object();
		$post_type = $query_fetch->post_type;
		$db->query("UPDATE `yb_posts` SET `post_status`='publish' WHERE `id` = '$post_id'");
		$_SESSION['alert'] = '<div class="alert alert-success">Data restored.</div>';
		header("location:edit.php?post_type=" . $post_type . "");
		break;
	case 'delete':
		$post_id = $_GET['id'];
		$data = $db->query("SELECT `post_img`,post_type FROM `yb_posts` WHERE  `id` = '$post_id'");
		$value = $data->fetch_object();
		$post_type = $value->post_type;
		$post_img = $value->post_img;
		if (empty($post_img)) {
			$db->query("DELETE FROM `yb_posts` WHERE  `id` = '$post_id'");
		}
		if (!empty($post_img)) {
			unlink("../uploads/post-images/" . $post_img); //remove file 
			$db->query("DELETE FROM `yb_posts` WHERE  `id` = '$post_id'");
		}
		$_SESSION['alert'] = '<div class="alert alert-success">Data deleted.</div>';
		header("location:edit.php?post_type=" . $post_type . "");
		break;
	default:
		$_SESSION['alert'] = '<div class="alert alert-danger">Something went wrong. Try after some time.</div>';
		header('Location: dashboard.php');
}