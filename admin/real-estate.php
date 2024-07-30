<?php
	$title = "Real Estate | Citizz Adzz";
	include 'header.php';
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Real Estate</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="card shadow-sm mb-3">
					<div class="card-header">
						<h5 class="card-title">Add Real Estate</h5>
					</div>
					<div class="card-body">
						<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
							<div class="col-xl-5 col-lg-4 col-md-4 mb-3">
								<label>Select Multiple Images:<span class="text-danger fw-bold"> *</span></label>
								<input type="file" class="form-control" name="re_img[]" multiple accept=".jpg, .jpeg, .pdf, .png, .gif" required>
							</div>
							<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
								<label>Select City:<span class="text-danger fw-bold"> *</span></label>
								<select class="form-control" name="re_city" required>
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
								<select class="form-control" name="re_status">
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
						<h5 class="card-title">Real Estate Details</h5>
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
										$select = "SELECT * FROM `real_estate` ORDER BY `re_entry` DESC";
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
										<td><input type="checkbox" class="form-check-input" name="checksingle[]" value="<?php echo $row['re_id'] ?>"></td>
										<td><?php echo $srno ?></td>
										<td><?php echo $row['re_entry'] ?></td>
										<td>
											<?php
												$csel = "SELECT * FROM `cities` WHERE `cid` = '$row[re_city]'";
												$cres = mysqli_query($con, $csel);
												$crow = mysqli_fetch_array($cres);
												echo $crow['cname'];
											?>
										</td>
										<td>
											<?php
												if(pathinfo($row['re_img'], PATHINFO_EXTENSION) == 'pdf')
												{
											?>
												<a href="<?php echo $root ?>../assets/img/real_estate/<?php echo $row['re_img'] ?>" class="btn btn-sm btn-dark" target="_blank"><i class="bi bi-file-earmark-pdf-fill me-2"></i>View PDF File</a>
											<?php
												}
												else
												{
											?>
												<a href="../assets/img/real_estate/<?php echo $row['re_img'] ?>" class="image-popup">
													<img src="../assets/img/real_estate/<?php echo $row['re_img'] ?>" class="img-fluid" width="100" lazyload>
												</a>
											<?php
												}
											?>
										</td>
										<td><?php echo $row['re_status'] == '1' ? 'Active' : 'Inactive' ?></td>
										<td>
											<a href="real-estate-update.php?id=<?php echo $row['re_id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
											<a href="?id=<?php echo $row['re_id'] ?>&re_img=<?php echo $row['re_img'] ?>" class="btn btn-sm btn-danger" onclick="deletefunc(event, this.href);"><i class="bi bi-trash"></i></a>
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
	$('.sidebar .nav .nav-item#real_estate').addClass('active');
</script>

<?php
	if (isset($_POST['add']))
	{
		$entry_date = date('Y-m-d');
		$re_city = mysqli_real_escape_string($con, $_POST['re_city']);
		$re_status = mysqli_real_escape_string($con, $_POST['re_status']);

		$target_dir = '../assets/img/real_estate/';
		$re_image = implode(",", array_filter($_FILES['re_img']['name']));
		$re_image_tmp = implode(",", array_filter($_FILES['re_img']['tmp_name']));
		$re_img_tmp = explode(",", $re_image_tmp);

		foreach ($re_img_tmp as $key => $value)
		{
			$file_tmpname = $_FILES["re_img"]["tmp_name"][$key];
			$file_name = $_FILES['re_img']["name"][$key];

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
					$insert = "INSERT INTO `real_estate`(`re_entry`, `re_city`, `re_img`, `re_status`) VALUES ('$entry_date','$re_city','$file_name','$re_status')";
					// echo $insert; exit;
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
	}

  if (isset($_GET['id'], $_GET['re_img']))
  {
    $id = $_GET['id'];
    $re_img = $_GET['re_img'];

    $delete = "DELETE FROM `real_estate` WHERE `re_id` = '$id'";
    $del_result = mysqli_query($con, $delete);

    if ($del_result)
    {
    	unlink('../assets/img/real_estate/'.$re_img);
      echo "
          <script LANGUAGE='JavaScript'>;
            swal('Success', 'Data Deleted!', 'success')
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
              location.href = 'real-estate.php'
            });
          </script>");
    }
  }

  if (isset($_POST['alldelete']))
	{
		$deleteall = implode(',', $_POST['deleteall']);

		$results = mysqli_query($con, "SELECT * FROM `real_estate` WHERE `re_id` IN ($deleteall)");		
		while ($rows = mysqli_fetch_array($results))
		{
			$re_img = $rows['re_img'];
			unlink('../assets/img/real_estate/'.$re_img);
		}

		$delete = "DELETE FROM `real_estate` WHERE `re_id` IN ($deleteall)";
		// echo $delete; exit;
		$del_result = mysqli_query($con, $delete);

		if ($del_result)
		{
		  echo "
		      <script LANGUAGE='JavaScript'>;
		        swal('Success', 'All Data Deleted!', 'success')
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
		          location.href = 'real-estate.php'
		        });
		      </script>");
		}
	}
?>