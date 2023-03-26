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
    <style>
        .modal {
            z-index: 999999;
        }

        .enquiry-now {
            text-align: right;
            position: fixed;
            transform: rotate(270deg);
            right: -40px;
            top: 50%;
            z-index: 10;
        }
    </style>

</head>

<body>
    <div class="boxed_wrapper">

        <!-- Main header -->
        <header class="main-header header-style-five">
            <div class="header-top-style4">
                <div class="container">
                    <div class="outer-box clearfix">
                        <div class="header-top-left-style4 pull-left">
                            <ul>
                                <li><span class="flaticon-location-marker"></span>1315, Devika Tower,Nehru Place, New
                                    Delhi, Delhi 110019
                                </li>
                                <li><span class="flaticon-mail-2"></span><a
                                        href="mailto:info@yellowbirdvisas.com">info@yellowbirdvisas.com</a></li>
                            </ul>
                        </div>
                        <div class="header-top-right-style4 pull-right">
                            <div class="header-social-link-style4">
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/395332580571639" target="_blank"><i
                                                class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/yellowbirdimmigration" target="_blank"><i
                                                class="fa fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/company/yellowbirdvisas" target="_blank"><i
                                                class="fa fa-linkedin" aria-hidden="true"></i></a>
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
            </div>
            <!--Start header-->
            <div class="header-style5">
                <div class="container">
                    <div class="outer-box clearfix">
                        <!--Start Header Left-->
                        <div class="header-left-style5 pull-left">
                            <div class="logo">
                                <a href="<?php echo ROOT; ?>"><img src="images/yellowbird-logo.webp"
                                        alt="Yellowbird Logo" title=""></a>
                            </div>
                        </div>
                        <!--End Header Left-->
                        <!--Start Header Right-->
                        <div class="header-right-style5 pull-right clearfix">
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
                                <nav class="main-menu style5 navbar-expand-md navbar-light">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li <?php if ($page == '') {
                                                echo 'class="current"';
                                            } ?>><a       href="<?php echo ROOT; ?>">Home</a></li>
                                            <li <?php if ($page == 'about-us') {
                                                echo 'class="current"';
                                            } ?>><a       href="<?php echo ROOT; ?>/about-us">About
                                                    Us</a></li>
                                            <li class="dropdown <?php if ($page == 'countries') {
                                                echo 'current';
                                            } ?>"><a href="<?php echo ROOT; ?>/countries">Countries</a>
                                                <ul>

                                                    <li><a href="<?php echo ROOT; ?>/canada">Canada</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/australia">Australia</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/uk">UK</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/europe">Europe</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/singapore">Singapore</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/uae">UAE</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/new-zealand">New Zealand</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown <?php if ($page == 'visa') {
                                                echo 'current';
                                            } ?>"><a href="visa">Visa</a>
                                                <ul>

                                                    <li><a href="<?php echo ROOT; ?>/pr-visa">PR Visa</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/student-visa">Student Visa</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/tourist-visit-visa">Tourist / Visit
                                                            Visa</a></li>
                                                    <li><a href="<?php echo ROOT; ?>/job-seeker-visa">Job Seeker
                                                            Visa</a>
                                                    </li>
                                                    <li><a href="<?php echo ROOT; ?>/spouse-visa">Spouse Visa</a></li>

                                                </ul>
                                            </li>

                                            <li class="dropdown <?php if ($page == 'services') {
                                                echo 'current';
                                            } ?>"><a href="visa">Services</a>
                                                <ul>

                                                    <li><a href="<?php echo ROOT; ?>/ielts">IELTS</a></li>

                                                </ul>
                                            </li>

                                            <li <?php if ($page == 'blog') {
                                                echo 'class="current"';
                                            } ?>><a       href="<?php echo ROOT; ?>/blog">Blog</a></li>
                                            <li <?php if ($page == 'news') {
                                                echo 'class="current"';
                                            } ?>><a href="<?php echo ROOT; ?>/news">News</a></li>
                                            <li <?php if ($page == 'contact-us') {
                                                echo 'class="current"';
                                            } ?>><a href="<?php echo ROOT; ?>/contact-us">Contact Us</a></li>

                                        </ul>
                                    </div>
                                </nav>
                                <!-- Main Menu End-->
                            </div>

                            <div class="btns-box">
                                <a class="btn-one style2" href="#"><span class="txt">Apply Now<i
                                            class="fa fa-angle-double-right" aria-hidden="true"></i></span></a>
                            </div>

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

                            <div class="any-questions-box style3">
                                <div class="icon">
                                    <span class="flaticon-speech-bubble"></span>
                                </div>
                                <div class="title">
                                    <h4>Have any Questions?</h4>
                                    <a href="tel:918383969795">+91-838-396-9795</a>
                                </div>
                            </div>

                        </div>
                        <!--End Header Right-->
                    </div>
                </div>
            </div>
            <!--End header -->

            <!--Sticky Header-->
            <div class="sticky-header">
                <div class="container">
                    <div class="clearfix">
                        <!--Logo-->
                        <div class="logo float-left">
                            <a href="<?php echo ROOT; ?>" class="img-responsive"><img src="images/yellowbird-logo.webp"
                                    alt="yellowbird-logo"></a>
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
                    <div class="nav-logo"><a href="<?php echo ROOT; ?>"><img src="images/yellowbird-logo.webp"
                                alt="yellowbird-logo"></a></div>
                    <div class="menu-outer">
                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                    </div>
                    <!--Social Links-->
                    <div class="social-links">
                        <ul class="clearfix">
                            <li><a href="https://www.facebook.com/395332580571639" target="_blank"><span
                                        class="fab fa fa-facebook-square"></span></a></li>
                            <li><a href="https://www.instagram.com/yellowbirdimmigration" target="_blank"><span
                                        class="fab fa fa-instagram"></span></a></li>
                            <li><a href="https://www.linkedin.com/company/yellowbirdvisas" target="_blank"><span
                                        class="fab fa fa-linkedin-square"></span></a></li>
                            <li><a href="https://www.youtube.com/@ybinfo" target="_blank"><span
                                        class="fab fa fa-youtube-play"></span></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- End Mobile Menu -->
        </header>
        <section class="alert-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if (!empty($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } ?>
                    </div>
                </div>
            </div>
        </section>