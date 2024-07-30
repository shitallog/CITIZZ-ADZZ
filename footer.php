	<div class="modal fade" id="UForgotModal" tabindex="-1" role="dialog" aria-labelledby="UForgotModalPro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content border-0">
				<div class="modal-header bg-custom-gradient">
					<h6 class="modal-title"><i class="bi bi-box-arrow-right me-2"></i>Forgot Password ?</h6>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">									
					<form id="uforgot-password" class="form" method="POST">
                      <div class="input-group shadow-sm mb-3">
                        <input type="email" class="form-control" name="uforgot_email" placeholder="Enter Registered Email Address" aria-label="Enter Email Address" aria-describedby="button-addon2" required>
                        <button class="btn btn-secondary" type="submit" name="usend_mail" id="button-addon2">Send Email</button>                        
                      </div>
                  	</form>
                  	<div id="uforgotmsg"></div>
				</div>
			</div>
		</div>
	</div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" async></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php
	if (isset($_POST['uotp_verify']))
    {
      	$uforgot_email = mysqli_real_escape_string($con, $_POST['uforgot_email']);
		$uotp = mysqli_real_escape_string($con, $_POST['uotp']);
      	
      	$sql = "SELECT * FROM `users` WHERE `email` = '$uforgot_email' AND `email_otp` = '$uotp'";
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
          	$query = "UPDATE `users` SET `email_otp` = '0', `email_verify` = 'yes' WHERE `email` = '$uforgot_email'";
            //echo $query; exit;
            $result = mysqli_query($con, $query);
            if($result)
            {
              $_SESSION['uotp_verified'] = 'yes';
              $_SESSION['uforgot_email'] = $uforgot_email;
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

<?php
    if(isset($_GET['logout']))
    {
        // start all session variables
        session_start();
        // remove all session variables
        session_unset(); 
        // destroy the session 
        session_destroy(); 
        echo ("<script LANGUAGE='JavaScript'>
        window.location.href='index.php';
        </script>");
    }
?>