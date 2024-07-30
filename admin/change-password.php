<?php include("../config.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<title>Change Password | Citizz Adzz Admin</title>
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
                      	<?php
                            $otp_verified = $_SESSION['otp_verified'];
                            $forgot_email = $_SESSION['forgot_email'];
                            if(isset($otp_verified, $forgot_email))
                            {
                        ?>
						<div class="card-header text-center">
							<div class="card-title">Change Password</div>
						</div>
                      	<div class="card-body">
                          	<h3 class="text-center fw-bold py-2">Change Password</h3>
                          	<hr>
                            <form class="form row px-3 px-lg-4 px-xl-3 py-3" method="POST">                              
                              <div class="col-xl-12 mb-3">
                                <label>Email</label>
                                <div class="text-bg-light p-2 border shadow-sm"><?php echo $forgot_email ?></div>
                              </div>
                              <div class="col-xl-12 mb-4">
                                <label>New Password <span class="text-danger fw-bold">*</span></label>
                                <input type="password" name="new-password" class="form-control shadow-sm" placeholder="Enter New Password" required="required">
                              </div>
                              <div class="col-xl-12">
                                <button type="submit" name="update_pass" class="btn btn-success form-control text-uppercase">change password</button>
                              </div>
                            </form>
                      	</div>
                      	<?php				
                            }
                            else
                            {
                        ?>
                      	<div class="card-body">
                          <div class="row">
                              <div class="col-xl-12">
                                  <div class="alert alert-danger fade show shadow-sm" role="alert">
                                      Please verify your OTP to view this page.
                                  </div>
                              </div>
                          </div>
                      	</div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
          	
		</div>
	</section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/js/ready.js"></script>
</html>
<?php
  if(isset($_POST['update_pass']))
  {
	  $new_password = mysqli_real_escape_string($con, $_POST['new-password']);
      $new_password_md5 = md5($new_password);

      $update = "UPDATE `admin` SET `admin_pass`='$new_password_md5' WHERE `admin_email`='$forgot_email'";
      // echo $update;exit();
      $upd_result = mysqli_query($con, $update);
      if($upd_result)
      {
        session_start();
        unset($_SESSION['otp_verified'], $_SESSION['forgot_email']);
        echo "<script>
				swal('Success', 'Password Changed Successfully!', 'success')
					.then(() => {
						location.href = 'login.php'
					});
			</script>";
      }
      else
      {
        echo "<script>
				swal('Error', 'There was an error occurred, please try again later!', 'error')
					.then(() => {
						location.href = 'login.php'
					});
			</script>";
      }
  }
?>