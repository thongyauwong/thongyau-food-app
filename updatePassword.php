<?php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_POST['cpassword']) && isset($_POST['npassword'])) {
	$cpassword = $_POST['cpassword'];
	$npassword = $_POST['npassword'];
}
if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
}

$cpassword = md5($cpassword);
$npassword = md5($npassword);

$query = 'select * from tbluser '
           ."where userid='$userid' "
           ." and password='$cpassword'";
$result = $dbcnx->query($query);
if ($result->num_rows >0 ){
	$query = 'update tbluser set '
		     ."password=('$npassword') "
			 ."where userid='$userid' ";
	$result = $dbcnx->query($query);
	
	$dbcnx->close();   
	echo "<script>alert('Password is changed successfully!');document.location='Myaccount.php'</script>";
    exit(); 
}else{
	echo "<script>alert('Incorrect current password! Please try again.');document.location='Myaccount.php'</script>";
}
?>