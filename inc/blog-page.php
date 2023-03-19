<!--Start Blog Area-->
<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="blog-post">
                    <!--Start Single blog Style1-->
                    <?php
                    $selectBlogQuery = $db->query("SELECT * FROM `yb_posts` WHERE `post_type`='blog' AND `post_status`='publish'");
                    if (is_array($selectBlogQuery) || is_object($selectBlogQuery)) {
                        foreach ($selectBlogQuery as $rowBlogQuery) {
                            $post_title = $rowBlogQuery["post_title"];
                            $post_img = $rowBlogQuery["post_img"];
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
                            $post_date_time = $rowBlogQuery["post_date_time"];
                            $autho_id = $rowBlogQuery["autho_id"];
                            $getAuthoQuery = $db->query("SELECT * FROM `author` WHERE `id`='$autho_id'");
                            $rowAuthoQuery = $getAuthoQuery->fetch_assoc();
                            $cat_id = $rowBlogQuery["cat_id"];
                            $getCatQuery = $db->query("SELECT * FROM `yb_category` WHERE `id`='$cat_id'");
                            $rowCatQuery = $getCatQuery->fetch_assoc();

                            ?>
                            <div class="single-blog-style1 style1instyle3 wow fadeInLeft" data-wow-delay="100ms"
                                data-wow-duration="1500ms">
                                <div class="img-holder">
                                    <div class="inner">
                                        <img src="<?php echo $post_img; ?>" alt="<?php echo $post_img_alt_text; ?>">
                                    </div>
                                    <div class="date-box">
                                        <h3>
                                            <?php echo date('d', strtotime($post_date_time)); ?><br><span>
                                                <?php echo date('M', strtotime($post_date_time)); ?>
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="text-holder">
                                    <ul class="meta-info">
                                        <li><span class="flaticon-user thm-clr"></span><a
                                                href="author/<?php echo $rowAuthoQuery["autho_seo_url"]; ?>">By <?php echo $rowAuthoQuery['autho_name']; ?></a></li>
                                        <li><span class="flaticon-open-archive thm-clr"></span><a href="#">
                                                <?php echo ucwords($rowCatQuery['cat_name']); ?>
                                            </a></li>
                                        <li><span class="flaticon-conversation thm-clr"></span><a href="#">02</a></li>
                                    </ul>
                                    <h3><a href="<?php echo $rowBlogQuery["post_title_seo_url"]; ?>"><?php echo $post_title; ?></a>
                                    </h3>
                                    <!-- <div class="text">
                                        <p>We provides the simplest solution for processing your all types of visa. Say
                                            goodbye to endless hassles and confusions.</p>
                                    </div> -->
                                </div>
                            </div>
                        <?php }
                    } ?>
                    <!--End Single blog Style1-->


                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <ul class="styled-pagination text-center clearfix">
                            <li class="prev"><a href="#"><span class="fa fa-angle-left"></span></a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#" class="active">2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="next"><a href="#"><span class="fa fa-angle-right"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!--Start sidebar Wrapper-->
            <div class="col-xl-4 col-lg-5 col-md-9 col-sm-12">
                <div class="sidebar-wrapper">

                    <!--Start sidebar categories Box-->
                    <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="1200ms">
                        <div class="title">
                            <h3>Categories</h3>
                        </div>
                        <div class="categories-box">
                            <ul class="categories clearfix">
                                <?php
                                $getCatQuery = $db->query("SELECT * FROM `yb_category` WHERE `cat_status`='publish'");
                                while ($rowCatQuery = $getCatQuery->fetch_assoc()) {
                                    $catId = $rowCatQuery['id'];
                                    $checkPostQuery = $db->query("SELECT `id` FROM `yb_posts` WHERE `cat_id`='$catId'");
                                    ?>
                                    <li><a href="blog/category/<?php echo $rowCatQuery['cat_seo_url']; ?>">
                                            <?php echo $rowCatQuery['cat_name']; ?> <span>(<?php echo $checkPostQuery->num_rows;?>)</span>
                                        </a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!--End sidebar categories Box-->
                    <!--Start single sidebar-->
                    <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.5s" data-wow-duration="1200ms">
                        <div class="title">
                            <h3>Recent Post</h3>
                        </div>
                        <ul class="recent-posts">
                        <?php
                    $selectBlogQuery = $db->query("SELECT * FROM `yb_posts` WHERE `post_type`='blog' AND `post_status`='publish' LIMIT 3");
                    if (is_array($selectBlogQuery) || is_object($selectBlogQuery)) {
                        foreach ($selectBlogQuery as $rowBlogQuery) {
                            $post_title = $rowBlogQuery["post_title"];
                            $post_img = $rowBlogQuery["post_img"];
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
                            $post_date_time = $rowBlogQuery["post_date_time"];
                            ?>
                            
                            <li>
                                <div class="img-box">
                                    <img src="<?php echo $post_img;?>" alt="<?php echo $post_img_alt_text;?>">
                                    <div class="overlay-content">
                                        <a href="<?php echo $rowBlogQuery["post_title_seo_url"];?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="title-box">
                                    <h4><a href="<?php echo $rowBlogQuery["post_title_seo_url"];?>"><?php echo $post_title;?></a></h4>
                                    <div class="date"><?php echo date('d M Y', strtotime($post_date_time));?></div>
                                </div>
                            </li>
                            <?php }}?>
                           
                           

                        </ul>
                    </div>
                    <!--End single sidebar-->
                   
                   
                </div>
            </div>
            <!--End Sidebar Wrapper-->


        </div>
    </div>
</section>
<!--End Blog Area-->