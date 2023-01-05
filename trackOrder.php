<?php
include "dbconnect.php";
session_start();

if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Orders History</title>
<link rel="icon" type="image/gif" href="titleicon.gif" />
<meta charset="utf-8">
<link rel="stylesheet" href="fundamentalStyle.css">
<link rel="stylesheet" href="topNavigationBar.css">
<style>
h2 { text-align: center;}

table {
	width: 70%;
	margin: 20px 0 20px 20px;
	border-collapse: collapse;
}
hr {
  border: 1px solid lightgrey;
}
</style>
</head>
<body>
<div id="wrapper">
	<header style="padding: 20px 0px">
		<h2 style="text-align:center; margin-bottom:2px; font-family:Comic Sans MS">TY & WY Food House</h2>
		<img src="Foodlogo2.JPG"  class="center">
	</header>
	
	<div  class="topnav">
	   <a class="active" href="index.php">Home</a>
	   <a href="restaurant.php">Restaurant</a>
	   <a href="about.php">About</a>
	   
	   <?php
			if (isset($_SESSION['fname'])) {
				echo '<div class="split">';
				echo '<button class="dropbtn">'.$_SESSION['fname'].'</button>';
				echo '<div class="dropdown-content">';
				   echo '<a href="Myaccount.php">Account</a>';
				   echo '<a href="Mychart.php">Mychart</a>';
				   echo '<a href="index.php?signout=1">Log out</a>';
				echo '</div>';
				echo '</div>';
			}
	   ?>
	</div>
	
	<div id="rightcolumn">
		<table border="0">
		<tr>
			<td><b>Past orders<b></td>
		</tr>
		<?php
			$query = 'select tod.date from tblorder tod ' 
					."where tod.useridd=$userid "
					."GROUP BY tod.date "
					."order by tod.date DESC";
			$result = $dbcnx->query($query);
			$length = $result->num_rows;
			define('DELIVERYFEE', 3.5);
			echo '<table border="0">';
			if ($result->num_rows >0 ) {
				for ($i=0; $i < $length; $i++){
					$row = $result->fetch_assoc();
					$query2 = 'select * from tblorder tod ' 
							.'left join tblfood tf on tf.foodid = tod.fooddid '
							.'left join tblrestaurant trt on trt.restaurantid = tod.restauranttid '
							."where tod.useridd=$userid "
							."and tod.date='".$row['date']."'";
					$result2 = $dbcnx->query($query2);
					$length2 = $result2->num_rows;
					$totalprice = 0;
					
					if ($result2->num_rows >0 ) {
						echo '<tr style="background-color: #dddddd">';
						echo '<td colspan="3" style="padding:5px 5px">'.date("Y-m-d h:i:sa", strtotime($row['date'])).'</td>';
						echo '</tr>';
						for ($j=0; $j < $length2; $j++){
							$row2 = $result2->fetch_assoc();
							$totalprice = $totalprice + ($row2['price'] * $row2['totalquanttity']);
							
							echo '<tr>';
							echo '<td rowspan="2" style="padding:10px 0px"><img src="food'.$row2['restaurantid'].'menuSelect'.$row2['foodnameid'].'.JPG" width="80" height="80"></td>';
							echo '<td><b>'.$row2['restaurantname'].'<b></td>';
							echo '<td>$'.$row2['price'] * $row2['totalquanttity'].'</td>';
							echo '</tr>';
							echo '<tr>';
							echo '<td>'.$row2['totalquanttity'].'x '.$row2['foodname'].'</td>';
							echo '</tr>';
						}
						echo '<tr>';
						echo '<td></td>';
						echo '<td style="text-align:center; border-top:1px solid black; padding: 10px 0px 20px 0px"><b>Total (incl. Del): <b></td>';
						echo '<td style="border-top:1px solid black; padding: 10px 0px 30px 0px"><b>$'.$totalprice + DELIVERYFEE.'<b></td>';
						echo '</tr>';
					}
				}
			}
			echo '</table>';
		?>
		</table>
	</div>
	
	<div id="bottompart">
	<footer>
		<small><i>Copyright &copy; 2022 TY & WY Food House
		</i></small>
	</footer>
	</div>
	
</div>
</body>
</html>