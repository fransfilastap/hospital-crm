<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php echo $title; ?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="<?php echo base_url("assets/back/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" />
	<link href="<?php echo base_url("assets/back/css/metro.css") ?>" rel="stylesheet" />
	<link href="<?php echo base_url("assets/back/bootstrap/css/bootstrap-responsive.min.css") ?>" rel="stylesheet" />
	<link href="<?php echo base_url("assets/back/font-awesome/css/font-awesome.css") ?>" rel="stylesheet" />
	<link href="<?php echo base_url("assets/back/css/style.css") ?>" rel="stylesheet" />
	<link href="<?php echo base_url("assets/back/css/style_responsive.css") ?>" rel="stylesheet" />
	<link href="<?php echo base_url("assets/back/css/style_default.css") ?>" rel="stylesheet" id="style_color" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/gritter/css/jquery.gritter.css") ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/uniform/css/uniform.default.css") ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/bootstrap-daterangepicker/daterangepicker.css") ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css") ?>">
	<link href="<?php echo base_url("assets/back/fullcalendar/fullcalendar/bootstrap-fullcalendar.css") ?>" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/bootstrap-wysihtml5/bootstrap-wysihtml5.css"); ?>">
	<link href="<?php echo base_url("assets/back/jqvmap/jqvmap/jqvmap.css") ?>" media="screen" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url("assets/back/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js") ?>" media="screen" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url("assets/back//jquery-tags-input/jquery.tagsinput.min.js") ?>" media="screen" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/chosen-bootstrap/chosen/chosen.css") ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/jquery-tags-input/jquery.tagsinput.css") ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/bootstrap-timepicker/compiled/timepicker.css") ?>"  /> 
	   <?php if(!isset($js_files)){
   echo "<script type='text/javascript' src='". base_url('assets/back/js/jquery-1.8.3.min.js') ."'></script>"; 
   echo "<script type='text/javascript' src='". base_url('assets/back/js/jquery.blockui.js') ."'></script>"; }
   ?>


	<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
	<div class="row-fluid">
		<div class="span12" id="notification_response"></div>
	</div>
	<!-- BEGIN HEADER -->
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="<?php echo site_url() ?>" target="_blank" >
				<img src="<?php echo base_url("assets/back/img/logo.png") ?>" alt="logo" />
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="<?php echo base_url("assets/back/img/menu-toggler.png") ?>" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->				
				<!-- BEGIN TOP NAVIGATION MENU -->					
				<ul class="nav pull-right">
				<!-- BEGIN E-KONSULTASI DROPDOWN -->
				<?php 
					$role = $this->session->userdata("current_admin_role");
				if( strtolower($role) == "dokter" || strtolower($role) == "superuser" ){ ?>
					<li class="dropdown" id="header_ekonsultasi_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-comment"></i>
						<span id="question_badge" class="badge">0</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>Anda mempunyai <span id="total_pertanyaan">0</span> pertanyaan baru</p>
							</li>
							<div id="question_append">
							</div>
							<li class="external">
								<a href="<?php echo site_url("admin/ekonsultasi") ?>">Lihat semua ekonsultasi baru <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
				<?php } ?>
				<!-- END E-KONSULTASI DROPDOWN -->
				<?php if( strtolower($role) == "admin" || strtolower($role) == "superuser" ){ ?>
				<!-- BEGIN VISIT NOTIFICATION DROPDOWN -->	
					<li class="dropdown" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-warning-sign"></i>
						<span id="kunjungan_badge" class="badge">0</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>Anda mempunyai <span id="total_kunjungan">0</span> kunjungan baru</p>
							</li>
							<div id="feedback_append">
							</div>
							<li class="external">
								<a href="#">See all notifications <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
				<?php } ?>
				<?php if( strtolower($role) == "admin" || strtolower($role) == "superuser" ){ ?>
					<!-- BEGIN INBOX DROPDOWN -->
					<li class="dropdown" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelope-alt"></i>
						<span id="message_badge" class="badge">0</span>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li>
								<p>Anda mempunyai <span id="total_pesan">0</span> pesan baru</p>
							</li>
							<div id="message_append">
							</div>
							<li class="external">
								<a href="<?php echo site_url("admin/smsgateaway") ?>">Lihat semua pesan masuk <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
				<?php } ?>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img alt="" src="<?php echo base_url("assets/back/img/avatar1_small.jpg") ?>" />
						<span class="username"><?php echo current_admin_name(); ?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url("admin/profil") ?>"><i class="icon-user"></i> Profil</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo base_url("admin/logout") ?>"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU -->	
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
			<div class="slide hide">
				<i class="icon-angle-left"></i>
			</div>
			<form class="sidebar-search" />
				<div class="input-box">
					<input type="text" class="" placeholder="Search" />
					<input type="button" class="submit" value=" " />
				</div>
			</form>
			<div class="clearfix"></div>
			<!-- END RESPONSIVE QUICK SEARCH FORM -->
			<!-- BEGIN SIDEBAR MENU -->
			<ul>
			<?php foreach ($menus as $key => $menu) { ?>
				<li class="<?php 
								if( $menu['has_sub'] ) echo "has-sub"; 
								if( $menu['selected'] ) echo " active";
							?>">
					<a href="<?php echo ( $menu['has_sub'] == TRUE ? 'javascript:;' : $menu['href'] ) ?>" class="">
					<i class="<?php echo $menu['attributes']['icon']; ?>"></i> <?php echo $menu['name']; ?>
					<span class="<?php echo ( $menu['selected']  ? 'selected' : 'arrow' ); ?>"></span>
					</a>

					<?php if( $menu['has_sub'] )  { ?>
					<ul class="sub">
					<?php foreach ($menu['sub'] as $key => $submenu) {  ?>
						<li class="<?php echo ( $submenu['active'] ? 'active' : ''  ) ?>"><a class="" href="<?php echo $submenu['href'] ?>" ><?php echo $submenu['name'] ?></a></li>
					<?php } ?>
					</ul>
					<?php } ?>
				</li>
			<?php } ?>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">	
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->		
						<h3 class="page-title">
							<?php echo "$page_title";?>
							<small><?php echo "$description";?></small>
						</h3>
						<?php echo $breadcrumb;  ?>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				
					<?php echo $content;?>
				
			</div>
			<!-- END PAGE CONTAINER-->		
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		2013 &copy; CRM Rumah Sakit
		<div class="span pull-right">
			<span class="go-top"><i class="icon-angle-up"></i></span>
		</div>
	</div>
	<!-- END FOOTER -->
 <!-- BEGIN JAVASCRIPTS -->    
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo base_url("assets/back/breakpoints/breakpoints.js") ?>"></script>      
   <script src="<?php echo base_url("assets/back/bootstrap/js/bootstrap.min.js") ?>"></script>   
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="<?php echo base_url("assets/back/js/excanvas.js") ?>"></script>
   <script src="<?php echo base_url("assets/back/js/respond.js") ?>"></script>
   <![endif]-->

   <?php if( isset( $dashboard_js ) ){
   		
   		foreach ($dashboard_js as $key => $js) {
  	?>
  	<script src="<?php echo base_url("assets/back/flot/$js") ?>"></script>
  	<?php 
   	}

   }
   elseif ( isset( $pasien_js ) ) {
   	foreach ($pasien_js as $key => $js) {
   ?>
   <script src="<?php echo base_url("assets/back/flot/$js") ?>"></script>
   <?php	}
    	
    } ?>

   <script type="text/javascript" src="<?php echo base_url("assets/back/chosen-bootstrap/chosen/chosen.jquery.min.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/uniform/jquery.uniform.min.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/bootstrap-wysihtml5/wysihtml5-0.3.0.js") ?>"></script> 
   <script type="text/javascript" src="<?php echo base_url("assets/back/bootstrap-wysihtml5/bootstrap-wysihtml5.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/jquery-tags-input/jquery.tagsinput.min.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/bootstrap-datepicker/js/bootstrap-datepicker.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/clockface/js/clockface.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/bootstrap-daterangepicker/date.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/bootstrap-daterangepicker/daterangepicker.js") ?>"></script> 
   <script type="text/javascript" src="<?php echo base_url("assets/back/bootstrap-colorpicker/js/bootstrap-colorpicker.js") ?>"></script>  
   <script type="text/javascript" src="<?php echo base_url("assets/back/bootstrap-timepicker/js/bootstrap-timepicker.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/data-tables/jquery.dataTables.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/data-tables/DT_bootstrap.js") ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/back/gritter/js/jquery.gritter.js") ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/back/uniform/jquery.uniform.min.js") ?>"></script>	
	<script type="text/javascript" src="<?php echo base_url("assets/back/js/jquery.pulsate.min.js") ?>"></script>
   <script src="<?php echo base_url("assets/back/js/app.js") ?>"></script>
   <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>   
   <script type="text/javascript" src="<?php echo site_url("assets/back/js/notification.js") ?>"></script> 
   <script>
      jQuery(document).ready(function() {       
         

         // initiate layout and plugins
         App.init();

        
         //bagian dashboard disini
         <?php 
	         if( isset($dashboard_js) ){

	         		$link = site_url("admin/dashboard/refresh");
	         	    echo "var data = ".$data_dashboard.";\n";
	         		echo "CRM_APP.drawDashboard(data,\"".$link."\");";

	         } 
	         if( isset($pasien_js) ){
	         		
	         		$link = site_url("admin/dashboard/refresh");
	         	    echo "var data = ".$pasien_stat.";\n";
	         		echo "CRM_APP.drawDashboard(data,\"".$link."\");";	         	
	         }
         ?>


         //bagian notifikasi disini
         Notification.standby("<?php echo site_url('admin'); ?>","<?php echo $role; ?>");

      });
   </script>
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>