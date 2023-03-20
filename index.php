<?php
include 'config/config.php';
include 'config/helper.php';
if ($page == "" && $postId != "") {
    include 'inc/header.php';
    include 'inc/home-page-banner-slider.php';
    include 'inc/section-visa.php';
    include 'inc/section-visa-assessment.php';
    include 'inc/section-country.php';
    include 'inc/section-why-choose.php';
    include 'inc/section-slogan.php';
    include 'inc/section-blog.php';
    include 'inc/footer.php';
} elseif ($page != "" && $postId != "") {
    include 'inc/header.php';
    include 'inc/single-page.php';
    include 'inc/footer.php';
} elseif ($page != "" && $newsCatId != "") {
    include 'inc/header.php';
    include 'inc/news-cat-page.php';
    include 'inc/footer.php';
} elseif ($page != "" && $tagId != "") {
    include 'inc/header.php';
    include 'inc/tag-page.php';
    include 'inc/footer.php';
} elseif ($page != "" && $authoId != "") {
    include 'inc/header.php';
    include 'inc/autho-page.php';
    include 'inc/footer.php';
} elseif ($page != "" && $page == "blog") {
    include 'inc/header.php';
    include 'inc/blog-page.php';
    include 'inc/footer.php';
} elseif ($page != "" && $page == "news") {
    include 'inc/header.php';
    include 'inc/news-page.php';
    include 'inc/footer.php';
} elseif ($page != "" && $page == "search") {
    include 'inc/header.php';
    include 'inc/search-page.php';
    include 'inc/footer.php';
} elseif ($page != "" && $page == "thank-you") {
    include 'inc/header.php';
    include 'inc/thank-you-page.php';
    include 'inc/footer.php';
} elseif ($page != "" && $page == "sitemap-index.xml") {
    include 'sitemap-index.php';
} elseif ($page != "" && $page == "page-sitemap.xml") {
    include 'page-sitemap.php';
} elseif ($page != "" && $page == "post-sitemap.xml") {
    include 'post-sitemap.php';
} elseif ($page != "" && $page == "pr-news-sitemap.xml") {
    include 'pr-news-sitemap.php';
} elseif ($page != "" && $page == "news-sitemap.xml") {
    include 'news-sitemap.php';
} elseif ($page != "" && $page == "feed") {
    include 'feed.php';
} else {
    header("HTTP/1.1 404 Not Found");
    include 'inc/header.php';
    include 'inc/error-page.php';
    include 'inc/footer.php';
}
?>