<?php
	$title = "Cities | Citizz Adzz";
	include 'header.php';
?>
<?php
	$id = $_GET['id'];
	$select = "SELECT * FROM `cities` WHERE `cid` = '$id'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Cities</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-8 col-lg-10 col-md-10">
						<div class="card shadow-sm mb-3">
							<div class="card-header">
								<h5 class="card-title">Update Cities</h5>
							</div>
							<div class="card-body">
								<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
									<div class="col-xl-6 col-lg-6 col-md-6 mb-3">
										<label>City Name:<span class="text-danger fw-bold"> *</span></label>
										<input type="text" class="form-control" name="cname" placeholder="Enter City Name" value="<?php echo $row['cname'] ?>" required>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
										<label>Status:</label>
										<select class="form-control" name="status">
											<option value="1" <?php echo $row['status'] == '1' ? 'selected' : '' ?>>Active</option>
											<option value="2" <?php echo $row['status'] == '2' ? 'selected' : '' ?>>Inactive</option>
										</select>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
										<button type="submit" class="form-control btn btn-sm btn-default text-uppercase py-2" name="update_cities">update</button>
									</div>
								</form>
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
	$('.sidebar .nav .nav-item#cities').addClass('active');
</script>

<?php
	/*** Submit ***/
	if (isset($_POST['update_cities']))
	{
		$cname = mysqli_real_escape_string($con, $_POST['cname']);
		$status = mysqli_real_escape_string($con, $_POST['status']);

		$update = "UPDATE `cities` SET `cname` = '$cname', `status` = '$status' WHERE `cid` = '$id'";
		$result = mysqli_query($con, $update);
		if ($result)
		{
			echo "
        <script LANGUAGE='JavaScript'>;
          swal('Success', 'Data Updated!', 'success')
          .then(() => {
            location.href = 'cities.php'
          });
        </script>
      ";
		}
		else
		{
			echo ("<script LANGUAGE='JavaScript'>
        swal('Error', 'There was an error occurred. Please try again later!', 'error')
          .then(() => {
            location.href = ''
          });
      </script>");
		}
	}
?>