<!--Start Select Country Area-->
<section class="select-country-area" style="background-image: url(images/parallax-background/select-country-bg.jpg)">
    <div class="container">
        <div class="sec-title text-center">
            <h3>Select COUNTRY</h3>
            <h2>Choose Your Country<br> <span>For Immigration.</span></h2>
        </div>
        <div class="row">
            <!--Start Single select Country-->
            <?php
            $query = $db->query("SELECT * FROM `yb_posts` WHERE post_type='page' AND post_status='publish' AND post_title IN ('Canada','Australia','UK','Europe') ORDER BY sort_order LIMIT 4");
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
                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $string .= '...';
                    }
                    ?>
                    <div class="col-xl-6">
                        <div class="single-select-country">
                            <div class="img-holder">
                                <img src="<?php echo $post_img; ?>" alt="<?php echo $row['post_title']; ?>">
                            </div>
                            <div class="text-holder">
                                <h3>
                                    <?php echo $row['post_title']; ?>
                                </h3>
                                <p>
                                    <?php echo $string; ?>
                                </p>
                                <a href="<?php echo ROOT . '/' . $row['post_title_seo_url']; ?>">Read More<span
                                        class="flaticon-right"></span></a>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
            <!--End Single select Country-->

        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="view-all-country-button text-center">
                    <p>Challenges are just opportunities in disguise. <a href="countries">View all country!</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Select Country Area-->