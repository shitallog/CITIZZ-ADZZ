<?php $title = "My Profile - Citizz Adzz"; ?>
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
				if(isset($user, $user_id))
				{
					$select = "SELECT * FROM `users` WHERE `uid` = '$user_id'";
					$result = mysqli_query($con, $select);
					if(mysqli_num_rows($result) > 0)
					{
						$row = mysqli_fetch_assoc($result);
			?>
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
					<img src="assets/img/profile-left.jpg" class="img-fluid">
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 d-flex align-items-stretch">
					<div class="card shadow px-0 px-xl-5 px-lg-4 w-100">
						<div class="card-body">
							<h3 class="text-center fw-bold py-2">My Profile</h3>							
                            <form class="form row px-3 px-lg-4 px-xl-3 py-3" method="POST">
                              <div class="col-xl-12 mb-3">
                                <label>Full Name <span class="text-danger fw-bold">*</span></label>
                                <input type="text" name="fname" class="form-control shadow-sm" placeholder="Enter Full Name" value="<?php echo $row['fname'] ?>" required="required">
                              </div>
                              <div class="col-xl-12 mb-3">
                                <label>Email <span class="text-danger fw-bold">*</span></label>
                                <input type="email" name="email" class="form-control shadow-sm" placeholder="Enter Email" value="<?php echo $row['email'] ?>" required="required">
                              </div>
                              <div class="col-xl-12 mb-3">
                                <label>Mobile <span class="text-danger fw-bold">*</span></label>
                                <div class="input-group">
                                  <span class="input-group-text" id="basic-addon1">+91</span>
                                  <input type="tel" name="mobile" class="form-control shadow-sm" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" aria-describedby="basic-addon1" placeholder="9XXXXXXXXX" value="<?php echo $row['mobile'] ?>" required="required">
                                </div>
                              </div>
                              <div class="col-xl-12 mb-3">
                                <label>Date of Birth <span class="text-danger fw-bold">*</span></label>
                                <input type="date" name="dob" class="form-control shadow-sm" value="<?php echo $row['dob'] ?>" required="required">
                              </div>
                              <div class="col-xl-12 mb-4">
                                <label>Current Password <span class="text-danger fw-bold">*</span></label>
                                <div class="input-group">
                                  <input type="password" name="current-password" class="form-control shadow-sm" placeholder="Enter Password" required="required">
                                  <button type="button" class="btn btn-success" onclick="CheckUserPassword($(this));">
                                    <i class="bi bi-person-lock me-2"></i> Check
                                  </button>
                                </div>
                                <span id="userMSG"></span>
                              </div>
                              <div class="col-xl-12 mb-4 d-none" id="newpassword">
                                <label>Password <span class="text-danger fw-bold">*</span></label>
                                <input type="password" name="new-password" class="form-control shadow-sm" placeholder="Enter Password" required="required" disabled>
                              </div>
                              <div class="col-xl-12">
                                <button type="submit" name="update" class="btn btn-custom-gradient text-uppercase">update profile</button>
                              </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
			<?php
					}					
				}
				else
				{
			?>
			<div class="row">
				<div class="col-xl-12">
					<div class="alert alert-warning fade show shadow-sm" role="alert">
						Please <a href="sign-in.php" class="fw-bold">login</a> or <a href="sign-up.php" class="fw-bold">register</a> to view this page.
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
	if(isset($_POST['update']))
	{
	    $fname = mysqli_real_escape_string($con, $_POST['fname']);
	    $email = mysqli_real_escape_string($con, $_POST['email']);
	    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	    $dob = mysqli_real_escape_string($con, $_POST['dob']);
	    $current_password = mysqli_real_escape_string($con, $_POST['current-password']);	    

	    if(isset($current_password, $_POST['new-password']))
	    {
	    	$pass = mysqli_real_escape_string($con, $_POST['new-password']);
	    	$pass = md5($pass);
		    $select = "SELECT * FROM `users` WHERE (`email` = '$email' OR `mobile` = '$mobile') AND `uid` != '$_SESSION[user_id]'";
			// echo $select;exit();
			$result = mysqli_query($con, $select);
			if(mysqli_num_rows($result) > 0)
			{
				echo "<script>
		          swal('Warning', 'Email or Mobile Already Exists!', 'warning')
		              .then(() => {
		                location.href = ''
		              });
		        </script>";				
			}
		    else
		    {
		      	$update = "UPDATE `users` SET `fname`='$fname',`pass`='$pass',`email`='$email',`mobile`='$mobile',`dob`='$dob' WHERE `uid`='$_SESSION[user_id]'";
		      	// echo $update;exit();
		      	$upd_result = mysqli_query($con, $update);
		      	if($upd_result)
		      	{
		      		session_start();
		      		$_SESSION['admin_login'] = $row['admin_name'];
		      		echo "<script>
			          swal('Success', 'Details Updated Successfully!', 'success')
			              .then(() => {
			                location.href = ''
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
		}
		else
		{
			echo "<script>
	          swal('Error', 'Please Verify Password!', 'error')
	              .then(() => {
	                location.href = ''
	              });
	        </script>";
		}
	}
?>