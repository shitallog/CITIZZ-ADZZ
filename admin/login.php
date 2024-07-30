<?php include("../config.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<title>Admin Login | Citizz Adzz</title>
	<link rel="apple-touch-icon" href="../assets/img/favicon.png" sizes="180x180">
	<link rel="icon" href="../assets/img/favicon.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Andika:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/ready.css">
</head>
<body class="bg-light" style="min-height: 0">
	<section>
		<div class="container">
			<div class="row d-flex flex-column justify-content-center align-items-center my-4 py-4">
				<div class="col-xl-4 col-lg-5 col-md-6">
					<img src="../assets/img/logo.png" class="img-fluid my-4">
					<div class="card">
						<div class="card-header text-center">
							<div class="card-title">Admin Login</div>
						</div>
						<div class="card-body">
							<form class="form" method="POST">
								<div class="mb-3">
									<label for="email">Username<span class="text-danger fw-bold"> *</span></label>
									<input type="text" class="form-control shadow-sm" name="username" placeholder="Enter Username" required>
								</div>
								<div class="mb-4">
									<label for="password">Password<span class="text-danger fw-bold"> *</span></label>
									<div class="input-group">
									<input type="password" name="password" class="form-control shadow-sm input_generate" placeholder="Enter Password" aria-label="Enter Password" aria-describedby="button-addon1" required="required">
									<button class="btn btn-secondary eye_btn" onclick="ShowPassword();" type="button" id="button-addon1">
										<i class="bi bi-eye-fill" aria-hidden="true"></i>
									</button>
								</div>
								</div>
								<button type="submit" name="login" class="btn btn-success rounded-0 form-control text-uppercase d-flex align-items-center justify-content-center"><i class="bi bi-person-lock fs-4 me-2"></i>login</button>
							</form>
						</div>
                      	<a href="#ForgotModal" data-bs-toggle="modal" data-bs-target="#ForgotModal" class="text-center mb-3">Forgot Password</a>
					</div>                  	
					<p class="text-center"><i class="bi bi-c-circle me-2"></i> <?php echo date('Y'); ?> <b>Citizz Adzz.com</b>. All Rights Reserved.</p>
					<p class="text-center">Website Designed by <a href="https://technobizzar.com" class="fw-bold">Technobizzar</a></p>
				</div>
			</div>
		</div>
	</section>
  
  	<div class="modal fade" id="ForgotModal" tabindex="-1" role="dialog" aria-labelledby="ForgotModalPro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content border-0">
				<div class="modal-header text-bg-danger">
					<h6 class="modal-title"><i class="bi bi-box-arrow-right me-2"></i>Forgot Password ?</h6>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">									
					<form id="forgot-password" class="form" method="POST">
                      <div class="input-group shadow-sm mb-3">
                        <input type="email" class="form-control" name="forgot_email" placeholder="Enter Email Address" aria-label="Enter Email Address" aria-describedby="button-addon2" required>
                        <button class="btn btn-secondary" type="submit" name="send_mail" id="button-addon2">Send Email</button>                        
                      </div>
                  	</form>
                  	<div id="forgotmsg"></div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/js/ready.js"></script>
</html>
<?php
  if(isset($_POST['login']))
  {
    $user = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
    $pass = md5($pass);

    $select = "SELECT * FROM `admin` WHERE `admin_user` = '$user' AND `admin_pass` = '$pass'";
    // echo $select; exit;
    $result = mysqli_query($con, $select);
    if (mysqli_num_rows($result) > 0)
    {
      $row = mysqli_fetch_array($result);
      //session_start();
      $_SESSION['admin_id'] = $row['aid'];
      $_SESSION['admin_login'] = $row['admin_name'];
      $_SESSION["login_time_stamp"] = time();
      //print_r($_SESSION);
      echo "<script>
        swal('Success', 'Login Successful!', 'success')
            .then(() => {
              location.href = 'index.php'
            });
      </script>";
    }
    else
    {
      echo "<script>
          swal('Error', 'There was an error occurred, please try again later!', 'error')
              .then(() => {
                location.href = ''
              });
        </script>";
    }
  }

  if (isset($_POST['otp_verify']))
  {
    $forgot_email = mysqli_real_escape_string($con, $_POST['forgot_email']);
    $otp = mysqli_real_escape_string($con, $_POST['otp']);

    $sql = "SELECT * FROM `admin` WHERE `admin_email` = '$forgot_email' AND `email_otp` = '$otp'";
    //echo $sql; exit;
    $res = mysqli_query($con, $sql);
    if(mysqli_num_rows($res) == 0)
    {
      echo ("<script LANGUAGE='JavaScript'>
                swal('Error', 'Incorrect OTP!', 'error')
                  .then(() => {
                    location.href = ''
                  });
              </script>");
    }
    else
    {
      $query = "UPDATE `admin` SET `email_otp` = '0', `email_verify` = 'yes' WHERE `aid` = '1'";
      //echo $query; exit;
      $result = mysqli_query($con, $query);
      if($result)
      {
        //session_start();
        $_SESSION['otp_verified'] = 'yes';
        $_SESSION['forgot_email'] = $forgot_email;
        //print_r($_SESSION);exit;
        echo "
                  <script LANGUAGE='JavaScript'>;
                    swal('Success', 'OTP Verified!', 'success')
                    .then(() => {
                      location.href = 'change-password.php'
                    });
                  </script>
                ";
      }
    }
  }
?>