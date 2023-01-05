<?php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && 
	isset($_POST['mobile']) && isset($_POST['dd']) && isset($_POST['mm']) && 
	isset($_POST['yyyy']) && isset($_POST['block']) && isset($_POST['street']) && 
	isset($_POST['floor']) && isset($_POST['unit']) && isset($_POST['postal'])) {
	$fname = $_POST['fname'];
	$_SESSION['fname'] = $fname;
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['mobile'];
	$birthday = $_POST['dd'];
	$birthmonth = $_POST['mm'];
	$birthyear = $_POST['yyyy'];
	$block = $_POST['block'];
	$street = $_POST['street'];
	$floor = $_POST['floor'];
	$unit = $_POST['unit'];
	$postal = $_POST['postal'];
}

if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
	$query = "update tbluser set firstname=('$fname'), "
		   ."lastname=('$lname'), "
		   ."email=('$email'), "
		   ."phone=('$phone'), "
		   ."block=('$block'), "
		   ."street=('$street'), "
		   ."floor=('$floor'), "
		   ."unit=('$unit'), "
		   ."postal=('$postal'), "
		   ."birthday=('$birthday'), "
		   ."birthmonth=('$birthmonth'), "
		   ."birthyear=('$birthyear') "
           ."where userid='$userid' ";
    $result = $dbcnx->query($query);
	
	$dbcnx->close();
	echo "<script>alert('Profile is updated successfully!');document.location='Myaccount.php'</script>";
	exit(); 
}
?>