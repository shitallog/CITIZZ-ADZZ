<?php $title = "Advertisements - Citizz Adzz"; ?>
<?php include 'header.php'; ?>
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
					<h1 class="text-light">Advertisements</h1>
					<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3">
						<ol class="breadcrumb px-3 py-2">
							<li class="breadcrumb-item">
								<a href="index.php" class="text-light text-decoration-none">Home</a>
							</li>
							<li class="breadcrumb-item fw-bold">Advertisements</li>
						</ol>
					</div>
					<div class="text-center">
						<p class="fs-4 fw-semibold text-light">Select Cities to view details:</p>
						<div class="dropdown-center">
							<a href="#" class="btn btn-outline-light btn-lg rounded-pill dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="px-2">Select Cities</span></a>
							<ul class="dropdown-menu dropdown-menu-dark">
							<?php
								$select = "SELECT *  FROM `cities` WHERE `status` = '1'";
								$result = mysqli_query($con, $select);
								if(mysqli_num_rows($result) > 0)
								{
									while($row = mysqli_fetch_array($result))
									{
							?>
								<li><a class="dropdown-item" href="advertisements.php?id=<?php echo $row['cid'] ?>&name=<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></a></li>						
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
	</section>
	<section class="py-5">
		<div class="container">			
			<?php
				if(isset($user_id, $user))
				{
					if(isset($_GET['id']))
					{
			?>
			<h3 class="display-5">Advertisements in <?php echo isset($_GET['name']) ? $_GET['name'] : '' ?></h3>
			<hr class="pb-3">
			<?php
						$id = $_GET['id'];
						$select = "SELECT * FROM `advertisements` WHERE `ad_city` = '$id' AND `ad_status` = '1'";
						$result = mysqli_query($con, $select);
						if(mysqli_num_rows($result) > 0)
						{
							$root=(isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
							$root.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
			?>			
			<div class="row gy-3" d_data-masonry='{"percentPosition": true }'>
				<?php
							while($row = mysqli_fetch_array($result))
							{
								if(pathinfo($row['ad_img'], PATHINFO_EXTENSION) == 'pdf')
								{
				?>
				<div class="col-xl-4 col-lg-4 col-md-4 d-flex">
					<div class="card w-100">
						<div class="card-header">
							<a href="<?php echo $root ?>assets/img/advertisements/<?php echo $row['ad_img'] ?>" class="btn btn-sm btn-custom-gradient float-end" target="_blank">
								<i class="bi bi-file-earmark-pdf-fill me-2"></i>View PDF File
							</a>
						</div>
						<div class="card-body">
							<canvas id="pdf-canvas" url="<?php echo $root ?>assets/img/advertisements/<?php echo $row['ad_img'] ?>" class="img-fluid w-100 h-100" width="" height="250"></canvas>
						</div>						
					</div>					
				</div>
				<?php
								}
								else
								{
				?>
				<div class="col-xl-4 col-lg-4 col-md-4 d-flex">
					<a href="assets/img/advertisements/<?php echo $row['ad_img'] ?>" class="image-popup d-flex h-100">
						<img src="assets/img/advertisements/<?php echo $row['ad_img'] ?>" class="img-fluid shadow" lazyload>
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
			<?php
					}
					else
					{
			?>
						<div class="row">
							<div class="col-xl-12">
								<div class="alert alert-warning fade show shadow-sm" role="alert">
									Please select cities to view.
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