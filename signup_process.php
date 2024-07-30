<?php
	include 'config.php';

	$fname = $_POST['fname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$dob = $_POST['dob'];
	$password = $_POST['password'];
	$password = md5($password);

	$select = "SELECT * FROM `users` WHERE `email` = '$email' OR `mobile` = '$mobile'";
	// echo $select;exit();
	$result = mysqli_query($con, $select);
	if(mysqli_num_rows($result) > 0)
	{
		echo json_encode( array('warning' => "User already exists!") );
	}
	else
	{
		$insert = "INSERT INTO `users`(`fname`, `pass`, `email`, `mobile`, `dob`) VALUES ('$fname','$password','$email','$mobile','$dob')";
		$ins_result = mysqli_query($con, $insert);
		if ($ins_result)
		{
			echo json_encode( array('success' => "Registration Successful!") );
		}
		else
		{
			echo json_encode( array('error' => "There was an error occurred, please try again later!") );
		}
	}
?>