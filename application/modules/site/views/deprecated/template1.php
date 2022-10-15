<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="CRM RS Community -- Bisnis pulsa prospek tinggi">
<meta name="author" content="Frans Filasta Pratama">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title><?php echo $title; ?></title>

<link rel="shortcut icon" href="assets/flatpad/img/favicon.ico" />

<!-- STYLES -->
<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/flatpad/css/fontello/fontello.css') ?>" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/flatpad/css/superfish.css'); ?>" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/flatpad/css/prettyPhoto.css') ?>" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/flatpad/css/skeleton.css') ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/flatpad/css/base.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/flatpad/css/style.css') ?>" />

<!--[if lt IE 9]> <script type="text/javascript" src="<?php echo('js/customM.js'); ?>"></script> <![endif]-->

</head>

<body>

<!-- Body Wrapper -->
<div class="body-wrapper">
    <!-- Header -->
    <header id="header">
      <!-- Topbar -->
      <div id="topbar">
          <div class="container">
          
              <!-- Logo -->
                <div class="logo">
                    <a href="#header" class="logo-wrap">
                        <img src="assets/flatpad/img/logo.png" alt="MyPassion" />
                    </a>
                </div>
                <!-- /Logo -->
                
                <!-- Nav -->
                <nav id="nav">
                  
                    <!-- Main Menu -->
                    <ul class="sf-menu m-top-40 m-bottom-40">
                            <li><a href="<?php echo site_url(); ?>">Home</a></li>
                            <li>
                                <a href="<?php echo site_url("blog"); ?>">Blog</a>
                                <ul>
                                    <?php foreach ($categories as $category) { ?>
                                    <li><a href="<?php echo site_url('category/'.$category->id_category.'/'.strtolower($category->category_name)); ?>"><?php echo $category->category_name;  ?></a></li>
                                    <?php } ?>
                                </ul>
                                
                            </li>
                            <li><a href="#service">Marketing</a></li>
                            <li><a href="#team">Contact</a></li>
                            <li><a href="<?php echo site_url('pasien/login') ?>">pasien</a></li>
                    </ul>
                    <!-- /Main Menu -->
                    
                    <!-- Mobile Nav Toggler -->
                    <div class="nav-toggle">
                        <a href="#"></a>
                    </div>
                    <!-- /Mobile Nav Toggler -->
                </nav>
                <!-- /Nav -->
            </div>
        </div>
        <!-- Topbar -->
        
        <!-- Mobile Menu -->
        <div class="mobile-menu">
          <div class="menu-device">
                <ul class="menu">
                        <li><a href="#header">Home</a></li>
                            <li>
                                <a href="#">Blog</a>
                                <ul>
                                    <li><a href="#">Beritaa</a></li>
                                    <li><a href="#">Pengumuman</a></li>
                                    <li><a href="#">Event</a></li>
                                    <li>
                                        <a href="#">Menu Level 2</a>
                                        <ul>
                                            <li><a href="#">Menu Level 3</a></li>
                                            <li><a href="#">Menu Level 3</a>
                                                <ul>
                                                    <li><a href="#">Menu Level 4</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                
                            </li>
                            <li><a href="#service">Marketing</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#contact">pasien</a></li>
                </ul>
            </div>
            <div class="mobile-menu-inner">
                <ul class="menu">
                        <li><a href="#header">Home</a></li>
                            <li>
                                <a href="#">Blog</a>
                                <ul>
                                    <li><a href="#">Beritaa</a></li>
                                    <li><a href="#">Pengumuman</a></li>
                                    <li><a href="#">Event</a></li>
                                    <li>
                                        <a href="#">Menu Level 2</a>
                                        <ul>
                                            <li><a href="#">Menu Level 3</a></li>
                                            <li><a href="#">Menu Level 3</a>
                                                <ul>
                                                    <li><a href="#">Menu Level 4</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                
                            </li>
                            <li><a href="#service">Marketing</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#contact">pasien</a></li>
                </ul>
            </div>
        </div>
        <!-- /Mobile Menu -->
    </header>
    <!-- /Header -->
    
    <?php echo $content; ?>
    
    <!-- Footer -->
    <footer id="footer">
      <div class="container">
          <div class="row">
              <div class="span6">
                    <p class="copyright"> © 2013 <a href="#">FlatPad.</a> All Rights Reserved.</p>
                </div>
                <div class="span6">
                    <ul class="social-list-1">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                        <li><a href="#"><i class="icon-rss"></i></a></li>
                        <li><a href="#"><i class="icon-skype"></i></a></li>
                        
                        <!--
                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                        <li><a href="#"><i class="icon-vimeo"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-flickr"></i></a></li>
                        <li><a href="#"><i class="icon-github"></i></a></li>
                        <li><a href="#"><i class="icon-gplus"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#"><i class="icon-tumblr"></i></a></li>
                        <li><a href="#"><i class="icon-lastfm"></i></a></li>
                        <li><a href="#"><i class="icon-instagram"></i></a></li>
                        <li><a href="#"><i class="icon-reddit"></i></a></li>
                        <li><a href="#"><i class="icon-yahoo"></i></a></li>
                        <li><a href="#"><i class="icon-forrst"></i></a></li>
                        <li><a href="#"><i class="icon-digg"></i></a></li>
                        <li><a href="#"><i class="icon-odnoklassniki"></i></a></li>
                        <li><a href="#"><i class="icon-yandex-rect"></i></a></li>
                        <li><a href="#"><i class="icon-behance"></i></a></li>
                        <li><a href="#"><i class="icon-google-circles"></i></a></li>
                        <li><a href="#"><i class="icon-vkontakte"></i></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- / Footer -->
</div>
<!-- / Body Wrapper -->

<!-- SCRIPTS -->
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/easing.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/jquery.sticky.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/modernizr.custom.97074.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/customM.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/hoverdir.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/prettyPhoto.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/superfish.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/carouFredSel.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/cycle.js') ?>"></script>

<!--[if lt IE 9]> <script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/html5.js') ?>"></script> <![endif]-->
<script type="text/javascript" src="<?php echo site_url('assets/flatpad/js/mypassion.js') ?>"></script>


</body>
</html>
