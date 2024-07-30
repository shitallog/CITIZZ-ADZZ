<?php $title = "City Advertisements - Citizz Adzz"; ?>
<?php include 'header.php'; ?>
<?php
	$id = $_GET['id'];
	$select = "SELECT * FROM `cities` WHERE `cid` = '$id' AND `status` = '1'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
<div class="container-fluid">
	<div class="py-2 text-center">
		<a href="index.php"><img src="assets/img/logo.png" class="img-fluid"></a>
	</div>
</div>
<div id="wrapper">
	<section class="page-title py-5">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 text-center">
					<h1 class="text-light"><?php echo $row['cname'] ?></h1>
					<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3">
						<ol class="breadcrumb px-3 py-2">
							<li class="breadcrumb-item">
								<a href="index.php" class="text-light text-decoration-none">Home</a>
							</li>
							<li class="breadcrumb-item fw-bold"><?php echo $row['cname'] ?></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="py-5">
		<div class="container">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<?php
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];
						if(isset($user, $user_id))
						{							
				?>
				<nav class="text-bg-light mb-4 shadow-sm">
					<div class="nav nav-pills nav-fill justify-content-center bg-white fw-semibold border" id="nav-tab" role="tablist">
						<button class="nav-link rounded-0 text-uppercase active" id="nav-jobscareers-tab-<?php echo $id ?>" data-bs-toggle="tab" data-bs-target="#nav-jobscareers-<?php echo $id ?>" type="button" role="tab" aria-controls="nav-jobscareers-<?php echo $id ?>" aria-selected="true">jobs & careers</button>
						<button class="nav-link rounded-0 text-uppercase" id="nav-realestate-tab-<?php echo $id ?>" data-bs-toggle="tab" data-bs-target="#nav-realestate-<?php echo $id ?>" type="button" role="tab" aria-controls="nav-realestate-<?php echo $id ?>" aria-selected="false">real estate</button>
						<button class="nav-link rounded-0 text-uppercase" id="nav-advertisements-tab-<?php echo $id ?>" data-bs-toggle="tab" data-bs-target="#nav-advertisements-<?php echo $id ?>" type="button" role="tab" aria-controls="nav-advertisements-<?php echo $id ?>" aria-selected="false">advertisements</button>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-jobscareers-<?php echo $id ?>" role="tabpanel" aria-labelledby="nav-jobscareers-tab-<?php echo $id ?>" tabindex="0">
						<div class="row gy-3" d_data-masonry='{"percentPosition": true }'>
							<?php
								$select = "SELECT * FROM `city_adverts` WHERE `city_id` = '$id' AND `ca_type` = 'jobs_careers' AND `ca_status` = '1'";
								$result = mysqli_query($con, $select);
								if(mysqli_num_rows($result) > 0)
								{
									$root=(isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
									$root.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
									while($row = mysqli_fetch_array($result))
									{
										if(pathinfo($row['ca_img'], PATHINFO_EXTENSION) == 'pdf')
										{
							?>
							<div class="col-xl-4 col-lg-4 col-md-4 d-flex">
								<div class="card w-100">
									<div class="card-header">
										<a href="<?php echo $root ?>assets/img/cities/<?php echo $row['ca_img'] ?>" class="btn btn-sm btn-custom-gradient float-end" target="_blank">
											<i class="bi bi-file-earmark-pdf-fill me-2"></i>View PDF File
										</a>
									</div>
									<div class="card-body">
										<canvas id="pdf-canvas" url="<?php echo $root ?>assets/img/cities/<?php echo $row['ca_img'] ?>" class="img-fluid w-100 h-100" width="" height="250"></canvas>
									</div>						
								</div>					
							</div>
							<?php
										}
										else
										{
							?>
							<div class="col-xl-4 col-lg-4 col-md-4 d-flex">
								<a href="assets/img/cities/<?php echo $row['ca_img'] ?>" class="image-popup d-flex h-100">
									<img src="assets/img/cities/<?php echo $row['ca_img'] ?>" class="img-fluid shadow" lazyload>
								</a>
							</div>
							<?php
										}
									}
								}
								else
								{
						?>
									<div class="row">
										<div class="col-xl-12">
											<div class="alert alert-warning fade show shadow-sm" role="alert">
												No Advertisements Found.
											</div>
										</div>
									</div>
						<?php
								}
							?>
						</div>
					</div>
					<div class="tab-pane fade" id="nav-realestate-<?php echo $id ?>" role="tabpanel" aria-labelledby="nav-realestate-tab-<?php echo $id ?>" tabindex="0">
						<div class="row gy-3" d_data-masonry='{"percentPosition": true }'>
							<?php
								$select = "SELECT * FROM `city_adverts` WHERE `city_id` = '$id' AND `ca_type` = 'real_estate' AND `ca_status` = '1'";
								$result = mysqli_query($con, $select);
								if(mysqli_num_rows($result) > 0)
								{
									$root=(isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
									$root.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
									while($row = mysqli_fetch_array($result))
									{
										if(pathinfo($row['ca_img'], PATHINFO_EXTENSION) == 'pdf')
										{
							?>
							<div class="col-xl-4 col-lg-4 col-md-4 d-flex">
								<div class="card w-100">
									<div class="card-header">
										<a href="<?php echo $root ?>assets/img/cities/<?php echo $row['ca_img'] ?>" class="btn btn-sm btn-custom-gradient float-end" target="_blank">
											<i class="bi bi-file-earmark-pdf-fill me-2"></i>View PDF File
										</a>
									</div>
									<div class="card-body">
										<canvas id="pdf-canvas" url="<?php echo $root ?>assets/img/cities/<?php echo $row['ca_img'] ?>" class="img-fluid w-100 h-100" width="" height="250"></canvas>
									</div>						
								</div>					
							</div>
							<?php
										}
										else
										{
							?>
							<div class="col-xl-4 col-lg-4 col-md-4 d-flex">
								<a href="assets/img/cities/<?php echo $row['ca_img'] ?>" class="image-popup d-flex h-100">
									<img src="assets/img/cities/<?php echo $row['ca_img'] ?>" class="img-fluid shadow" lazyload>
								</a>
							</div>
							<?php
										}
									}
								}
								else
								{
						?>
									<div class="row">
										<div class="col-xl-12">
											<div class="alert alert-warning fade show shadow-sm" role="alert">
												No Advertisements Found.
											</div>
										</div>
									</div>
						<?php
								}
							?>
						</div>
					</div>
					<div class="tab-pane fade" id="nav-advertisements-<?php echo $id ?>" role="tabpanel" aria-labelledby="nav-advertisements-tab-<?php echo $id ?>" tabindex="0">
						<div class="row gy-3" d_data-masonry='{"percentPosition": true }'>
							<?php
								$select = "SELECT * FROM `city_adverts` WHERE `city_id` = '$id' AND `ca_type` = 'advertisements' AND `ca_status` = '1'";
								$result = mysqli_query($con, $select);
								if(mysqli_num_rows($result) > 0)
								{
									$root=(isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
									$root.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
									while($row = mysqli_fetch_array($result))
									{
										if(pathinfo($row['ca_img'], PATHINFO_EXTENSION) == 'pdf')
										{
							?>
							<div class="col-xl-4 col-lg-4 col-md-4 d-flex">
								<div class="card w-100">
									<div class="card-header">
										<a href="<?php echo $root ?>assets/img/cities/<?php echo $row['ca_img'] ?>" class="btn btn-sm btn-custom-gradient float-end" target="_blank">
											<i class="bi bi-file-earmark-pdf-fill me-2"></i>View PDF File
										</a>
									</div>
									<div class="card-body">
										<canvas id="pdf-canvas" url="<?php echo $root ?>assets/img/cities/<?php echo $row['ca_img'] ?>" class="img-fluid w-100 h-100" width="" height="250"></canvas>
									</div>						
								</div>					
							</div>
							<?php
										}
										else
										{
							?>
							<div class="col-xl-4 col-lg-4 col-md-4 d-flex">
								<a href="assets/img/cities/<?php echo $row['ca_img'] ?>" class="image-popup d-flex h-100">
									<img src="assets/img/cities/<?php echo $row['ca_img'] ?>" class="img-fluid shadow" lazyload>
								</a>
							</div>
							<?php
										}
									}
								}
								else
								{
						?>
									<div class="row">
										<div class="col-xl-12">
											<div class="alert alert-warning fade show shadow-sm" role="alert">
												No Advertisements Found.
											</div>
										</div>
									</div>
						<?php
								}
							?>
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
						<div class="alert alert-warning fade show shadow-sm" role="alert">
							Please <a href="sign-in.php" class="fw-bold">login</a> or <a href="sign-up.php" class="fw-bold">register</a> to view this page.
						</div>
					</div>
				</div>
				<?php
						}
					}
				?>
			</div>
		</div>
	</section>
</div>
<?php include 'footer.php'; ?>