<?php
	$title = "Edit Profile | Citizz Adzz";
	include 'header.php';
?>
<?php
	$admin_id = $_SESSION["admin_id"];
	$select = "SELECT * FROM `admin` WHERE `aid` = '$admin_id'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Admin Profile</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-12 col-lg-10 col-md-10">
						<div class="card shadow-sm mb-3">
							<div class="card-header">
								<h5 class="card-title">Edit Profile</h5>
							</div>
							<div class="card-body">
								<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
									<div class="col-xl-3 col-lg-6 col-md-6 mb-3">
										<label>Name:<span class="text-danger fw-bold"> *</span></label>
										<input type="text" class="form-control" name="admin_name" placeholder="Enter Name" value="<?php echo $row['admin_name'] ?>" required>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
										<label>Email:</label>
										<input type="email" class="form-control" name="admin_email" placeholder="Enter Email" value="<?php echo $row['admin_email'] ?>" required>
									</div>
                                  	<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
										<label>Username:</label>
										<input type="text" class="form-control" name="admin_user" placeholder="Enter Username" value="<?php echo $row['admin_user'] ?>" required>
									</div>
                                  	<?php
  										if($_SESSION['otp_verified'] !== 'yes') {
  									?>
                                  	<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
										<label>Current Password:</label>
										<input type="password" class="form-control" name="admin_current_pass" placeholder="Enter Current Password">
									</div>
                                  	<?php
                                        }
  									?>
                                  	<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
										<label>New Password:</label>
										<input type="password" class="form-control" name="admin_pass" placeholder="Enter New Password">
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 mb-3">
                                      	<a href="#ForgotModal" data-bs-toggle="modal" data-bs-target="#ForgotModal" class="d-block mb-3">Forgot Password</a>
										<button type="submit" class="btn btn-sm btn-default text-uppercase px-3 py-2" name="update_profile">update profile</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$('.sidebar .nav .nav-item#profile').addClass('active');
</script>

<?php
	/*** Submit ***/
	if (isset($_POST['update_profile']))
	{
		$admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
      	$admin_email = mysqli_real_escape_string($con, $_POST['admin_email']);
		$admin_user = mysqli_real_escape_string($con, $_POST['admin_user']);
      	$admin_current_pass = mysqli_real_escape_string($con, $_POST['admin_current_pass']);
      	$admin_current_pass_md5 = md5($admin_current_pass);
		$admin_pass = mysqli_real_escape_string($con, $_POST['admin_pass']);
      	$admin_pass_md5 = md5($admin_pass);

      	if($_SESSION['otp_verified'] !== 'yes')
        {
          $select = "SELECT * FROM `admin` WHERE `aid` = '$admin_id' AND `admin_pass` = '$admin_current_pass_md5'";
          //echo $select; exit;
          $result = mysqli_query($con, $select);
          if(mysqli_num_rows($result) == 0)
          {
            echo ("<script LANGUAGE='JavaScript'>
               swal('Error', 'Current Password is incorrect!', 'error')
                 .then(() => {
                    location.href = ''
                 });
               </script>");
          }
          else
          {
            if(!empty($admin_pass))
            {
              $update = "UPDATE `admin` SET `admin_name` = '$admin_name', `admin_email` = '$admin_email', `admin_user` = '$admin_user', `admin_pass` = '$admin_pass_md5' WHERE `aid` = '$admin_id'";
            }
            else
            {
              $update = "UPDATE `admin` SET `admin_name` = '$admin_name', `admin_email` = '$admin_email', `admin_user` = '$admin_user' WHERE `aid` = '$admin_id'";
            }
            
            //echo $update; exit;
            $updresult = mysqli_query($con, $update);
            if ($updresult)
            {
                $_SESSION['otp_verified'] = '';
                echo "
                  <script LANGUAGE='JavaScript'>;
                    swal('Success', 'Data Updated!', 'success')
                    .then(() => {
                      location.href = 'profile.php'
                    });
                  </script>
                ";
            }
            else
            {
                echo ("<script LANGUAGE='JavaScript'>
                  swal('Error', 'There was an error occurred. Please try again later!', 'error')
                    .then(() => {
                      location.href = ''
                    });
                </script>");
            }
          }
        }
      	else
        {
          if(!empty($admin_pass))
          {
            $update = "UPDATE `admin` SET `admin_name` = '$admin_name', `admin_email` = '$admin_email', `admin_user` = '$admin_user', `admin_pass` = '$admin_pass_md5' WHERE `aid` = '$admin_id'";
          }
          else
          {
            $update = "UPDATE `admin` SET `admin_name` = '$admin_name', `admin_email` = '$admin_email', `admin_user` = '$admin_user' WHERE `aid` = '$admin_id'";
          }
          
          //echo $update; exit;
          $updresult = mysqli_query($con, $update);
          if ($updresult)
          {
              $_SESSION['otp_verified'] = '';
              echo "
                <script LANGUAGE='JavaScript'>;
                  swal('Success', 'Data Updated!', 'success')
                  .then(() => {
                    location.href = 'profile.php'
                  });
                </script>
              ";
          }
          else
          {
              echo ("<script LANGUAGE='JavaScript'>
                swal('Error', 'There was an error occurred. Please try again later!', 'error')
                  .then(() => {
                    location.href = ''
                  });
              </script>");
          }
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
          	$query = "UPDATE `admin` SET `email_otp` = '0', `email_verify` = 'yes' WHERE `aid` = '$admin_id'";
            //echo $query; exit;
            $result = mysqli_query($con, $query);
            if($result)
            {
              $_SESSION['otp_verified'] = 'yes';
              	echo "
                  <script LANGUAGE='JavaScript'>;
                    swal('Success', 'OTP Verified!', 'success')
                    .then(() => {
                      location.href = 'profile.php'
                    });
                  </script>
                ";
            }
        }
    }
?>