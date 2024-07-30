<?php
	$title = "Cities | Citizz Adzz";
	include 'header.php';
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Cities</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4">
						<div class="card shadow-sm mb-3">
							<div class="card-header">
								<h5 class="card-title">Add Cities</h5>
							</div>
							<div class="card-body">
								<form class="form row align-items-end" method="POST" enctype="multipart/form-data">
									<div class="col-xl-12 col-lg-12 col-md-12 mb-3">
										<label>City Name:<span class="text-danger fw-bold"> *</span></label>
										<input type="text" class="form-control" name="cname" placeholder="Enter City Name" required>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 mb-3">
										<label>Status:</label>
										<select class="form-control" name="status">
											<option value="1">Active</option>
											<option value="2">Inactive</option>
										</select>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 mb-3">
										<button type="submit" class="form-control btn btn-sm btn-default text-uppercase py-2" name="add_cities">submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8">
						<div class="card shadow-sm">
							<div class="card-header">
								<h5 class="card-title">Cities Details</h5>
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
												<th>City Name</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$select = "SELECT * FROM `cities`";
												$result = mysqli_query($con, $select);
												if(mysqli_num_rows($result) > 0)
												{
													$srno = 1;
													while($row = mysqli_fetch_assoc($result))
													{
											?>
											<tr>
												<td><input type="checkbox" class="form-check-input" name="checksingle[]" value="<?php echo $row['cid'] ?>"></td>
												<td><?php echo $srno ?></td>
												<td><?php echo $row['cname'] ?></td>
												<td><?php echo $row['status'] == '1' ? 'Active' : 'Inactive' ?></td>
												<td>
													<a href="cities-update.php?id=<?php echo $row['cid'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
													<a href="?cid=<?php echo $row['cid'] ?>" class="btn btn-sm btn-danger" onclick="deletefunc(event, this.href);"><i class="bi bi-trash"></i></a>
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
	$('.sidebar .nav .nav-item#cities').addClass('active');
</script>

<?php
	/*** Submit ***/
	if (isset($_POST['add_cities']))
	{
		$cname = mysqli_real_escape_string($con, $_POST['cname']);
		$status = mysqli_real_escape_string($con, $_POST['status']);

		$insert = "INSERT INTO `cities`(`cname`, `status`) VALUES ('$cname','$status')";
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

	/*** Delete ***/
  if (isset($_GET['cid']))
  {
    $cid = $_GET['cid'];

    $delete = "DELETE FROM `cities` WHERE `cid` = '$cid'";
    $del_result = mysqli_query($con, $delete);

    if ($del_result)
    {
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
    $delete = "DELETE FROM `cities` WHERE `cid` IN ($deleteall)";
    // echo $delete; exit;
    $del_result = mysqli_query($con, $delete);

    if ($del_result)
    {
      echo "
          <script LANGUAGE='JavaScript'>;
            swal('Success', 'All Data Deleted!', 'success')
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
?>