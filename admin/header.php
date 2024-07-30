<?php
  include("../config.php"); 
  session_start();
  //print_r($_SESSION);exit;
  if(!empty($_SESSION["admin_id"]) && !empty($_SESSION["admin_login"]))
  {
    $admin_id = $_SESSION["admin_id"];
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
  date_default_timezone_set("Asia/Kolkata");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<title><?php echo !empty($title) ? $title : "Citizz Adzz Admin" ?></title>
	<link rel="apple-touch-icon" href="../assets/img/favicon.png" sizes="180x180">
	<link rel="icon" href="../assets/img/favicon.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Andika:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="assets/css/ready.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header px-5 px-lg-3">
				<a href="index.php" class="logo">
					<img src="../assets/img/logo.png" class="img-fluid">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="bi bi-three-dots-vertical"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid justify-content-center">
					<span><i class="bi bi-person-check-fill text-success fs-5 me-2"></i>Hello, <b><?php echo $admin ?></b>!</span>					
					<ul class="navbar-nav topbar-nav ms-md-auto align-items-center">						
						<li class="nav-item">
							<a href="#LogoutModal" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#LogoutModal"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar">
			<div class="scrollbar-inner sidebar-wrapper">				
				<ul class="nav">
					<li id="dashboard" class="nav-item">
						<a href="index.php">
							<i class="bi bi-speedometer2"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li id="users" class="nav-item">
						<a href="users.php">
							<i class="bi bi-people"></i>
							<p>Users</p>
						</a>
					</li>
					<li id="real_estate" class="nav-item">
						<a href="real-estate.php">
							<i class="bi bi-house-heart"></i>
							<p>Real Estate</p>
						</a>
					</li>
					<li id="advertisements" class="nav-item">
						<a href="advertisements.php">
							<i class="bi bi-megaphone"></i>
							<p>Advertisements</p>
						</a>
					</li>
					<li id="cities" class="nav-item">
						<a href="cities.php">
							<i class="bi bi-buildings"></i>
							<p>Cities</p>
						</a>
					</li>
					<li id="cities-adverts" class="nav-item">
						<a href="cities-adverts.php">
							<i class="bi bi-megaphone-fill"></i>
							<p>City Adverts</p>
						</a>
					</li>
					<li id="jobs_careers" class="nav-item">
						<a href="jobs-careers.php">
							<i class="bi bi-briefcase"></i>
							<p>Jobs & Careers</p>
						</a>
					</li>
                  	<li id="profile" class="nav-item">
						<a href="profile.php">
							<i class="bi bi-person-gear"></i>
							<p>Edit Profile</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">