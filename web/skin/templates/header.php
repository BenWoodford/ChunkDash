<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8" />
	<title>LoadingChunks Staff Dashboard</title>
	<meta name="author" content="Ben Woodford" />
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="/skin/static/css/bootstrap.css" rel="stylesheet" />
	<link href="/skin/static/css/bootstrap-responsive.css" rel="stylesheet" />
	<link id="base-style" href="/skin/static/css/style.css" rel="stylesheet" />
	<link id="base-style-responsive" href="/skin/static/css/style-responsive.css" rel="stylesheet" />
	<link id="custom" href="/skin/static/css/custom.css" rel="stylesheet" />
	<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css' />
	
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="/skin/static/css/ie.css" rel="stylesheet" />
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="/skin/static/css/ie9.css" rel="stylesheet" />
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="/skin/static/img/favicon.ico" />
	<!-- end: Favicon -->
	
		
		
		
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="/"><span>Staff Dashboard</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white warning-sign"></i>
							</a>
							<ul class="dropdown-menu notifications" id="notificationsListMini">
								<li>
									<span class="dropdown-menu-title">Recent Notifications</span>
								</li>
                                <li id="view_all">
                            		<a id="viewAllNotifications" class="dropdown-menu-sub-footer">View all notifications</a>
								</li>
							</ul>
						</li>
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> <span id="logged_in"><?=$name?></span>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="halflings-icon white off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span1">
				<div class="nav-collapse sidebar-nav">
					<ul id="sidemenu" class="nav nav-tabs nav-stacked main-menu">
						<li class="active"><a href="/" data-page="overview" class="menu-item"><i class="fa-icon-dashboard"></i><span class="hidden-tablet"> Overview</span></a></li>	
						<li><a href="/hardware" data-page="hardware" class="menu-item"><i class="fa-icon-upload-alt"></i><span class="hidden-tablet"> Hardware</span></a></li>
						<li><a href="/bans" data-page="bans" class="menu-item"><i class="fa-icon-legal"></i><span class="hidden-tablet"> Ban Manager</span></a></li>
						<li><a href="/tasks" data-page="tasks" class="menu-item"><i class="fa-icon-tasks"></i><span class="hidden-tablet"> Wunderlist</span></a></li>
						<li><a href="/users" data-page="users" class="menu-item"><i class="fa-icon-user"></i><span class="hidden-tablet"> Users</span></a></li>
						<li><a href="/shopping" data-page="shopping" class="menu-item"><i class="fa-icon-shopping-cart"></i><span class="hidden-tablet"> Shopping</span></a></li>
						<li><a href="/notifications" data-page="notifications" class="menu-item"><i class="fa-icon-warning-sign"></i><span class="hidden-tablet"> Notifications</span></a></li>
						<li><a href="/statistics" data-page="statistics" class="menu-item"><i class="fa-icon-bar-chart"></i><span class="hidden-tablet"> Statistics</span></a></li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span11">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>

			<!-- start: Content -->
			<div id="content" class="span11"><div id="innercontent">