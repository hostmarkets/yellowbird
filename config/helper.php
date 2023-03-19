<?php
$path = $_SERVER["REQUEST_URI"];
$PATHINFO_BASENAME = pathinfo($path,PATHINFO_BASENAME);
if($PATHINFO_BASENAME=="helper.php"){
    include_once("config.php");
    header("Location: " . ROOT . "/helper/");
    exit();
}

$page_id = "";
$page_catid = "";
$page_ncatid = "";
$tag_id = "";
$autho_id = "";
$post_type = "";
$redirect_page = "";

//For post

$select=$db->query("SELECT * FROM yb_posts WHERE post_status='publish' AND (post_title_seo_url='$res2' OR post_title_seo_url='$res3')");
if (is_array($select) || is_object($select))
{
foreach($select as $row){
	$page_id = $row["id"];
	$post_title = $row["post_title"];
	$post_type = $row["post_type"];
	$page_url = $row["post_title_seo_url"];
	$ban_clr = explode('/', $page_url);
	$page_title = $row["seo_title"];
	$page_meta_description = $row["meta_description"];
	$page_meta_keywords = $row["meta_keywords"];
	$ccu = $row["ccu"];
	$noindex = $row["noindex"];
	$nofollow = $row["nofollow"];
	$page_post_content = $row["post_content"];
	$loc_id = $row["location_id"];
	$get_loc_query = $db->query("SELECT name FROM locations WHERE id='$loc_id'");
	if($get_loc_query->num_rows>0){
$get_loc_row = $get_loc_query->fetch_assoc();
$get_loc_name = $get_loc_row['name'];
}
	$drop_menu = $row["drop_menu"];
	$post_image = $row["post_image"];
	if(!empty($post_image)){
		if(file_exists("upload/post-images/".$post_image)){
			$post_image = "upload/post-images/".$post_image;
			$post_img_alt = $post_title;
		}else{
			$post_image = "images/Homepage-Featured-Image.jpg";
			$post_img_alt = $post_title;
		}
	}else{
		$post_image = "images/Homepage-Featured-Image.jpg";
		$post_img_alt = $post_title;
	}
	$posted_date = $row['post_date_time'];

	/** for blog schema data */
	$post_date_time = $posted_date;
	$post_date_time_update = $row['post_date_time_update'];
	$blogSchemaAuthoId = $row['autho_id'];
	$blogSchemaQuery = $db->query("SELECT `autho_name`,`autho_seo_url` FROM `author` WHERE `id`='$blogSchemaAuthoId'");
	if($blogSchemaQuery->num_rows>0){
	$blogSchemaRow = $blogSchemaQuery->fetch_assoc();
	$blogSchemaAuthoName = $blogSchemaRow['autho_name'];
	$blogSchemaAuthoURL = $blogSchemaRow['autho_seo_url'];
}else{
	$blogSchemaAuthoName = "Nationwide Visas";
	$blogSchemaAuthoURL = "nationwide";
}
}
}

//For Category

$post_cat = $db->query("SELECT * FROM pcategory WHERE fld_seo_url='$catres2' AND cat_status='publish'");
if(is_array($post_cat) || is_object($post_cat)){
foreach($post_cat as $post_row){
	$page_catid = $post_row['id'];
	$page_cat_name = $post_row['pcname'];
	$page_fld_seo_url = $post_row['fld_seo_url'];
	$cat_pagetitle = $post_row["fld_meta_title"];
	$cat_pagemetadesc = $post_row["kdesc"];
	$cat_pagekeywords = $post_row["fld_meta_keyword"];
}
}

//For news Category

$post_ncat = $db->query("SELECT * FROM pcategory WHERE fld_seo_url='$ncatres2' AND cat_status='publish'");
if(is_array($post_ncat) || is_object($post_ncat)){
foreach($post_ncat as $post_nrow){
	$page_ncatid = $post_nrow['id'];
	$page_ncat_name = $post_nrow['pcname'];
	$page_fld_seo_url = $post_nrow['fld_seo_url'];
	$ncat_pagetitle = $post_nrow["fld_meta_title"];
	$ncat_pagemetadesc = $post_nrow["kdesc"];
	$ncat_pagekeywords = $post_nrow["fld_meta_keyword"];
	$ncat_image = $post_nrow['pcimage'];
	if(!empty($ncat_image)){
		if(file_exists("upload/cat-images/".$ncat_image)){
			$ncat_image = "upload/cat-images/".$ncat_image;
		}else{
			$ncat_image = "images/Homepage-Featured-Image.jpg";
		}
	}else{
		$ncat_image = "images/Homepage-Featured-Image.jpg";
	}
}
}

//For Author

$post_autho = $db->query("SELECT * FROM author WHERE autho_seo_url='$authres2' AND autho_status='publish'");
if(is_array($post_autho) || is_object($post_autho)){
foreach($post_autho as $post_autho_row){
	$autho_id = $post_autho_row['id'];
	$autho_name = $post_autho_row['autho_name'];
	$autho_seo_url = $post_autho_row['autho_seo_url'];
	$auto_pagetitle = $autho_name;
	$auto_pagemetadesc = $autho_name;
	$auto_pagekeywords = $autho_name;
	$auto_image = $post_autho_row['autho_img'];
	if(!empty($auto_image)){
		if(file_exists("upload/author-images/".$auto_image)){
			$auto_image = "upload/author-images/".$auto_image;
		}else{
			$auto_image = "images/favicon.png";
		}
	}else{
		$auto_image = "images/favicon.png";
	}
}
}

//For Tag

$tag_query = $db->query("SELECT * FROM yb_posts WHERE post_status='publish' AND (post_type='blog' || post_type='news') AND meta_keywords LIKE '%$tagres2%'");
if(is_array($tag_query) || is_object($tag_query)){
foreach($tag_query as $tag_row){
	$tag_id = $tag_row["id"];
}
}
//For SEO Start

if($page=="" && $page_id!=""){
	$title = $page_title;
	$keywords = $page_meta_keywords;
	$meta_desc = $page_meta_description;
	$ccu = ROOT;
	$og_url = $ccu;
	$og_title = "Nationwide immigration Services Pvt. Ltd.";
	$og_img = $post_image;
	$og__img_alt = $post_img_alt;
	$noindex = "index";
	$nofollow = "follow";
}elseif($page!="" && $page_id!=""){
	$title = $page_title;
	$keywords = $page_meta_keywords;
	$meta_desc = $page_meta_description;
	$ccu = ROOT.'/'.$ccu.'/';
	$og_url = $ccu;
	$og_title = $post_title;
	$og_img = $post_image;
	$og__img_alt = $post_img_alt;
	$noindex = !empty($noindex) ? $noindex : "index";
	$nofollow = !empty($nofollow) ? $nofollow : "follow";
}elseif($page!="" && $page_ncatid!=""){
	$title = $ncat_pagetitle." | Nationwide Visas";
	$meta_desc = $ncat_pagemetadesc;
	$keywords = $ncat_pagekeywords;
	$ccu = ROOT."/news/category/".$page_fld_seo_url."/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = $ncat_image;
	$og__img_alt = $page_ncat_name;
	$noindex = "index";
	$nofollow = "follow";
}elseif($page!="" && $autho_id!=""){
	$title = $auto_pagetitle." | Nationwide Visas";
	$meta_desc = $auto_pagemetadesc;
	$keywords = $auto_pagekeywords;
	$ccu = ROOT."/author/".$autho_seo_url."/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = $auto_image;
	$og__img_alt = $autho_name;
	$noindex = "noindex";
	$nofollow = "follow";
}elseif($page!="" && $tag_id!="" && $page!="news/"){
	$title_head = str_replace("-", " ", $tagres2);
	$title = "".$title_head." Archives - Nationwide Visas";
	$meta_desc = $title." - Archives - Nationwide Visas";
	$keywords = $title_head."archives, nationwide visas";
	$tagres2 = str_replace(" ", "-", $tagres2);
	$ccu = ROOT."/tag/".$tagres2."/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Tag-Featured-Image.jpg";
	$og__img_alt = "Tag Featured Image";
	$noindex = "noindex";
	$nofollow = "follow";
}elseif($page!="" && $page=="thanks/"){
	$title = "Thanks | Nationwide Visas";		   
	$keywords = "Thanks, nationwide visas";		   
	$meta_desc = "Thanks - Nationwide Visas";	
	$ccu = ROOT."/thanks/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "satyendra-email-templates/images/Emailer123.png";
	$og__img_alt = "Thank you for interacting with us";
	$noindex = "noindex";
	$nofollow = "follow"; 
}elseif($page!="" && $page=="blog/"){
	$title = "Canada, Australia & Germany Immigration Latest News & Blog 2022";
	$meta_desc = "Get the latest Canada, Australia &
	Germany immigration news and articles. Nationwide Visas, most reliable
	and trustworthy immigration consultants.";
	$keywords = "Canada
	Immigration Blog, Australia Immigration Blog, Germany Immigration Blog";
	$ccu = ROOT."/blog/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Blog-Featured-Image.jpg";
	$og__img_alt = "Blog Featured Image";
	$noindex = "index";
	$nofollow = "follow";
}elseif($page!="" && $page=="pr-news/"){
	$title = "PR News 2022 | Nationwide Visas";
	$meta_desc = "PR News 2022. Nationwide Visas";
	$keywords = "PR News 2022, nationwide visas";
	$ccu = ROOT."/pr-news/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Homepage-Featured-Image.jpg";
	$og__img_alt = "PR News Featured Image";
	$noindex = "index";
	$nofollow = "follow";
}elseif($page!="" && $page=="news/"){
	$title = "Latest News 2022 | Nationwide Visas";
	$meta_desc = "Latest News 2022. Nationwide Visas";
	$keywords = "Latest News 2022, nationwide visas";
	$ccu = ROOT."/news/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Homepage-Featured-Image.jpg";
	$og__img_alt = "Latest News Featured Image";
	$noindex = "index";
	$nofollow = "follow";
}elseif($page!="" && $page=="article/"){
	$title = "Latest Article 2022 | Nationwide Visas";
	$meta_desc = "Latest Article 2022. Nationwide Visas";
	$keywords = "Latest Article 2022, nationwide visas";
	$ccu = ROOT."/article/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Homepage-Featured-Image.jpg";
	$og__img_alt = "Latest Article Featured Image";
	$noindex = "index";
	$nofollow = "follow";
}elseif($page!="" && $page=="latest-immigration-news/"){
	$title = "Latest Immigration News 2022 | Nationwide Visas";
	$meta_desc = "Latest Immigration News 2022. Nationwide Visas";
	$keywords = "Latest Immigration News 2022, nationwide visas";
	$ccu = ROOT."/latest-immigration-news/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Homepage-Featured-Image.jpg";
	$og__img_alt = "Latest News Featured Image";
	$noindex = "index";
	$nofollow = "follow";
}elseif($page!="" && $page=="walk-in/"){
	$title = "Walk-In | Nationwide Visas";
	$meta_desc = "Walk-In. Nationwide Visas";
	$keywords = "Walk-In, nationwide visas";
	$ccu = ROOT."/walk-in/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Walk-In-Featured-Image.jpg";
	$og__img_alt = "walk-in Image";
	$noindex = "index";
	$nofollow = "follow";
}elseif($page!="" && $page=="unsubscribe/"){
	$title = "Unsubscribe| Nationwide Visas Search";
	$meta_desc = "Nationwide Visas Unsubscribe";
	$keywords = "Unsubscribe, nationwide visas";
	$ccu = ROOT."/unsubscribe/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Unsubscribe-Featured-Image.jpg";
	$og__img_alt = "Unsubscribe Featured Image";
	$noindex = "noindex";
	$nofollow = "follow";
}elseif($page!="" && $page=="search/"){
	$title = $q." | Nationwide Visas Search";
	$meta_desc = $q." Nationwide Visas Search";
	$keywords = "search, nationwide visas";
	$ccu = ROOT."/search/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/Search-Function-Featured-Image.jpg";
	$og__img_alt = "Search Function Featured Image";
	$noindex = "noindex";
	$nofollow = "follow";
}else{
	$title = "404 - Page not found | Nationwide Visas";
	$keywords = "404, nationwide visas";
	$meta_desc = "404 - Nationwide Visas";
	$ccu = ROOT."/404/";
	$og_url = $ccu;
	$og_title = $title;
	$og_img = "images/404-Featured-Image.jpg";
	$og__img_alt = "404 Featured Image";
	$noindex = "noindex";
	$nofollow = "follow";
}

// SEO end

//trailing slash to url

$site_adress = (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
$whole_url = $site_adress . $_SERVER['REQUEST_URI'];
$pos = strpos($whole_url, "?");
$changed_url = FALSE;
if($pos !== FALSE && $whole_url[$pos - 1] != "/") {
	$whole_url = substr_replace($whole_url, "/", $pos, 0);
	$changed_url = TRUE;
} else if($pos == FALSE && substr($whole_url, -1) != '/') {
	$whole_url = $whole_url . "/";
	$changed_url = TRUE;
}
if($changed_url) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: " . $whole_url);
	exit();
}

//page view count

$sql     = $db->query("SELECT hits FROM yb_posts WHERE id='$page_id'");
if($sql->num_rows>0){
	$row     = $sql->fetch_assoc();
	$hits    = $row['hits'];
}

// setting hits = 1, if we have no hits value

if (empty($hits)) {
	$hits    = 1;
	$sql1    = $db->query("UPDATE yb_posts SET hits='$hits' WHERE id='$page_id'");
}else{
// Incrementing counts value
	$plus_hits    = $hits+1;
	$sql2         = $db->query("update yb_posts set hits='$plus_hits' WHERE id='$page_id'");
}