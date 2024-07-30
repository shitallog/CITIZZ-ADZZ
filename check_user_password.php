<?php
	include 'config.php';
	session_start();
	$uid = $_SESSION['user_id'];
	$password = $_POST['oldpass'];
	$password = md5($password);

	$select = "SELECT * FROM `users` WHERE `uid` = '$uid' AND `pass` = '$password'";
	// echo $select;exit();
	$result = mysqli_query($con, $select);
	if(mysqli_num_rows($result) > 0)
	{
		echo json_encode( array('success' => "Password verified!") );
	}
	else
	{
		echo json_encode( array('error' => "Incorrect Password!") );
	}
?>