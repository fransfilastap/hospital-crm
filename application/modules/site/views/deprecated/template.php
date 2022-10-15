
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Counter Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Bisnis Pulsa Membuat menjadi Kaya raya">
    <meta name="author" content="SI2010">
    <!-- Le styles -->
    <link href="<?php echo site_url('assets/back/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo site_url('assets/back/themes/css/main.css');?>" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
  </head>

<body>
<div class="container">
  <!-- Navbar
    ================================================== -->
    <div class="navbar">
        <div class="container">
          <button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="row"><h3 class="loadhome span3"><a href="index.html">Counter Online</a></h1>
			  <div class="nav-collapse collapse"><br/>
				<ul class="nav pull-right">
					<li class="active"><a href="<?php echo site_url();?>">Home</a></li>
					<li class="" ><a href="aboutus.html">Abount us</a></li>
					
					<li class=""><a href="blog">Blog</a></li>
					<li class=""><a href="contact.html">Contact</a></li>
					
				</ul>
			  </div>
		  </div>
        </div>
    </div>
	<div class="row"> 
	<div class="span12" style="
	
	background: rgb(238,238,238); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(238,238,238,1) 0%, rgba(238,238,238,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(238,238,238,1)), color-stop(100%,rgba(238,238,238,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(238,238,238,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(238,238,238,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(238,238,238,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(238,238,238,1) 0%,rgba(238,238,238,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#eeeeee',GradientType=0 ); /* IE6-9 */



	padding-top:5px; ">
	<ul class="nav nav-pills" style="margin-bottom:5px; margin-left:10px;">
	<?php
		foreach($menus as $menu){
			if(!isset($menu['child'])){
			echo "<li ><a href=".$menu['menu_link'].">".$menu['menu_name']."</a>  </li>";}
			else{
			echo "<li class='dropdown'>
			<a class='dropdown-toggle'
       data-toggle='dropdown'
       href='".$menu['menu_link']."'>
        ".$menu['menu_name']."
        <b class='caret'></b>
      </a>";
      	echo "<ul class='dropdown-menu'>";

             foreach($menu['child'] as $child){
             	echo "<li ><a href=".$child->menu_content.">".$child->menu_title."</a>  </li>";
             }
        echo "</ul>";

       }

			}
		
	?>

</ul></div></div>


 <?php echo $content; ?>
	
		
 <!-- Footer
 ================================================== -->
<footer class="footer">
	<div class="container">
		<div class="span4 pull-right">
			<a href="#"><img style="max-width:45px" src="<?php echo site_url('assets/back/themes/css/images/facebook.png')?>" title="facebook"></a>
			<a href="#"><img style="max-width:45px" src="<?php echo site_url('assets/back/themes/css/images/twitter.png')?>" title="twitter"></a>
			<a href="#"><img style="max-width:45px" src="<?php echo site_url('assets/back/themes/css/images/rss.png');?>" title="rss"></a>
			<a href="#"><img style="max-width:45px" src="<?php echo site_url('assets/back/themes/css/images/youtube.png');?>" title="youtube"></a>
		</div>
		<p>&copy;2012 <br/><em> Copyright informations <a href="#">Terms and Conditions, </a> <a href="comingsoon.html">Coming soon page</a></em></p>
	</div>
</footer>
<br/>
</div><!-- /container -->
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo site_url('assets/back/bootstrap/js/jquery.js') ?>"></script>	
    <script src="<?php echo site_url('assets/back/bootstrap/js/bootstrap.min.js') ?>"></script>
	
</body>
</html>
