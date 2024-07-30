<?php
	$title = "Dashboard | Citizz Adzz";
	include 'header.php';
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Dashboard</h4>
		<div class="row">
			<div class="col-xl-3 col-lg-6 col-md-3 col-6 d-flex align-items-stretch text-center text-lg-start">
				<div class="card text-light bg-default w-100">
					<div class="card-body">
						<div class="row">
							<div class="col-xl-4 col-lg-4">
								<div class="fs-1 text-center">
									<i class="bi bi-megaphone"></i>
								</div>
							</div>
							<div class="col-xl-8 col-lg-8">
								<div class="numbers">
									<p class="card-category">Advertisements</p>
									<h4 class="card-title"><?php echo mysqli_num_rows(mysqli_query($con, 'SELECT * FROM `advertisements`')); ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-3 col-6 d-flex align-items-stretch text-center text-lg-start">
				<div class="card text-bg-success w-100">
					<div class="card-body ">
						<div class="row">
							<div class="col-xl-4 col-lg-4">
								<div class="fs-1 text-center">
									<i class="bi bi-buildings"></i>
								</div>
							</div>
							<div class="col-xl-8 col-lg-8">
								<div class="numbers">
									<p class="card-category">Cities</p>
									<h4 class="card-title"><?php echo mysqli_num_rows(mysqli_query($con, 'SELECT * FROM `cities`')); ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-3 col-6 d-flex align-items-stretch text-center text-lg-start">
				<div class="card text-bg-danger w-100">
					<div class="card-body">
						<div class="row">
							<div class="col-xl-4 col-lg-4">
								<div class="fs-1 text-center">
									<i class="bi bi-briefcase"></i>
								</div>
							</div>
							<div class="col-xl-8 col-lg-8">
								<div class="numbers">
									<p class="card-category">Jobs & Careers</p>
									<h4 class="card-title"><?php echo mysqli_num_rows(mysqli_query($con, 'SELECT * FROM `jobs_careers`')); ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-3 col-6 d-flex align-items-stretch text-center text-lg-start">
				<div class="card text-bg-dark w-100">
					<div class="card-body">
						<div class="row">
							<div class="col-xl-4 col-lg-4">
								<div class="fs-1 text-center">
									<i class="bi bi-house-heart"></i>
								</div>
							</div>
							<div class="col-xl-8 col-lg-8">
								<div class="numbers">
									<p class="card-category">Real Estate</p>
									<h4 class="card-title"><?php echo mysqli_num_rows(mysqli_query($con, 'SELECT * FROM `real_estate`')); ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-3 col-6 d-flex align-items-stretch text-center text-lg-start">
				<div class="card text-bg-primary w-100">
					<div class="card-body ">
						<div class="row">
							<div class="col-xl-4 col-lg-4">
								<div class="fs-1 text-center">
									<i class="bi bi-people"></i>
								</div>
							</div>
							<div class="col-xl-8 col-lg-8">
								<div class="numbers">
									<p class="card-category">Users</p>
									<h4 class="card-title"><?php echo mysqli_num_rows(mysqli_query($con, 'SELECT * FROM `users`')); ?></h4>
								</div>
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
	$('.sidebar .nav .nav-item#dashboard').addClass('active');
</script>