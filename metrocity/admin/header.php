<?php
	include("../config.php");

	session_start();
	if(!empty($_SESSION["admin_login"]))
	{
		$admin = $_SESSION["admin_login"];
		if(time()-$_SESSION["login_time_stamp"] > 14400) 
		{
			session_unset();
			session_destroy();
			echo ("<script LANGUAGE='JavaScript'>
			window.location.href='login.php';
			</script>");
		}
	}
	else
	{
		echo ("<script LANGUAGE='JavaScript'>
		window.location.href='login.php';
		</script>");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>ADMIN | Metrocity</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="shortcut icon" href="../icon.png" type="image/x-icon">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link href="assets/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	<!-- Select2 CSS --> 
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="index.php" class="logo">
					<img src="../Logo_Metrocity.png" width="200">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item">
							<a class="nav-link">
								<i class="la la-user text-primary"></i> Hello, Admin
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" data-toggle="modal" data-target="#modalUpdate">
								<i class="la la-power-off text-danger"></i> Logout
							</a>
						</li>
						<!-- <li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle"><span >Hizrian</span></a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
										<div class="u-text">
											<h4>Hizrian</h4>
											<p class="text-muted">hello@themekita.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
									</div>
								</li>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
								<a class="dropdown-item" href="#"> My Balance</a>
								<a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="ti-settings"></i> Account Setting</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="fa fa-power-off"></i> Logout</a>
							</ul>
							 /.dropdown-user -->
						<!-- </li> -->
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar">
			<div class="scrollbar-inner sidebar-wrapper">
				<ul class="nav">
					<li class="nav-item dashboard">
						<a href="index.php">
							<i class="la la-dashboard"></i>
							<p>Dashboard</p>
							<!-- <span class="badge badge-count">5</span> -->
						</a>
					</li>
                  	<li class="nav-item enquiry">
						<a href="enquiry.php">
							<i class="la la-pencil-square"></i>
							<p>Enquiry</p>
							<!-- <span class="badge badge-count">5</span> -->
						</a>
					</li>
					<li class="nav-item banner">
						<a href="banner.php">
							<i class="la la-image"></i>
							<p>Banner</p>
							<!-- <span class="badge badge-count">14</span> -->
						</a>
					</li>
					<li class="nav-item projects">
						<a href="projects.php">
							<i class="la la-building"></i>
							<p>Projects</p>
							<!-- <span class="badge badge-count">50</span> -->
						</a>
					</li>
					<li class="nav-item gallery">
						<a href="gallery.php">
							<i class="la la-clone"></i>
							<p>Gallery</p>
							<!-- <span class="badge badge-count">6</span> -->
						</a>
					</li>
					<li class="nav-item blogs">
						<a href="blogs.php">
							<i class="la la-comment"></i>
							<p>Blogs</p>
							<!-- <span class="badge badge-success">3</span> -->
						</a>
					</li>
					<li class="nav-item news">
						<a href="news.php">
							<i class="la la-newspaper-o"></i>
							<p>News</p>
							<!-- <span class="badge badge-danger">25</span> -->
						</a>
					</li>
					<li class="nav-item adverts">
						<a href="promos.php">
							<i class="la la-picture-o"></i>
							<p>Advertisements</p>
						</a>
					</li>
                  	<li class="nav-item contact">
						<a href="contact-us.php">
							<i class="la la-phone"></i>
							<p>Contact Us</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">