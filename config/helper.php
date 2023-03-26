<?php
$path = $_SERVER["REQUEST_URI"];
$PATHINFO_BASENAME = pathinfo($path, PATHINFO_BASENAME);
if ($PATHINFO_BASENAME == "helper.php") {
	include_once("config.php");
	header("Location: " . ROOT . "/helper/");
	exit();
}

$postId = "";
$catId = "";
$newsCatId = "";
$authoId = "";
$tagId = "";

/** For post */

$selectPostQuery = $db->query("SELECT * FROM `yb_posts` WHERE `post_status`='publish' AND (`post_title_seo_url`='$res2' OR `post_title_seo_url`='$res3')");
if (is_array($selectPostQuery) || is_object($selectPostQuery)) {
	foreach ($selectPostQuery as $rowPostQuery) {
		$postId = $rowPostQuery["id"];
		$post_title = $rowPostQuery["post_title"];
		$post_type = $rowPostQuery["post_type"];
		$post_title_seo_url = $rowPostQuery["post_title_seo_url"];
		$meta_title = $rowPostQuery["meta_title"];
		$meta_description = $rowPostQuery["meta_description"];
		$meta_keywords = $rowPostQuery["meta_keywords"];
		$meta_index = $rowPostQuery["meta_index"];
		$meta_follow = $rowPostQuery["meta_follow"];
		$post_content = $rowPostQuery["post_content"];
		$post_img = $rowPostQuery["post_img"];
		if (!empty($post_img)) {
			if (file_exists("uploads/post-images/" . $post_img)) {
				$post_img = "uploads/post-images/" . $post_img;
				$post_img_alt_text = $post_title;
			} else {
				$post_img = "images/yellowbird-logo.webp";
				$post_img_alt_text = $post_title;
			}
		} else {
			$post_img = "images/yellowbird-logo.webp";
			$post_img_alt_text = $post_title;
		}
		$post_date_time = $rowPostQuery['post_date_time'];
	}
}

/** For Category */

$selectCatQuery = $db->query("SELECT * FROM `yb_category` WHERE `cat_seo_url`='$catres2' AND `cat_status`='publish'");
if (is_array($selectCatQuery) || is_object($selectCatQuery)) {
	foreach ($selectCatQuery as $rowCatQuery) {
		$catId = $rowCatQuery['id'];
		$cat_name = $rowCatQuery['cat_name'];
		$cat_seo_url = $rowCatQuery['cat_seo_url'];
		$cat_meta_title = $rowCatQuery["cat_meta_title"];
		$cat_meta_descp = $rowCatQuery["cat_meta_descp"];
		$cat_meta_keyword = $rowCatQuery["cat_meta_keyword"];
	}
}

/** For news Category */

$selectNewsCatQuery = $db->query("SELECT * FROM `yb_category` WHERE `cat_seo_url`='$ncatres2' AND `cat_status`='publish'");
if (is_array($selectNewsCatQuery) || is_object($selectNewsCatQuery)) {
	foreach ($selectNewsCatQuery as $rowNewsCatQuery) {
		$newsCatId = $rowNewsCatQuery['id'];
		$news_cat_name = $rowNewsCatQuery['cat_name'];
		$news_cat_seo_url = $rowNewsCatQuery['cat_seo_url'];
		$news_cat_meta_title = $rowNewsCatQuery["cat_meta_title"];
		$news_cat_meta_descp = $rowNewsCatQuery["cat_meta_descp"];
		$news_cat_meta_keyword = $rowNewsCatQuery["cat_meta_keyword"];
		$news_cat_img = $rowNewsCatQuery['cat_img'];
		if (!empty($news_cat_img)) {
			if (file_exists("uploads/cat-images/" . $news_cat_img)) {
				$news_cat_img = "uploads/cat-images/" . $news_cat_img;
			} else {
				$news_cat_img = "images/yellowbird-logo.webp";
			}
		} else {
			$news_cat_img = "images/yellowbird-logo.webp";
		}
	}
}

/** For Author */

$selectAuthoQuery = $db->query("SELECT * FROM `author` WHERE `autho_seo_url`='$authres2' AND `autho_status`='publish'");
if (is_array($selectAuthoQuery) || is_object($selectAuthoQuery)) {
	foreach ($selectAuthoQuery as $rowAuthoQuery) {
		$authoId = $rowAuthoQuery['id'];
		$autho_name = $rowAuthoQuery['autho_name'];
		$autho_seo_url = $rowAuthoQuery['autho_seo_url'];
		$auto_pagetitle = $autho_name;
		$auto_pagemetadesc = $autho_name;
		$auto_pagekeywords = $autho_name;
		$auto_image = $rowAuthoQuery['autho_img'];
		if (!empty($auto_image)) {
			if (file_exists("uploads/author-images/" . $auto_image)) {
				$auto_image = "uploads/author-images/" . $auto_image;
			} else {
				$auto_image = "images/yellowbird-logo.webp";
			}
		} else {
			$auto_image = "images/yellowbird-logo.webp";
		}
	}
}

/** For Tag */
$tags = explode(',', $tagres2);
$tags = implode("','", $tags);
$selectTagQuery = $db->query("SELECT * FROM `yb_posts` WHERE `post_status`='publish' AND (`post_type`='blog' || `post_type`='news') AND `meta_keywords` = '$tags'");
if (is_array($selectTagQuery) || is_object($selectTagQuery)) {
	foreach ($selectTagQuery as $rowTagQuery) {
		$tagId = $rowTagQuery["id"];
	}
}

/** SEO Start */

if ($page == "" && $postId != "") {
	$title = $meta_title;
	$keywords = $meta_keywords;
	$meta_desc = $meta_description;
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = "Yellowbird Immigration Services Pvt. Ltd.";
	$og_img = $post_img;
	$og_img_alt = $post_img_alt_text;
	$metaIndex = $meta_index;
	$metaFollow = $meta_follow;
} elseif ($page != "" && $postId != "") {
	$title = $meta_title;
	$keywords = $meta_keywords;
	$meta_desc = $meta_description;
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $post_title;
	$og_img = $post_img;
	$og_img_alt = $post_img_alt_text;
	$metaIndex = $meta_index;
	$metaFollow = $meta_follow;
} elseif ($page != "" && $newsCatId != "") {
	$title = $news_cat_meta_title;
	$meta_desc = $news_cat_meta_descp;
	$keywords = $news_cat_meta_keyword;
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $title;
	$og_img = $news_cat_img;
	$og_img_alt = $news_cat_name;
	$metaIndex = "noindex";
	$metaFollow = "nofollow";
} elseif ($page != "" && $authoId != "") {
	$title = $auto_pagetitle;
	$meta_desc = $auto_pagemetadesc;
	$keywords = $auto_pagekeywords;
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $title;
	$og_img = $auto_image;
	$og_img_alt = $autho_name;
	$metaIndex = "noindex";
	$metaFollow = "nofollow";
} elseif ($page != "" && $tagId != "" && $page != "news") {
	$title_head = str_replace("-", " ", $tagres2);
	$title = "" . $title_head . " Archives";
	$meta_desc = $title . " - Archives";
	$keywords = $title_head . "archives";
	$tagres2 = str_replace(" ", "-", $tagres2);
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/yellowbird-logo.webp";
	$og_img_alt = "Tag Featured Image";
	$metaIndex = "noindex";
	$metaFollow = "nofollow";
} elseif ($page != "" && $page == "thank-you") {
	$title = "Thank You | Yellowbird Immigration Services Pvt. Ltd.";
	$keywords = "Thank You, Yellowbird Immigration Services";
	$meta_desc = "Thank You - Yellowbird Immigration Services Pvt. Ltd.";
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/yellowbird-logo.webp";
	$og_img_alt = "Thank you";
	$metaIndex = "noindex";
	$metaFollow = "nofollow";
} elseif ($page != "" && $page == "blog") {
	$title = "Latest Blog 2023 | Yellowbird Immigration Services";
	$meta_desc = "Get the Latest Blog 2023. Yellowbird Immigration Services";
	$keywords = "latest blog, Yellowbird Immigration Services";
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/yellowbird-logo.webp";
	$og_img_alt = "Blog Featured Image";
	$metaIndex = "noindex";
	$metaFollow = "nofollow";
} elseif ($page != "" && $page == "news") {
	$title = "Latest News 2023 | Yellowbird Immigration Services";
	$meta_desc = "Latest News 2023. Yellowbird Immigration Services";
	$keywords = "Latest News 2023, Yellowbird Immigration Services";
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/yellowbird-logo.webp";
	$og_img_alt = "News Featured Image";
	$metaIndex = "noindex";
	$metaFollow = "nofollow";
} elseif ($page != "" && $page == "search") {
	$title = $q . " | Yellowbird Immigration Search";
	$meta_desc = $q . " Yellowbird Immigration Search";
	$keywords = "search, Yellowbird Immigration";
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/yellowbird-logo.webp";
	$og_img_alt = "Search Featured Image";
	$metaIndex = "noindex";
	$metaFollow = "nofollow";
} else {
	$title = "404 - Page not found | Yellowbird Immigration Services";
	$keywords = "404, Yellowbird Immigration Services";
	$meta_desc = "404 - Yellowbird Immigration Services";
	$ccu = ROOT . canonical;
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/yellowbird-logo.webp";
	$og_img_alt = "404 Featured Image";
	$metaIndex = "noindex";
	$metaFollow = "nofollow";
}

/** SEO end */


/** page view count */

$sql = $db->query("SELECT `hits` FROM `yb_posts` WHERE `id`='$postId'");
if ($sql->num_rows > 0) {
	$row = $sql->fetch_assoc();
	$hits = $row['hits'];
}

/** setting hits = 1, if we have no hits value */

if (empty($hits)) {
	$hits = 1;
	$sql1 = $db->query("UPDATE `yb_posts` SET `hits`='$hits' WHERE `id`='$postId'");
} else {
	/** Incrementing counts value */
	$plus_hits = $hits + 1;
	$sql2 = $db->query("UPDATE `yb_posts` set `hits`='$plus_hits' WHERE `id`='$postId'");
}