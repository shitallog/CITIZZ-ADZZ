<?php
	include 'config.php';
	session_start();
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = md5($password);

	$select = "SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$password' AND `status` = '1'";
	// echo $select;exit();
	$result = mysqli_query($con, $select);
	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$_SESSION['user_id'] = $row['uid'];
		$_SESSION['user_login'] = $row['email'];
		$_SESSION["login_time_stamp"] = time();
		echo json_encode( array('success' => "Login Successful!") );
	}
	else
	{
		echo json_encode( array('error' => "There was an error occurred, please try again later!") );
	}
?>