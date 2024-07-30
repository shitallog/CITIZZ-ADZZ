<?php
include("header.php");
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Photo Gallery</h4>
		<div class="row">
<?php
if(isset($_GET["gid"]))
{
	$gid = $_GET["gid"];
	$select = "SELECT * FROM `gallery` WHERE `gid` = '$gid'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Edit Gallery</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data">
							<div class="form-group col-md-3">
								<label>Gallery Title</label>
								<input type="text" name="gallery_title" class="form-control text-capitalize" value="<?php echo $row['gallery_title']; ?>" placeholder="Enter Gallery Title">
							</div>				
							<div class="form-group col-md-3">
								<label>Gallery Image</label>
								<input type="file" name="gallery_img" class="form-control-file" value="<?php echo $row['gallery_img']; ?>">
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
								<img src="../images/gallery/<?php echo $row['gallery_img']; ?>" class="img-fluid w-100 mt-4" loading="lazy">
							</div>
							<div class="form-group col-md-3">
								<label>Gallery Type</label>
								<select name="gallery_type" class="form-control">
									<option value="customer-booking" <?php if($row["gallery_type"] == 'customer-booking') echo 'selected'; ?> >Customer Booking</option>
									<option value="saledeed" <?php if($row["gallery_type"] == '1') echo 'saledeed'; ?> >Saledeed</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1" <?php if($row["status"] == '1') echo 'selected'; ?> >Active</option>
									<option value="2" <?php if($row["status"] == '2') echo 'selected'; ?> >Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="upd_gallery" class="btn btn-success">Submit</button>
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
						<div class="card-title">Add Gallery</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data">
							<div class="form-group col-md-3">
								<label>Gallery Title</label>
								<input type="text" name="gallery_title" class="form-control text-capitalize" placeholder="Enter Gallery Title">
							</div>			
							<div class="form-group col-md-3">
								<label>Gallery Image(s)<span class="text-danger"> *</span></label>
								<input type="file" multiple name="gallery_img[]" class="form-control-file" required>
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
							</div>
							<div class="form-group col-md-3">
								<label>Gallery Type</label>
								<select name="gallery_type" class="form-control">
									<option value="customer-booking">Customer Booking</option>
									<option value="saledeed">Saledeed</option>
								</select>
							</div>						
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="add_gallery" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Gallery Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th width="10%">Sr.No.</th>
										<th width="20%">Title</th>
										<th width="25%">Image</th>
										<th width="10%">Gallery Type</th>										
										<th width="15%">Status</th>
										<th width="20%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `gallery`";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$gid = $row["gid"];
												$gallery_title = $row["gallery_title"];
												$gallery_img = $row["gallery_img"];	
												$gallery_type = $row["gallery_type"];										
												$status = $row["status"];
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><?php echo $gallery_title; ?></td>
										<td><img src="../images/gallery/<?php echo $gallery_img; ?>" class="img-fluid w-75" loading="lazy"></td>
										<td>
											<?php
												if ($gallery_type == 'customer-booking')
													echo "Customer Booking";
												elseif ($gallery_type == 'saledeed')
													echo "Saledeed";
											?>
										</td>						
										<td><?php if($status == '1'){ echo 'Active'; } else{ echo 'Inactive'; } ?></td>
										<td>											
											<a href="gallery.php?gid=<?php echo $gid; ?>" class="btn-sm btn-success m-1">
												<i class="la la-edit"></i>
											</a>
											<a href="gallery.php?del_gid=<?php echo $gid; ?>&del_img=<?php echo $gallery_img; ?>" onclick="deletegallery(this.href, event);" class="btn-sm btn-danger m-1">
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
	$(".sidebar .nav .gallery").addClass("active");

	function deletegallery(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
</script>

<?php
if (isset($_POST['add_gallery']))
{
	$gallery_title = mysqli_real_escape_string($con, ucwords($_POST['gallery_title']));
	$gallery_type = mysqli_real_escape_string($con, $_POST['gallery_type']);
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$target_dir = "../images/gallery/";
	$gallery_img = implode(",", $_FILES['gallery_img']['name']);
	$gallery_img_tmp = implode(",", $_FILES['gallery_img']['tmp_name']);
	$gal_img_tmp = explode(",", $gallery_img_tmp);

	$target_file = $target_dir . basename($gallery_img);

	foreach ($gal_img_tmp as $key => $value)
	{		
		$file_tmpname = $_FILES["gallery_img"]["tmp_name"][$key];
		$file_name = $_FILES['gallery_img']["name"][$key];

		// $pdffiles[] = $_FILES['uploadPDF']["name"][$key];
		// Set upload file path
		$filepath = $target_dir . basename($file_name);

		if(file_exists($filepath))
		{
			// $filepath1 = $target_dir.time()."_".$file_name;
			// if( move_uploaded_file($file_tmpname, $filepath1))
			// {
				echo "
					<script LANGUAGE='JavaScript'>;
		        		window.alert('{$gallery_img} Already Exists!');
		        		window.location.href='';
	              </script>
				";
				exit();
			// }
		}
		else
		{
			if (move_uploaded_file($file_tmpname, $filepath))
			{
				$insert = "INSERT INTO `gallery`(`gallery_title`, `gallery_img`, `gallery_type`, `status`) VALUES ('$gallery_title','$file_name','$gallery_type','$status')";
				$ins_result = mysqli_query($con, $insert);

				if ($ins_result)
				{
					echo "
						<script LANGUAGE='JavaScript'>;
			        		window.alert('Gallery Added Successfully');
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
	}
}

if (isset($_POST['upd_gallery']))
{
	$gallery_title = mysqli_real_escape_string($con, ucwords($_POST['gallery_title']));
	$gallery_type = mysqli_real_escape_string($con, $_POST['gallery_type']);
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$target_dir = "../images/gallery/";
	$gallery_img = $_FILES['gallery_img']['name'];
	$target_file = $target_dir . basename($gallery_img);

	if (move_uploaded_file($_FILES["gallery_img"]["tmp_name"], $target_file))
	{
		$sel_img = "SELECT * FROM `gallery` WHERE `gid` = '$_GET[gid]'";
		$res_img = mysqli_query($con, $sel_img);
		$row_img = mysqli_fetch_array($res_img);
		unlink("../images/gallery/".$row_img['gallery_img']);

		$update = "UPDATE `gallery` SET `gallery_title`='$gallery_title',`gallery_img`='$gallery_img',`gallery_type`='$gallery_type',`status`='$status' WHERE `gid`='$_GET[gid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Gallery Updated Successfully');
                window.location.href='gallery.php'; 
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
		$update = "UPDATE `gallery` SET `gallery_title`='$gallery_title',`gallery_type`='$gallery_type',`status`='$status' WHERE `gid`='$_GET[gid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Gallery Updated Successfully');
                window.location.href='gallery.php'; 
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

if (isset($_GET['del_gid']) && isset($_GET['del_img']))
{
	$del_gid = $_GET['del_gid'];
	$del_img = $_GET['del_img'];

	$delete = "DELETE FROM `gallery` WHERE `gid` = '$del_gid'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		unlink("../images/gallery/".$del_img);
		echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('{$del_img} Deleted Successfully');
                window.location.href='gallery.php'; 
              </script>
			";
	}
}
?>