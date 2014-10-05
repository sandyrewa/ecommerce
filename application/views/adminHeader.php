<?php
/*
####################################################################
### file location - application/views/adminHeader.php       ########
### Developed by  - Sandeep singh                           ########
###                                                         ########
### Developer     - Sandeep Singh(sandy)                    ########
####################################################################
*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Mosaddek">
		<meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">

		<title><?php if(!empty($headerData)){ echo $headerData['title'];} else { echo "Well Come To eCommerce Zone";}?></title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/bootstrap-reset.css" rel="stylesheet">
		<!--external css-->
		<link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/css/demo_table.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.gritter.css" />
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" />

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
		<!--[if lt IE 9]>
		  <script src="js/html5shiv.js"></script>
		  <script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<!-- section start here and end on footer -->
		<section id="container" class="">
			<!--header start-->
		      	<header class="header white-bg">
		          	<div class="sidebar-toggle-box">
		             	<div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
		          	</div>
		          	<!--logo start-->
		          	<a href="index.html" class="logo" >Flat<span>lab</span></a>
		         	 <!--logo end-->
		          	
		          	<div class="top-nav ">
						<ul class="nav pull-right top-menu">
							<!-- <li>
								<input type="text" class="form-control search" placeholder="Search">
							</li> -->
							<!-- user login dropdown start-->
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<img alt="" src="<?php echo base_url();?>assets/images/avatar1_small.jpg">
									<span class="username">Jhon Doue</span>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu extended logout">
									<div class="log-arrow-up"></div>
									<li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>
									<li><a href="#"><i class="icon-cog"></i> Settings</a></li>
									<li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>
									<li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
								</ul>
							</li>
							<!-- user login dropdown end -->
						</ul>
		          	</div>
		      	</header>
		      	<!--header end-->