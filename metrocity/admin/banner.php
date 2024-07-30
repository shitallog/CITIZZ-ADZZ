<?php
include("header.php");
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Banner</h4>
		<div class="row">
<?php
if(isset($_GET["bid"]))
{
	$bid = $_GET["bid"];
	$select = "SELECT * FROM `banner` WHERE `bid` = '$bid'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Edit Banner</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data">				
							<div class="form-group col-md-3">
                              	<label>Banner Image</label>
								<input type="file" name="banner_img" class="form-control-file" value="<?php echo $row['banner_img']; ?>" accept=".jpg, .jpeg, .gif, .png">
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
								<img src="../images/banner/<?php echo $row['banner_img']; ?>" class="img-fluid w-100 mt-4" loading="lazy">
							</div>
							<div class="form-group col-md-3">
								<label>Date on which banner has to be displayed</label>
								<input type="date" name="banner_date" class="form-control" value="<?php echo $row["banner_date"]; ?>" required>
							</div>
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1" <?php if($row["status"] == '1') echo 'selected'; ?> >Active</option>
									<option value="2" <?php if($row["status"] == '2') echo 'selected'; ?> >Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="upd_banner" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
<?php
}
else
{
?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Add Banner</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data">				
							<div class="form-group col-md-3">
								<label>Banner Image <span class="text-danger">*</span></label>                              	
								<input type="file" name="banner_img" class="form-control-file" accept=".jpg, .jpeg, .gif, .png" required>
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
							</div>
							<div class="form-group col-md-3">
								<label>Date on which banner has to be displayed<span class="text-danger"> *</span></label>
								<input type="date" name="banner_date" class="form-control" required>
							</div>
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="add_banner" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Banner Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th width="10%">Sr.No.</th>
										<th width="40%">Image</th>
										<th width="15%">Date</th>
										<th width="15%">Status</th>
										<th width="20%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `banner`";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$bid = $row["bid"];
												$banner_img = $row["banner_img"];
												$banner_date = $row["banner_date"];
												$status = $row["status"];
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><img src="../images/banner/<?php echo $banner_img; ?>" class="img-fluid w-75" loading="lazy"></td>
										<td><?php echo $banner_date; ?></td>
										<td><?php if($status == '1'){ echo 'Active'; } else{ echo 'Inactive'; } ?></td>
										<td>											
											<a href="banner.php?bid=<?php echo $bid; ?>" class="btn-sm btn-success m-1">
												<i class="la la-edit"></i>
											</a>
											<a href="banner.php?del_bid=<?php echo $bid; ?>&del_img=<?php echo $banner_img; ?>" onclick="deletebanner(this.href, event);" class="btn-sm btn-danger m-1">
												<i class="la la-trash"></i>
											</a>
										</td>
									</tr>
									<?php
												$srno++;
											}
										}
									?>
								</tbody>
							</table>
						</div>
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
include("footer.php");
?>
<script type="text/javascript">
	$(".sidebar .nav .banner").addClass("active");

	function deletebanner(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
</script>

<?php
if (isset($_POST['add_banner']))
{
	$banner_date = mysqli_real_escape_string($con, $_POST['banner_date']);
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$target_dir = "../images/banner/";
	$banner_img = $_FILES['banner_img']['name'];
	$target_file = $target_dir . basename($banner_img);

	if (move_uploaded_file($_FILES["banner_img"]["tmp_name"], $target_file))
	{
		$insert = "INSERT INTO `banner`(`banner_img`, `banner_date`, `status`) VALUES ('$banner_img','$banner_date','$status')";
		$ins_result = mysqli_query($con, $insert);

		if ($ins_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Banner Added Successfully');
                window.location.href=''; 
              </script>
			";
		}
		else
		{
			echo ("<script LANGUAGE='JavaScript'>
	              window.alert('There was an error occured please try again later');
	              window.location.href=''; 
	        </script>");
		}
	}
}

if (isset($_POST['upd_banner']))
{
	$banner_date = mysqli_real_escape_string($con, $_POST['banner_date']);
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$target_dir = "../images/banner/";
	$banner_img = $_FILES['banner_img']['name'];
	$target_file = $target_dir . basename($banner_img);

	if (move_uploaded_file($_FILES["banner_img"]["tmp_name"], $target_file))
	{
		$sel_img = "SELECT * FROM `banner` WHERE `bid` = '$_GET[bid]'";
		$res_img = mysqli_query($con, $sel_img);
		$row_img = mysqli_fetch_array($res_img);
		unlink("../images/banner/".$row_img['banner_img']);

		$update = "UPDATE `banner` SET `banner_img`='$banner_img',`banner_date`='$banner_date',`status`='$status' WHERE `bid`='$_GET[bid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Banner Updated Successfully');
                window.location.href='banner.php'; 
              </script>
			";
		}
		else
		{
			echo ("<script LANGUAGE='JavaScript'>
	              window.alert('There was an error occured please try again later');
	              window.location.href=''; 
	        </script>");
		}
	}
	else
	{
		$update = "UPDATE `banner` SET `banner_date`='$banner_date',`status`='$status' WHERE `bid`='$_GET[bid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Banner Updated Successfully');
                window.location.href='banner.php'; 
              </script>
			";
		}
		else
		{
			echo ("<script LANGUAGE='JavaScript'>
	              window.alert('There was an error occured please try again later');
	              window.location.href=''; 
	        </script>");
		}
	}
}

if (isset($_GET['del_bid']) && isset($_GET['del_img']))
{
	$del_bid = $_GET['del_bid'];
	$del_img = $_GET['del_img'];

	$delete = "DELETE FROM `banner` WHERE `bid` = '$del_bid'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		unlink("../images/banner/".$del_img);
		echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Banner Deleted Successfully');
                window.location.href='banner.php'; 
              </script>
			";
	}
}
?>