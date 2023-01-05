<?php
include "dbconnect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>About</title>
<link rel="icon" type="image/gif" href="titleicon.gif" />
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="fundamentalStyle.css">
<link rel="stylesheet" href="topNavigationBar.css">
<style>
#floatleft { margin: 10px;float: left;}
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
			if (!isset($_SESSION['fname'])) {
				echo '<a href="LoginSignup.php" class="split">Login/Sign up</a>';
			}
			if (isset($_SESSION['fname'])) {
				echo '<div class="split">';
				echo '<button class="dropbtn">'.$_SESSION['fname'].'</button>';
				echo '<div class="dropdown-content">';
				   echo '<a href="Myaccount.php">Account</a>';
				   echo '<a href="Mychart.php">Mychart</a>';
				   echo '<a href="'.$_SERVER["PHP_SELF"].'?signout=1">Log out</a>';
				echo '</div>';
				echo '</div>';
			}
	   ?>
	</div>
	<div style="position:relative;">
		<img src="foodbackground.Jfif"  width="100%" height="100%">
		<div id="inbox">
			<div style="position:absolute; z-index:2; left:100px; right:100px;top: 10px"<p><strong><br><br><br>Brings the popular food with more affordable price. 
				most authentic cooking marinated recipe,freshness and hassle-fee desert at anytime, 
				any occassions. Our physical store at Nanyang Technological University on Nov of 2022, loved by many fans. 
				Hungry diners will truly enjoy of delicious wide selection of fresh meat and vegatables. </strong></p><br>
				<div id="inbox2">
				<img src="contactlogo.JPG"  width="150px" height="140px"id="floatleft">
				<P><br>© 2022 Food House. All Rights Reserved<br>
				Nanyang Technological University<br>
				Singapore 639798<br>
				Reservation Tel: 1234-5678<br>
				SMS: 8666-8666<br>
				Email: TY&WY FoodHouse@gmail.com<br></P>
				</div>
			</div>
		</div>
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