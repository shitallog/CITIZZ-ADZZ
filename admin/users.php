<?php
	$title = "Users | Citizz Adzz";
	include 'header.php';
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="mb-4 fw-bold">Users Details</h4>
		<div class="row">
			<div class="col-xl-12">
				<div class="card shadow-sm">
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-hover table-bordered border-primary text-nowrap shadow-sm">
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
										<th>Full Name</th>
										<th>Email</th>
										<th>Mobile No.</th>
										<th>Date of Birth</th>
										<th>Password</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `users`";
										$result = mysqli_query($con, $select);
										if(mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_assoc($result))
											{
									?>
									<tr>
										<td><input type="checkbox" class="form-check-input" name="checksingle[]" value="<?php echo $row['uid'] ?>"></td>
										<td><?php echo $srno ?></td>
										<td><?php echo $row['fname'] ?></td>
										<td><a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></td>
										<td><a href="tel:+91<?php echo $row['mobile'] ?>">+91 <?php echo $row['mobile'] ?></a></td>
										<td><?php echo $row['dob'] ?></td>
										<td class="text-muted fst-italic"><?php echo $row['pass'] ?></td>
										<td><?php echo $row['status'] == '1' ? 'Active' : 'Inactive' ?></td>
										<td>
											<!-- <a href="advertisements-update.php?id=<?php echo $row['uid'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a> -->
											<a href="?id=<?php echo $row['uid'] ?>" class="btn btn-sm btn-danger" onclick="deletefunc(event, this.href);">
                                            	<i class="bi bi-trash"></i>
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
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$('.sidebar .nav .nav-item#users').addClass('active');
</script>

<?php
  if (isset($_GET['id']))
  {
    $id = $_GET['id'];

    $delete = "DELETE FROM `users` WHERE `uid` = '$id'";
    $del_result = mysqli_query($con, $delete);

    if ($del_result)
    {
      echo "
          <script LANGUAGE='JavaScript'>;
            swal('Success', 'Data Deleted!', 'success')
            .then(() => {
              location.href = 'users.php'
            });
          </script>
        ";
    }
    else
    {
      echo ("<script LANGUAGE='JavaScript'>
          swal('Error', 'There was an error occurred. Please try again later!', 'error')
            .then(() => {
              location.href = 'users.php'
            });
          </script>");
    }
  }

  if (isset($_POST['alldelete']))
  {
    $deleteall = implode(',', $_POST['deleteall']);
    $delete = "DELETE FROM `users` WHERE `uid` IN ($deleteall)";
    // echo $delete; exit;
    $del_result = mysqli_query($con, $delete);

    if ($del_result)
    {
      echo "
          <script LANGUAGE='JavaScript'>;
            swal('Success', 'All Data Deleted!', 'success')
            .then(() => {
              location.href = 'users.php'
            });
          </script>
        ";
    }
    else
    {
      echo ("<script LANGUAGE='JavaScript'>
          swal('Error', 'There was an error occurred. Please try again later!', 'error')
            .then(() => {
              location.href = 'users.php'
            });
          </script>");
    }
  }
?>