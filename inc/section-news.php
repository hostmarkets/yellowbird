<!--Start Blog Style1 Area-->
<section class="blog-style1-area">
    <div class="container">
        <div class="sec-title text-center">
            <h3>OUR NEWS</h3>
            <h2>Articles From Resources<br> <span>And Latest News.</span></h2>
        </div>
        <div class="row">
            <!--Start Single blog Style1-->
            <?php
            $query = $db->query("SELECT * FROM `yb_posts` WHERE post_type='news' AND post_status='publish' ORDER BY id DESC LIMIT 3");
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

                    $post_date_time = $row["post_date_time"];
                    $autho_id = $row["autho_id"];
                    $getAuthoQuery = $db->query("SELECT * FROM `author` WHERE `id`='$autho_id'");
                    $rowAuthoQuery = $getAuthoQuery->fetch_assoc();
                    $cat_id = $row["cat_id"];
                    $getCatQuery = $db->query("SELECT * FROM `yb_category` WHERE `id`='$cat_id'");
                    $rowCatQuery = $getCatQuery->fetch_assoc();
                    ?>
                    <div class="col-xl-4 col-lg-4">
                        <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <a href="<?php echo ROOT; ?>/<?php echo $row['post_title_seo_url']; ?>">
                                <div class="img-holder">
                                    <div class="inner">
                                        <img src="<?php echo $post_img; ?>" alt="<?php echo $row['post_title']; ?>">
                                    </div>
                                    <div class="date-box">
                                        <h3>
                                            <?php echo date('d', strtotime($post_date_time)); ?><br><span>
                                                <?php echo date('M', strtotime($post_date_time)); ?>
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                            </a>
                            <div class="text-holder">
                                <ul class="meta-info">
                                    <li><span class="flaticon-user thm-clr"></span><a
                                            href="<?php echo ROOT; ?>/author/<?php echo $rowAuthoQuery["autho_seo_url"]; ?>">By
                                            <?php echo $rowAuthoQuery['autho_name']; ?>
                                        </a></li>
                                    <li><span class="flaticon-open-archive thm-clr"></span><a
                                            href="<?php echo ROOT; ?>/news/category/<?php echo $rowCatQuery['cat_seo_url']; ?>">
                                            <?php echo ucwords($rowCatQuery['cat_name']); ?>
                                        </a></li>

                                </ul>
                                <h3><a href="<?php echo ROOT; ?>/<?php echo $row['post_title_seo_url']; ?>">
                                        <?php echo $row['post_title']; ?>
                                    </a></h3>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
            <!--End Single blog Style1-->

        </div>
    </div>
</section>
<!--End Blog Style1 Area-->