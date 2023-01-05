<?php // register.php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_POST['userid']) && isset($_POST['passwrd']))
{
  $userid = $_POST['userid'];
  $password = $_POST['passwrd'];
  
  $password = md5($password);
  $query = 'select * from tbluser '
           ."where username='$userid' "
           ." and password='$password'";
  
  $result = $dbcnx->query($query);
  if ($result->num_rows >0 )
  {
	$row = $result->fetch_assoc();
	$username = $row['firstname'];
    $_SESSION['fname'] = $username;
    $_SESSION['userid'] = $row['userid'];	
	
	$dbcnx->close();   
	echo '<script type="text/javascript">'; 
	echo 'alert("Login successfully!");'; 
	echo 'window.location.href = "index.php";';
	echo '</script>';
    exit(); 
  }else{
	  echo '<script type="text/javascript">alert("Invalid Username and Password! Please try again");history.go(-1);</script>';
  }
}

?>