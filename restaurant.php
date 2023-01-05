<?php
include "dbconnect.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Restaurant</title>
<link rel="icon" type="image/gif" href="titleicon.gif" />
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="fundamentalStyle.css">
<link rel="stylesheet" href="topNavigationBar.css">
<style>
h2 { text-align: center;}

/*Image scrollable css*/
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

/***************************************************************/
.dropbtn2 {
  background-color: #ffffff;
  color: black;
  padding: 10px;
  font-size: 14px;
  border: 1px solid #000000;
}

.dropdown {
  position: relative;
  display: inline-block;
  margin-left:6%;
  margin-top: 10px;
}

.dropdown-content2 {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content2 a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}
.dropdown:hover .dropdown-content2 {display: block;}

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
				   echo '<a href="index.php?signout=1">Log out</a>';
				echo '</div>';
				echo '</div>';
			}
	   ?>
	</div>
	
	<div class="dropdown">
	  <button class="dropbtn2"><i style="background-image: url(filter.gif);background-repeat: no-repeat;padding-left: 20px;">FILTER</i></button>
	  <div id="myDropdown" class="dropdown-content2">
		<a href="#" onclick="showFood(3)">All</a>
		<a href="#" onclick="showFood(0)">Halal Food</a>
		<a href="#" onclick="showFood(1)">Chinese Food</a>
		<a href="#" onclick="showFood(2)">Korean Food</a>
	  </div>
	</div>
	
	<div class="cover">
	    <h3>Halal Food</h3>
		<button class="left" onclick="leftScroll(0)"><b><<</b></button>
      <div class="scroll-images">
	  <?php
		$query = 'select * from tblrestaurant where 1 LIMIT 0,6';
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
	
	<div class="cover">
		<h3>Chinese Food</h3>
		<button class="left" onclick="leftScroll(1)"><b><<</b></button>
      <div class="scroll-images">
	  <?php
		$query = 'select * from tblrestaurant where 1 LIMIT 6,6';
		$result = $dbcnx->query($query);
		$length = $result->num_rows;
		for ($i=0; $i < $length; $i++){
			$row = $result->fetch_assoc();
			echo '<div class="child">';
			echo '<a href="menu.php?food='.$row['restaurantid'].'"><img class="child-img" src="food'.$row['restaurantid'].'.JPG" width="200" height="150" alt="image" />'.$row['restaurantname'].'</a>';
			echo '</div>';
		}
	  ?>
	  
		<button class="right" onclick="rightScroll(1)"><b>>></b></button>
      </div>
    </div>
	
	<div class="cover">
		<h3>Korean Food</h3>
		<button class="left" onclick="leftScroll(2)"><b><<</b></button>
      <div class="scroll-images">
	  <?php
		$query = 'select * from tblrestaurant where 1 LIMIT 12,18';
		$result = $dbcnx->query($query);
		$length = $result->num_rows;
		for ($i=0; $i < $length; $i++){
			$row = $result->fetch_assoc();
			echo '<div class="child">';
			echo '<a href="menu.php?food='.$row['restaurantid'].'"><img class="child-img" src="food'.$row['restaurantid'].'.JPG" width="200" height="150" alt="image" />'.$row['restaurantname'].'</a>';
			echo '</div>';
		}
	  ?>
	  
		<button class="right" onclick="rightScroll(2)"><b>>></b></button>
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

function showFood(n) {
	var x = document.getElementsByClassName("cover");
	if (n == 0) {
		x[n].style.display = "block";
		x[1].style.display = "none";
		x[2].style.display = "none";
	}
	if (n == 1) {
		x[n].style.display = "block";
		x[0].style.display = "none";
		x[2].style.display = "none";
	}
	if (n == 2) {
		x[n].style.display = "block";
		x[0].style.display = "none";
		x[1].style.display = "none";
	}
	if (n == 3) {
		x[0].style.display = "block";
		x[1].style.display = "block";
		x[2].style.display = "block";
	}
}
</script>
</body>
</html>