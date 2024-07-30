<?php $title = "Sign up - Citizz Adzz"; ?>
<?php include 'header.php'; ?>
<div class="container-fluid">
	<div class="py-4 text-center">
		<a href="index.php"><img src="assets/img/logo.png" class="img-fluid"></a>
	</div>
</div>
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
				<img src="assets/img/register-banner-left.png" class="img-fluid">
			</div>
			<div class="col-xl-6 col-lg-6 col-md-12 d-flex align-items-stretch">
				<div class="card shadow w-100">
					<div class="card-body">
						<h3 class="text-center fw-bold py-2">Sign Up</h3>
						<form id="RegisterForm" class="form row px-3 py-1" method="POST">
							<div class="col-xl-12 col-lg-12 col-md-12 mb-3">
								<label>Full Name <span class="text-danger fw-bold">*</span></label>
								<input type="text" name="fname" class="form-control shadow-sm" placeholder="Enter Full Name" required="required">
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 mb-3">
								<label>Email <span class="text-danger fw-bold">*</span></label>
								<input type="email" name="email" class="form-control shadow-sm" placeholder="Enter Email Adddress" required="required">
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 mb-3">
								<label>Date of Birth <span class="text-danger fw-bold">*</span></label>
								<input type="date" name="dob" class="form-control shadow-sm" required="required">
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 mb-3">
								<label>Mobile <span class="text-danger fw-bold">*</span></label>
								<div class="input-group">
									<span class="input-group-text" id="basic-addon1">+91</span>
									<input type="tel" name="mobile" class="form-control shadow-sm" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" aria-describedby="basic-addon1" placeholder="9XXXXXXXXXX" required="required">
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 mb-4">
								<label>Password <span class="text-danger fw-bold">*</span></label>
								<div class="input-group">
									<input type="password" name="password" class="form-control shadow-sm input_generate" placeholder="Enter Password" aria-label="Enter New Password" aria-describedby="button-addon1" required="required">
									<button class="btn btn-secondary eye_btn" onclick="ShowPassword();" type="button" id="button-addon1">
										<i class="bi bi-eye-fill" aria-hidden="true"></i>
									</button>
								</div>
							</div>
							<button type="submit" id="register-btn" class="btn btn-custom-gradient text-uppercase mb-4">register now</button>
							<p class="text-center">Already have an account <a href="sign-in.php" class="text-decoration-none">click here</a>.</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>