<?php
include("header.php");
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Enquiry</h4>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Enquiry Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th>Sr.No.</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Project</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `enquiry` ORDER BY `eid` DESC";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$eid = $row["eid"];
												$name = $row["name"];
												$mobile = $row["mobile"];	
												$project = $row["project"];
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><?php echo $name; ?></td>
										<td><a href="tel:+91<?php echo $mobile; ?>">+91 <?php echo $mobile; ?></a></td>
										<td><?php echo $project; ?></td>				
										<td>
											<a href="enquiry.php?eid=<?php echo $eid; ?>" onclick="deleteenquiry(this.href, event);" class="btn-sm btn-danger m-1">
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

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Project Enquiry Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable2" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th>Sr.No.</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Location</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `project_enquiry` ORDER BY `pe_id` DESC";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$peid = $row["pe_id"];
												$name = $row["name"];
												$mobile = $row["mobile"];	
												$location = $row["location"];
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><?php echo $name; ?></td>
										<td><a href="tel:+91<?php echo $mobile; ?>">+91 <?php echo $mobile; ?></a></td>
										<td><?php echo $location; ?></td>				
										<td>
											<a href="enquiry.php?pid=<?php echo $peid; ?>" onclick="deletepenquiry(this.href, event);" class="btn-sm btn-danger m-1">
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
	$(".sidebar .nav .enquiry").addClass("active");

	function deleteenquiry(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}

	function deletepenquiry(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
</script>

<?php
if (isset($_GET['eid']))
{
	$eid = $_GET['eid'];

	$delete = "DELETE FROM `enquiry` WHERE `eid` = '$eid'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Enquiry Deleted Successfully');
            window.location.href='enquiry.php'; 
          </script>
		";
	}
}

if (isset($_GET['pid']))
{
	$pid = $_GET['pid'];

	$delete = "DELETE FROM `project_enquiry` WHERE `pe_id` = '$pid'";
	// echo $delete;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Project Enquiry Deleted Successfully');
            window.location.href='enquiry.php'; 
          </script>
		";
	}
}
?>