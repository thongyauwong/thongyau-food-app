<?php
include "dbconnect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login/Sign Up</title>
<link rel="icon" type="image/gif" href="titleicon.gif" />
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="LoginSignupCss.css">
<link rel="stylesheet" href="fundamentalStyle.css">
<link rel="stylesheet" href="topNavigationBar.css">
<style>
.div1{width:500px;height:250px;background-color:#ffffff;padding:40px 10px 10px 10px;margin:20px auto;border:3px ridge #000000;}

.button {
	padding: 15px 32px;
	text-align: center;
	text-decoration: bold;
	font-size: 16px;
	margin: 4px 0px;
	cursor: pointer;
	width:420px;
	height:40px;
}
.login {
	background-color:#04AA6D;	
	color: #ffffff;
	border: none;
}

.signup {
	background-color:#ffffff;	
	color: #000000;
	border: 1px
	ridge #000000
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
	   
	</div>
	
	<div id="rightcolumn" style="text-align: center">
	<br><br>
		<div class="div1"> 
		
		<p><strong>Welcome!!</strong><br>Sign up or log in to continue</p>
				<button class="button login" onclick="document.getElementById('id02').style.display='block'"><strong>Log in</strong></button>			
			<br>			
				<button class="button signup" onclick="document.getElementById('id01').style.display='block'"><strong>Sign up</strong></button>
		</div>	
	</div>
	<div id="bottompart">
	<footer>
		<small><i>Copyright &copy; 2022 TY & WY Food House
		</i></small>
	</footer>
	</div>
</div>

<div id="id01" class="modal">
  
  <form id="regForm" class="modal-content animate" action="register.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="avatar.PNG" alt="Avatar" class="avatar">
    </div>
	
    <div class="container">Name:
      <p><input type="text" placeholder="First name..." 		oninput="this.className = ''" name="fname" onkeypress="return limitalpha(event,this)"></p>
      <p><input type="text" placeholder="Last name..." oninput="this.className = ''" name="lname" onkeypress="return limitalpha(event,this)"></p>
    </div>
    
    <div class="container">Contact Info:
      <p><input type="text" placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
      <p><input type="text" placeholder="Phone..." oninput="this.className = ''" name="phone" onkeypress="return limitchar(event,this)" maxlength="8"></p>
	  <p><input type="text" placeholder="Block" oninput="this.className = ''" name="block" style="width: 20%;" onkeypress="return limitchar(event,this)" maxlength="3">
		 <input type="text" placeholder="Street" oninput="this.className = ''" name="street" style="width: 33%;" onkeypress="return limitstreet(event,this)">
		 <input type="text" placeholder="Floor" oninput="this.className = ''" name="floor" style="width: 20%;" onkeypress="return limitchar(event,this)" maxlength="3"> -  
		 <input type="text" placeholder="Unit" oninput="this.className = ''" name="unit" style="width: 20%;" onkeypress="return limitchar(event,this)" maxlength="3"> SINGAPORE 
		 <input type="text" placeholder="Postal" oninput="this.className = ''" name="postal" style="width: 23%;" maxlength="6" onkeypress="return limitchar(event,this)"></p>
	</div>
    
    <div class="container">Birthday:
      <p><input type="text" placeholder="dd" oninput="this.className = ''" name="dd" onkeypress="return limitchar(event,this)" maxlength="2"></p>
      <p><input type="text" placeholder="mm" oninput="this.className = ''" name="nn" onkeypress="return limitchar(event,this)" maxlength="2"></p>
      <p><input type="text" placeholder="yyyy" oninput="this.className = ''" name="yyyy" onkeypress="return limitchar(event,this)" maxlength="4"></p>
    </div>
    
    <div class="container">
      <label for="uname">Username:</label><br><br>
      <input type="text" placeholder="Enter Username" oninput="this.className = ''" id="uname" name="uname" required onkeypress="return limitusrname(event,this)"><br><br>
	  <div id="messageUser">
		<h5>User must contain the following:</h5>
		<p id="usrlength" class="invalid">Characters length between <b>8 to 12</b> and contains alphanumeric characters only e.g.abc123</p>
	  </div>
	  
      <label for="psw">Password:</label><br><br>
      <input type="password" placeholder="Enter Password" oninput="this.className = ''" id="psw" name="psw" required><br><br>
	  <input type="checkbox" id="shwhidepwd1" onclick="showPwd()">Show Password<br><br><br>
      
      <div id="message">
        <h5>Password must contain the following:</h5>
        <p id="letter" class="invalid">A <b>lowercase</b> letter e.g: a,b,c</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b>    letter e.g: A,B,C</p>
        <p id="number" class="invalid">A <b>number</b> e.g: 1,2,3</p>
        <p id="spchar" class="invalid">A <b>special character</b> e.g: @#$%</p>
        <p id="length" class="invalid">Characters length between <b>8 to 12</b></p>
   	  </div>  
      
      <label for="psw2">Re-enter Password:</label><br><br>
      <input type="password" placeholder="Re-enter Password" oninput="this.className = ''" id="psw2" name="psw2" required><br><br>      
    </div>
    
    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
    
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
  </div>
    
  </form>
</div>

<div id="id02" class="modal">
	<form id="logForm" class="modal-content animate" action="login.php" method="post">
		<div class="imgcontainer">
		  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
		  <img src="avatar.PNG" alt="Avatar" class="avatar">
		</div>
		
		<div class="container2">
		  <label for="userid">Username:</label><br><br>
		  <input type="text" placeholder="Enter Username" oninput="this.className = ''" name="userid" required><br><br>
		  
		  <label for="passwrd">Password:</label><br><br>
		  <input type="password" placeholder="Enter Password" oninput="this.className = ''" id="passwrd" name="passwrd" required><br><br>
		  <input type="checkbox" id="shwhidepwd" onclick="showPwd()">Show Password<br><br><br>
		</div>
		
		<div style="overflow:auto;">
		  <div style="float:right;">
			<button type="button" id="loginBtn" onclick="login()">Login</button>
		  </div>
		</div>
	</form>
</div>
<script src="LoginSignupValidate.js"></script>
</body>
</html>

				