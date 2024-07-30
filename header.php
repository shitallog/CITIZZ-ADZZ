<?php
  include("config.php");
  session_start();
//print_r($_SESSION);
  if(!empty($_SESSION["user_login"]))
  {
    $user_id = $_SESSION["user_id"];
    $user = $_SESSION["user_login"];
    if(time()-$_SESSION["login_time_stamp"] > 14400) 
    {
      session_unset();
      session_destroy();
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo !empty($title) ? $title : 'Citizz Adzz - Jobs & Real Estate' ?></title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"/>
	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
	<!-- Favicons -->
	<link rel="apple-touch-icon" href="assets/img/favicon.png" sizes="180x180">
	<link rel="icon" href="assets/img/favicon.png">
	<!-- Font Family -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Eczar:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
	<!-- <?php print_r($_SESSION); ?> -->
	<?php
		if (isset($user, $user_id))
		{
	?>
	<div class="clearfix py-2 px-3">
		<div class="dropdown-center float-end">
		  <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
		    <i class="bi bi-person-fill-check me-2"></i>
		    <?php
		    	echo $user;
		    ?>
		  </button>
		  <ul class="dropdown-menu p-0">
		    <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2"></i>My Profile</a></li>
		    <li><a class="dropdown-item text-danger" href="?logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
		  </ul>
		</div>
	</div>
	<?php
		}
	?>
	<div class="fixed-bottom">
		<nav class="navbar navbar-expand-sm bg-black navbar-dark">
			<div class="container-fluid">
				<!-- <a class="navbar-brand" href="#">Fixed bottom</a> -->
				<span class="me-auto text-light text-uppercase d-sm-none">menu</span>
				<button class="navbar-toggler ms-auto border" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav justify-content-evenly w-100">
						<li class="nav-item"><a class="nav-link text-light" href="about-us.php"><i class="bi bi-info-circle me-2"></i>About Us</a></li>
						<li class="nav-item"><a class="nav-link text-light" href="terms-conditions.php"><i class="bi bi-file-earmark-text me-2"></i>Terms & Conditions</a></li>
						<li class="nav-item"><a class="nav-link text-light" href="privacy-policy.php"><i class="bi bi-journal-text me-2"></i>Privacy Policy</a></li>
						<li class="nav-item"><a class="nav-link text-light" href="contact-us.php"><i class="bi bi-headset me-2"></i>Contact Us</a></li>
						<li class="nav-item"><a class="nav-link text-light" href="tariff.php"><i class="bi bi-currency-rupee me-2"></i>Tariff</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<footer class="footer bg-custom-gradient py-2">
      <div class="container">
        <div class="row gy-2 justify-content-center text-center">
          <div class="col-xl-5 col-lg-5 col-md-6">
            <div class="copyright fs-6">
							<i class="bi bi-c-circle me-2"></i> <?php echo date('Y') ?> <b>CitizzAdzz.com</b>. All Rights Reserved.
						</div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6">
						<div class="copyright fs-6">
							Website Designed by <a href="https://technobizzar.com" class="text-decoration-none text-dark fw-bold">Technobizzar</a>
						</div>
					</div>
        </div>
      </div>
	  </footer>
	</div>