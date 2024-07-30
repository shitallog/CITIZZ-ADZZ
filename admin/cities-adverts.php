<?php
	$title = "City Advertisements | Citizz Adzz";
	include 'header.php';
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">City Advertisements</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12">
						<div class="card shadow-sm mb-3">
							<div class="card-header">
								<h5 class="card-title">Add City Advertisements</h5>
							</div>
							<div class="card-body">
								<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
									<div class="col-xl-3 col-lg-4 col-md-4 mb-3">
										<label>Select City:<span class="text-danger fw-bold"> *</span></label>
										<select class="form-control" name="city_id" required>
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
									<div class="col-xl-4 col-lg-5 col-md-5 mb-3">
										<label>Select Multiple Images:<span class="text-danger fw-bold"> *</span></label>
										<input type="file" class="form-control" name="ca_img[]" multiple accept=".jpg, .jpeg, .pdf, .png, .gif" required>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 mb-3">
										<label>Select Type:</label>
										<select class="form-control" name="ca_type" required>
											<option value="">-- Select Type --</option>
											<option value="jobs_careers">Jobs & Careers</option>
											<option value="real_estate">Real Estate</option>
											<option value="advertisements">Advertisements</option>
										</select>
									</div>
									<div class="col-xl-2 col-lg-3 col-md-3 mb-3">
										<label>Select Status:</label>
										<select class="form-control" name="ca_status">
											<option value="1">Active</option>
											<option value="2">Inactive</option>
										</select>
									</div>									
									<div class="col-xl-2 col-lg-2 col-md-2 mb-3">
										<button type="submit" class="form-control btn btn-sm btn-default text-uppercase py-2" name="add_city_adverts">submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12">
						<div class="card shadow-sm">
							<div class="card-header">
								<h5 class="card-title">City Advertisements Details</h5>
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
												<th>City Name</th>
												<th>Image</th>
												<th>Type</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$select = "SELECT * FROM cities C, city_adverts CA WHERE C.cid = CA.city_id ORDER BY `ca_entry` DESC";
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
												<td><input type="checkbox" class="form-check-input" name="checksingle[]" value="<?php echo $row['ca_id'] ?>"></td>
												<td><?php echo $srno ?></td>
												<td><?php echo $row['ca_entry'] ?></td>
												<td><?php echo $row['cname'] ?></td>
												<td>
													<?php
														if(pathinfo($row['ca_img'], PATHINFO_EXTENSION) == 'pdf')
														{
													?>
														<a href="<?php echo $root ?>../assets/img/cities/<?php echo $row['ca_img'] ?>" class="btn btn-sm btn-dark" target="_blank"><i class="bi bi-file-earmark-pdf-fill me-2"></i>View PDF File</a>
													<?php
														}
														else
														{
													?>
														<a href="../assets/img/cities/<?php echo $row['ca_img'] ?>" class="image-popup">
															<img src="../assets/img/cities/<?php echo $row['ca_img'] ?>" class="img-fluid" width="100" lazyload>
														</a>
													<?php
														}
													?>
												</td>
												<td><?php echo ( ($row['ca_type'] == 'jobs_careers') ? "Jobs & Careers" : ( ($row['ca_type'] == 'real_estate') ? "Real Estate" : ( ($row['ca_type'] == 'advertisements') ? 'Advertisements' : '' ) ) ) ?></td>
												<td><?php echo $row['ca_status'] == '1' ? 'Active' : 'Inactive' ?></td>
												<td>
													<a href="city-adverts-update.php?id=<?php echo $row['ca_id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
													<a href="?ca_id=<?php echo $row['ca_id'] ?>&ca_img=<?php echo $row['ca_img'] ?>" class="btn btn-sm btn-danger" onclick="deletefunc(event, this.href);"><i class="bi bi-trash"></i></a>
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
	</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$('.sidebar .nav .nav-item#cities-adverts').addClass('active');
</script>

<?php

	if (isset($_POST['add_city_adverts']))
	{
		$entry_date = date('Y-m-d');
		$city_id = mysqli_real_escape_string($con, $_POST['city_id']);
		$ca_type = mysqli_real_escape_string($con, $_POST['ca_type']);
		$ca_status = mysqli_real_escape_string($con, $_POST['ca_status']);

		$target_dir = '../assets/img/cities/';
		$ca_image = implode(",", array_filter($_FILES['ca_img']['name']));
		$ca_image_tmp = implode(",", array_filter($_FILES['ca_img']['tmp_name']));
		$ca_img_tmp = explode(",", $ca_image_tmp);

		foreach ($ca_img_tmp as $key => $value)
		{
			$file_tmpname = $_FILES["ca_img"]["tmp_name"][$key];
			$file_name = $_FILES['ca_img']["name"][$key];

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
					$insert = "INSERT INTO `city_adverts`(`ca_entry`, `city_id`, `ca_img`, `ca_type`, `ca_status`) VALUES ('$entry_date','$city_id','$file_name','$ca_type','$ca_status')";
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


  if (isset($_GET['ca_id'], $_GET['ca_img']))
  {
    $ca_id = $_GET['ca_id'];
    $ca_img = $_GET['ca_img']; 

    $delete = "DELETE FROM `city_adverts` WHERE `ca_id` = '$ca_id'";
    $del_result = mysqli_query($con, $delete);

    if ($del_result)
    {
    	unlink('../assets/img/cities/'.$ca_img);
      echo "
          <script LANGUAGE='JavaScript'>;
            swal('Success', 'Data Deleted!', 'success')
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
              location.href = 'cities.php'
            });
          </script>");
    }
  }

  if (isset($_POST['alldelete']))
	{
		$deleteall = implode(',', $_POST['deleteall']);

		$results = mysqli_query($con, "SELECT * FROM `city_adverts` WHERE `ca_id` IN ($deleteall)");		
		while ($rows = mysqli_fetch_array($results))
		{
			$ca_img = $rows['ca_img'];
			unlink('../assets/img/cities/'.$ca_img);
		}

		$delete = "DELETE FROM `city_adverts` WHERE `ca_id` IN ($deleteall)";
		// echo $delete; exit;
		$del_result = mysqli_query($con, $delete);

		if ($del_result)
		{
		  echo "
		      <script LANGUAGE='JavaScript'>;
		        swal('Success', 'All Data Deleted!', 'success')
		        .then(() => {
		          location.href = 'cities-adverts.php'
		        });
		      </script>
		    ";
		}
		else
		{
		  echo ("<script LANGUAGE='JavaScript'>
		      swal('Error', 'There was an error occurred. Please try again later!', 'error')
		        .then(() => {
		          location.href = 'cities-adverts.php'
		        });
		      </script>");
		}
	}
?>