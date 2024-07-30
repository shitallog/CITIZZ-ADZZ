<?php
	$title = "Jobs & Careers | Citizz Adzz";
	include 'header.php';
?>
<?php
	$id = $_GET['id'];
	$select = "SELECT * FROM `jobs_careers` WHERE `jc_id` = '$id'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Jobs & Careers</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="card shadow-sm mb-3">
					<div class="card-header">
						<h5 class="card-title">Update Jobs & Careers</h5>
					</div>
					<div class="card-body">
						<img src="../assets/img/jobs_careers/<?php echo $row['jc_img'] ?>" class="img-fluid" width="200">
						<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
							<div class="col-xl-5 col-lg-4 col-md-4 mb-3">
								<label>Select Multiple Images:<span class="text-danger fw-bold"> *</span></label>
								<input type="file" class="form-control" name="jc_img" accept=".jpg, .jpeg, .pdf, .png, .gif">
							</div>
							<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
								<label>Select City:<span class="text-danger fw-bold"> *</span></label>
								<select class="form-control" name="jc_city" required>
									<option value="">-- Select City --</option>
									<?php
										$cselect = "SELECT * FROM `cities` WHERE `status` = '1'";
										$cresult = mysqli_query($con, $cselect);
										if(mysqli_num_rows($cresult) > 0)
										{
											while($crow = mysqli_fetch_array($cresult))
											{
									?>
									<option value="<?php echo $crow['cid'] ?>" <?php echo $crow['cid'] == $row['jc_city'] ? 'selected' : '' ?>><?php echo $crow['cname'] ?></option>
									<?php
											}
										}
									?>
								</select>
							</div>
							<div class="col-xl-2 col-lg-3 col-md-3 mb-3">
								<label>Select Status:</label>
								<select class="form-control" name="jc_status">
									<option value="1" <?php echo $row['jc_status'] == '1' ? 'selected' : '' ?>>Active</option>
									<option value="2" <?php echo $row['jc_status'] == '2' ? 'selected' : '' ?>>Inactive</option>
								</select>
							</div>
							<div class="col-xl-2 col-lg-2 col-md-2 mb-3">
								<button type="submit" class="form-control btn btn-sm btn-default text-uppercase py-2" name="update">update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$('.sidebar .nav .nav-item#jobs_careers').addClass('active');
</script>

<?php
	/*** Submit ***/
	if (isset($_POST['update']))
	{
		$entry_date = date('Y-m-d');
		$jc_city = mysqli_real_escape_string($con, $_POST['jc_city']);
		$jc_status = mysqli_real_escape_string($con, $_POST['jc_status']);			

		if(!empty($_FILES['jc_img']['name']))
		{
			$target_dir = '../assets/img/jobs_careers/';
			$jc_img = $_FILES['jc_img']['name'];
			$jc_img_tmp = $_FILES['jc_img']['tmp_name'];

			if(file_exists($target_dir . basename($jc_img)))
			{
				echo ("<script LANGUAGE='JavaScript'>
			        alert('".$jc_img." already exists !');
			        window.location.href = '';
			    </script>");
			}
			else
			{
				if(move_uploaded_file($jc_img_tmp, $target_dir . basename($jc_img)))
				{
					unlink('../assets/img/jobs_careers/'.$row['jc_img']);
					$update = "UPDATE `jobs_careers` SET `jc_entry` = '$entry_date', `jc_city` = '$jc_city', `jc_img` = '$jc_img', `jc_status` = '$jc_status' WHERE `jc_id` = '$id'";
				}				
			}
		}
		else
		{
			$update = "UPDATE `jobs_careers` SET `jc_entry` = '$entry_date', `jc_city` = '$jc_city', `jc_status` = '$jc_status' WHERE `jc_id` = '$id'";
		}
		// echo $update; exit;
		$result = mysqli_query($con, $update);
		if ($result)
		{
			echo "
		        <script LANGUAGE='JavaScript'>;
		          swal('Success', 'Data Updated!', 'success')
		          .then(() => {
		            location.href = 'jobs-careers.php'
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