<?php $title = "Citizz Adzz - Jobs & Real Estate"; ?>
<?php include 'header.php'; ?>
<div class="container-fluid">
	<div class="py-xl-4 py-lg-2 py-3 text-center">
		<a href="index.php"><img src="assets/img/logo.png" class="img-fluid"></a>
	</div>
</div>
<div id="wrapper">
	<div class="container">
		<div class="row justify-content-center text-center gy-4">
			<div class="col-xl-6 col-lg-9">
				<div class="row gy-xl-4 gy-2 justify-content-center mb-xl-5 mb-lg-3 mb-4">
					<div class="col-xl-6 col-lg-6 col-md-5">
						<a href="jobs-careers.php" class="btn btn-custom-gradient btn-lg fs-1 rounded-pill">Jobs & Careers</a>
					</div>
					<div class="col-xl-5 col-lg-4 col-md-4">
						<a href="real-estate.php" class="btn btn-custom-gradient btn-lg fs-1 rounded-pill">Real Estate</a>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6">
						<a href="advertisements.php" class="btn btn-custom-gradient btn-lg fs-1 rounded-pill">Advertisements</a>
					</div>
				</div>
				<?php
					if (!empty($user))
					{
				?>
				<h4 class="text-success">Hi, <?php echo $user; ?><i class="bi bi-person-fill-check ms-2"></i></h4>
				<?php
					}
					else
					{
				?>
				<div class="row gy-xl-4 gy-2 justify-content-center mb-xl-5 mb-lg-3 mb-4">
					<div class="col-xl-4 col-lg-3 col-md-3 col-6">
						<a href="sign-in.php" class="btn btn-outline-dark btn-lg rounded-pill"><i class="bi bi-person me-2"></i>Sign In</a>
					</div>
					<div class="col-xl-4 col-lg-3 col-md-3 col-6">
						<a href="sign-up.php" class="btn btn-outline-dark btn-lg rounded-pill"><i class="bi bi-people me-2"></i>Sign Up</a>
					</div>
                  	<div class="col-xl-5 col-lg-7 col-md-7 col-7">
						<a href="#UForgotModal" data-bs-toggle="modal" data-bs-target="#UForgotModal" class="btn btn-outline-dark btn-lg rounded-pill"><i class="bi bi-person-x me-2"></i>Forgot Password</a>
					</div>
				</div>
				<?php
					}
				?>
				<div class="text-center">
					<p class="fs-4 fw-semibold">Select Cities to view details:</p>
					<div class="dropdown-center">
						<a href="#" class="btn btn-outline-dark btn-lg rounded-pill dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="px-2">Select Cities</span></a>
						<ul class="dropdown-menu dropdown-menu-dark">
						<?php
							$select = "SELECT *  FROM `cities` WHERE `status` = '1'";
							$result = mysqli_query($con, $select);
							if(mysqli_num_rows($result) > 0)
							{
								while($row = mysqli_fetch_array($result))
								{
						?>
							<li><a class="dropdown-item" href="cities-advertisements.php?id=<?php echo $row['cid'] ?>&name=<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></a></li>						
						<?php
								}
							}
						?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>