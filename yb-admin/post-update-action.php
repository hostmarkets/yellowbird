<?php
include '../config/config.php';
include '../config/function.php';

    $id = test_input($_POST['id']);
	$postTitle = test_input($_POST['postTitle']);
	$permaLink = isset($_POST['permaLink']) ? test_input($_POST['permaLink']) : '';
	// Only allow letters, numbers, and dashes
		$postTitleSeoUrl = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($postTitle));
	// Replace multiple dashes with one dash
		$postTitleSeoUrl = preg_replace('/-+/', '-', $postTitleSeoUrl);
	if(substr($postTitleSeoUrl, -1)==='-'){ // Remove - from end
		$postTitleSeoUrl = substr($postTitleSeoUrl, 0, -1);
	}
	if(substr($postTitleSeoUrl, 0, 1)==='-'){ // Remove - from start
		$postTitleSeoUrl = substr($postTitleSeoUrl, 1);
	}
	
	if($postTitleSeoUrl=="home"){
		$postTitleSeoUrl = "";
	}
	
	if(empty($permaLink)){
		$postTitleSeoUrl = $postTitleSeoUrl;
	}else{
		// Only allow letters, numbers, and dashes
		$postTitleSeoUrl = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($permaLink));
	// Replace multiple dashes with one dash
		$postTitleSeoUrl = preg_replace('/-+/', '-', $postTitleSeoUrl);
	if(substr($postTitleSeoUrl, -1)==='-'){ // Remove - from end
		$postTitleSeoUrl = substr($postTitleSeoUrl, 0, -1);
	}
	if(substr($postTitleSeoUrl, 0, 1)==='-'){ // Remove - from start
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
	if($postType=='blog'){
		$expo = explode("blog/",$postTitleSeoUrl);
	$expo = $expo[1];
	$postTitleSeoUrl = "blog/".$expo;
	}elseif($postType=='news'){
		$expo = explode("news/",$postTitleSeoUrl);
	$expo = $expo[1];
	$postTitleSeoUrl = "news/".$expo;
	}
	$altText = isset($_POST['altText']) ? test_input($_POST['altText']) : '';
	
	if (empty($postTitle) || empty($metaTitle) || empty($metaDesc)) {
		echo '<div class="alert alert-warning">Please fill all required field.</div>';
	} else {
		
		$sql = $db->query("UPDATE yb_posts SET post_title='$postTitle',post_title_seo_url='$postTitleSeoUrl',post_content='$postContent',post_type='$postType',meta_title='$metaTitle',meta_description='$metaDesc',meta_keywords='$metaKeywords',meta_index='$metaIndex',meta_follow='$metaFollow',sitemap='$sitemap',post_date_time='$postDateTime',sort_order='$sortOrder' WHERE id='$id'");
		
	
		//post image upload
	if ($_FILES["featuredImage"]["size"] > 0) {
		$photo = $_FILES['featuredImage']['name'];
		$randTime = rand(00, 99).time();
		$photo_name = preg_replace('/([^a-zA-Z0-9\/-]+)/', '-', strtolower($postTitle));
		$photo_name = preg_replace('/-+/', '-', $photo_name);
			if(substr($photo_name, -1)==='-'){ // Remove - from end
				$photo_name = substr($photo_name, 0, -1);
			}
	if(substr($photo_name, 0, 1)==='-'){ // Remove - from start
		$photo_name = substr($photo_name, 1);
	}
	
	
	$allowedExts = array("gif", "jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "webp");
	$temp = explode(".", $photo);
	$extension = strtolower(end($temp));
	if ((in_array($extension, $allowedExts))) {
		if ($_FILES["featuredImage"]["error"] > 0) {
			echo "Return Code: " . $_FILES["featuredImage"]["error"] . "<br>";
		} else {
			$new_photo = str_replace(" ", "-", strtolower($photo_name."-".$randTime.".".$extension));
					
					// Location
	
			$location = "../uploads/post-images/".$new_photo;
	
			// move file to folder
	
			move_uploaded_file($_FILES["featuredImage"]["tmp_name"],$location);
	
			

			$data = $db->query("SELECT `post_img` FROM `yb_posts` WHERE `id` = '$id'");
		$value = $data->fetch_object();
		if(empty($value->post_img)){
			$db->query("UPDATE `yb_posts` SET `post_img` = '$new_photo',post_img_alt_text = '$altText' WHERE `id` = '$id'");	
		}else{
unlink('../uploads/post-images/'.$value->post_img); // remove files	
$db->query("UPDATE `yb_posts` SET `post_img` = '$new_photo',post_img_alt_text = '$altText' WHERE `id` = '$id'");
}
		}
	}
	}
	//post image upload ends
		
		if ($sql === TRUE) {
			echo '<div class="alert alert-success">Data successfully updated.</div>';
		} else {
			echo '<div class="alert alert-danger">Data not updated.</div>';
		}
	
	}