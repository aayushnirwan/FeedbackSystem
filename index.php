<?php
    require 'connect.php';
    if(isset($_SESSION['roll_no'])){
		if(!empty($_SESSION['roll_no']))
			header('Location: dashboardS.php');
	}
    if(isset($_SESSION['i_id'])){
		if(!empty($_SESSION['i_id']))
			header('Location: dashboardI.php');
	}
    //
	if(isset($_COOKIE['message']) && !empty($_COOKIE['message'])) {
	    echo $_COOKIE['message'];
		setcookie("message", "", time() - (86400 * 30), "/");
	}
 ?>
<!DOCTYPE html>
<html>
<title>FeedBack System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
body, html {
    height: 100%;
    line-height: 1.8;
}

.w3-bar .w3-button {
    padding: 16px;
}
a {
    text-decoration: none;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="#home" class="w3-bar-item w3-button w3-wide"><img src="assets/header.svg" style="width:100%; height: auto;"></img></a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">ABOUT</a>
      <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
  <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
</nav>

<!-- Header with full-height image -->
<header class="w3-display-container w3-grayscale-min" id="home" style="padding-bottom:10px; min-height:74%;">
    <br>
    <div class="w3-row">

        <div id="loginForm" class="w3-card-4 w3-col s12 m4 l3 w3-right">
            <button onclick="myFunction('loginAdmin')" class="w3-button w3-blue w3-block w3-left-align">
                Login as Admin </button>
            <div id="loginAdmin" class="w3-hide">
              <form class="w3-container" method="post" action="processAdmin.php">
                <div class="w3-section">
                  <label><b>Username</b></label>
                  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="admin_usrname" required>
                  <label><b>Password</b></label>
                  <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="admin_psw" required>
                  <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login as Admin</button>
                </div>
              </form>
          </div>

            <button onclick="myFunction('loginStudent')" class="w3-button w3-blue w3-block w3-left-align">
                Login as Student    </button>
            <div id="loginStudent" class="w3-hide">
              <form class="w3-container" method="post" action="processStudent.php">
                <div class="w3-section">
                  <label><b>Username</b></label>
                  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="student_usrname" required>
                  <label><b>Password</b></label>
                  <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="student_psw" required>
                  <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login as Student</button>
                </div>
              </form>
          </div>
          <button onclick="myFunction('loginInstructor')" class="w3-button w3-blue w3-block w3-left-align">
              Login as Instructor</button>
          <div id="loginInstructor" class="w3-hide">
            <form class="w3-container" method="post" action="processInstructor.php">
              <div class="w3-section">
                <label><b>Username</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="instructor_usrname" required>
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="instructor_psw" required>
                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login as Instructor</button>
              </div>
            </form>
        </div>
        </div>


        <div class="w3-col s12 m8 l9" style="padding:15px;">
            <div class="w3-content w3-display-container" style="height: 250px;">
              <img class="mySlides" src="assets/images/iiitg4.jpg" style="width:100%;">

              <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
              <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
            </div>
            <br><br>
            <h5 class="cyan-text text-darken-4" style="margin:0;margin-left:9px;">&#9776; News From Campus</h5>
            <div class="w3-card w3-col s6 m4 l3" style="margin-left: 10px;">
                <a href="http://iiitg.ac.in/yuvaan2k18/index.php">
                <img src="assets/images/banner.jpg" width="100%"></img>
                <p style="padding-left:10px;">IIITG: Yuvaan 2k18</p>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">


  <p>Powered by <a href="http://iiitg.ac.in/" title="IIITG" target="_blank" class="w3-hover-text-green">IIITG</a></p>
</footer>

<!-- Add Google Maps -->
<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }

function myFunction(id) {
    var all = document.getElementById('loginForm');
    all.childNodes[3].className = all.childNodes[3].className.replace(" w3-show", "");
    all.childNodes[7].className = all.childNodes[7].className.replace(" w3-show", "");
    all.childNodes[11].className = all.childNodes[11].className.replace(" w3-show", "");
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", " w3-hide");
    }
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}


// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>
</body>
</html>
