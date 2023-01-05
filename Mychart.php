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
<title>My Chart</title>
<link rel="icon" type="image/gif" href="titleicon.gif" />
<meta charset="utf-8">
<link rel="stylesheet" href="fundamentalStyle.css">
<link rel="stylesheet" href="topNavigationBar.css">
<style>
#wrapper { background-color: #ffffff; 
           width: 10%;
		   margin:auto;
           min-width:850px;
} 

.container h4 img {
	margin-right: 0px;
}

/******************************************************/

* {
  box-sizing: border-box;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 0px;
}

.container {
  background-color: #ffffff;
  padding: 5px 10px 15px 10px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  margin-bottom: 20px;
}

.container1 {
  background-color: #f2f2f2;
  padding: 5px 10px 15px 10px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  margin: 10px 100px 20px 100px;
}

.container2 {
	display: none;
}

.col-50 input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}
span.foodname {
  position: absolute;
}
.container img {
	margin-right: 20px;
}
input.invalid {
  background-color: #ffdddd;
}

#mychart {
	border-collapse: collapse;
	width: 100%;
}

tr:nth-child(odd){background-color: #f2f2f2;}
tr:hover {background-color: #ddd;}

#mychart input {
	background-color: none;
	border: none;
	box-sizing: border-box;
}
#mychart button {
	background-color: #ffffff;
	margin: 0 1px;
	border-radius: 4px;
	cursor: pointer;
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
	
	<h2>My Chart and Chekout </h2>

	<div class="col-25">
    <div class="container">
	  <?php
		$query = 'select * from tblchart tch '
			   .'left join tblfood tf on tf.foodid = tch.foodid '
			   ."where userid='$userid'";
			   
		$result = $dbcnx->query($query);
		$length = $result->num_rows;
		$totalprice = 0;
		define('DELIVERYFEE', 3.5);
		echo '<h4>Cart <span class="price" style="color:black; background-image: url(chart.gif);background-repeat: no-repeat;padding-left: 20px;" "><b>'.$length.'</b></span></h4>';
		
		if ($result->num_rows >0 ) {
			echo '<table id="mychart">';
			for ($i=0; $i < $length; $i++){
				$row = $result->fetch_assoc();
				$totalprice = $totalprice + ($row['price'] * $row['totalquantity']);
				$chartid = $row['chartid'];
				$quantity = $row['totalquantity'];
				
				echo '<tr class="subchart">';
				echo '<td><img src="food'.$row['restaurantid'].'menuSelect'.$row['foodnameid'].'.JPG" width="80" height="80"></td>';
				echo '<td style="text-align: right;">'.$row['foodname'].'</td>';
				echo '<td style="text-align: center;">quantity:<input type="text" style="width: 10%;" value='.$row['totalquantity'].' disabled></td>';
				echo "<td><a href='updateqty.php?chartid=$chartid&quantity=$quantity&mode=minus'><button type='button' class='minusBtn' onmouseover='minus($i)' onmouseout='normalBtn($i)'>-</button></a>";
				echo "<a href='updateqty.php?chartid=$chartid&quantity=$quantity&mode=add'><button type='button' class='addBtn'>+</button></a></td>";
				echo '<td><a href="delete.php?chartid='.$row['chartid'].'"><i style="background-image: url(delete.gif);background-repeat: no-repeat;padding-left: 20px;"></i></a></td>';
				echo '<td style="text-align: right;">$'.$row['price'] * $row['totalquantity'].'</td>';
				echo '</tr>';			
			}
			echo '</table>';
		}
	  
      echo '<hr>';
	  if ($length > 0) {
		  echo '<p>Delivery fee:<span class="price" style="color:black"><b>$'.DELIVERYFEE.'</b></span></p>';
		  echo '<p>Total <span class="price" style="color:black"><b>$'.$totalprice + DELIVERYFEE.'</b></span></p>';
	  }else{
		  echo '<p>Total <span class="price" style="color:black"><b>$'.$totalprice.'</b></span></p>';
	  }
	  
    echo '</div>';
	echo '</div>';
	
	if ($length > 0) {
		echo '<div class="container1">';
	}else{
		echo '<div class="container2">';
	}
	?>
      <form id="profileForm" class="profileForm" action="comfirmationMail.php" method="POST">
             
          <div class="col-50">
            <h3>Billing Address</h3>
			<?php
			$query = 'select * from tbluser '
				   ."where userid='$userid'";
		    $result = $dbcnx->query($query);
			if ($result->num_rows >0 ) {
				$row = $result->fetch_assoc();
				echo '<label for="fullname"><i style="background-image: url(fullname.gif);background-repeat: no-repeat;padding-left: 25px;"></i> Full Name</label>';
				echo "<input type='text' id='fullname' name='fullname' placeholder='Name' value='".$row['lastname']." ".$row['firstname']."' oninput='rmclassnm(this)' onkeypress='return limitalpha(event,this)'>";
				echo '<label for="email"><i style="background-image: url(mail.gif);background-repeat: no-repeat;padding-left: 25px;"></i> Email</label>';
				echo "<input type='text' id='email' name='email' placeholder='john@example.com' value='".$row['email']."' oninput='rmclassnm(this)'>";
				echo '<label for="address"><i style="background-image: url(deliver.gif);background-repeat: no-repeat;padding-left: 25px;"></i> Deliver To</label>';
				echo "<input type='text' id='address' name='address' placeholder='Address' value='BLK ".$row['block']." ".$row['street']." #".$row['floor']."-".$row['unit']." Singapore ".$row['postal']."' oninput='rmclassnm(this)'>";
				echo '<label for="phone"><i style="background-image: url(phone.gif);background-repeat: no-repeat;padding-left: 20px;"></i> Contact Number</label>';
				echo "<input type='text' id='phone' name='phone' value='".$row['phone']."' oninput='rmclassnm(this)' onkeypress='return limitchar(event,this)' placeholder='Mobile Number (must be 8 digit)' maxlength='8'>";
			}
			?>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i style="background-image: url(visa.gif);background-repeat: no-repeat;padding-left: 35px;" style="color:navy;"></i>
              <i style="background-image: url(american.gif);background-repeat: no-repeat;padding-left: 35px;"></i>
              <i style="background-image: url(mastercard.gif);background-repeat: no-repeat;padding-left: 35px;"></i>
            </div>
			<?php
				echo '<label for="cardname">Name on Card</label>';
				echo "<input type='text' id='cardname' name='cardname' placeholder='Peter Lim' oninput='rmclassnm(this)' onkeypress='return limitalpha(event,this)' value='".$row['cardname']."'>";
				echo '<label for="cardnumber">Credit card number</label>';
				echo "<input type='text' id='cardnumber' name='cardnumber' placeholder='1111-2222-3333-4444' oninput='rmclassnm(this)' onkeyup='addHyphen(this)' onkeypress='return limitchar(event,this)' maxlength='19' value='".$row['cardnumber']."'> ";
			?>
            </div>
                
        
		<button type="button" id="savePasswordBtn" class="btn" onclick="saveProfile()">Place Order</button>
      </form>
    </div>
	
	<div id="bottompart">
	<footer>
		<small><i>Copyright &copy; 2022 TY & WY Food House
		</i></small>
	</footer>
	</div>
</div>
<script>
function minus(n) {
	var x = document.getElementsByClassName("subchart");
	var y = x[n].getElementsByClassName("minusBtn");
	var z = x[n].getElementsByTagName("input");
	if (z[0].value == 1){
		y[0].disabled = true;
	}else{
		y[0].disabled = false;
	}
}
function normalBtn(n) {
	var x = document.getElementsByClassName("subchart");
	var y = x[n].getElementsByClassName("minusBtn");
	y[0].disabled = false;
}
function saveProfile() {
	var valid = true;
	x = document.getElementsByClassName("profileForm");
	y = x[0].getElementsByTagName("input");
	for (i = 0; i < y.length; i++) {
		if (y[i].value.trim().length === 0) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 1 && !y[i].value.match(/^[A-Za-z0-9.-]+@([A-Za-z]+\.){1,3}[A-Za-z]{2,3}$/g)){
		y[i].className += " invalid";
		valid = false;
		}
		if (i == 3 && y[i].value.length < 8) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 5 && y[i].value.length < 19) {
		  y[i].className += " invalid";
		  valid = false;
		}
	}
	if (!valid){ return false;}
	else {
		document.getElementById("profileForm").submit();
	}
}
function rmclassnm(event) {
	event.className = "";
}
function limitalpha(e, t) {
    var key, keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);
    if (keychar.match(/[A-Za-z ]/g)) {
        return true;
    }
    if (key == null || key == 0 || key == 8 || key == 9 || key == 13 || key == 27) {
        return true;
    }
    return false;
}
function limitchar(e, t) {
    goods = "0123456789";
    var key, keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    goods = goods.toLowerCase();
    if (goods.indexOf(keychar) != -1) {
        goods = "0123456789";
        return true;
    }
    if (key == null || key == 0 || key == 8 || key == 9 || key == 13 || key == 27) {
        goods = "0123456789";
        return true;
    }
    return false;
}
function addHyphen (element) {
	let ele = document.getElementById(element.id);
	ele = ele.value.split('-').join('');    // Remove dash (-) if mistakenly entered.

	let finalVal = ele.match(/.{1,4}/g).join('-');
	document.getElementById(element.id).value = finalVal;
}

</script>
</body>
</html>