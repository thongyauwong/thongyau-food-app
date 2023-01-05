// Get the modal
var modal = document.getElementById('id01');
var myInputUser = document.getElementById("uname");
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var spchar = document.getElementById("spchar");
var usrlength = document.getElementById("usrlength");


function showPwd() {
  var x = document.getElementById("psw");
  var y = document.getElementById("psw2");
  var z = document.getElementById("passwrd");
  var id01 = document.getElementById("id01");
  var id02 = document.getElementById("id02");
  if (window.getComputedStyle(id01).display === "block"){
	  if (x.type === "password" && y.type === "password") {
		x.type = "text";
		y.type = "text";
	  } else {
		x.type = "password";
		y.type = "password";
	  }
  }
  if (window.getComputedStyle(id02).display === "block"){
	  if (z.type === "password") {
		z.type = "text";
	  } else {
		z.type = "password";
	  }
  }
}  

myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

myInputUser.onfocus = function() {
  document.getElementById("messageUser").style.display = "block";
}
myInputUser.onblur = function() {
  document.getElementById("messageUser").style.display = "none";
}

myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8 && myInput.value.length <= 12) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
  
  // Validate special character
  var spchars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/g;
  if(myInput.value.match(spchars)) {  
    spchar.classList.remove("invalid");
    spchar.classList.add("valid");
  } else {
    spchar.classList.remove("valid");
    spchar.classList.add("invalid");
  }
}

myInputUser.onkeyup = function() {
  if(myInputUser.value.length >= 8 && myInputUser.value.length <= 12) {
	usrlength.classList.remove("invalid");
	usrlength.classList.add("valid");
  } else {
	usrlength.classList.remove("valid");
	usrlength.classList.add("invalid");
  }
}

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("container");
  var y = document.getElementsByTagName("span");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";	
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  let toggleButton = document.getElementById("shwhidepwd1");
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("container");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  const d = new Date();
  let year = Number(d.getFullYear());
  let month = Number(d.getMonth()+1);
  let day = Number(d.getDate());
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("container");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value.trim().length === 0) {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }	
    if (currentTab == 1 && i == 0 && !y[i].value.match(/^[A-Za-z0-9.-]+@([A-Za-z]+\.){1,3}[A-Za-z]{2,3}$/g)){
      y[i].className += " invalid";
      valid = false;
    }
	if (currentTab == 1 && i == 1 && y[i].value.length < 8) {
      y[i].className += " invalid";
      valid = false;
    }
	if (currentTab == 1 && i == 6 && y[i].value.length < 6) {
      y[i].className += " invalid";
      valid = false;
    }
    if (currentTab == 2 && i == 0 && ((Number(y[1].value) == month && Number(y[0].value) > day && Number(y[2].value) == year) || (Number(y[0].value) > 31 || Number(y[0].value) < 1))) {
      y[i].className += " invalid";
      valid = false;
    }
    if (currentTab == 2 && i == 1 && (Number(y[i].value) > 12 || Number(y[i].value) < 1 || (Number(y[1].value) > month && Number(y[2].value) == year))) {
      y[i].className += " invalid";
      valid = false;
    }
    if (currentTab == 2 && i == 2 && (Number(y[i].value) > year || Number(y[i].value) < 1920)) {
      y[i].className += " invalid";
      valid = false;
    }
	if (currentTab == 3 && i == 0 && (y[i].value.length < 8 || y[i].value.length > 12)) {
	  y[i].className += " invalid";
      valid = false;
	}
    if (currentTab == 3 && i == 1 && !y[i].value.match(/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,12}$/g)) {
      y[i].className += " invalid";
      valid = false;
    }
    if (currentTab == 3 && i == 3 && (y[i].value != y[i-2].value)) {
      y[i].className += " invalid";
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

function login() {
	var valid = true;
	let toggleButton = document.getElementById("shwhidepwd");
	var z = document.getElementById("passwrd");
	x = document.getElementsByClassName("container2");
	y = x[0].getElementsByTagName("input");
	for (i = 0; i < y.length-1; i++) {
    // If a field is empty...
		if (y[i].value.trim().length === 0) {
		  // add an "invalid" class to the field:
		  y[i].className += " invalid";
		  // and set the current valid status to false
		  valid = false;
		}	
	}
	if (!valid){ return false;}
	else {
		document.getElementById("logForm").submit();
	}
}

function limitchar(e, t) {
    goods = "0123456789";
	var x = document.getElementsByClassName("container");
	var y = x[1].getElementsByTagName("input");
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
		y[1].value = y[1].value.replace(/^0+/, '');
        return true;
    }
    if (key == null || key == 0 || key == 8 || key == 9 || key == 13 || key == 27) {
        goods = "0123456789";
        return true;
    }
    return false;
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

function limitusrname(e, t) {
    var key, keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);
    if (keychar.match(/[A-Za-z0-9]/g)) {
        return true;
    }
    if (key == null || key == 0 || key == 8 || key == 9 || key == 13 || key == 27) {
        return true;
    }
    return false;
}

function limitstreet(e, t) {
    var key, keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);
    if (keychar.match(/[ A-Za-z0-9]/g)) {
        return true;
    }
    if (key == null || key == 0 || key == 8 || key == 9 || key == 13 || key == 27) {
        return true;
    }
    return false;
}