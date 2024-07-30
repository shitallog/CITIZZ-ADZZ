<?php
	$title = "Advertisements | Citizz Adzz";
	include 'header.php';
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Advertisements</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="card shadow-sm mb-3">
					<div class="card-header">
						<h5 class="card-title">Add Advertisement</h5>
					</div>
					<div class="card-body">
						<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
							<div class="col-xl-5 col-lg-4 col-md-4 mb-3">
								<label>Select Multiple Images:<span class="text-danger fw-bold"> *</span></label>
								<input type="file" class="form-control" name="ad_img[]" multiple accept=".jpg, .jpeg, .pdf, .png, .gif" required>
							</div>
							<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
								<label>Select City:<span class="text-danger fw-bold"> *</span></label>
								<select class="form-control" name="ad_city" required>
									<option value="">-- Select City --</option>
									<?php
										$select = "SELECT * FROM `cities` WHERE `status` = '1'";
										$result = mysqli_query($con, $select);
										if(mysqli_num_rows($result) > 0)
										{
											while($row = mysqli_fetch_array($result))
											{
									?>
									<option value="<?php echo $row['cid'] ?>"><?php echo $row['cname'] ?></option>
									<?php
											}
										}
									?>
								</select>
							</div>
							<div class="col-xl-2 col-lg-2 col-md-2 mb-3">
								<label>Select Status:</label>
								<select class="form-control" name="ad_status">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							<div class="col-xl-2 col-lg-2 col-md-2 mb-3">
								<button type="submit" class="form-control btn btn-sm btn-default text-uppercase py-2" name="add">submit</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card shadow-sm">
					<div class="card-header">
						<h5 class="card-title">Advertisement Details</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="dataTable table table-hover table-bordered border-primary text-nowrap shadow-sm">
								<thead class="text-bg-primary">
									<tr>
										<th>
					                      <form method="POST" id="alldeleteform">
					                        <input type="hidden" name="deleteall[]">
					                        <input type="checkbox" class="form-check-input align-middle" name="checkall[]" required>
					                        <button type="submit" name="alldelete" class="btn btn-sm btn-danger">
					                          <i class="bi bi-trash"></i>
					                        </button>
					                      </form>
					                  	</th>
										<th>Sr. No.</th>
										<th>Entry Date</th>
										<th>City</th>
										<th>Image</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `advertisements` ORDER BY `ad_entry` DESC";
										$result = mysqli_query($con, $select);
										if(mysqli_num_rows($result) > 0)
										{
											$root=(isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
											$root.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
											$srno = 1;
											while($row = mysqli_fetch_assoc($result))
											{
									?>
									<tr>
										<td><input type="checkbox" class="form-check-input" name="checksingle[]" value="<?php echo $row['ad_id'] ?>"></td>
										<td><?php echo $srno ?></td>
										<td><?php echo $row['ad_entry'] ?></td>
										<td>
											<?php
												$csel = "SELECT * FROM `cities` WHERE `cid` = '$row[ad_city]'";
												$cres = mysqli_query($con, $csel);
												$crow = mysqli_fetch_array($cres);
												echo $crow['cname'];
											?>
										</td>
										<td>
											<?php
												if(pathinfo($row['ad_img'], PATHINFO_EXTENSION) == 'pdf')
												{
											?>
												<a href="<?php echo $root ?>../assets/img/advertisements/<?php echo $row['ad_img'] ?>" class="btn btn-sm btn-dark" target="_blank"><i class="bi bi-file-earmark-pdf-fill me-2"></i>View PDF File</a>
											<?php
												}
												else
												{
											?>
												<a href="../assets/img/advertisements/<?php echo $row['ad_img'] ?>" class="image-popup">
													<img src="../assets/img/advertisements/<?php echo $row['ad_img'] ?>" class="img-fluid" width="100" lazyload>
												</a>
											<?php
												}
											?>
										</td>
										<td><?php echo $row['ad_status'] == '1' ? 'Active' : 'Inactive' ?></td>
										<td>
											<a href="advertisements-update.php?id=<?php echo $row['ad_id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
											<a href="?id=<?php echo $row['ad_id'] ?>&ad_img=<?php echo $row['ad_img'] ?>" class="btn btn-sm btn-danger" onclick="deletefunc(event, this.href);"><i class="bi bi-trash"></i></a>
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
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$('.sidebar .nav .nav-item#advertisements').addClass('active');
</script>

<?php
	if (isset($_POST['add']))
	{
		$entry_date = date('Y-m-d');
		$ad_city = mysqli_real_escape_string($con, $_POST['ad_city']);
		$ad_status = mysqli_real_escape_string($con, $_POST['ad_status']);

		$target_dir = '../assets/img/advertisements/';
		$ad_image = implode(",", array_filter($_FILES['ad_img']['name']));
		$ad_image_tmp = implode(",", array_filter($_FILES['ad_img']['tmp_name']));
		$ad_img_tmp = explode(",", $ad_image_tmp);

		foreach ($ad_img_tmp as $key => $value)
		{
			$file_tmpname = $_FILES["ad_img"]["tmp_name"][$key];
			$file_name = $_FILES['ad_img']["name"][$key];

			// Set upload file path
			$filepath = $target_dir . basename($file_name);

			if(file_exists($filepath))
			{
				echo ("<script LANGUAGE='JavaScript'>
			        alert('".$file_name." already exists !');
			        window.location.href = '';
			    </script>");
			}
			else
			{
				if(move_uploaded_file($file_tmpname, $filepath))
				{
					$insert = "INSERT INTO `advertisements`(`ad_entry`, `ad_city`, `ad_img`, `ad_status`) VALUES ('$entry_date','$ad_city','$file_name','$ad_status')";
					//echo $insert;
					$result = mysqli_query($con, $insert);
					if ($result)
					{
						echo "
			        <script LANGUAGE='JavaScript'>;
			          swal('Success', 'Data Inserted!', 'success')
			          .then(() => {
			            location.href = ''
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
			}
		}
      //exit;
	}

	if (isset($_GET['id'], $_GET['ad_img']))
	{
		$id = $_GET['id'];
		$ad_img = $_GET['ad_img'];

		$delete = "DELETE FROM `advertisements` WHERE `ad_id` = '$id'";
		$del_result = mysqli_query($con, $delete);

		if ($del_result)
		{
			unlink('../assets/img/advertisements/'.$ad_img);
		  	echo "
		      <script LANGUAGE='JavaScript'>;
		        swal('Success', 'Data Deleted!', 'success')
		        .then(() => {
		          location.href = 'advertisements.php'
		        });
		      </script>
		    ";
		}
		else
		{
		  echo ("<script LANGUAGE='JavaScript'>
		      swal('Error', 'There was an error occurred. Please try again later!', 'error')
		        .then(() => {
		          location.href = 'advertisements.php'
		        });
		      </script>");
		}
	}

	if (isset($_POST['alldelete']))
	{
		$deleteall = implode(',', $_POST['deleteall']);

		$results = mysqli_query($con, "SELECT * FROM `advertisements` WHERE `ad_id` IN ($deleteall)");		
		while ($rows = mysqli_fetch_array($results))
		{
			$ad_img = $rows['ad_img'];
			unlink('../assets/img/advertisements/'.$ad_img);
		}

		$delete = "DELETE FROM `advertisements` WHERE `ad_id` IN ($deleteall)";
		// echo $delete; exit;
		$del_result = mysqli_query($con, $delete);

		if ($del_result)
		{
		  echo "
		      <script LANGUAGE='JavaScript'>;
		        swal('Success', 'All Data Deleted!', 'success')
		        .then(() => {
		          location.href = 'advertisements.php'
		        });
		      </script>
		    ";
		}
		else
		{
		  echo ("<script LANGUAGE='JavaScript'>
		      swal('Error', 'There was an error occurred. Please try again later!', 'error')
		        .then(() => {
		          location.href = 'advertisements.php'
		        });
		      </script>");
		}
	}
?>