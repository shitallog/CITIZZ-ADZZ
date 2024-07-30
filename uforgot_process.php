<?php
  session_start();
  //$user_id = $_SESSION["user_id"];
  include 'config.php';

  $uforgot_email = $_POST["uforgot_email"];
  $randomnumber = rand(100000, 999999);

  $to = $uforgot_email;
  $subject = "Forgot Password | Citizz Adzz";

  $message = "<h3 style='margin-bottom: 20px;'>Dear Citizz Adzz User,</h3>";
  $message .= "<br>";
  $message .= "<p>Your OTP is <b>".$randomnumber."</b>. Enter OTP to verify your account.</p>";

  $header = "From: no-reply@citizzadzz.com \r\n";
  $header .= "MIME-Version: 1.0\n" ;
  $header .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
  $header .= "X-Priority: 1 (Highest)\n";
  $header .= "X-MSMail-Priority: High\n";
  $header .= "Importance: High\n";
  $header .= "Content-type: text/html\r\n";

  $sql = "SELECT * FROM `users` WHERE `email` = '$uforgot_email'";
  //echo $sql; exit;
  $res = mysqli_query($con, $sql);
  if(mysqli_num_rows($res) > 0)
  {
    $retval = mail($to,$subject,$message,$header);
  }
  else
  {
    echo "
      <div class='alert alert-warning alert-dismissible fade show shadow-sm' role='alert'>
        Please enter your registered email!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
    ";
    exit;
  }

  if($retval)
  {
    $query = "UPDATE `users` SET `email_otp` = '$randomnumber', `email_verify` = 'no' WHERE `email` = '$uforgot_email'";
    //echo $query; exit;
    $result = mysqli_query($con, $query);
    if($result)
    {
    echo "      
      <div class='alert alert-success alert-dismissible fade show shadow-sm' role='alert'>
        OTP sent on given email!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
    ";
    }
  }
  else
  {
    echo "
      <div class='alert alert-danger alert-dismissible fade show shadow-sm' role='alert'>
        There was a technical problem! Please try again later!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
    ";
  }
?>