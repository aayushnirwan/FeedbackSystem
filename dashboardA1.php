<?php

	require 'connect.php';
	if(isset($_SESSION['name'])){
		if(empty($_SESSION['name']))
			header('Location: index.php');
	}else {
		header('Location: index.php');
	}

	if(isset($_COOKIE['message']) && !empty($_COOKIE['message'])) {
	    echo $_COOKIE['message'];
		setcookie("message", "", time() - (86400 * 30), "/");
	}

?>


<!DOCTYPE html>
<html>
<title><?php echo $_SESSION['name']; ?> - Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
a {
    text-decoration: none;
}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div>
 <div class="w3-bar w3-white w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button"><img src="assets/header.svg" style="width:100%; height: auto;"></img></a>
  <a href="LogOut.php" class="w3-bar-item w3-button w3-padding-large w3-right">Logout</a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px; margin-top: 20px; min-height: 75vh;">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?php echo $_SESSION['name']; ?></h4>
		 <p class="w3-center"><img src="assets/images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p id="password">
			 <i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme" onclick="update(this)"></i>
			 <span id="content">
				 <?php echo 'Change Password'; ?>
			 </span>
		 </p>
		 <p class="w3-center" style="display: none;">
			 <button class="w3-button w3-green" onclick="saveUpdation(this)">Save</button>
		 </p>
        </div>
      </div>
      <br>
      <!-- <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Give FeedBack</button>
          <div id="Demo1" class="w3-hide w3-container">
              <?php
    		        $result = $conn->query("SELECT * FROM `student` natural join `takes` WHERE `roll_no`='{$_SESSION['roll_no']}'");
    				if($result){
    					while($row = $result->fetch_assoc()) {
                            echo '<a href="feedback.php?cid='.$row['course_id'].'"><p class="w3-center">'.$row['course_id'].' - Course_Name</p></a>';
                        }
                    }
                ?>
          </div>
       </div>
      </div> -->

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <!-- <div class="w3-col m6">

      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Share your Blog</h6>
              <p contenteditable="true" class="w3-border w3-padding">Status: Feeling Blue</p>
              <button type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button>
            </div>
          </div>
        </div>
      </div>

</div> -->
    <!-- Right Column -->

    <div class="w3-col m8 w3-right">
      <div class="w3-card w3-round w3-white w3-left-align">
        <div>
          <header class="w3-display-container w3-grayscale-min" id="home" style="min-height:74%;">
              <div class="w3-row">

                  <div class="w3-card-4 w3-left-align">
                      <button onclick="myFunction('Add User')" class="w3-button w3-blue w3-block w3-left-align">
                          Add User </button>
                      <div id="Add User" class="w3-hide">
                        <form class="w3-container" method="post" action="admin/processadduser.php">
                          <div class="w3-section">
                            <label><b>Username</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="s_usrname" required>
                            <label><b>Password</b></label>
                            <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="s_psw" required>
														<label><b>Name</b></label>
														<input class="w3-input w3-border" type="text" placeholder="Enter Name" name="s_name" required>
														<label><b>Email Id</b></label>
														<input class="w3-input w3-border" type="text" placeholder="Enter Email ID" name="s_email" required>
														<label><b>Mobile No</b></label>
														<input class="w3-input w3-border" type="text" placeholder="Enter Mobile No" name="s_mobile" required>
														<label><b>Branch</b></label>
														<input class="w3-input w3-border" type="text" placeholder="Enter Branch" name="s_branch" required>
                            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add User</button>
                          </div>
                        </form>
                    </div>

                      <button onclick="myFunction('Add Instructor')" class="w3-button w3-blue w3-block w3-left-align">
                          Add Instructor    </button>
                      <div id="Add Instructor" class="w3-hide">
                        <form class="w3-container" method="post" action="admin/processaddinstructor.php">
                          <div class="w3-section">
                            <label><b>Instructor ID</b></label>
                            <input class="w3-input w3-border" type="text" placeholder="Enter Instructor ID" name="i_id" required>
                            <label><b>Password</b></label>
                            <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="i_psw" required>
														<label><b>Name</b></label>
														<input class="w3-input w3-border" type="text" placeholder="Enter Name" name="i_name" required>
														<label><b>Department</b></label>
														<input class="w3-input w3-border" type="text" placeholder="Enter Department" name="i_dept" required>
														<label><b>Email Id</b></label>
														<input class="w3-input w3-border" type="text" placeholder="Enter Email ID" name="i_email" required>
														<label><b>Mobile No</b></label>
														<input class="w3-input w3-border" type="text" placeholder="Enter Mobile No" name="i_mobile" required>
                            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add Instructor</button>
                          </div>
                        </form>
                    </div>
                    <button onclick="myFunction('Add Course')" class="w3-button w3-blue w3-block w3-left-align">
                        Add Course</button>
                    <div id="Add Course" class="w3-hide">
                      <form class="w3-container" method="post" action="admin/processaddcourse.php">
                        <div class="w3-section">
                          <label><b>Course Id</b></label>
                          <input class="w3-input w3-border" type="text" placeholder="Enter course_id" name="cid" required>
                          <label><b>Title</b></label>
                          <input class="w3-input w3-border" type="text" placeholder="Enter Title" name="title" required>
                          <label><b>Department</b></label>
                          <input class="w3-input w3-border" type="text" placeholder="Enter Department" name="dept" required>
                          <label><b>Credit</b></label>
                          <input class="w3-input w3-border" type="text" placeholder="Enter Credit" name="credit" required>
                          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add Course</button>
                        </div>
                      </form>
                  </div>
                  </div>
									<button onclick="myFunction('Remove User')" class="w3-button w3-blue w3-block w3-left-align">
											Remove User </button>
									<div id="Remove User" class="w3-hide">
										<form class="w3-container" method="post" action="admin/processremoveuser.php">
											<div class="w3-section">
												<label><b>Username</b></label>
												<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="s_usrname" required>
												<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Remove User</button>
											</div>
										</form>
								</div>

									<button onclick="myFunction('Remove Instructor')" class="w3-button w3-blue w3-block w3-left-align">
											Remove Instructor    </button>
									<div id="Remove Instructor" class="w3-hide">
										<form class="w3-container" method="post" action="admin/processremoveinstructor.php">
											<div class="w3-section">
												<label><b>Instructor ID</b></label>
												<input class="w3-input w3-border" type="text" placeholder="Enter Instructor ID" name="i_id" required>
												<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Remove Instructor</button>
											</div>
										</form>
								</div>
								<button onclick="myFunction('Remove Course')" class="w3-button w3-blue w3-block w3-left-align">
										Remove Course</button>
								<div id="Remove Course" class="w3-hide">
									<form class="w3-container" method="post" action="admin/processremovecourse.php">
										<div class="w3-section">
											<label><b>Course Id</b></label>
											<input class="w3-input w3-border" type="text" placeholder="Enter course_id" name="cid" required>
											<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Remove Course</button>
										</div>
									</form>
							</div>
							</div>
							<button onclick="myFunction('Update User')" class="w3-button w3-blue w3-block w3-left-align">
									Update User </button>
							<div id="Update User" class="w3-hide">
								<form class="w3-container" method="post" action="admin/processupdateuser.php">
									<div class="w3-section">
										<label><b>Username</b></label>
										<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="s_usrname" required>
										<label><b>Password</b></label>
										<input class="w3-input w3-border" type="password" placeholder="Enter Password" name="s_psw" required>
										<label><b>Name</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Name" name="s_name" required>
										<label><b>Email Id</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Email ID" name="s_email" required>
										<label><b>Mobile No</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Mobile No" name="s_mobile" required>
										<label><b>Branch</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Branch" name="s_branch" required>
										<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Update User</button>
									</div>
								</form>
						</div>

							<button onclick="myFunction('Update Instructor')" class="w3-button w3-blue w3-block w3-left-align">
									Update Instructor    </button>
							<div id="Update Instructor" class="w3-hide">
								<form class="w3-container" method="post" action="admin/processupdateinstructor.php">
									<div class="w3-section">
										<label><b>Instructor ID</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Instructor ID" name="i_id" required>
										<label><b>Password</b></label>
										<input class="w3-input w3-border" type="password" placeholder="Enter Password" name="i_psw" required>
										<label><b>Name</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Name" name="i_name" required>
										<label><b>Department</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Department" name="i_dept" required>
										<label><b>Email Id</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Email ID" name="i_email" required>
										<label><b>Mobile No</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Mobile No" name="i_mobile" required>
										<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Update Instructor</button>
									</div>
								</form>
						</div>
						<button onclick="myFunction('Update Course')" class="w3-button w3-blue w3-block w3-left-align">
								Update Course</button>
						<div id="Update Course" class="w3-hide">
							<form class="w3-container" method="post" action="admin/processupdatecourse.php">
								<div class="w3-section">
									<label><b>Course Id</b></label>
									<input class="w3-input w3-border" type="text" placeholder="Enter course_id" name="cid" required>
									<label><b>Title</b></label>
									<input class="w3-input w3-border" type="text" placeholder="Enter Title" name="title" required>
									<label><b>Department</b></label>
									<input class="w3-input w3-border" type="text" placeholder="Enter Department" name="dept" required>
									<label><b>Credit</b></label>
									<input class="w3-input w3-border" type="text" placeholder="Enter Credit" name="credit" required>
									<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Update Course</button>
								</div>
							</form>
					</div>
					</div>
        </div>

          <!-- <p>Upcoming Events:</p>
          <img src="#" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button    class="w3-button w3-block w3-theme-l4">Info</button></p> -->
        </div>
      </div>
      <br>
    <!-- End Right Column -->
    </div>

  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>
<br>


<footer class="w3-container w3-theme-d5 ">
  <p class="w3-center w3-padding-16">Powered by <a href="https://www.iiitg.ac.in" target="_blank">IIITG</a></p>
</footer>

<script>
var originalContent = "";
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

//
function update(content) {
	var saveButton = content.parentElement.parentElement.childNodes[9];
	if(saveButton.style.display == "block") {
		content.parentElement.parentElement.innerHTML = originalContent;
		saveButton.style.display = "none";
	} else {
		originalContent = content.parentElement.parentElement.innerHTML;
		ww = "<input type=\"password\" name=\"updated_passowrd\" class=\"w3-input\" style=\"display: inline; width:auto;\" placeholder=\"Type New Password\">";
		content.parentElement.parentElement.childNodes[7].childNodes[3].innerHTML = ww;
		saveButton.style.display = "block";
	}

}
function saveUpdation(content) {
		var parent = content.parentElement.parentElement;
		console.log(parent.childNodes[7].childNodes[3].childNodes[0].value);
		var password = parent.childNodes[7].childNodes[3].childNodes[0].value;
		var url = "admin/updateAdmin.php";
		// console.log('email='+email+'&mobile='+mobile);
		var xhr = new XMLHttpRequest();
		xhr.onload = function(){
			var res = xhr.responseText;
			if(res == "Updated") {
				alert (res);
				document.getElementById('profile').innerHTML = originalContent;
				document.getElementById('profile').childNodes[7].childNodes[3].innerHTML = email;
				document.getElementById('profile').childNodes[9].childNodes[3].innerHTML = mobile;
			} else {
				document.getElementById('profile').innerHTML = originalContent;
			}
		}
  		xhr.onerror = function(){
			alert (xhr.responseText);
			document.getElementById('profile').innerHTML = originalContent;
		}
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('email='+email+'&mobile='+mobile);
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
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
