<?php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_POST['cname']) && isset($_POST['cnumber'])) {
	$cname = $_POST['cname'];
	$cnumber = $_POST['cnumber'];
}
if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
}

if ($_GET['mode'] == 'update') {
	$query = "update tbluser set cardname=('$cname'), "
			."cardnumber=('$cnumber') "
			."where userid='$userid' ";
	$result = $dbcnx->query($query);
	
	$dbcnx->close();
	echo "<script>alert('Payment is updated successfully!');document.location='Myaccount.php'</script>";
	exit(); 
}elseif ($_GET['mode'] == 'delete') {
	$query = "update tbluser set cardname = NULL, "
			."cardnumber = NULL "
			."where userid='$userid' ";
		   
	$result = $dbcnx->query($query);
	$dbcnx->close();
	echo "<script>alert('Payment is removed successfully!');document.location='Myaccount.php'</script>";
	exit(); 
}

?>