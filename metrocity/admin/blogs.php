<?php
include("header.php");
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Blogs</h4>
		<div class="row">
<?php
if(isset($_GET["bid"]))
{
	$bid = $_GET["bid"];
	$select = "SELECT * FROM `blogs` WHERE `blog_id` = '$bid'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Edit Blog</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data" novalidate>				
							<div class="form-group col-md-4">
								<label>Blog Image</label>
								<input type="file" name="blog_img" class="form-control-file" value="<?php echo $row['blog_img']; ?>">
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
								<img src="../images/blogs/<?php echo $row['blog_img']; ?>" class="img-fluid w-100 mt-4" loading="lazy">
							</div>
							<div class="form-group col-md-8">
								<label>Blog Title</label>
								<input type="text" name="blog_title" class="form-control" value="<?php echo $row["blog_title"]; ?>" placeholder="Enter Blog Title" required>
							</div>
							<div class="form-group col-md-12">
								<label>Blog Content</label>
								<textarea rows="5" name="blog_content" class="form-control blog_content" placeholder="Enter Blog Content" required><?php echo $row["blog_content"]; ?></textarea>
							</div>
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1" <?php if($row["status"] == '1') echo 'selected'; ?> >Active</option>
									<option value="2" <?php if($row["status"] == '2') echo 'selected'; ?> >Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="upd_blog" class="btn btn-success">Submit</button>
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
						<div class="card-title">Add Blog</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data" novalidate>				
							<div class="form-group col-md-4">
								<label>Blog Image<span class="text-danger"> *</span></label>
								<input type="file" name="blog_img" class="form-control-file" required>
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
							</div>
							<div class="form-group col-md-8">
								<label>Blog Title<span class="text-danger"> *</span></label>
								<input type="text" name="blog_title" class="form-control" placeholder="Enter Blog Title" required>
							</div>
							<div class="form-group col-md-12">
								<label>Blog Content<span class="text-danger"> *</span></label>
								<textarea rows="5" name="blog_content" class="form-control blog_content" placeholder="Enter Blog Content" required></textarea>
							</div>
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="add_blog" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Blogs Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th width="5%">Sr.No.</th>
										<th width="15%">Image</th>
										<th width="25%">Title</th>
										<th width="30%">Content</th>
										<th width="10%">Published on</th>
										<th width="5%">Status</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `blogs`";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$blog_id = $row["blog_id"];
												$blog_img = $row["blog_img"];
												$blog_title = $row["blog_title"];
												$blog_content = $row["blog_content"];
												$blog_date = $row["blog_date"];
												$status = $row["status"];
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><img src="../images/blogs/<?php echo $blog_img; ?>" class="img-fluid" width="150" loading="lazy"></td>
										<td style="white-space: break-spaces;"><?php echo $blog_title; ?></td>
										<td style="white-space: break-spaces;"><?php echo substr($blog_content, 0, 100).'...'; ?></td>
										<td><?php echo $blog_date; ?></td>
										<td><?php if($status == '1'){ echo 'Active'; } else{ echo 'Inactive'; } ?></td>
										<td>											
											<a href="blogs.php?bid=<?php echo $blog_id; ?>" class="btn-sm btn-success m-1">
												<i class="la la-edit"></i>
											</a>
											<a href="blogs.php?del_bid=<?php echo $blog_id; ?>&del_img=<?php echo $blog_img; ?>" onclick="deleteblog(this.href, event);" class="btn-sm btn-danger m-1">
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
	$(".sidebar .nav .blogs").addClass("active");

	ClassicEditor
        .create( document.querySelector( '.blog_content' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );

	function deleteblog(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
</script>

<?php
if (isset($_POST['add_blog']))
{
	$blog_title = mysqli_real_escape_string($con, $_POST['blog_title']);
	$blog_content = mysqli_real_escape_string($con, $_POST['blog_content']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	$blog_date = date('Y-m-d');

	$target_dir = "../images/blogs/";
	$blog_img = $_FILES['blog_img']['name'];
	$target_file = $target_dir . basename($blog_img);

	if (move_uploaded_file($_FILES["blog_img"]["tmp_name"], $target_file))
	{
		$insert = "INSERT INTO `blogs`(`blog_title`, `blog_img`, `blog_content`, `blog_date`, `status`) VALUES ('$blog_title','$blog_img','$blog_content','$blog_date','$status')";
		$ins_result = mysqli_query($con, $insert);

		if ($ins_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Blog Added Successfully');
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

if (isset($_POST['upd_blog']))
{
	$blog_title = mysqli_real_escape_string($con, $_POST['blog_title']);
	$blog_content = mysqli_real_escape_string($con, $_POST['blog_content']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	$blog_date = date('Y-m-d');

	$target_dir = "../images/blogs/";
	$blog_img = $_FILES['blog_img']['name'];
	$target_file = $target_dir . basename($blog_img);

	if (move_uploaded_file($_FILES["blog_img"]["tmp_name"], $target_file))
	{
		$sel_img = "SELECT * FROM `blogs` WHERE `blog_id` = '$_GET[bid]'";
		$res_img = mysqli_query($con, $sel_img);
		$row_img = mysqli_fetch_array($res_img);
		unlink("../images/blogs/".$row_img['blog_img']);

		$update = "UPDATE `blogs` SET `blog_title`='$blog_title',`blog_img`='$blog_img',`blog_content`='$blog_content',`blog_date`='$blog_date',`status`='$status' WHERE `blog_id`='$_GET[bid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Blog Updated Successfully');
                window.location.href='blogs.php'; 
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
		$update = "UPDATE `blogs` SET `blog_title`='$blog_title',`blog_content`='$blog_content',`blog_date`='$blog_date',`status`='$status' WHERE `blog_id`='$_GET[bid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Blog Updated Successfully');
                window.location.href='blogs.php'; 
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

	$delete = "DELETE FROM `blogs` WHERE `blog_id` = '$del_bid'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		unlink("../images/blogs/".$del_img);
		echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Blog Deleted Successfully');
                window.location.href='blogs.php'; 
              </script>
			";
	}
}
?>