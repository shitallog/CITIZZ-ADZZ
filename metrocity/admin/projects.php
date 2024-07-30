<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

include("header.php");
?>
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Projects</h4>
		<div class="row">
<?php
if(isset($_GET["pid"]))
{
	$pid = $_GET["pid"];
	$select = "SELECT * FROM `projects` WHERE `p_id` = '$pid'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_array($result);
?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Edit Projects</div>
					</div>
					<div class="card-body">
						<form class="form" method="POST" enctype="multipart/form-data">
							<div class="row">			
								<div class="form-group col-md-4">
									<label>Project Title</label>
									<input type="text" name="project_title" class="form-control" placeholder="Enter Project Title" value="<?php echo $row['p_name']; ?>" required>
								</div>

								<div class="form-group col-md-3">
									<label>Project Image</label>
									<input type="file" name="p_img" class="form-control-file">
                                  	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
									<?php if(!empty($row['p_img'])){ ?>
									<img src="../images/projects/<?php echo $row['p_img']; ?>" class="img-fluid w-25" loading="lazy">
									<?php } ?>
								</div>

								<div class="form-group col-md-5">
									<label>Project Description</label>
									<textarea name="project_desc" class="form-control" placeholder="Enter Project Description" required><?php echo $row['p_desc']; ?></textarea>
								</div>
							</div>
							<?php
								if(!empty($row['p_location']))
								{
									$proj_loc = explode(",", $row['p_location']);

									foreach ($proj_loc as $k1 => $v1)
									{
										if(!empty($v1))
										{
											$sel_img = "SELECT * FROM `project_imgs` WHERE `proj_id` = '$pid' AND `img_id` = '$v1'";
											// echo $sel_img;
											$res_img = mysqli_query($con, $sel_img);
											$row_img = mysqli_fetch_array($res_img);
							?>
							
							<div class="row">
								<!-- Field Start -->
								<div class="col-xs-12 col-md-3">
									<div class="form-group">
										<input type="hidden" name="img_id[]" value="<?php echo $v1; ?>">
										<label>Project Location</label>		
										<input class="form-control" name="project_loc[]" type="text" placeholder="Enter Project Location" value="<?php echo $row_img['location']; ?>">
									</div>
								</div>
								<!-- Field Ends -->

								<!-- Field Start -->
								<div class="col-xs-12 col-md-3">
									<div class="form-group">
										<label>Project Image</label>
										<input type="hidden" name="project_img[]" value="<?php echo $row_img['p_img']; ?>">
										<input class="form-control-file" name="project_img[]" type="file" value="<?php echo $row_img['p_img']; ?>">
                                      	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
										<img src="../images/projects/<?php echo $row_img['p_img']; ?>" class="img-fluid w-25" loading="lazy">
									</div>
								</div>
								<!-- Field Ends -->

								<!-- Field Start -->
								<div class="col-xs-12 col-md-5">
									<div class="form-group">
										<label>Location Description</label>
										<textarea class="form-control" name="loc_desc[]" placeholder="Enter Location Description" required><?php echo $row_img['location_desc']; ?></textarea>
									</div>
								</div>
								<!-- Field Ends -->

								<!-- Field Start -->
								<div class="col-xs-12 col-md-1">
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="button" url="projects.php?id=<?php echo $pid; ?>&loc_id=<?php echo $v1; ?>" class="btn btn-danger form-control h- btn-upd_remove">
											<i class="la la-minus font-weight-bold" aria-hidden="true"></i>
										</button>
									</div>
								</div>
								<!-- Field Ends -->
							</div>
							
							<?php
										}
									}
								}
							?>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUpdateProjImg">Add More</button>

							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1" <?php if($row["status"] == '1') echo 'selected'; ?> >Active</option>
									<option value="2" <?php if($row["status"] == '2') echo 'selected'; ?> >Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="upd_project" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="modalUpdateProjImg" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header bg-default">
							<h6 class="modal-title">Add More Locations</h6>
							<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row targetDiv" id="div0">
								<div class="col-md-12">
									<form method="POST" enctype="multipart/form-data">
										<div id="myRepeatingFields" class="upd_fvrduplicate">									
											<div class="row upd_entry">
												<!-- Field Start -->
												<div class="col-md-3">
													<div class="form-group">
														<label>Project Location</label>
														<input class="form-control" name="project_loc[]" type="text" placeholder="Enter Project Location" required>
													</div>
												</div>
												<!-- Field Ends -->

												<!-- Field Start -->
												<div class="col-md-3">
													<div class="form-group">
														<label>Project Image</label>
														<input class="form-control-file" name="project_img[]" type="file" placeholder="Enter Project Image" required>
                                                      	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
													</div>
												</div>
												<!-- Field Ends -->

												<!-- Field Start -->
												<div class="col-md-4">
													<div class="form-group">
														<label>Location Description</label>
														<textarea class="form-control" name="loc_desc[]" placeholder="Enter Location Description" required></textarea>
													</div>
												</div>
												<!-- Field Ends -->

												<!-- Field Start -->
												<div class="col-md-2">
													<div class="form-group">
														<label>&nbsp;</label>
														<button type="button" class="btn btn-success form-control h- btn-upd">
															<i class="la la-plus font-weight-bold" aria-hidden="true"></i>
														</button>
													</div>
												</div>
												<!-- Field Ends -->												
											</div>
										</div>
										<div class="col-md-4">
											<input type="submit" name="upd_proj_imgs" class="btn btn-primary" value="Submit">
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- <div class="modal-footer">
							<a href="?logout" class="btn btn-secondary">LOGOUT</a>
						</div> -->
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
						<div class="card-title">Add Project</div>
					</div>
					<div class="card-body">
						<form class="form" method="POST" enctype="multipart/form-data">
							<div class="row">			
								<div class="form-group col-md-4">
									<label>Project Title</label>
									<input type="text" name="project_title" class="form-control" placeholder="Enter Project Title" required>
								</div>

								<div class="form-group col-md-3">
									<label>Project Image</label>
									<input type="file" name="p_img" class="form-control-file" required>
                                  	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
								</div>

								<div class="form-group col-md-5">
									<label>Project Description</label>
									<textarea name="project_desc" class="form-control" placeholder="Enter Project Description" required></textarea>
								</div>
							</div>

							<div class="row targetDiv" id="div0">
								<div class="col-md-12">
									<div id="myRepeatingFields" class="fvrduplicate">
										<div class="row entry">
											<!-- Field Start -->
											<div class="col-xs-12 col-md-3">
												<div class="form-group">
													<label>Project Location</label>
													<input class="form-control" name="project_loc[]" type="text" placeholder="Enter Project Location" required>
												</div>
											</div>
											<!-- Field Ends -->

											<!-- Field Start -->
											<div class="col-xs-12 col-md-3">
												<div class="form-group">
													<label>Project Image</label>
													<input class="form-control-file" name="project_img[]" type="file" placeholder="Enter Project Image" required>
                                                  	<span class="text-danger d-block font-weight-bold">Please choose images files less than 70KB.</span>
												</div>
											</div>
											<!-- Field Ends -->

											<!-- Field Start -->
											<div class="col-xs-12 col-md-5">
												<div class="form-group">
													<label>Location Description</label>
													<textarea class="form-control" name="loc_desc[]" placeholder="Enter Location Description" required></textarea>
												</div>
											</div>
											<!-- Field Ends -->

											<!-- Field Start -->
											<div class="col-xs-12 col-md-1">
												<div class="form-group">
													<label>&nbsp;</label>
													<button type="button" class="btn btn-success form-control h- btn-add">
														<i class="la la-plus font-weight-bold" aria-hidden="true"></i>
													</button>
												</div>
											</div>
											<!-- Field Ends -->
										</div>


									</div>
								</div>
							</div>
			
							<div class="form-group col-md-3">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" name="add_project" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Projects Details</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-head-bg-primary">
								<thead>
									<tr>
										<th width="5%">Sr.No.</th>
										<th width="20%">Project Image</th>
										<th width="20%">Project Title</th>
										<th width="30%">Project Description</th>
										<th width="5%">Locations</th>
										<th width="10%">Status</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$select = "SELECT * FROM `projects`";
										$result = mysqli_query($con, $select);

										if (mysqli_num_rows($result) > 0)
										{
											$srno = 1;
											while($row = mysqli_fetch_array($result))
											{
												$pid = $row["p_id"];
												$project_img = $row["p_img"];
												$project_title = $row["p_name"];
												$project_desc = $row["p_desc"];
												$project_loc = $row["p_location"];
												$status = $row["status"];
									?>
									<tr>
										<td><?php echo $srno; ?></td>
										<td><?php if(!empty($project_img)){ ?><img src="../images/projects/<?php echo $project_img; ?>" class="img-fluid" loading="lazy"><?php } ?></td>
										<td><?php echo $project_title; ?></td>
										<td style="white-space: break-spaces; text-align: justify;"><?php echo $project_desc; ?></td>
										<td>
											<a href="#" class="btn-sm btn-primary" data-toggle="modal" data-target="#modalViewLocation_<?php echo $pid; ?>">
												<i class="la la-eye" aria-hidden="true"></i> View
											</a>

											<!-- Modal -->
											<div class="modal fade" id="modalViewLocation_<?php echo $pid; ?>" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
												<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
													<div class="modal-content">
														<div class="modal-header bg-default">
															<h6 class="modal-title">View Locations for <?php echo $project_title; ?></h6>
															<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="table-responsive">
																<table class="table table-striped" border="1">
																	<thead>
																		<tr>
																			<th width="20%">Image</th>
																			<th width="25%">Location</th>
																			<th width="55%">Description</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			if(!empty($project_loc))
																			{
																				$sel_img = "SELECT * FROM `project_imgs` WHERE `proj_id` = '$pid' AND `img_id` IN ($project_loc)";
																				$res_img = mysqli_query($con, $sel_img);
																				if(mysqli_num_rows($res_img) > 0)
																				{
																					while($row_img = mysqli_fetch_array($res_img))
																					{
																						// echo $row_img['location']."<br><br>";
																		?>
																		<tr>
																			<td><img src="../images/projects/<?php echo $row_img['p_img']; ?>" class="img-fluid" loading="lazy"></td>
																			<td><?php echo $row_img['location'] ?></td>
																			<td style="white-space: break-spaces; text-align: justify;"><?php echo $row_img['location_desc'] ?></td>
																		</tr>
																		<?php	
																					}
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
										</td>
										<td><?php if($status == '1'){ echo 'Active'; } else{ echo 'Inactive'; } ?></td>
										<td>											
											<a href="projects.php?pid=<?php echo $pid; ?>" class="btn-sm btn-success m-1">
												<i class="la la-edit"></i>
											</a>
											<a href="projects.php?del_pid=<?php echo $pid; ?>&del_img=<?php echo $project_loc; ?>" onclick="deleteproject(this.href, event);" class="btn-sm btn-danger m-1">
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
	$(".sidebar .nav .projects").addClass("active");

	function deleteproject(url, e)
	{
		e.preventDefault();
		if(confirm("Are you sure you want to delete?") == true)
		{
			window.location.href = url;
		}
	}
	$(function()
	{
		$(document).on('click', '.btn-add', function(e)
		{
			e.preventDefault();
			var controlForm = $('.fvrduplicate:last'),
			currentEntry = $(this).parents('.entry:last'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);
			newEntry.find('input').val('');
          	newEntry.find('textarea').val('');
			controlForm.find('.entry:not(:first) .btn-add')
			.removeClass('btn-add').addClass('btn-remove')
			.removeClass('btn-success').addClass('btn-danger')
			.html('<i class="la la-minus font-weight-bold" aria-hidden="true"></i>');
		}).on('click', '.btn-remove', function(e)
		{
			e.preventDefault();
			$(this).parents('.entry:last').remove();
			return false;
		});

		$(document).on('click', '.btn-upd', function(e)
		{
			e.preventDefault();
			// $(this).parents('.upd_entry:first').find('div').removeClass('d-none').addClass('d-block');
			var controlForm = $('.upd_fvrduplicate:first'),
			currentEntry = $(this).parents('.upd_entry:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);
			// newEntry.find('div').removeClass('d-none').addClass('d-block');
			newEntry.find('input').val('');
          	newEntry.find('textarea').val('');
			controlForm.find('.upd_entry:not(:last) .btn-upd')
			.removeClass('btn-upd').addClass('btn-upd_remove')
			.removeClass('btn-success').addClass('btn-danger')
			.html('<i class="la la-minus font-weight-bold" aria-hidden="true"></i>');
		}).on('click', '.btn-upd_remove', function(e)
		{
			e.preventDefault();
			// $(this).parents('.upd_entry:first').remove();
			var url = $(this).attr("url");
			if (typeof url !== typeof undefined && url !== false)
			{
				if (confirm("Are you sure you want to delete location ?") == true)
				{
					window.location.href = url;
				}
			}
			else
			{
				$(this).parents('.upd_entry:first').remove();
			}
			return false;
		});
	});

</script>

<?php
// Project Add
if (isset($_POST['add_project']))
{
	$project_title = mysqli_real_escape_string($con, $_POST['project_title']);
	$project_desc = mysqli_real_escape_string($con, $_POST['project_desc']);
	$project_loc = mysqli_real_escape_string($con, implode(",", array_filter($_POST['project_loc'])));
	$loc_desc = mysqli_real_escape_string($con, implode("(,)", array_filter($_POST['loc_desc'])));
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$target_dir = "../images/projects/";
	$p_img = $_FILES['p_img']['name'];
	$project_img = implode(",", array_filter($_FILES['project_img']['name']));
	$project_img_tmp = implode(",", array_filter($_FILES['project_img']['tmp_name']));
	$pj_img_tmp = explode(",", $project_img_tmp);

	$target_file = $target_dir . basename($project_img);

	$pro_loc = explode(",", $project_loc);
	$l_desc = explode("(,)", $loc_desc);

	// print_r($pro_loc);
	if( move_uploaded_file($_FILES['p_img']['tmp_name'], $target_dir.basename($p_img)) )
	{
	}

	$in = "INSERT INTO `projects`(`p_img`, `p_name`, `p_desc`, `status`) VALUES ('$p_img','$project_title','$project_desc','$status')";
	// echo $in; exit;
	$in_result = mysqli_query($con, $in);

	if ($in_result)
	{
		$last_pid = mysqli_insert_id($con);
		$last_imgid = array();

		foreach ($pj_img_tmp as $key => $value)
		{	
			$file_tmpname = $_FILES["project_img"]["tmp_name"][$key];
			$file_name = $_FILES['project_img']["name"][$key];

			// $pdffiles[] = $_FILES['uploadPDF']["name"][$key];
			// Set upload file path
			$filepath = $target_dir . basename($file_name);

			if(file_exists($filepath))
			{
				// $filepath1 = $target_dir.time()."_".$file_name;
				if( move_uploaded_file($file_tmpname, $filepath1))
				{
					echo "
						<script LANGUAGE='JavaScript'>;
			        		window.alert('{$project_img} Already Exists!');
			        		window.location.href='';
		              </script>
					";
					exit();
				}
			}
			else
			{
				if (move_uploaded_file($file_tmpname, $filepath))
				{
					foreach ($pro_loc as $k => $v)
					{
						if($key == $k)
						{
							foreach ($l_desc as $k2 => $v2)
							{
								if($k == $k2)
								{
									$insert = "INSERT INTO `project_imgs`(`proj_id`, `location`, `p_img`, `location_desc`) VALUES ('$last_pid','$v','$file_name','$v2')";
									// echo $insert; 
									// exit;
									$ins_result = mysqli_query($con, $insert);

									if ($ins_result)
									{
										$last_imgid[] = mysqli_insert_id($con);
									}
								}
							}
						}
					}
				}
			}
		}
	}

	$imgid = implode(',', $last_imgid);

	$upt = "UPDATE `projects` SET `p_location` = '$imgid' WHERE `p_id` = '$last_pid'";
	// echo $upt; exit;
	$upt_result = mysqli_query($con, $upt);

	if ($ins_result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Project Added Successfully');
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

// Project Update
if (isset($_POST['upd_project']))
{
	$project_title = mysqli_real_escape_string($con, $_POST['project_title']);
	$project_desc = mysqli_real_escape_string($con, $_POST['project_desc']);
	$project_loc = mysqli_real_escape_string($con, implode(",", $_POST['project_loc']));
	$project_img_id = mysqli_real_escape_string($con, implode(",", $_POST['img_id']));
	$loc_desc = mysqli_real_escape_string($con, implode("(,)", $_POST['loc_desc']));
	$status = mysqli_real_escape_string($con, $_POST['status']);

	$target_dir = "../images/projects/";
	$p_img = $_FILES['p_img']['name'];
	$project_img = implode(",", $_FILES['project_img']['name']);
	$project_img_tmp = implode(",", array_filter($_FILES['project_img']['tmp_name']));
	$pj_img_tmp = explode(",", $project_img_tmp);

	$target_file = $target_dir . basename($project_img);

	$pro_loc = explode(",", $project_loc);
	$l_desc = explode("(,)", $loc_desc);

	$pro_img = explode(",", $project_img);
	$pro_img_id = explode(",", $project_img_id);

	foreach ($pro_loc as $k1 => $v1)
	{
		foreach ($pro_img as $k2 => $v2)
		{
			if ($k1 == $k2)
			{
				foreach($pro_img_id as $k3 => $v3)
				{
					if($k2 == $k3)
					{
						foreach($l_desc as $k4 => $v4)
						{
							if($k3 == $k4)
							{
								if (!empty($v2))
								{
                                  	$file_tmpname = $_FILES["project_img"]["tmp_name"][$k3];
									$file_name = $_FILES['project_img']["name"][$k3];

									$filepath = $target_dir . basename($file_name);
									if(file_exists($filepath))
									{
										echo "
											<script LANGUAGE='JavaScript'>;
								        		window.alert('{$file_name} Already Exists!');
								        		window.location.href='';
							              </script>
										";
										exit();
									}
									else
									{
										if (move_uploaded_file($file_tmpname, $filepath))
										{
                                          $dpimg = "SELECT * FROM `project_imgs` WHERE `proj_id` = '$_GET[pid]' AND `img_id` = '$v3'";
                                          //echo $dpimg;
                                          $res_dpimg = mysqli_query($con, $dpimg);
                                          $rw_dpimg = mysqli_fetch_array($res_dpimg);
                                          unlink($target_dir.$rw_dpimg['p_img']);
                                          // echo "ID: ".$v3." | IMG: ".$v2;

                                          // echo "<br>";
                                          $query = "UPDATE `project_imgs` SET `location` = '$v1', `p_img` = '$v2', `location_desc` = '$v4' WHERE `proj_id` = '$_GET[pid]' AND `img_id` = '$v3'";
                                          // echo $query."<br><br>";
                                          // echo "pro_img: ".$k2." | pro_img_id: ".$k3."<br>";
                                        }
                                    }
								}
								else
								{
									// echo "ID: ".$v3." | IMG: ".$v2;
									// echo "<br>";
									$query = "UPDATE `project_imgs` SET `location` = '$v1', `location_desc` = '$v4' WHERE `proj_id` = '$_GET[pid]' AND `img_id` = '$v3'";
									// echo $query."<br>";
									// echo "Loc: ".$v1." Img: ".$v2."<br>";
								}
								$res_query = mysqli_query($con, $query);
							}
						}
					}
				}
			}
		}
	}
	// exit;

	if ($res_query)
	{
		if( move_uploaded_file($_FILES['p_img']['tmp_name'], $target_dir.basename($p_img)) )
		{
			$d_img = "SELECT `p_img` FROM `projects` WHERE `p_id` = '$_GET[pid]'";
			$r_img = mysqli_query($con, $d_img);
			$rw_img = mysqli_fetch_array($r_img);

			$update = "UPDATE `projects` SET `p_img` = '$p_img', `p_name` = '$project_title', `p_desc` = '$project_desc', `status` = '$status' WHERE `p_id` = '$_GET[pid]'";
			$res_update = mysqli_query($con, $update);
			if ($res_update)
			{
				unlink('../images/projects/'.$rw_img['p_img']);
				echo "
					<script LANGUAGE='JavaScript'>;
		        		window.alert('Project Updated Successfully');
		            window.location.href='projects.php'; 
		          </script>
				";
			}
		}
		else
		{
			$update = "UPDATE `projects` SET `p_name` = '$project_title', `p_desc` = '$project_desc', `status` = '$status' WHERE `p_id` = '$_GET[pid]'";
			$res_update = mysqli_query($con, $update);
			if ($res_update)
			{
				echo "
					<script LANGUAGE='JavaScript'>;
		        		window.alert('Project Updated Successfully');
		            window.location.href='projects.php'; 
		          </script>
				";
			}
		}
	}
}

// Project Img Update
if (isset($_POST['upd_proj_imgs']))
{
	$project_loc = mysqli_real_escape_string($con, implode(",", $_POST['project_loc']));
	$loc_desc = mysqli_real_escape_string($con, implode("(,)", $_POST['loc_desc']));
	$target_dir = "../images/projects/";
	$project_img = implode(",", $_FILES['project_img']['name']);
	$project_img_tmp = implode(",", $_FILES['project_img']['tmp_name']);
	$pj_img_tmp = explode(",", $project_img_tmp);

	$target_file = $target_dir . basename($project_img);

	$pro_loc = explode(",", $project_loc);
	$l_desc = explode("(,)", $loc_desc);

	// print_r($pro_loc);

	// $in = "INSERT INTO `projects`(`p_name`, `status`) VALUES ('$project_title','$status')";
	// echo $in; exit;
	// $in_result = mysqli_query($con, $in);

	// if ($in_result)
	// {
		// $last_pid = mysqli_insert_id($con);
		$last_imgid = array();

		foreach ($pj_img_tmp as $key => $value)
		{	
			$file_tmpname = $_FILES["project_img"]["tmp_name"][$key];
			$file_name = $_FILES['project_img']["name"][$key];

			// $pdffiles[] = $_FILES['uploadPDF']["name"][$key];
			// Set upload file path
			$filepath = $target_dir . basename($file_name);

			if(file_exists($filepath))
			{
				// $filepath1 = $target_dir.time()."_".$file_name;
				//if( move_uploaded_file($file_tmpname, $filepath1))
				//{
					echo "
						<script LANGUAGE='JavaScript'>;
			        		window.alert('{$project_img} Already Exists!');
			        		window.location.href='';
		              </script>
					";
					exit();
				//}
			}
			else
			{
				if (move_uploaded_file($file_tmpname, $filepath))
				{
					foreach ($pro_loc as $k => $v)
					{
						if($key == $k)
						{
							foreach ($l_desc as $k2 => $v2)
							{
								if($k == $k2)
								{
									$insert = "INSERT INTO `project_imgs`(`proj_id`, `location`, `p_img`, `location_desc`) VALUES ('$_GET[pid]','$v','$file_name','$v2')";
									// echo $insert."<br>"; 
									// exit;
									$ins_result = mysqli_query($con, $insert);

									if ($ins_result)
									{
										$last_imgid[] = mysqli_insert_id($con);
									}
								}
							}
						}
					}
				}
			}
		}
		// exit;
	// }

	$imgid = implode(',', $last_imgid);

	$upt = "UPDATE `projects` SET `p_location` = CONCAT(p_location, ',$imgid') WHERE `p_id` = '$_GET[pid]'";
	// echo $upt; exit;
	$upt_result = mysqli_query($con, $upt);

	if ($ins_result)
	{
		echo "
			<script LANGUAGE='JavaScript'>;
        		window.alert('Project Location Updated Successfully');
            window.location.href='projects.php'; 
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

// Project Location Delete
if (isset($_GET['id']) && isset($_GET['loc_id']))
{
	$id = $_GET['id'];
	$loc_id = $_GET['loc_id'];

	$select_img = "SELECT * FROM `project_imgs` WHERE `img_id` = '$loc_id' AND `proj_id` = '$id'";
	$res_img = mysqli_query($con, $select_img);
	$row_img = mysqli_fetch_array($res_img);
	unlink("../images/projects/".$row_img['p_img']);

	$delete = "DELETE FROM `project_imgs` WHERE `img_id` = '$loc_id' AND `proj_id` = '$id'";
	// echo $delete."<br><br>";
	// exit;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		$upd_proj = "UPDATE `projects`
SET `p_location` = trim(both ',' from REPLACE(CONCAT(',', p_location, ','), ',$loc_id,', ','))
WHERE CONCAT(',', p_location, ',') like '%,$loc_id,%'";
		// echo $upd_proj; exit;
		$res_upd_proj = mysqli_query($con, $upd_proj);
		if($res_upd_proj)
		{
			echo "
					<script LANGUAGE='JavaScript'>;
		        		window.alert('Project Location Deleted Successfully');
	                window.location.href='projects.php?pid=".$id."'; 
	              </script>
				";
		}
	}
}

// Project Delete
if (isset($_GET['del_pid']) || isset($_GET['del_img']))
{
	$del_pid = $_GET['del_pid'];
	$del_img = explode(',', $_GET['del_img']);
	if(!empty($_GET['del_img']))
	{
		foreach ($del_img as $key => $value)
		{
			$select = "SELECT * FROM `project_imgs` WHERE `img_id` = '$value'";
			$res = mysqli_query($con, $select);
			$rw = mysqli_fetch_array($res);
			unlink("../images/projects/".$rw['p_img']);

			$del_img = "DELETE FROM `project_imgs` WHERE `img_id` = '$value' AND `proj_id` = '$del_pid'";
			// echo $del_img;
			$rs_img = mysqli_query($con, $del_img);
		}
	}
	// exit;

	$d_img = "SELECT `p_img` FROM `projects` WHERE `p_id` = '$del_pid'";
	$r_img = mysqli_query($con, $d_img);
	$rw_img = mysqli_fetch_array($r_img);

	$delete = "DELETE FROM `projects` WHERE `p_id` = '$del_pid'";
	// echo $delete; exit;
	$del_result = mysqli_query($con, $delete);

	if ($del_result)
	{
		unlink('../images/projects/'.$rw_img['p_img']);
		echo "
				<script LANGUAGE='JavaScript'>;
	        		window.alert('Project Deleted Successfully');
                window.location.href='projects.php'; 
              </script>
			";
	}
}
?>