<!DOCTYPE html>
<html>
<body>

<?php
include "ChromePhp.php";
include "dbconnect.php";
session_start();

if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
}
if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['cardname']) && isset($_POST['cardnumber'])) {
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$cardname = $_POST['cardname'];
	$cardnumber = $_POST['cardnumber'];
	$maskedcnum = preg_replace("/(?<=.{4}).(?=.{4})/", "*", $cardnumber);
}

$to = 'f32ee@localhost';
$subject = 'Food Order Comfirmation';
$query = 'select tc.restaurantid as restid, tc.foodnameid as fdnmid, '
		.'trt.restaurantname, tf.foodname, tc.totalquantity, tf.price '
		.'from tblchart tc '
		.'left join tblfood tf on tf.foodid = tc.foodid '
		.'left join tblrestaurant trt on trt.restaurantid = tc.restaurantid '
	   ."where userid='$userid'";
$result = $dbcnx->query($query);
$length = $result->num_rows;
$totalprice = 0;
define('DELIVERYFEE', 3.5);

$message = '
<html>
<head>
  <title>Food Order Comfirmation</title>
</head>
<style>
tr:nth-child(odd){background-color: #e6e6e6;}
th {
	background-color:cc4400;
}
.center {
        display: block;
		width: 15%;
}
header { 
  background-color:#f2f2f2;
  padding: 0 20px;
}
</style>
<body>
  <header style="padding: 20px 0px">
	<h2 style="margin-bottom:2px; font-family:Comic Sans MS">TY & WY Food House</h2>
	<img src="http://localhost:8000/ie4717/EPLE-DG01/Foodlogo2.JPG" class="center">
  </header>
  <p>Dear '.$_SESSION['fname'].',</p>
  <p>Here are the orders you have just placed!</p>
  <table border="1" style="border-collapse: collapse">
    <tr>
	  <th></th>
      <th style="text-align:left">Restaurant</th><th style="text-align:left">Food</th>
	  <th style="text-align:left">Quantity</th><th style="text-align:left">Price</th>
    </tr>';
for ($i=0; $i < $length; $i++){
	$row = $result->fetch_assoc();
	$totalprice = $totalprice + ($row['price'] * $row['totalquantity']);
	$message .= '<tr>
		  <td style="padding:5px"><img src="http://localhost:8000/ie4717/EPLE-DG01/food'.$row['restid'].'menuSelect'.$row['fdnmid'].'.JPG" width="80" height="80"></td>
		  <td style="padding-right:10px">'.$row['restaurantname'].'</td><td style="padding-right:10px">'.$row['foodname'].'</td>
		  <td style="padding-right:10px">'.$row['totalquantity'].'</td><td style="padding-right:10px">$'.$row['price'] * $row['totalquantity'].'</td>
		</tr>';
}
    
$message .= '</table>
			<p><b>Total Price:</b> $'.$totalprice + DELIVERYFEE.' (Including delivery fee $3.50)</p>
			<p><b>Name:</b> '.$fullname.'</p>
			<p><b>Email:</b> '.$email.'</p>
			<p><b>Deliver To:</b> '.$address.'</p>
			<p><b>Contact Number:</b> '.$phone.'</p>
			<table style="border-collapse: collapse">
			 <tr>
			 <th colspan="2">Payment by</th>
			 </tr>
			 <tr>
			 <td><b>Name on card: </b></td><td>'.$cardname.'</td>
			 </tr>
			 <tr>
			 <td><b>Credit card number: </b></td><td>'.$maskedcnum.'</td>
			 </tr>
			 </table>
			<br><br>
			<p>Best Regard,<br>TY & WY Food House</p>
			</body>
			</html>
			';
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: f32ee@localhost' . "\r\n" .
'Reply-To: f32ee@localhost' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers,
'-ff32ee@localhost');

if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
}
$query = 'select * from tblchart '
	   ."where userid='$userid'";
$result = $dbcnx->query($query);
$length = $result->num_rows;
for ($i=0; $i < $length; $i++){
	$row = $result->fetch_assoc();
	$query2 = "INSERT INTO tblorder (fooddid, fooddnameid, restauranttid, totalquanttity, useridd)" 
			.'VALUES ('.$row['foodid'].', '.$row['foodnameid'].', '.$row['restaurantid'].', '.$row['totalquantity'].', '.$row['userid'].')';
	$result2 = $dbcnx->query($query2);
}

$query = 'delete from tblchart '
	   ."where userid='$userid'";
	   
$result = $dbcnx->query($query);
$dbcnx->close();
echo "<script>alert('Order placed successfully!');document.location='Mychart.php'</script>";	
exit();
?>
</body>
</html>