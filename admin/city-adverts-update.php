<?php
	$title = "City Advertisements | Citizz Adzz";
	include 'header.php';
?>
<?php
	$id = $_GET['id'];
	$select = "SELECT * FROM `city_adverts` WHERE `ca_id` = '$id'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Cities</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12">
						<div class="card shadow-sm mb-3">
							<div class="card-header">
								<h5 class="card-title">Update City Advertisements</h5>
							</div>
							<div class="card-body">
								<img src="../assets/img/cities/<?php echo $row['ca_img'] ?>" class="img-fluid" width="200">
								<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
									<div class="col-xl-3 col-lg-4 col-md-4 mb-3">
										<label>Select City:<span class="text-danger fw-bold"> *</span></label>
										<select class="form-control" name="city_id" required>
											<option value="">-- Select City --</option>
											<?php
												$cselect = "SELECT * FROM `cities` WHERE `status` = '1'";
												$cresult = mysqli_query($con, $cselect);
												if(mysqli_num_rows($cresult) > 0)
												{
													while($crow = mysqli_fetch_array($cresult))
													{
											?>
											<option value="<?php echo $crow['cid'] ?>" <?php echo $crow['cid'] == $row['city_id'] ? 'selected' : '' ?>><?php echo $crow['cname'] ?></option>
											<?php
													}
												}
											?>
										</select>
									</div>									
									<div class="col-xl-4 col-lg-5 col-md-5 mb-3">
										<label>Select Image:<span class="text-danger fw-bold"> *</span></label>
										<input type="file" class="form-control" name="ca_img" accept=".jpg, .jpeg, .pdf, .png, .gif">
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
										<label>Select Type:</label>
										<select class="form-control" name="ca_type" required>
											<option value="">-- Select Type --</option>
											<option value="jobs_careers" <?php echo $row['ca_type'] == 'jobs_careers' ? 'selected' : '' ?>>Jobs & Careers</option>
											<option value="real_estate" <?php echo $row['ca_type'] == 'real_estate' ? 'selected' : '' ?>>Real Estate</option>
											<option value="advertisements" <?php echo $row['ca_type'] == 'advertisements' ? 'selected' : '' ?>>Advertisements</option>
										</select>
									</div>
									<div class="col-xl-2 col-lg-3 col-md-3 mb-3">
										<label>Select Status:</label>
										<select class="form-control" name="ca_status">
											<option value="1" <?php echo $row['ca_status'] == '1' ? 'selected' : '' ?>>Active</option>
											<option value="2" <?php echo $row['ca_status'] == '2' ? 'selected' : '' ?>>Inactive</option>
										</select>
									</div>
									<div class="col-xl-2 col-lg-2 col-md-2 mb-3">
										<button type="submit" class="form-control btn btn-sm btn-default text-uppercase py-2" name="update_city_adverts">update</button>
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
	if (isset($_POST['update_city_adverts']))
	{
		$entry_date = date('Y-m-d');
		$city_id = mysqli_real_escape_string($con, $_POST['city_id']);
		$ca_type = mysqli_real_escape_string($con, $_POST['ca_type']);		
		$ca_status = mysqli_real_escape_string($con, $_POST['ca_status']);			

		if(!empty($_FILES['ca_img']['name']))
		{
			$target_dir = '../assets/img/cities/';
			$ca_img = $_FILES['ca_img']['name'];
			$ca_img_tmp = $_FILES['ca_img']['tmp_name'];

			if(file_exists($target_dir . basename($ca_img)))
			{
				echo ("<script LANGUAGE='JavaScript'>
	        alert('".$ca_img." already exists !');
	        window.location.href = '';
	      </script>");
			}
			else
			{
				if(move_uploaded_file($ca_img_tmp, $target_dir . basename($ca_img)))
				{
					unlink('../assets/img/cities/'.$row['ca_img']);
					$update = "UPDATE `city_adverts` SET `ca_entry` = '$entry_date', `city_id` = '$city_id', `ca_img` = '$ca_img', `ca_type` = '$ca_type', `ca_status` = '$ca_status' WHERE `ca_id` = '$id'";
				}				
			}
		}
		else
		{
			$update = "UPDATE `city_adverts` SET `ca_entry` = '$entry_date', `city_id` = '$city_id', `ca_type` = '$ca_type', `ca_status` = '$ca_status' WHERE `ca_id` = '$id'";
		}
		// echo $update; exit;
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