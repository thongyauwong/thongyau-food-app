<?php
include "dbconnect.php";
session_start();

if (isset($_GET['signout'])) {
	unset($_SESSION['fname']);
	unset($_SESSION['userid']);
	session_destroy();
	echo "<script>alert('You have logged out successfully!');document.location='index.php'</script>";	
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<link rel="icon" type="image/gif" href="titleicon.gif" />
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="fundamentalStyle.css">
<link rel="stylesheet" href="topNavigationBar.css">
<style>
#mainPage {
	width: 100%;
	margin-top: 20px;
}
#mainPage th {
	padding: 50px 0px;
	background-color: #ccddff;
	font-family: 'Courier New', monospace;
	font-size: 30px;
}

/******various restaurant showcase********/

.scroll-images {
  width: 100%;
  height: auto;
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  overflow-y: hidden;
  scroll-behavior: smooth;
}

.scroll-images::-webkit-scrollbar {
  -webkit-appearance: none;
}

.child {
  width: 200px;
  height: 190px;
  margin: 1px 10px;
}

.cover {
  padding: 0px 30px;
  position: relative;
  margin: 70px 20px;
}
.left {
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
}
.right {
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
}
.cover button {
	background-color: #04AA6D;
	color: #ffffff;
	border: none;
	border-radius: 8px;
	padding: 9px 9px;
	font-size: 10px;
	cursor: pointer;
}
button:hover {
  opacity: 0.5;
}
.child-img:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05); 
  cursor: pointer;
}
.cover a {
	text-decoration: none;
	color: #000000;
}
</style>
</head>
<body onload="scroller();">
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
		<table id="mainPage">
		<tr>
			<th id="tabledata">Hi there, Welcome to TY & WY Food House!</th>
		</tr>
		</table>
			
		<div class="cover">
		
		<h3 style="display: inline;">Popular food</h3>
		
			<br>
			<button class="left" onclick="leftScroll(0)"><b><<</b></button>
		  <div class="scroll-images">
		  <?php
			$query = 'SELECT tblr.restaurantid, tblr.restaurantname, sum(tblo.totalquanttity) FROM tblrestaurant tblr '
				     .'left join tblorder tblo on tblr.restaurantid = tblo.restauranttid '
                     .'group by tblr.restaurantid '
					 .'order by sum(tblo.totalquanttity) DESC '              
					 .'LIMIT 0,6 ';
			$result = $dbcnx->query($query);
			$length = $result->num_rows;
			for ($i=0; $i < $length; $i++){
				$row = $result->fetch_assoc();
				echo '<div class="child">';
				echo '<a href="menu.php?food='.$row['restaurantid'].'"><img class="child-img" src="food'.$row['restaurantid'].'.JPG" width="200" height="150" alt="image" />'.$row['restaurantname'].'</a>';
				echo '</div>';
			}
		  ?>
			
			<button class="right" onclick="rightScroll(0)"><b>>></b></button>
		  </div>
		</div>		
			
	
	<div id="bottompart">
	<footer>
		<small><i>Copyright &copy; 2022 TY & WY Food House
		</i></small>
	</footer>
	</div>
</div>
<script>
  function leftScroll(n) {
	x = document.getElementsByClassName("cover");
	const left = x[n].querySelector(".scroll-images");
	left.scrollBy(-200, 0);
  }
  function rightScroll(n) {
	x = document.getElementsByClassName("cover");
	const right = x[n].querySelector(".scroll-images");
	right.scrollBy(200, 0);
  }
  
  var message="Welcome!";
   message += " Delivery fee as low as $3.50!";
   var space=" ";
   var position=0;
   function scroller(){
        var newtext = message.substring(position,message.length)+
        space + message.substring(0,position);
        var td = document.getElementById("tabledata");
        td.firstChild.nodeValue = newtext;
        position++;
        if (position > message.length){position=0;}
        window.setTimeout("scroller()",200);
   }
</script>
</body>
</html>