<?php
include "dbconnect.php";
session_start();

if (isset($_GET['food'])) {
	$_SESSION['food'] = $_GET['food'];
	$food = $_SESSION['food'];
}

$query = 'select * from tblrestaurant '
	   ."where restaurantid='$food' ";
$result = $dbcnx->query($query);
$row = $result->fetch_assoc();
$restaurantname = $row['restaurantname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Menu</title>
<link rel="icon" type="image/gif" href="titleicon.gif" />
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="fundamentalStyle.css">
<link rel="stylesheet" href="topNavigationBar.css">
<style>
h3 { margin-left: 20px;}

/*table css*/
table { 
	margin: 10px auto 20px auto;
	width: 80%;
}
td {
	padding: 15px 0px 15px 15px;
}
#addToChartForm button {
   color: #000000;
   font-weight: bold;
   width: 350px;
   height: 97px;
   border: none;
   box-shadow: 0 8px 16px 0 rgba(0,0,0,0.1), 0 6px 20px 0 rgba(0,0,0,0.19);
   cursor: pointer;
 }
 #addToChartForm button:hover {
	 box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
 }

#addToChartForm button img {
   margin-right: 250px;
   vertical-align: middle;
   position: relative;
 }
#addToChartForm button span {
	 position: absolute;
	 text-align: left;
}

/***slide in animation****/
#addToChartForm {
  animation-duration: 1.5s;
  animation-name: slidein;
}
@keyframes slidein {
  from {
    margin-left: 100%;
    width: 300%;
  }

  to {
    margin-left: 0%;
    width: 100%;
  }
}
 
 
 
 /*animate pop up css*/
 #logForm1 {
  padding: 40px;
}
 #logForm2 {
  padding: 40px;
}
 #logForm3 {
  padding: 40px;
}
 #logForm4 {
  padding: 40px;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: left;
  margin: 24px 0 12px 0;
  position: relative;
}

.imgcontainer img {
	margin-right: 20px;
}

.imgcontainer span {
	position: absolute;
}

.container button {
  border: 1px solid #000000;
  border-radius: 3px;
  color: #009933;
  padding: 2px 5px;
  background-color: #ffffff; 
  cursor: pointer;
}

.container input {
  width: 9%;
  padding: 8px 5px 8px 15px;
  border: none;
  box-sizing: border-box;
}

.subcontainer button {
  float: right;
  border: none;
  border-radius: 3px;
  color: #ffffff;
  padding: 10px 10px;
  background-color: #00b33c;
} 

.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 10% auto 13% auto; 
  border: 1px solid #888;
  width: 30%;
  border-radius: 10px;
}

.close {
  position: absolute;
  right: -30px;
  top: -60px;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
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
	<?php
		echo '<img src="food'.$_SESSION['food'].'menu.JPG" width="850" height="200">';
	
	echo '<h2 style="margin-left: 20px">'.$restaurantname.'</h2>';
	?>
	<h3>Menu</h3>
	
	<div id="addToChartForm">
		<table>
			<tr>
			<?php
				$query = 'select * from tblfood '
					   ."where restaurantid='$food' "
					   ."LIMIT 0,2";
				$result = $dbcnx->query($query);				
				$length = $result->num_rows;
				for ($i=1; $i <= $length; $i++){
					$row = $result->fetch_assoc();
					echo "<td><button class='btnExample' type='submit' value='Submit' onclick='openDiv($i)'>";					
					echo '<div>';
					echo '<div>';
					echo '<span>'.$row['foodname'].' <br><br><br><br>Price: S$'.$row['price'].'</span>';
					echo '</div>';
					echo '<div>';
					echo '<img src="food'.$_SESSION['food'].'menuSelect'.$i.'.JPG" width="80" height="80" alt=""/>';
					echo '</div>';
					echo '</div>';
					echo '</button>';
					echo '</td>';
				}
			?>
				
			</tr>
			<tr>
			<?php
				$query = 'select * from tblfood '
					   ."where restaurantid='$food' "
					   ."LIMIT 2,4";
				$result = $dbcnx->query($query);				
				$length = $result->num_rows;
				for ($i=3; $i <= $length+2; $i++){
					$row = $result->fetch_assoc();
					echo "<td><button class='btnExample' type='submit' value='Submit' onclick='openDiv($i)'>";
					echo '<div>';
					echo '<div>';
					echo '<span>'.$row['foodname'].' <br><br><br><br>Price: S$'.$row['price'].'</span>';
					echo '</div>';
					echo '<div>';
					echo '<img src="food'.$_SESSION['food'].'menuSelect'.$i.'.JPG" width="80" height="80" alt=""/>';
					echo '</div>';
					echo '</div>';
					echo '</button>';
					echo '</td>';
				}
			?>
			
				
			</tr>
		</table>
	</div>
	<div id="bottompart">
	<footer>
		<small><i>Copyright &copy; 2022 TY & WY Food House
		</i></small>
	</footer>
	</div>
</div>

<?php
	$query = 'select * from tblfood '
		   ."where restaurantid='$food' ";
		   
	$result = $dbcnx->query($query);
	$length = $result->num_rows;
	for ($i=1; $i <= $length; $i++){
		$row = $result->fetch_assoc();
		echo '<div id="id0'.$i.'" class="modal">';
		echo '<form id="logForm'.$i.'" class="modal-content animate" action="addChart.php?food='.$food.'&foods='.$i.'" method="post">';
		echo '<div id="testing" class="imgcontainer">';
		echo "<span onclick=document.getElementById('id0$i').style.display='none' class='close' title='Close'>&times;</span>";
		echo '<img src="food'.$food.'menuSelect'.$i.'.jpg" alt="Avatar" class="avatar" width="80" height="80">';
		echo '<span>'.$row['foodname'].'<br><br><br>Price: S$'.$row['price'].'</span>';
		echo '</div>';
		echo '<div class="container">';
		echo "<button type='button' class='minusBtn' onclick='minus($i)' onmouseover='minusToggle($i)' onmouseout='normalBtn($i)'>-</button>";
		echo '<input type="text" class="foodqty" id="quantity'.$i.'" name="quantity'.$i.'" placeholder="0" size="1" value="1" maxlength="0">';
		echo "<button type='button' class='addBtn' onclick='add($i)'>+</button>";
		echo '<div class="subcontainer">';
		echo "<button type='button' id='addToChartBtn' onclick='chartBtn($i)'>Add to chart</button>";
		echo '</div>';
		echo '</div>';
		echo '</form>';
		echo '</div>';
	}
?>

<script>
function openDiv(n){
	if (n == 1) {
		document.getElementById("id01").style.display = "block";
	}
	if (n == 2) {
		document.getElementById("id02").style.display = "block";
	}
	if (n == 3) {
		document.getElementById("id03").style.display = "block";
	}
	if (n == 4) {
		document.getElementById("id04").style.display = "block";
	}	
}
function minus(n) {
	var x = document.getElementsByClassName("container");
	var y = x[n-1].getElementsByClassName("minusBtn");
	var z = x[n-1].getElementsByTagName("input");
	if (z[0].value == 1 || z[0].value == 2){
		y[0].disabled = true;
	}else{
		y[0].disabled = false;
	}
	z[0].value = 
	Number(z[0].value) - 1;
}
function add(n) {
	var x = document.getElementsByClassName("container");
	var y = x[n-1].getElementsByClassName("minusBtn");
	var z = x[n-1].getElementsByTagName("input");
	y[0].disabled = false;
	z[0].value = 
	Number(z[0].value) + 1;
}
function chartBtn(n) {
	if (n == 1){
		document.getElementById("logForm1").submit();
	}
	if (n == 2){
		document.getElementById("logForm2").submit();
	}
	if (n == 3){
		document.getElementById("logForm3").submit();
	}
	if (n == 4){
		document.getElementById("logForm4").submit();
	}
	
}
function minusToggle(n) {
	var x = document.getElementsByClassName("container");
	var y = x[n-1].getElementsByClassName("minusBtn");
	var z = x[n-1].getElementsByTagName("input");
	if (z[0].value == 1){
		y[0].disabled = true;
	}else{
		y[0].disabled = false;
	}
}
function normalBtn(n) {
	var x = document.getElementsByClassName("container");
	var y = x[n-1].getElementsByClassName("minusBtn");
	y[0].disabled = false;
}
</script>
</body>
</html>