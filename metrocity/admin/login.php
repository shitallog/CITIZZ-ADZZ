<?php include('../config.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>ADMIN Login | Metrocity</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="shortcut icon" href="../icon.png" type="image/x-icon">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body class="bg-light">
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-5 mt-5 mx-auto pt-5">
					<div class="card">
						<div class="card-header text-center">
							<img src="../Logo_Metrocity.png" width="200">
							<div class="card-title">Admin Login</div>
						</div>
						<div class="card-body">
							<form method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" name="username" placeholder="Enter Username">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Enter Password">
								</div>
								<div class="card-action text-center">
									<button type="submit" name="login" class="btn btn-success">Login</button>
									<button type="reset" class="btn btn-danger">Clear</button>
								</div>
							</form>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<!-- <script src="assets/js/plugin/chartist/chartist.min.js"></script> -->
<!-- <script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script> -->
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<!-- <script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script> -->
<!-- <script src="assets/js/plugin/chart-circle/circles.min.js"></script> -->
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- <script src="assets/js/demo.js"></script> -->
</html>

<?php
if (isset($_POST['login']))
{
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$pass = md5($password);

	$select = "SELECT * FROM `admin` WHERE `admin_user` = '$username' AND `admin_pass` = '$pass'";
	// echo $select; exit;
	$result = mysqli_query($con, $select);

	if (mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		session_start();
		$_SESSION['admin_login'] = $row['admin_name'];
		$_SESSION["login_time_stamp"] = time();
		echo "
			<script LANGUAGE='JavaScript'>;
	    		window.alert('Login Successful!');
	              window.location.href='index.php'; 
	          </script>
		";
	}
	else
	{
		echo ("<script LANGUAGE='JavaScript'>
	          window.alert('There was an error logging in. Please try again later!');
	    </script>");
	}
}
?>