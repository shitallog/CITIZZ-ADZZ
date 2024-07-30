<?php
include("header.php");
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Advertisements</h4>
		<div class="row">
<?php
if(isset($_GET["aid"]))
{
	$aid = $_GET["aid"];
	$select = "SELECT * FROM `adverts` WHERE `aid` = '$aid'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Edit Advertisements</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data">				
							<div class="form-group col-md-3">
								<label>Adverts Image</label>
								<input type="file" name="adverts_img" class="form-control-file" value="<?php echo $row['adverts_img']; ?>">
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
								<img src="../images/promos/<?php echo $row['adverts_img']; ?>" class="img-fluid w-100 mt-4" loading="lazy">
							</div>
							<div class="form-group col-md-3">
								<label>Adverts Title</label>
								<input type="text" name="adverts_title" class="form-control" value="<?php echo $row["adverts_title"]; ?>" placeholder="Enter Adverts Title">
							</div>
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1" <?php if($row["status"] == '1') echo 'selected'; ?> >Active</option>
									<option value="2" <?php if($row["status"] == '2') echo 'selected'; ?> >Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="upd_adverts" class="btn btn-success">Submit</button>
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
						<div class="card-title">Add Advertisement</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data">				
							<div class="form-group col-md-3">
								<label>Adverts Image<span class="text-danger"> *</span></label>
								<input type="file" name="adverts_img" class="form-control-file" required>
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
							</div>
							<div class="form-group col-md-3">
								<label>Adverts Title</label>
								<input type="text" name="adverts_title" class="form-control" placeholder="Enter Adverts Title">
							</div>
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="add_adverts" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Advertisements Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th width="10%">Sr.No.</th>
										<th width="40%">Image</th>
										<th width="15%">Title</th>
										<th width="15%">Status</th>
										<th width="20%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `adverts`";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$aid = $row["aid"];
												$adverts_img = $row["adverts_img"];
												$adverts_title = $row["adverts_title"];
												$status = $row["status"];
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><img src="../images/promos/<?php echo $adverts_img; ?>" class="img-fluid w-75" loading="lazy"></td>
										<td><?php echo $adverts_title; ?></td>
										<td><?php if($status == '1'){ echo 'Active'; } else{ echo 'Inactive'; } ?></td>
										<td>											
											<a href="promos.php?aid=<?php echo $aid; ?>" class="btn-sm btn-success m-1">
												<i class="la la-edit"></i>
											</a>
											<a href="promos.php?del_aid=<?php echo $aid; ?>&del_img=<?php echo $adverts_img; ?>" onclick="deleteadverts(this.href, event);" class="btn-sm btn-danger m-1">
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
	$(".sidebar .nav .adverts").addClass("active");

	function deleteadverts(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
</script>

<?php
if (isset($_POST['add_adverts']))
{
	$adverts_title = mysqli_real_escape_string($con, $_POST['adverts_title']);
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$target_dir = "../images/promos/";
	$adverts_img = $_FILES['adverts_img']['name'];
	$target_file = $target_dir . basename($adverts_img);

	if (move_uploaded_file($_FILES["adverts_img"]["tmp_name"], $target_file))
	{
		$insert = "INSERT INTO `adverts`(`adverts_img`, `adverts_title`, `status`) VALUES ('$adverts_img','$adverts_title','$status')";
		$ins_result = mysqli_query($con, $insert);

		if ($ins_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Advertisement Added Successfully');
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

if (isset($_POST['upd_adverts']))
{
	$adverts_title = mysqli_real_escape_string($con, $_POST['adverts_title']);
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$target_dir = "../images/promos/";
	$adverts_img = $_FILES['adverts_img']['name'];
	$target_file = $target_dir . basename($adverts_img);

	if (move_uploaded_file($_FILES["adverts_img"]["tmp_name"], $target_file))
	{
		$sel_img = "SELECT * FROM `adverts` WHERE `aid` = '$_GET[aid]'";
		$res_img = mysqli_query($con, $sel_img);
		$row_img = mysqli_fetch_array($res_img);
		unlink("../images/promos/".$row_img['adverts_img']);

		$update = "UPDATE `adverts` SET `adverts_img`='$adverts_img',`adverts_title`='$adverts_title',`status`='$status' WHERE `aid`='$_GET[aid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Advertisement Updated Successfully');
                window.location.href='promos.php'; 
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
		$update = "UPDATE `adverts` SET `adverts_title`='$adverts_title',`status`='$status' WHERE `aid`='$_GET[aid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Advertisement Updated Successfully');
                window.location.href='promos.php'; 
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

if (isset($_GET['del_aid']) && isset($_GET['del_img']))
{
	$del_aid = $_GET['del_aid'];
	$del_img = $_GET['del_img'];

	$delete = "DELETE FROM `adverts` WHERE `aid` = '$del_aid'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		unlink("../images/promos/".$del_img);
		echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Advertisement Deleted Successfully');
                window.location.href='promos.php'; 
              </script>
			";
	}
}
?>