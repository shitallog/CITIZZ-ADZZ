<?php
include("header.php");
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Contact Us</h4>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Contact Us Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th>Sr.No.</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Subject</th>
										<th>Message</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `contact_us` ORDER BY `c_id` DESC";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$cid = $row["c_id"];
												$name = $row["name"];
												$mobile = $row["mobile"];	
												$subject = $row["subject"];
												$message = $row["message"];												
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><?php echo $name; ?></td>
                                      	<td>
                                          <a href="tel:+91<?php echo $mobile; ?>">+91 <?php echo $mobile; ?></a>
                                      	</td>
										<td style="white-space: break-spaces;"><?php echo $subject; ?></td>
										<td style="white-space: break-spaces;"><?php echo $message; ?></td>
										<td>
											<a href="contact-us.php?id=<?php echo $cid; ?>" onclick="deletecontact(this.href, event);" class="btn-sm btn-danger m-1">
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
		</div>
	</div>
</div>
<?php
include("footer.php");
?>
<script type="text/javascript">
	$(".sidebar .nav .contact").addClass("active");

	function deleteenquiry(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
</script>

<?php
if (isset($_GET['id']))
{
	$id = $_GET['id'];

	$delete = "DELETE FROM `contact_us` WHERE `c_id` = '$id'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Contact Deleted Successfully');
            window.location.href='contact-us.php'; 
          </script>
		";
	}
}
?>