<!--Start Visa Area-->
<section class="visa-area">
    <div class="container">
        <div class="sec-title text-center">
            <h3>CHOOSE YOUR VISA</h3>
            <h2>With Migrate Immigration Visa<br> <span>Service We Provide.</span></h2>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="theme-carousel event-carousel owl-carousel owl-theme owl-dot-style1"
                    data-options='{"loop":true, "margin":40, "autoheight":true, "nav":false, "dots":true, "autoplay":true, "stagePadding":15, "autoplayTimeout":10000, "smartSpeed":700, "responsive":{ "0":{"items": "1"}, "500":{"items": "1"}, "767":{"items": "2"}, "1199":{"items": "3"}, "1600":{"items": "3"} }}'>
                    <!--Start Single Visa Box-->
                    <?php
                    $query = $db->query("SELECT * FROM `yb_posts` WHERE post_type='page' AND post_status='publish' AND post_title IN ('PR Visa','Student Visa','Tourist / Visit Visa','Job Seeker Visa','Spouse Visa') ORDER BY sort_order");
                    if (is_array($query) or is_object($query)) {
                        foreach ($query as $row) {
                            $post_img = $row['post_img'];
                            if (!empty($post_img)) {
                                if (file_exists('uploads/post-images/' . $post_img)) {
                                    $post_img = 'uploads/post-images/' . $post_img;
                                } else {
                                    $post_img = 'https://placehold.co/1200x628';
                                }
                            } else {
                                $post_img = 'https://placehold.co/1200x628';
                            }
                            // strip tags to avoid breaking any html
                            $string = $row['meta_description'];
$string = strip_tags($string);
if (strlen($string) > 10) {

    // truncate string
    $stringCut = substr($string, 0, 10);
    $endPoint = strrpos($stringCut, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
    $string .= '...';
}
                            ?>
                            <div class="single-visa-box">
                            <a href="<?php echo ROOT . '/' . $row['post_title_seo_url']; ?>">
                                <div class="img-holder">
                                    <div class="inner">
                                        <img src="<?php echo $post_img; ?>" alt="<?php echo $row['post_title']; ?>">
                                        <div class="overlay-style-one bg1"></div>
                                    </div>

                                </div>
</a>
                                <div class="text-holder">
                                    <h3><a href="<?php echo ROOT . '/' . $row['post_title_seo_url']; ?>">
                                            <?php echo $row['post_title']; ?>
                                        </a></h3>
                                    <p>
                                        <?php echo $string; ?>
                                    </p>
                                </div>
                            </div>
                        <?php }
                    } ?>
                    <!--End Single Visa Box-->

                </div>
            </div>

        </div>
    </div>
</section>
<!--End Visa Area-->