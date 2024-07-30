<?php
include("header.php");

$sel_banner = "SELECT * FROM `banner`";
$res_banner = mysqli_query($con, $sel_banner);
$count_banner = mysqli_num_rows($res_banner);

$sel_projects = "SELECT * FROM `projects`";
$res_projects = mysqli_query($con, $sel_projects);
$count_projects = mysqli_num_rows($res_projects);

$sel_gallery = "SELECT * FROM `gallery`";
$res_gallery = mysqli_query($con, $sel_gallery);
$count_gallery = mysqli_num_rows($res_gallery);

$sel_blogs = "SELECT * FROM `blogs`";
$res_blogs = mysqli_query($con, $sel_blogs);
$count_blogs = mysqli_num_rows($res_blogs);

$sel_news = "SELECT * FROM `news`";
$res_news = mysqli_query($con, $sel_news);
$count_news = mysqli_num_rows($res_news);

$sel_adverts = "SELECT * FROM `adverts`";
$res_adverts = mysqli_query($con, $sel_adverts);
$count_adverts = mysqli_num_rows($res_adverts);

$sel_enquiry = "SELECT * FROM `enquiry`";
$res_enquiry = mysqli_query($con, $sel_enquiry);
$count_enquiry = mysqli_num_rows($res_enquiry);

$sel_p_enquiry = "SELECT * FROM `project_enquiry`";
$res_p_enquiry = mysqli_query($con, $sel_p_enquiry);
$count_p_enquiry = mysqli_num_rows($res_p_enquiry);

$sel_contact = "SELECT * FROM `contact_us`";
$res_contact = mysqli_query($con, $sel_contact);
$count_contact = mysqli_num_rows($res_contact);
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Dashboard</h4>
		<div class="row">
			<div class="col-md-3">
				<div class="card card-stats card-default">
					<div class="card-body ">
						<div class="row">
							<div class="col-4">
								<div class="icon-big text-center">
									<i class="la la-image"></i>
								</div>
							</div>
							<div class="col-8 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category text-uppercase">banner</p>
									<h4 class="card-title"><?php echo $count_banner; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="card card-stats card-warning">
					<div class="card-body ">
						<div class="row">
							<div class="col-4">
								<div class="icon-big text-center">
									<i class="la la-building"></i>
								</div>
							</div>
							<div class="col-8 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category text-uppercase">projects</p>
									<h4 class="card-title"><?php echo $count_projects; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="card card-stats card-success">
					<div class="card-body ">
						<div class="row">
							<div class="col-4">
								<div class="icon-big text-center">
									<i class="la la-clone"></i>
								</div>
							</div>
							<div class="col-8 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category text-uppercase">gallery</p>
									<h4 class="card-title"><?php echo $count_gallery; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="card card-stats card-danger">
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<div class="icon-big text-center">
									<i class="la la-comment"></i>
								</div>
							</div>
							<div class="col-8 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category text-uppercase">blog</p>
									<h4 class="card-title"><?php echo $count_blogs; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="card card-stats card-primary">
					<div class="card-body ">
						<div class="row">
							<div class="col-4">
								<div class="icon-big text-center">
									<i class="la la-newspaper-o"></i>
								</div>
							</div>
							<div class="col-8 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category text-uppercase">news</p>
									<h4 class="card-title"><?php echo $count_news; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="card card-stats card-info">
					<div class="card-body ">
						<div class="row">
							<div class="col-4">
								<div class="icon-big text-center">
									<i class="la la-picture-o"></i>
								</div>
							</div>
							<div class="col-8 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category text-uppercase">Advertisement</p>
									<h4 class="card-title"><?php echo $count_adverts; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="card card-stats card-default">
					<div class="card-body ">
						<div class="row">
							<div class="col-4">
								<div class="icon-big text-center">
									<i class="la la-pencil-square"></i>
								</div>
							</div>
							<div class="col-8 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Enquiry</p>
									<h4 class="card-title"><?php echo $count_enquiry+$count_p_enquiry; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="card card-stats card-primary">
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<div class="icon-big text-center">
									<i class="la la-phone"></i>
								</div>
							</div>
							<div class="col-8 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Contact Us</p>
									<h4 class="card-title"><?php echo $count_contact; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			

			<!-- <div class="col-md-3">
				<div class="card card-stats">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center icon-warning">
									<i class="la la-pie-chart text-warning"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Number</p>
									<h4 class="card-title">150GB</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card card-stats">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="la la-bar-chart text-success"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Revenue</p>
									<h4 class="card-title">$ 1,345</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card card-stats">
					<div class="card-body">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="la la-times-circle-o text-danger"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Errors</p>
									<h4 class="card-title">23</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card card-stats">
					<div class="card-body">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="la la-heart-o text-primary"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Followers</p>
									<h4 class="card-title">+45K</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</div>
<?php
include("footer.php");
?>
<script type="text/javascript">
	$(".sidebar .nav .dashboard").addClass("active");
</script>