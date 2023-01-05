<?php
include "dbconnect.php";
session_start();

if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
	$query = 'select * from tbluser '
           ."where userid='$userid' ";
    $result = $dbcnx->query($query);
	$row = $result->fetch_assoc();
}

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
<title>Profile</title>
<link rel="icon" type="image/gif" href="titleicon.gif" />
<meta charset="utf-8">
<link rel="stylesheet" href="fundamentalStyle.css">
<link rel="stylesheet" href="topNavigationBar.css">
<style>
h2 { text-align: center;}

/*Table, Fieldset, input box, button css*/
fieldset { width: 500px;
		   border: 1px solid #666;
		   padding: 30px;
		   border-radius: 8px;
}

legend { font-family: "Open Sans",Arial,sans-serif;
	     font-size: 15px;
		 font-weight: bold;
}

label { float: left;
		clear: left;
		display: block;
		width: 100px;
		text-align: right;
		padding-right: 10px;
		font-size: 12px;		
}
	
table { margin: 40px auto 10px auto;
}

tr button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  border-radius: 8px;
  padding: 12px 12px;
  font-size: 14px;
  cursor: pointer;
  margin-top: 10px;
}

input[type=text], input[type=password] {
  width: 70%;
  padding: 8px 20px;
  margin: 0px 0px 5px;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
input#dd,#mm,#yyyy {
  width: 20%;
  padding: 8px 20px;
  margin: 0px 0px 5px;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

input.invalid {
  background-color: #ffdddd;
}
button:hover {
  opacity: 0.5;
}
.order a {
	text-decoration: none;
}

.icon-container {
  margin-bottom: 20px;
  font-size: 24px;
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
		<h2>MY ACCOUNT</h2>
		<div class="content"> 
		
		<form id="profileForm" class="profileForm" action="updateProfile.php" method="post">
		<table>
			
			<tr>
			    <td><fieldset>
				<?php
				    echo '<legend>MY PROFILE</legend>';
					echo "<label>First Name: </label><input type='text' name='fname' id='fname' value='".$row['firstname']."' oninput='rmclassnm(this)' onkeypress='return limitalpha(event,this)' placeholder='First Name'><br><br>";
					echo "<label>Last Name: </label><input type='text' name='lname' id='lname' value='".$row['lastname']."' oninput='rmclassnm(this)' onkeypress='return limitalpha(event,this)' placeholder='Last Name'><br><br>";
					echo "<label>E-mail: </label><input type='text' name='email' id='email' value='".$row['email']."' oninput='rmclassnm(this)' placeholder='E-mail. e.g abc123@gmail.com'><br><br>";
					echo "<label>Mobile Number: </label><input type='text' name='mobile' id='mobile' value='".$row['phone']."' oninput='rmclassnm(this)' onkeypress='return limitchar(event,this)' placeholder='Mobile Number (must be 8 digit)' maxlength='8'><br><br>";
					echo "<label>Primary Address: </label>blk <input type='text' name='block' id='block' value='".$row['block']."' oninput='rmclassnm(this)' placeholder='Block' style='width:15%;' maxlength='3'> "
					    ."<input type='text' name='street' id='street' value='".$row['street']."' oninput='rmclassnm(this)' placeholder='Street'  style='width:49%;'> "
						."<input type='text' name='floor' id='floor' value='".$row['floor']."' oninput='rmclassnm(this)' placeholder='Floor'  style='width:15%;margin-left:22%;' maxlength='3'> -  "
						."<input type='text' name='unit' id='unit' value='".$row['unit']."' oninput='rmclassnm(this)' placeholder='Unit'  style='width:15%;' maxlength='3'> singapore  "
						."<input type='text' name='postal' id='postal' value='".$row['postal']."' oninput='rmclassnm(this)' placeholder='Postal'  style='width:18%;' maxlength='6'><br><br> ";
					echo "<label>Birthday: </label><input type='text' name='dd' id='dd' class='birthday' value='".$row['birthday']."' oninput='rmclassnm(this)' onkeypress='return limitchar(event,this)' placeholder='day' maxlength='2'> "
					    ."<input type='text' name='mm' id='mm' class='birthday' value='".$row['birthmonth']."' oninput='rmclassnm(this)' onkeypress='return limitchar(event,this)' placeholder='month' maxlength='2'> "
					    ."<input type='text' name='yyyy' id='yyyy' class='birthday' value='".$row['birthyear']."' oninput='rmclassnm(this)' onkeypress='return limitchar(event,this)' placeholder='year' maxlength='4'><br><br> ";
				?>
				</td></fieldset>
			</tr>
			
			<tr>
			    <td align="right"><button type="button" id="saveProfileBtn" onclick="saveProfile()">save</button></td>
			</tr>	
		</table>
		</form>
		
		
		<form id="passwordForm" class="passwordForm" action="updatePassword.php" method="post">
		<table>
			
			<tr>
			    <td><fieldset>
				    <legend>PASSWORD</legend>
					<label>Current password: </label><input type="password" name="cpassword" id="cpassword" oninput="rmclassnm(this)" placeholder="Current password"><br><br>
					<label>New password: </label><input type="password" name="npassword" id="npassword" oninput="rmclassnm(this)" placeholder="New password. e.g Ab123!"><br><br>
			    </td></fieldset>
			</tr>
			<tr>
			    <td align="right"><button type="button" id="savePasswordBtn" onclick="savePassword()">save</button></td>
			</tr>			
		</table>
		</form>
		
		<?php
			$query2 = 'select * from tbluser '
					."where userid='$userid' ";
			$result2 = $dbcnx->query($query2);
			$row2 = $result2->fetch_assoc();
			$row['cardnumber'] = preg_replace("/(?<=.{4}).(?=.{4})/", "*", $row['cardnumber']);
			if (is_null($row2['cardnumber'])) {
				echo '<form id="paymentForm" class="paymentForm" action="updatePayment.php?mode=update" method="post">';
				echo '<table>';
				echo '<tr>';
				echo '<td><fieldset>';
				echo '<legend>PAYMENT METHOD</legend>';
				echo '<label>Accepted Cards </label>';
				echo '<div class="icon-container">';
				echo '<i style="background-image: url(visa.gif);background-repeat: no-repeat;padding-left: 35px;" style="color:navy;"></i>';
				echo '<i style="background-image: url(american.gif);background-repeat: no-repeat;padding-left: 35px;"></i>';
				echo '<i style="background-image: url(mastercard.gif);background-repeat: no-repeat;padding-left: 35px;"></i>';
				echo '</div>';
				echo '<label>Name on Card: </label><input type="text" name="cname" id="cname" oninput="rmclassnm(this)" placeholder="Name" onkeypress="return limitalpha(event,this)"><br><br>';
				echo '<label>Credit Card Number: </label><input type="text" name="cnumber" id="cnumber" oninput="rmclassnm(this)" placeholder="1111-2222-3333-4444" onkeyup="addHyphen(this)" onkeypress="return limitchar(event,this)" maxlength="19"><br><br>';
				echo '</td></fieldset>';
				echo '</tr>';
				echo '<tr>';
				echo '<td align="right"><button type="button" id="savePaymentBtn" onclick="savePayment()">save</button></td>';
			}else {
				echo '<form id="paymentForm" class="paymentForm" action="updatePayment.php?mode=delete" method="post">';
				echo '<table>';
				echo '<tr>';
				echo '<td><fieldset>';
				echo '<legend>PAYMENT METHOD</legend>';
				echo '<label>Accepted Cards </label>';
				echo '<div class="icon-container">';
				echo '<i style="background-image: url(visa.gif);background-repeat: no-repeat;padding-left: 35px;" style="color:navy;"></i>';
				echo '<i style="background-image: url(american.gif);background-repeat: no-repeat;padding-left: 35px;"></i>';
				echo '<i style="background-image: url(mastercard.gif);background-repeat: no-repeat;padding-left: 35px;"></i>';
				echo '</div>';
				echo "<label>Name on Card: </label><input type='text' name='cname' id='cname' oninput='rmclassnm(this)' placeholder='Name' value='".$row['cardname']."' disabled><br><br>";
				echo "<label>Credit Card Number: </label><input type='text' name='cnumber' id='cnumber' oninput='rmclassnm(this)' placeholder='1111-2222-3333-4444' value='".$row['cardnumber']."' disabled><br><br>";
				echo '</td></fieldset>';
				echo '</tr>';
				echo '<tr>';
				echo '<td align="right"><button type="button" id="savePaymentBtn" onclick="savePayment()">remove card</button></td>';
			}
		?>
			</tr>
		</table>
		</form>
		
		<table class="order">
			<tr>
				<td><fieldset>
					<legend>MY ORDER</legend>
					<label><a href="trackOrder.php">View Past Orders</a></label>
				</td></fieldset>
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
</div>
<script>
function saveProfile() {
	const d = new Date();
    let year = Number(d.getFullYear());
	let month = Number(d.getMonth()+1);
	let day = Number(d.getDate());
	var valid = true;
	x = document.getElementsByClassName("profileForm");
	y = x[0].getElementsByTagName("input");
	for (i = 0; i < y.length; i++) {
		if (y[i].value.trim().length === 0) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 2 && !y[i].value.match(/^[A-Za-z0-9.-]+@([A-Za-z]+\.){1,3}[A-Za-z]{2,3}$/g)){
		y[i].className += " invalid";
		valid = false;
		}
		if (i == 3 && y[i].value.length < 8) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 8 && y[i].value.length < 6) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 9 && ((Number(y[i].value) > 31 || Number(y[i].value) < 1) || (Number(y[10].value) == month && Number(y[i].value) > day && Number(y[11].value) == year))) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 10 && (Number(y[i].value) > 12 || Number(y[i].value) < 1 || (Number(y[10].value) > month && Number(y[11].value) == year))) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 11 && (Number(y[i].value) > year || Number(y[i].value) < 1920)) {
		  y[i].className += " invalid";
		  valid = false;
		}
	}
	if (!valid){ return false;}
	else {
		document.getElementById("profileForm").submit();
	}	
}
function savePassword() {
	var valid = true;
	x = document.getElementsByClassName("passwordForm");
	y = x[0].getElementsByTagName("input");
	for (i = 0; i < y.length; i++) {
		if (y[i].value.trim().length === 0) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 1 && !y[i].value.match(/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,12}$/g)) {
		  y[i].className += " invalid";
		  valid = false;
		}
	}
	if (!valid){ return false;}
	else {
		document.getElementById("passwordForm").submit();
	}	
}
function savePayment() {
	var valid = true;
	x = document.getElementsByClassName("paymentForm");
	y = x[0].getElementsByTagName("input");
	for (i = 0; i < y.length; i++) {
		if (y[i].value.trim().length === 0) {
		  y[i].className += " invalid";
		  valid = false;
		}
		if (i == 1 && y[i].value.length < 19) {
		  y[i].className += " invalid";
		  valid = false;
		}
	}
	if (!valid){ return false;}
	else {
		document.getElementById("paymentForm").submit();
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