<?php
	$title = "Real Estate | Citizz Adzz";
	include 'header.php';
?>
<?php
	$id = $_GET['id'];
	$select = "SELECT * FROM `real_estate` WHERE `re_id` = '$id'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Real Estate</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="card shadow-sm mb-3">
					<div class="card-header">
						<h5 class="card-title">Update Real Estate</h5>
					</div>
					<div class="card-body">
						<img src="../assets/img/real_estate/<?php echo $row['re_img'] ?>" class="img-fluid" width="200">
						<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
							<div class="col-xl-5 col-lg-4 col-md-4 mb-3">
								<label>Select Multiple Images:<span class="text-danger fw-bold"> *</span></label>
								<input type="file" class="form-control" name="re_img" accept=".jpg, .jpeg, .pdf, .png, .gif">
							</div>
							<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
								<label>Select City:<span class="text-danger fw-bold"> *</span></label>
								<select class="form-control" name="re_city" required>
									<option value="">-- Select City --</option>
									<?php
										$cselect = "SELECT * FROM `cities` WHERE `status` = '1'";
										$cresult = mysqli_query($con, $cselect);
										if(mysqli_num_rows($cresult) > 0)
										{
											while($crow = mysqli_fetch_array($cresult))
											{
									?>
									<option value="<?php echo $crow['cid'] ?>" <?php echo $crow['cid'] == $row['re_city'] ? 'selected' : '' ?>><?php echo $crow['cname'] ?></option>
									<?php
											}
										}
									?>
								</select>
							</div>
							<div class="col-xl-2 col-lg-2 col-md-2 mb-3">
								<label>Select Status:</label>
								<select class="form-control" name="re_status">
									<option value="1" <?php echo $row['re_status'] == '1' ? 'selected' : '' ?>>Active</option>
									<option value="2" <?php echo $row['re_status'] == '2' ? 'selected' : '' ?>>Inactive</option>
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
	$('.sidebar .nav .nav-item#real_estate').addClass('active');
</script>

<?php
	/*** Submit ***/
	if (isset($_POST['update']))
	{
		$entry_date = date('Y-m-d');
		$re_city = mysqli_real_escape_string($con, $_POST['re_city']);
		$re_status = mysqli_real_escape_string($con, $_POST['re_status']);			

		if(!empty($_FILES['re_img']['name']))
		{
			$target_dir = '../assets/img/real_estate/';
			$re_img = $_FILES['re_img']['name'];
			$re_img_tmp = $_FILES['re_img']['tmp_name'];

			if(file_exists($target_dir . basename($re_img)))
			{
				echo ("<script LANGUAGE='JavaScript'>
			        alert('".$re_img." already exists !');
			        window.location.href = '';
			    </script>");
			}
			else
			{
				if(move_uploaded_file($re_img_tmp, $target_dir . basename($re_img)))
				{
					unlink('../assets/img/real_estate/'.$row['re_img']);
					$update = "UPDATE `real_estate` SET `re_entry` = '$entry_date', `re_city` = '$re_city', `re_img` = '$re_img', `re_status` = '$re_status' WHERE `re_id` = '$id'";
				}				
			}
		}
		else
		{
			$update = "UPDATE `real_estate` SET `re_entry` = '$entry_date', `re_city` = '$re_city', `re_status` = '$re_status' WHERE `re_id` = '$id'";
		}
		// echo $update; exit;
		$result = mysqli_query($con, $update);
		if ($result)
		{
			echo "
		        <script LANGUAGE='JavaScript'>;
		          swal('Success', 'Data Updated!', 'success')
		          .then(() => {
		            location.href = 'real-estate.php'
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