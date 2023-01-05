<?php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_GET['chartid'])) {
	$chartid = $_GET['chartid'];
	
$query = 'delete from tblchart '
           ."where chartid='$chartid' ";

$result = $dbcnx->query($query);
$dbcnx->close(); 

header("Location: Mychart.php");
exit(); 
}
?>