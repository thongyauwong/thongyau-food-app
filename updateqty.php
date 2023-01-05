<?php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_GET['chartid'])) {
	$chartid = $_GET['chartid'];
}
if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
}
if (isset($_GET['quantity'])) {
	$quantity = $_GET['quantity'];
}
if ($mode == "minus") {
	$quantity = $quantity - 1;
	$sql = 'update tblchart set '
		  ."totalquantity=('$quantity') "
		  ."where chartid='$chartid' ";
    $result = $dbcnx->query($sql);
}
if ($mode == "add") {
	$quantity = $quantity + 1;
	$sql = 'update tblchart set '
		  ."totalquantity=('$quantity') "
		  ."where chartid='$chartid' ";
    $result = $dbcnx->query($sql);
}	

$dbcnx->close();
header("Location: Mychart.php");
exit(); 
?>