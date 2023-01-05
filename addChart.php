<?php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_GET['food'])) {
	$_SESSION['food'] = $_GET['food'];
	$food = $_SESSION['food'];
}
if (isset($_GET['foods'])) {
	$_SESSION['foods'] = $_GET['foods'];
	$foods = $_SESSION['foods'];
}
if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
}
if (isset($_POST["quantity$foods"])) {
	$quantity = $_POST["quantity$foods"];
}
$query = 'select * from tblfood '
           ."where foodnameid='$foods' "
           ." and restaurantid='$food'";
  
$result = $dbcnx->query($query);
if ($result->num_rows >0 ) {
	$row = $result->fetch_assoc();
	$foodid = $row['foodid'];
}

	
if (!isset($_SESSION['fname'])) {
	echo '<script type="text/javascript">alert("Please login first before ordering!");history.go(-1);</script>';
}
if (isset($_SESSION['fname'])) {
	$sql = 'select * from tblchart '
			."where foodid='$foodid' ";
	$result = $dbcnx->query($sql);
	if ($result->num_rows >0 ) {
		$row = $result->fetch_assoc();
		$existqty = $row['totalquantity'];
		$quantity = $quantity + $existqty;
		
		$sql = 'update tblchart set '
		      ."totalquantity=('$quantity') "
			  ."where foodid='$foodid' ";
		$result = $dbcnx->query($sql);
	}else{
		$sql = "INSERT INTO tblchart (foodid, foodnameid, restaurantid, totalquantity, userid) 
				VALUES ('$foodid', '$foods', '$food', '$quantity', '$userid')";
		$result = $dbcnx->query($sql);
	}
	$dbcnx->close(); 
	echo '<script type="text/javascript">alert("Food is added to chart!");history.go(-1);</script>';
}
?>