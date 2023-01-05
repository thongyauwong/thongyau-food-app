<?php // register.php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['dd']) && isset($_POST['nn']) && isset($_POST['yyyy']) && isset($_POST['block']) && isset($_POST['street']) && isset($_POST['floor']) && isset($_POST['unit']) && isset($_POST['postal'])) {
	$uname = $_POST['uname'];
	$psw = $_POST['psw'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$block = $_POST['block'];
	$street = $_POST['street'];
	$floor = $_POST['floor'];
	$unit = $_POST['unit'];
	$postal = $_POST['postal'];
	$birthday = $_POST['dd'];
	$birthmonth = $_POST['nn'];
	$birthyear = $_POST['yyyy'];
}

$sql = "select * from tbluser where username='$uname' ";
$result = $dbcnx->query($sql);
if ($result->num_rows >0 )
{
	echo '<script type="text/javascript">alert("Username already exist! Please use another username");history.go(-1);</script>';   
}
else
{
	if (isset($_POST['fname'])) {
		$fname = $_POST['fname'];
		$_SESSION['fname'] = $fname;
		//ChromePhp::log($_SESSION['valid_user']);
	}
	$psw = md5($psw);
	$sql = "INSERT INTO tbluser (username, password, firstname, lastname, email, phone, block, street, floor, unit, postal, birthday, birthmonth, birthyear) 
			VALUES ('$uname', '$psw', '$fname', '$lname', '$email', '$phone', '$block', '$street', '$floor', '$unit', '$postal', '$birthday', '$birthmonth', '$birthyear')";
	$result = $dbcnx->query($sql);
	
	$sql = "SELECT * FROM TBLUSER WHERE username='$uname'";
	$result = $dbcnx->query($sql);
	$row = $result->fetch_assoc();
	$_SESSION['userid'] = $row['userid'];
	
	$dbcnx->close();
	echo '<script type="text/javascript">'; 
	echo 'alert("Register successfully!");'; 
	echo 'window.location.href = "index.php";';
	echo '</script>';
	exit(); 
}	
?>
