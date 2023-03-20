<!-- Start Main Slider -->
<section class="main-slider style1">
    <div class="slider-box">
        <!-- Banner Carousel -->
        <div class="banner-carousel owl-theme owl-carousel">
            <!-- Slide -->
            <?php
            $banQuery = $db->query("SELECT * FROM `yb_banners` WHERE `ban_status`='publish'");
            if (is_array($banQuery) || is_object($banQuery)) {
                foreach ($banQuery as $key => $banRow) {
                    $banImg = $banRow['ban_img'];
                    if (!empty($banImg)) {
                        if (file_exists("uploads/ban-images/" . $banImg)) {
                            $banImg = "uploads/ban-images/" . $banImg;
                        } else {
                            $banImg = "https://placehold.co/1920x800";
                        }
                    } else {
                        $banImg = "https://placehold.co/1920x800";
                    }

                    ?>
                    <div class="slide">
                        <div class="image-layer" style="background-image:url(<?php echo $banImg; ?>)">
                        </div>

                    </div>
                <?php }
            } ?>




        </div>
    </div>
</section>
<!-- End Main Slider -->