<?php $title = "Change Password - Citizz Adzz"; ?>
<?php include 'header.php'; ?>
<div class="container-fluid">
	<div class="py-2 text-center">
		<a href="index.php"><img src="assets/img/logo.png" class="img-fluid"></a>
	</div>
</div>
<div id="wrapper">
	<section class="py-5">
		<div class="container">
			<?php
          		$uotp_verified = $_SESSION['uotp_verified'];
                $uforgot_email = $_SESSION['uforgot_email'];
				if(isset($uotp_verified, $uforgot_email))
				{
			?>
			<div class="row align-items-center justify-content-center">
				<div class="col-xl-5 col-lg-6 col-md-12 d-flex align-items-stretch">
					<div class="card shadow px-0 px-xl-5 px-lg-4 w-100">
						<div class="card-body">
							<h3 class="text-center fw-bold py-2">Change Password</h3>
                          	<hr>
                            <form class="form row px-3 px-lg-4 px-xl-3 py-3" method="POST">                              
                              <div class="col-xl-12 mb-3">
                                <label>Email</label>
                                <div class="text-bg-light p-2 border shadow-sm"><?php echo $uforgot_email ?></div>
                              </div>
                              <div class="col-xl-12 mb-4">
                                <label>New Password <span class="text-danger fw-bold">*</span></label>
                                <input type="password" name="new-password" class="form-control shadow-sm" placeholder="Enter New Password" required="required">
                              </div>
                              <div class="col-xl-12">
                                <button type="submit" name="update_pass" class="btn btn-custom-gradient text-uppercase">change password</button>
                              </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
			<?php				
				}
				else
				{
			?>
			<div class="row">
				<div class="col-xl-12">
					<div class="alert alert-danger fade show shadow-sm" role="alert">
						Please verify your OTP to view this page.
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</section>
</div>
<?php include 'footer.php'; ?>
<?php
  if(isset($_POST['update_pass']))
  {
	  $new_password = mysqli_real_escape_string($con, $_POST['new-password']);
      $new_password_md5 = md5($new_password);

      $update = "UPDATE `users` SET `pass`='$new_password_md5' WHERE `email`='$uforgot_email'";
      // echo $update;exit();
      $upd_result = mysqli_query($con, $update);
      if($upd_result)
      {
        session_start();
        unset($_SESSION['uotp_verified'], $_SESSION['uforgot_email']);
        echo "<script>
				swal('Success', 'Password Changed Successfully!', 'success')
					.then(() => {
						location.href = 'sign-in.php'
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
?>