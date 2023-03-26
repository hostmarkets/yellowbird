<?php
if ($post_type == "blog") {
    include('inc/blog-page.php');
} elseif ($post_type == "news") {
    include('inc/news-page.php');
} elseif ($page == 'about-us') { ?>
    <!--Start About Style1 Area-->
    <section class="about-style1-area pdtop100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="about-style1-text-box pdtop0-r">
                        <div class="sec-title">
                            <h3>ABOUT US</h3>

                        </div>
                        <div class="inner-contant">
                            <div class="text">
                                <p>We are a group of professionals with Dedicated experience in the industry since 2011.

                                    our professional documentation experts are well equiped with exquisite knowledge of
                                    immigration & have worked in the industry</p>
                            </div>
                            <ul>
                                <li>Helped 10000+ clients</li>
                                <li>500+ PR Approvals</li>
                                <li>1000+ Study Apporovals & Open Work Permits</li>
                                <li>No count - Tourist/ Visit</li>
                            </ul>
                            <div class="bottom-box">
                                <div class="left">
                                    <div class="button">
                                        <a class="btn-one" href="<?php echo ROOT; ?>/contact-us"><span class="txt">Contact
                                                Now<i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="icon">
                                        <span class="flaticon-24-hours thm-clr"></span>
                                    </div>
                                    <div class="phone">
                                        <a href="tel:918383969795">+91-838-396-9795</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="about-style1-image-box clearfix">
                        <div class="image-box clearfix">
                            <div class="main-image"><img src="images/about-1.jpg" alt="about-1 image"></div>
                            <div class="inner">
                                <img class="" src="images/about-2.jpg" alt="about-2 Image">
                                <div class="icon"><span class="flaticon-people-1"></span></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End About Style1 Area-->
    <?php
    include 'inc/section-who-we-are.php';
    include 'inc/section-why-choose.php';
    include 'inc/section-slogan.php';
    include 'inc/section-fact-counter.php';
} elseif ($page === 'countries') { ?>
    <!--Start Select Country Style3 Area-->
    <section class="select-country-style3-area country-page">
        <div class="container">
            <div class="row">
                <!--Start Single select Country style3-->
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
                        <div class="col-xl-4 col-lg-4">
                            <div class="single-select-country-style3">
                                <a href="<?php echo ROOT . '/' . $row['post_title_seo_url']; ?>">
                                    <div class="img-holder">
                                        <div class="inner">
                                            <img src="<?php echo $post_img; ?>" alt="<?php echo $row['post_title']; ?>">
                                        </div>

                                    </div>
                                </a>
                                <div class="text-holder">
                                    <div class="icon"><span class="flaticon-technology"></span></div>
                                    <h3>
                                        <?php echo $row['post_title']; ?>
                                    </h3>
                                    <p>
                                        <?php echo $string; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
                <!--End Single select Country style3-->


            </div>
        </div>
    </section>
    <!--End Select Country Style3 Area-->
<?php } elseif ($page === 'contact-us') { ?>
    <!--Start Contact Form Section-->
    <section class="contact-form-area">
        <div class="container">
            <div class="title text-center">
                <h2>Get in Touch</h2>
                <p>Feel free to get in touch with me. We alwasy open to discussing now projects,<br> createive ideas
                    or opportunities to be part of your visions</p>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="contact-form">
                        <form id="contact-form" name="contact_form" class="default-form2" action="form-action.php"
                            method="post">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="input-box">
                                        <input type="text" name="form_name" value="" placeholder="Name" required="">
                                    </div>
                                    <div class="input-box">
                                        <input type="text" name="form_phone" value="" placeholder="Phone" required="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="input-box">
                                        <input type="email" name="form_email" value="" placeholder="Email" required="">
                                    </div>
                                    <div class="input-box">
                                        <input type="text" name="form_subject" value="" placeholder="Subject" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="input-box">
                                        <textarea name="form_message" placeholder="Message" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="button-box text-center">
                                        <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden"
                                            value="">
                                        <button class="btn-one" type="submit" data-loading-text="Please wait...">
                                            <span class="txt">Send Massage</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End Contact Form Section-->
    <!--Start Get In Touch Area-->
    <section class="getin-touch-area" style="background-image: url(images/getin-touch-bg.jpg)">
        <div class="container">
            <div class="row">

                <div class="col-xl-7">
                    <div class="map-outer">
                        <!--Map Canvas-->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14018.988510052477!2d77.2503488!3d28.5473195!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf4332b83c667bbff!2sYellowbird%20Immigration%20Services%20Pvt.%20Ltd.%20*21%20Best%20Immigration%20Consultants%20in%20Delhi!5e0!3m2!1sen!2sin!4v1678037178863!5m2!1sen!2sin"
                            width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <div class="col-xl-5">
                    <div class="getin-touch-content">
                        <div class="sec-title">
                            <h3>Contact</h3>
                            <h2><span>Get in Touch Now</span></h2>
                        </div>
                        <div class="inner-content">
                            <ul class="contact-info">
                                <li class="single">
                                    <div class="icon">
                                        <span class="flaticon-worldwide thm-clr"></span>
                                    </div>
                                    <div class="text">
                                        <h4>1315, Devika Tower
                                            Nehru Place,</h4>
                                        <p>New Delhi, Delhi 110019</p>
                                    </div>
                                </li>
                                <li class="single">
                                    <div class="icon">
                                        <span class="flaticon-mail-1 thm-clr"></span>
                                    </div>
                                    <div class="text">
                                        <h4>Send Your Mail At</h4>
                                        <p><a href="mailto:info@yellowbirdvisas.com">info@yellowbirdvisas.com</a>
                                        </p>
                                    </div>
                                </li>
                                <li class="single">
                                    <div class="icon">
                                        <span class="flaticon-countdown thm-clr"></span>
                                    </div>
                                    <div class="text">
                                        <h4>Working Hours</h4>
                                        <p>Mon-Sat:10.00am To 6.00pm</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="social-media-box">
                                <h3>Social Media</h3>
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/395332580571639"><i class="fa fa-facebook"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/yellowbirdimmigration"><i class="fa fa-instagram"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/company/yellowbirdvisas"><i class="fa fa-linkedin"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/@ybinfo"><i class="fa fa-youtube-play"
                                                aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End Get In Touch Area-->
<?php } else { ?>
    <!--Start Content Area-->
    <section class="visa-detail-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <div class="visa-detail-content">
                        <div class="img-box">
                            <img src="<?php echo $post_img; ?>" alt="<?php echo $post_title; ?>">
                        </div>
                        <div class="text-box">
                            <h2>
                                <?php echo $post_title; ?>
                            </h2>
                            <p>
                                <?php echo $post_content; ?>
                            </p>


                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="sidebar-style1">

                        <div class="single-sidebar-style1 last-child">
                            <div class="title">
                                <p>You Select Now</p>
                                <h3>The Destiation To Fly!</h3>
                            </div>
                            <div class="visa-form-box">
                                <form id="visa-form" name="visa_form" class="default-form2" action="form-action.php"
                                    method="post">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="input-box">
                                                <input type="text" name="form_name" value="" placeholder="Name" required="">
                                                <div class="icon"><span class="flaticon-user"></span></div>
                                            </div>
                                            <div class="input-box">
                                                <select name="form_country" class="selectpicker" data-width="100%"
                                                    required="">
                                                    <option value="" selected="selected">Choose Country</option>
                                                    <?php
                                                    $selectQuery = $db->query("SELECT `name` FROM `countries`");
                                                    if (is_array($selectQuery) || is_object($selectQuery)) {
                                                        foreach ($selectQuery as $key => $selectRow) {
                                                            ?>
                                                            <option value="<?php echo $selectRow['name']; ?>">
                                                                <?php echo $selectRow['name']; ?>
                                                            </option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="input-box">
                                                <input type="text" name="form_phone" value="" placeholder="Phone"
                                                    required="">
                                                <div class="icon"><span class="flaticon-telephone"></span></div>
                                            </div>
                                            <div class="input-box">
                                                <input type="email" name="form_email" value="" placeholder="Email"
                                                    required="">
                                                <div class="icon"><span class="flaticon-mail-2"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="input-box">
                                                <select name="form_visa" class="selectpicker" data-width="100%" required="">
                                                    <option value="" selected="selected">Choose Visa</option>
                                                    <option>PR Visa</option>
                                                    <option>Student Visa</option>
                                                    <option>Tourist / Visit Visa</option>
                                                    <option>Job Seeker Visa</option>
                                                    <option>Spouse Visa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="button-box">
                                                <button class="btn-one" type="submit">
                                                    <span class="txt">Apply Now</span>
                                                </button>
                                                <input type="hidden" name="sideBarForm">
                                                <input type="hidden" name="urlAddress" value="<?php echo $REQUEST_URI; ?>">
                                                <input type="hidden" name="utmSource" value="<?php echo $utmSource; ?>">
                                                <input type="hidden" name="utmMedium" value="<?php echo $utmMedium; ?>">
                                                <input type="hidden" name="utmCampaign" value="<?php echo $utmCampaign; ?>">
                                                <input type="hidden" name="gclid" value="<?php echo $gclid; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!--End Single Sidebar Style1-->
                    </div>
                </div>



            </div>
        </div>
    </section>
    <!--End Content Area-->
<?php } ?>