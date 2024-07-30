<footer class="footer bg-success py-3 text-center text-light">
				<div class="container-fluid">
					<div class="row gy-2">
						<div class="col-xl-5 col-lg-5 col-md-6">
							<div class="copyright mx-auto fs-6">
								<i class="bi bi-c-circle me-2"></i> <?php echo date('Y'); ?> <b>Citizz Adzz.com</b>. All Rights Reserved.
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-6">
							<div class="copyright mx-auto fs-6">
								Website Designed by <a href="https://technobizzar.com" class="text-light fw-bold">Technobizzar</a>
							</div>
						</div>
					</div>
					
				</div>
			</footer>
		</div>
	</div>

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
	
	<!-- Logout Modal -->
	<div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="LogoutModalPro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content border-0">
				<div class="modal-header text-bg-danger">
					<h6 class="modal-title"><i class="bi bi-box-arrow-right me-2"></i>Logout ?</h6>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-center">									
					<p class="fw-bold">Are you sure, you want to logout ?</p>
				</div>
				<div class="modal-footer">
					<a href="?logout" class="btn btn-danger">OK</a>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/js/ready.js"></script>
</html>

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
           window.location.href='login.php';
       </script>");
    }
?>