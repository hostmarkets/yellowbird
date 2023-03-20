<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $title; ?>
    </title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="<?php echo $meta_desc; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="YahooSeeker" content="<?php echo $metaIndex; ?>,<?php echo $metaFollow; ?>">
    <meta name="msnbot" content="<?php echo $metaIndex; ?>,<?php echo $metaFollow; ?>">
    <meta name="googlebot" content="<?php echo $metaIndex; ?>,<?php echo $metaFollow; ?>">
    <meta name="robots" content="<?php echo $metaIndex; ?>,<?php echo $metaFollow; ?>">

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $og_title; ?>">
    <meta property="og:description" content="<?php echo $meta_desc; ?>">
    <meta property="og:url" content="<?php echo $og_url; ?>">
    <meta property="og:site_name" content="Yellowbird Immigration">
    <meta property="og:image" content="<?php echo $og_img; ?>">
    <meta property="og:image:alt" content="<?php echo $og_img_alt; ?>">
    <meta name="twitter:card" content="<?php echo $og_title; ?>">
    <meta name="twitter:title" content="<?php echo $og_title; ?>">
    <meta name="twitter:site" content="@yellowbirdvisas">
    <meta name="twitter:image" content="<?php echo $og_img_alt; ?>">
    <meta name="twitter:creator" content="@yellowbirdvisas">
    <meta property="fb:app_id" content="">
    <link rel="canonical" href="<?php echo $ccu; ?>">

    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/imp.css">
    <link rel="stylesheet" href="css/custom-animate.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <link rel="stylesheet" href="css/hiddenbar.css">

    <link rel="stylesheet" href="css/color.css">
    <link href="css/color/theme-color.css" id="jssDefault" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/yellowbird-logo.webp">
    <link rel="icon" type="image/png" href="images/yellowbird-logo.webp" sizes="32x32">
    <link rel="icon" type="image/png" href="images/yellowbird-logo.webp" sizes="16x16">

    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Search box -->
    <script>
        $('#searchFormq').submit(function (e) {
            e.preventDefault();
            var search = $('.searchq').val();
            var url = $(this).attr('action');
            //alert('search='+search+ ' url='+url);
            window.location.href = url + search;
        });
    </script>

</head>

<body>
    <div class="boxed_wrapper">

        <!-- Main header -->
        <header class="main-header header-style-one">
            <div class="border-top" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1000"></div>
            <!--Start header-->
            <div class="header">
                <div class="container">
                    <div class="outer-box clearfix">
                        <!--Start Header Left-->
                        <div class="header-left clearfix pull-left">
                            <div class="logo">
                                <a href="<?php echo ROOT; ?>"><img src="images/yellowbird-logo.webp"
                                        alt="yellowbird-logo Logo"></a>
                            </div>
                        </div>
                        <!--End Header Left-->
                        <!--Start Header Right-->
                        <div class="header-right pull-right clearfix">
                            <div class="top">
                                <div class="header-contact-info">
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <span class="flaticon-worldwide thm-clr"></span>
                                            </div>
                                            <div class="title">
                                                <h3>1315, Devika Tower</h3>
                                                <p>Nehru Place, New Delhi, Delhi 110019</p>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="icon">
                                                <span class="flaticon-email thm-clr"></span>
                                            </div>
                                            <div class="title">
                                                <h3><a href="tel:918383969795">+91-838-396-9795</a></h3>
                                                <p><a
                                                        href="mailto:info@yellowbirdvisas.com">info@yellowbirdvisas.com</a>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="bottom clearfix">
                                <div class="left pull-left">
                                    <ul class="header-menu">

                                        <li><a href="#">Get A Free Consultation<i class="fa fa-angle-double-right"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a href="#">Apply Now<i class="fa fa-angle-double-right"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a href="#">Pay Now<i class="fa fa-angle-double-right"
                                                    aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="right pull-right">
                                    <div class="header-social-link">
                                        <ul>
                                            <li>
                                                <a href="https://www.facebook.com/395332580571639" target="_blank"><i
                                                        class="fa fa-facebook" aria-hidden="true"></i></a>
                                            </li>
                                            <li>
                                                <a href="https://www.instagram.com/yellowbirdimmigration"
                                                    target="_blank"><i class="fa fa-instagram"
                                                        aria-hidden="true"></i></a>
                                            </li>
                                            <li>
                                                <a href="https://www.linkedin.com/company/yellowbirdvisas"
                                                    target="_blank"><i class="fa fa-linkedin"
                                                        aria-hidden="true"></i></a>
                                            </li>
                                            <li>
                                                <a href="https://www.youtube.com/@ybinfo" target="_blank"><i
                                                        class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Header Right-->
                    </div>
                </div>
            </div>
            <!--End header -->

            <!--Start Header Bottom-->
            <div class="header-bottom">
                <div class="container">
                    <div class="outer-box clearfix">
                        <div class="header-bottom-left pull-left">

                            <div class="nav-outer clearfix">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler">
                                    <div class="inner">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </div>
                                </div>
                                <!-- Main Menu -->
                                <nav class="main-menu style1 navbar-expand-md navbar-light">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li <?php if ($page == '') {
                                                echo 'class="current"';
                                            } ?>><a
                                                    href="<?php echo ROOT; ?>">Home</a></li>
                                            <li <?php if ($page == 'about-us') {
                                                echo 'class="current"';
                                            } ?>><a href="about-us">About
                                                    Us</a></li>

                                            <li class="dropdown"><a href="visa">Visa</a>
                                                <ul>

                                                    <li><a href="student-visa">Student Visa</a></li>
                                                    <li><a href="business-visa">Business Visa</a></li>
                                                    <li><a href="job-seeker-visa">Job Seeker Visa</a></li>
                                                    <li><a href="tourist-visa">Tourist Visa</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="visa">Services</a>
                                                <ul>

                                                    <li><a href="student-visa">Student Visa</a></li>
                                                    <li><a href="business-visa">Business Visa</a></li>
                                                    <li><a href="job-seeker-visa">Job Seeker Visa</a></li>
                                                    <li><a href="tourist-visa">Tourist Visa</a></li>
                                                </ul>
                                            </li>

                                            <li><a href="blog">Blog</a></li>
                                            <li><a href="news">News</a></li>
                                            <li><a href="contact-us">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </nav>
                                <!-- Main Menu End-->
                            </div>

                        </div>
                        <div class="header-bottom-right clearfix pull-right">
                            <div class="outer-search-box-style1">
                                <div class="seach-toggle"><i class="fa fa-search"></i></div>
                                <ul class="search-box">
                                    <li>
                                        <form name="searchFormq" method="get" action="search" id="searchFormq">
                                            <div class="form-group">
                                                <input type="text" class="searchq" name="q" placeholder="Search Here"
                                                    required="">
                                                <button type="submit" name="rslt" value="1"><i
                                                        class="fa fa-search"></i></button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Bottom-->

            <!--Sticky Header-->
            <div class="sticky-header">
                <div class="container">
                    <div class="clearfix">
                        <!--Logo-->
                        <div class="logo float-left">
                            <a href="index.html" class="img-responsive"><img src="images/yellowbird-logo.webp"
                                    alt="yellowbird-logo" title="yellowbird-logo"></a>
                        </div>
                        <!--Right Col-->
                        <div class="right-col float-right">
                            <!-- Main Menu -->
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Sticky Header-->

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

                <nav class="menu-box">
                    <div class="nav-logo"><a href="index.html"><img src="images/yellowbird-logo.webp"
                                alt="yellowbird-logo"></a>
                    </div>
                    <div class="menu-outer">
                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                    </div>
                    <!--Social Links-->
                    <div class="social-links">
                        <ul class="clearfix">
                            <li><a href="#"><span class="fab fa fa-facebook-square"></span></a></li>
                            <li><a href="#"><span class="fab fa fa-twitter-square"></span></a></li>
                            <li><a href="#"><span class="fab fa fa-pinterest-square"></span></a></li>
                            <li><a href="#"><span class="fab fa fa-google-plus-square"></span></a></li>
                            <li><a href="#"><span class="fab fa fa-youtube-square"></span></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- End Mobile Menu -->
        </header>