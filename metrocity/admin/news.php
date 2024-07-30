<?php
include("header.php");
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">News</h4>
		<div class="row">
<?php
if(isset($_GET["nid"]))
{
	$nid = $_GET["nid"];
	$select = "SELECT * FROM `news` WHERE `news_id` = '$nid'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Edit News</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data" novalidate>				
							<div class="form-group col-md-4">
								<label>News Image</label>
								<input type="file" name="news_img" class="form-control-file" value="<?php echo $row['news_img']; ?>">
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
								<img src="../images/news/<?php echo $row['news_img']; ?>" class="img-fluid w-100 mt-4" loading="lazy">
							</div>
							<div class="form-group col-md-4">
								<label>News Title</label>
								<input type="text" name="news_title" class="form-control" value="<?php echo $row["news_title"]; ?>" placeholder="Enter News Title">
							</div>
							<!-- <div class="form-group col-md-12">
								<label>News Content</label>
								<textarea rows="5" name="news_content" class="form-control news_content" placeholder="Enter News Content" required><?php echo $row["news_content"]; ?></textarea>
							</div> -->
							<div class="form-group col-md-4">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1" <?php if($row["status"] == '1') echo 'selected'; ?> >Active</option>
									<option value="2" <?php if($row["status"] == '2') echo 'selected'; ?> >Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="upd_news" class="btn btn-success">Submit</button>
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
						<div class="card-title">Add News</div>
					</div>
					<div class="card-body">
						<form class="form-row" method="POST" enctype="multipart/form-data" novalidate>				
							<div class="form-group col-md-4">
								<label>News Image<span class="text-danger"> *</span></label>
								<input type="file" name="news_img" class="form-control-file" required>
                              	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
							</div>
							<div class="form-group col-md-4">
								<label>News Title</label>
								<input type="text" name="news_title" class="form-control" placeholder="Enter News Title">
							</div>
							<!-- <div class="form-group col-md-12">
								<label>News Content</label>
								<textarea rows="5" name="news_content" class="form-control news_content" placeholder="Enter News Content" required></textarea>
							</div> -->
							<div class="form-group col-md-4">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="add_news" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">News Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th width="5%">Sr.No.</th>
										<th width="15%">Image</th>
										<th width="25%">Title</th>
										<!-- <th width="27%">Content</th> -->
										<!-- <th width="10%">Published on</th> -->
										<th width="8%">Status</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `news`";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$news_id = $row["news_id"];
												$news_img = $row["news_img"];
												$news_title = $row["news_title"];
												// $news_content = $row["news_content"];
												// $news_date = $row["news_date"];
												$status = $row["status"];
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><img src="../images/news/<?php echo $news_img; ?>" class="img-fluid" width="150" loading="lazy"></td>
										<td><?php echo $news_title; ?></td>
										<!-- <td style="white-space: break-spaces;"><?php echo substr($news_content, 0, 100).'...'; ?></td> -->
										<!-- <td><?php echo $news_date; ?></td> -->
										<td><?php if($status == '1'){ echo 'Active'; } else{ echo 'Inactive'; } ?></td>
										<td>											
											<a href="news.php?nid=<?php echo $news_id; ?>" class="btn-sm btn-success m-1">
												<i class="la la-edit"></i>
											</a>
											<a href="news.php?del_nid=<?php echo $news_id; ?>&del_img=<?php echo $news_img; ?>" onclick="deletenews(this.href, event);" class="btn-sm btn-danger m-1">
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
	$(".sidebar .nav .news").addClass("active");

	// ClassicEditor
 //        .create( document.querySelector( '.news_content' ) )
 //        .then( editor => {
 //                console.log( editor );
 //        } )
 //        .catch( error => {
 //                console.error( error );
 //        } );

	function deletenews(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
</script>

<?php
if (isset($_POST['add_news']))
{
	$news_title = mysqli_real_escape_string($con, $_POST['news_title']);
	// $news_content = mysqli_real_escape_string($con, $_POST['news_content']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	// $news_date = date('Y-m-d');

	$target_dir = "../images/news/";
	$news_img = $_FILES['news_img']['name'];
	$target_file = $target_dir . basename($news_img);

	if (move_uploaded_file($_FILES["news_img"]["tmp_name"], $target_file))
	{
		$insert = "INSERT INTO `news`(`news_title`, `news_img`, `status`) VALUES ('$news_title','$news_img','$status')";
		$ins_result = mysqli_query($con, $insert);

		if ($ins_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('News Added Successfully');
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

if (isset($_POST['upd_news']))
{
	$news_title = mysqli_real_escape_string($con, $_POST['news_title']);
	// $news_content = mysqli_real_escape_string($con, $_POST['news_content']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	// $news_date = date('Y-m-d');

	$target_dir = "../images/news/";
	$news_img = $_FILES['news_img']['name'];
	$target_file = $target_dir . basename($news_img);

	if (move_uploaded_file($_FILES["news_img"]["tmp_name"], $target_file))
	{
		$sel_img = "SELECT * FROM `news` WHERE `news_id` = '$_GET[nid]'";
		$res_img = mysqli_query($con, $sel_img);
		$row_img = mysqli_fetch_array($res_img);
		unlink("../images/news/".$row_img['news_img']);

		$update = "UPDATE `news` SET `news_title`='$news_title',`news_img`='$news_img',`status`='$status' WHERE `news_id`='$_GET[nid]'";
		// echo $update; exit();
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('News Updated Successfully');
                window.location.href='news.php'; 
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
		$update = "UPDATE `news` SET `news_title`='$news_title',`status`='$status' WHERE `news_id`='$_GET[nid]'";
		$upd_result = mysqli_query($con, $update);

		if ($upd_result)
		{
			echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('News Updated Successfully');
                window.location.href='news.php'; 
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

if (isset($_GET['del_nid']) && isset($_GET['del_img']))
{
	$del_nid = $_GET['del_nid'];
	$del_img = $_GET['del_img'];

	$delete = "DELETE FROM `news` WHERE `news_id` = '$del_nid'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		unlink("../images/news/".$del_img);
		echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('News Deleted Successfully');
                window.location.href='news.php'; 
              </script>
			";
	}
}
?>