<?php $title = "Sign in - Citizz Adzz"; ?>
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
				<img src="assets/img/login-banner-left.png" class="img-fluid">
			</div>
			<div class="col-xl-6 col-lg-6 col-md-12 d-flex align-items-stretch">
				<div class="card shadow px-0 px-xl-5 px-lg-4 w-100">
					<div class="card-body">
						<h3 class="text-center fw-bold py-2">Sign in</h3>
						<ul class="nav nav-tabs justify-content-center rounded" id="AccountTab" role="tablist">
							<li class="nav-item w-50" role="presentation">
								<button class="nav-link w-100 active" id="email-tab" data-bs-toggle="tab" data-bs-target="#email-tab-pane" type="button" role="tab" aria-controls="email-tab-pane" aria-selected="true">Email Login</button>
							</li>
							<li class="nav-item w-50" role="presentation">
								<button class="nav-link w-100" id="mobile-tab" data-bs-toggle="tab" data-bs-target="#mobile-tab-pane" type="button" role="tab" aria-controls="mobile-tab-pane" aria-selected="false">Mobile Login</button>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="email-tab-pane" role="tabpanel" aria-labelledby="email-tab" tabindex="0">
								<form id="LoginWithEmail" class="form row px-3 px-lg-4 px-xl-5 py-4" method="POST">
									<div class="col-xl-12 mb-3">
										<label>Email <span class="text-danger fw-bold">*</span></label>
										<input type="email" name="email" class="form-control shadow-sm" placeholder="example@example.com" required="required">
									</div>
									<div class="col-xl-12 mb-4">
										<label>Password <span class="text-danger fw-bold">*</span></label>
										<div class="input-group">
											<input type="password" name="password" class="form-control shadow-sm input_generate" placeholder="Enter Password" aria-label="Enter New Password" aria-describedby="button-addon1" required="required">
											<button class="btn btn-secondary eye_btn" onclick="ShowPassword();" type="button" id="button-addon1">
												<i class="bi bi-eye-fill" aria-hidden="true"></i>
											</button>
										</div>
									</div>
									<button type="submit" id="login-email" class="btn btn-custom-gradient text-uppercase">login</button>				
								</form>
							</div>
							<div class="tab-pane fade" id="mobile-tab-pane" role="tabpanel" aria-labelledby="mobile-tab" tabindex="0">
								<form id="LoginWithMobile" class="form row px-3 px-lg-4 px-xl-5 py-4" method="POST">
									<div class="col-xl-12 mb-3">
										<label>Mobile <span class="text-danger fw-bold">*</span></label>
										<div class="input-group">
											<span class="input-group-text" id="basic-addon1">+91</span>
											<input type="tel" name="mobile" class="form-control shadow-sm" maxlength="10" pattern="[6789][0-9]{9}" onkeypress="return isNumber(event)" aria-describedby="basic-addon1" placeholder="9XXXXXXXXX" required="required">
										</div>
									</div>
									<div class="col-xl-12 mb-4">
										<label>Password <span class="text-danger fw-bold">*</span></label>
										<div class="input-group">
											<input type="password" name="password" class="form-control shadow-sm input_generate" placeholder="Enter Password" aria-label="Enter New Password" aria-describedby="button-addon3" required="required">
											<button class="btn btn-secondary eye_btn" onclick="ShowPassword();" type="button" id="button-addon3">
												<i class="bi bi-eye-fill" aria-hidden="true"></i>
											</button>
										</div>
									</div>
									<button type="submit" id="login-mobile" class="btn btn-custom-gradient text-uppercase">login</button>				
								</form>
							</div>
						</div>
                      	<p class="text-center"><a href="#UForgotModal" data-bs-toggle="modal" data-bs-target="#UForgotModal" class="text-decoration-none">Forgot Password ?</a></p>
						<p class="text-center">Need an account <a href="sign-up.php" class="text-decoration-none">click here</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>