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
    <div class="w3-col m2">
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

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7" style="margin-left:50px;margin-right:0px; ">
      <!-- <div class="w3-row-padding">
        <div class="w3-col m12"> -->
			<button class=" w3-btn w3-purple">Student's List </button>
			<button class=" w3-btn w3-purple w3-right" onclick="myFunction('AddStudent')">Add Student</button>
			<table id="student" class="w3-table-all w3-card-4 w3-hoverable ">
				<tr>
			      <th>Roll Number</th>
			      <th>Full Name</th>
			      <th>Email</th>
				  <th>Mobile Number</th>
				  <th>Branch</th>
				  <th>Delete</th>
			    </tr>
				<?php
					$result = $conn->query("SELECT * FROM `student`");
					while($row = $result->fetch_assoc()) {
						$rollno = $row['roll_no'];
						$name = $row['name'];
						$email = $row['email_id'];
						$mobile = $row['mobile_no'];
						$branch = $row['branch'];
				 ?>
					    <tr onclick="getData(this, 'Student'); myFunction('updateStudent')">
					      <td><?php echo $rollno; ?></td>
						  <td><?php echo $name; ?></td>
						  <td><?php echo $email; ?></td>
						  <td><?php echo $mobile; ?></td>
						  <td><?php echo $branch; ?></td>
						  <td class="w3-center">
							  <button class="w3-button w3-green" onclick="myFunction('RemoveStudent');">x</button>
						  </td>
					    </tr>
				<?php
					}
				 ?>
			  </table>
			  <hr>
			  <button class=" w3-btn w3-purple">Instructor's List </button>
			  <button class=" w3-btn w3-purple w3-right" onclick="myFunction('AddInstructor')">Add Instructor</button>
			  <table id="instructor" class="w3-table-all w3-card-4 w3-hoverable">
  				<tr>
  			      <th>I_ID</th>
  			      <th>Full Name</th>
  			      <th>Email</th>
  				  <th>Mobile Number</th>
				  <th>Department</th>
				  <th>Delete</th>
  			    </tr>
  				<?php
  					$result = $conn->query("SELECT * FROM `instructor`");
  					while($row = $result->fetch_assoc()) {
  						$i_id = $row['i_id'];
  						$name = $row['name'];
  						$email = $row['email_id'];
  						$mobile = $row['mobile_no'];
  						$department = $row['department'];
  				 ?>
  					    <tr onclick="getData(this, 'Instructor'); myFunction('UpdateInstructor')">
  					      <td><?php echo $i_id; ?></td>
  						  <td><?php echo $name; ?></td>
  						  <td><?php echo $email; ?></td>
  						  <td><?php echo $mobile; ?></td>
  						  <td><?php echo $department; ?></td>
						  <td class="w3-center">
							  <button class="w3-button w3-green" onclick="myFunction('RemoveInstructor');">x</button>
						  </td>
  					    </tr>
  				<?php
  					}
  				 ?>
  			  </table>
			  <hr>
			  <button class=" w3-btn w3-purple">Course's List </button>
			  <button class=" w3-btn w3-purple w3-right" onclick="myFunction('AddCourse')">Add Course</button>
			  <table id="course" class="w3-table-all w3-card-4 w3-hoverable">
  				<tr>
  			      <th>Course ID</th>
  			      <th>Course Name</th>
				  <th>Department</th>
  			      <th>Credits</th>
				  <th>Delete</th>
  			    </tr>
  				<?php
  					$result = $conn->query("SELECT * FROM `course`");
  					while($row = $result->fetch_assoc()) {
  						$course_id = $row['course_id'];
  						$title = $row['title'];
  						$credits = $row['credits'];
  						$department = $row['department'];
  				 ?>
  					    <tr onclick="getData(this, 'Course'); myFunction('UpdateCourse')">
  					      <td><?php echo $course_id; ?></td>
  						  <td><?php echo $title; ?></td>
						  <td><?php echo $department; ?></td>
  						  <td><?php echo $credits; ?></td>
						  <td class="w3-center">
							  <button class="w3-button w3-green" onclick="myFunction('RemoveCourse');">x</button>
						  </td>
  					    </tr>
  				<?php
  					}
  				 ?>
  			  </table>
			  <hr>
			  <button class=" w3-btn w3-purple">Takes Table </button>
			  <button class=" w3-btn w3-purple w3-right" onclick="myFunction('AddTakes')">Add an Entry in Takes</button>
			  <table id="takes" class="w3-table-all w3-card-4 w3-hoverable">
  				<tr>
  			      <th>Semester</th>
  			      <th>Year</th>
				  <th>Flag</th>
  			      <th>Roll Number</th>
				  <th>Course ID</th>
  			    </tr>
  				<?php
  					$result = $conn->query("SELECT * FROM `takes`");
  					while($row = $result->fetch_assoc()) {
  						$semester = $row['semester'];
  						$year = $row['year'];
  						$flag = $row['flag'];
  						$rollno = $row['roll_no'];
						$course_id = $row['course_id'];
  				 ?>
  					    <tr>
  					      <td><?php echo $semester; ?></td>
  						  <td><?php echo $year; ?></td>
						  <td><?php echo $flag; ?></td>
  						  <td><?php echo $rollno; ?></td>
						  <td><?php echo $course_id; ?></td>
  					    </tr>
  				<?php
  					}
  				 ?>
  			  </table>
			  <hr>
			  <button class=" w3-btn w3-purple">Teaches List </button>
			  <button class=" w3-btn w3-purple w3-right" onclick="myFunction('AddTeaches')">Add an Entry in Teaches</button>
			  <table id="teaches" class="w3-table-all w3-card-4 w3-hoverable">
  				<tr>
  			      <th>Semester</th>
  			      <th>Year</th>
				  <th>I_ID</th>
				  <th>Course ID</th>
  			    </tr>
  				<?php
  					$result = $conn->query("SELECT * FROM `teaches`");
  					while($row = $result->fetch_assoc()) {
  						$semester = $row['semester'];
  						$year = $row['year'];
  						$i_id = $row['i_id'];
						$course_id = $row['course_id'];
  				 ?>
  					    <tr>
  					      <td><?php echo $semester; ?></td>
  						  <td><?php echo $year; ?></td>
  						  <td><?php echo $i_id; ?></td>
						  <td><?php echo $course_id; ?></td>
  					    </tr>
  				<?php
  					}
  				 ?>
  			  </table>
        <!-- </div>
      </div> -->
	</div>

    <!-- Right Column -->
    <div class="w3-col m2" style="position: absolute; right: 2%;">
      <div class="w3-card w3-round w3-white w3-left-align">
        <div>
          <header class="w3-display-container w3-grayscale-min" id="home" style="min-height:74%;">
              <div class="w3-row">

                  <div class="w3-card-4 w3-left-align">
                      <button onclick="myFunction('AddStudent')" class="w3-button w3-blue w3-block w3-left-align">
                          Add Student </button>
                      <div id="AddStudent" class="w3-hide">
                        <form class="w3-container" method="post" action="admin/processadduser.php">
                          <div class="w3-section">
                            <label><b>Roll Number</b></label>
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
							<select class="w3-input w3-border" name="s_branch">
								<option value="Computer_Science">Computer_Science</option>
								<option value="ECE">ECE</option>
							</select>
                            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add User</button>
                          </div>
                        </form>
                    </div>

                      <button onclick="myFunction('AddInstructor')" class="w3-button w3-blue w3-block w3-left-align">
                          Add Instructor    </button>
                      <div id="AddInstructor" class="w3-hide">
                        <form class="w3-container" method="post" action="admin/processaddinstructor.php">
                          <div class="w3-section">
                            <label><b>Instructor ID</b></label>
                            <input class="w3-input w3-border" type="text" placeholder="Enter Instructor ID" name="i_id" required>
                            <label><b>Password</b></label>
                            <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="i_psw" required>
							<label><b>Name</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Name" name="i_name" required>
							<label><b>Department</b></label>
							<select class="w3-input w3-border" name="i_dept">
								<option value="Computer_Science">Computer_Science</option>
								<option value="ECE">ECE</option>
								<option value="ScienceAndMathematics">ScienceAndMathematics</option>
  							  	<option value="HSS">HSS</option>
							</select>
							<label><b>Email Id</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Email ID" name="i_email" required>
							<label><b>Mobile No</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Mobile No" name="i_mobile" required>
                            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add Instructor</button>
                          </div>
                        </form>
                    </div>
                    <button onclick="myFunction('AddCourse')" class="w3-button w3-blue w3-block w3-left-align">
                        Add Course</button>
                    <div id="AddCourse" class="w3-hide">
                      <form class="w3-container" method="post" action="admin/processaddcourse.php">
                        <div class="w3-section">
                          <label><b>Course Id</b></label>
                          <input class="w3-input w3-border" type="text" placeholder="Enter course_id" name="cid" required>
                          <label><b>Title</b></label>
                          <input class="w3-input w3-border" type="text" placeholder="Enter Title" name="title" required>
                          <label><b>Department</b></label>
						  <select class="w3-input w3-border" name="dept">
							  <option value="Computer_Science">Computer_Science</option>
							  <option value="ECE">ECE</option>
							  <option value="ScienceAndMathematics">ScienceAndMathematics</option>
							  <option value="HSS">HSS</option>
						  </select>
                          <label><b>Credit</b></label>
                          <input class="w3-input w3-border" type="text" placeholder="Enter Credit" name="credit" required>
                          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add Course</button>
                        </div>
                      </form>
                  </div>
                  </div>
					<button onclick="myFunction('RemoveStudent')" class="w3-button w3-blue w3-block w3-left-align">
							Remove Student </button>
					<div id="RemoveStudent" class="w3-hide">
						<form class="w3-container" method="post" action="admin/processremoveuser.php">
							<div class="w3-section">
								<label><b>Username</b></label>
								<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="s_usrname" required>
								<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Remove User</button>
							</div>
						</form>
				</div>

					<button onclick="myFunction('RemoveInstructor')" class="w3-button w3-blue w3-block w3-left-align">
							Remove Instructor    </button>
					<div id="RemoveInstructor" class="w3-hide">
						<form class="w3-container" method="post" action="admin/processremoveinstructor.php">
							<div class="w3-section">
								<label><b>Instructor ID</b></label>
								<input class="w3-input w3-border" type="text" placeholder="Enter Instructor ID" name="i_id" required>
								<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Remove Instructor</button>
							</div>
						</form>
				</div>
				<button onclick="myFunction('RemoveCourse')" class="w3-button w3-blue w3-block w3-left-align">
						Remove Course</button>
				<div id="RemoveCourse" class="w3-hide">
					<form class="w3-container" method="post" action="admin/processremovecourse.php">
						<div class="w3-section">
							<label><b>Course Id</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter course_id" name="cid" required>
							<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Remove Course</button>
						</div>
					</form>
					</div>
					</div>
					<button onclick="myFunction('updateStudent')" class="w3-button w3-blue w3-block w3-left-align">
							Update Student </button>
					<div id="updateStudent" class="w3-hide">
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
								<select class="w3-input w3-border" name="s_branch">
									<option value="Computer_Science">Computer_Science</option>
									<option value="ECE">ECE</option>
								</select>
								<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Update User</button>
							</div>
						</form>
				</div>

					<button onclick="myFunction('UpdateInstructor')" class="w3-button w3-blue w3-block w3-left-align">
							Update Instructor    </button>
					<div id="UpdateInstructor" class="w3-hide">
						<form class="w3-container" method="post" action="admin/processupdateinstructor.php">
							<div class="w3-section">
								<label><b>Instructor ID</b></label>
								<input class="w3-input w3-border" type="text" placeholder="Enter Instructor ID" name="i_id" required>
								<label><b>Password</b></label>
								<input class="w3-input w3-border" type="password" placeholder="Enter Password" name="i_psw" required>
								<label><b>Name</b></label>
								<input class="w3-input w3-border" type="text" placeholder="Enter Name" name="i_name" required>
								<label><b>Email Id</b></label>
								<input class="w3-input w3-border" type="text" placeholder="Enter Email ID" name="i_email" required>
								<label><b>Mobile No</b></label>
								<input class="w3-input w3-border" type="text" placeholder="Enter Mobile No" name="i_mobile" required>
								<label><b>Department</b></label>
								<input class="w3-input w3-border" type="text" placeholder="Enter Department" name="i_dept" required>
								<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Update Instructor</button>
							</div>
						</form>
				</div>
				<button onclick="myFunction('UpdateCourse')" class="w3-button w3-blue w3-block w3-left-align">
						Update Course</button>
				<div id="UpdateCourse" class="w3-hide">
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
				<button onclick="myFunction('AddTakes')" class="w3-button w3-blue w3-block w3-left-align">
						Add Takes</button>
				<div id="AddTakes" class="w3-hide">
					<form class="w3-container" method="post" action="admin/processaddtakes.php">
						<div class="w3-section">
							<label><b>Semester</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Semester" name="sem" required>
							<label><b>Year</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Year" name="year" required>
							<label><b>Roll Number</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Roll_no" name="roll_no" required>
							<label><b>Course ID</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Course ID" name="c_id" required>
							<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add Takes</button>
						</div>
					</form>
				</div>
				<button onclick="myFunction('AddTeaches')" class="w3-button w3-blue w3-block w3-left-align">
						Add Teaches</button>
				<div id="AddTeaches" class="w3-hide">
					<form class="w3-container" method="post" action="admin/processaddteaches.php">
						<div class="w3-section">
							<label><b>Semester</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Semester" name="sem" required>
							<label><b>Year</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Year" name="year" required>
							<label><b>Instructor ID</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Instructor ID" name="i_id" required>
							<label><b>Course ID</b></label>
							<input class="w3-input w3-border" type="text" placeholder="Enter Course ID" name="c_id" required>
							<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add Teaches</button>
						</div>
					</form>
				</div>
			</div>
        </div>

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
function getData(data, destination) {
	console.log(data);
	console.log(destination);
	if(destination == 'Student') {
		var fillIt = document.getElementById('updateStudent').childNodes[1].childNodes[1];
		fillIt.childNodes[3].value = data.childNodes[1].innerHTML;
		fillIt.childNodes[11].value = data.childNodes[3].innerHTML;
		fillIt.childNodes[15].value = data.childNodes[5].innerHTML;
		fillIt.childNodes[19].value = data.childNodes[7].innerHTML;
		fillIt.childNodes[23].value = data.childNodes[9].innerHTML;
	} else if(destination == 'Instructor') {
		var fillIt = document.getElementById('UpdateInstructor').childNodes[1].childNodes[1];
		fillIt.childNodes[3].value = data.childNodes[1].innerHTML;
		fillIt.childNodes[11].value = data.childNodes[3].innerHTML;
		fillIt.childNodes[15].value = data.childNodes[5].innerHTML;
		fillIt.childNodes[19].value = data.childNodes[7].innerHTML;
		fillIt.childNodes[23].value = data.childNodes[9].innerHTML;
	} else if(destination == 'Course') {
		var fillIt = document.getElementById('UpdateCourse').childNodes[1].childNodes[1];
		console.log(fillIt);
		fillIt.childNodes[3].value = data.childNodes[1].innerHTML;
		fillIt.childNodes[7].value = data.childNodes[3].innerHTML;
		fillIt.childNodes[11].value = data.childNodes[5].innerHTML;
		fillIt.childNodes[15].value = data.childNodes[7].innerHTML;
	}

}
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "updateStudent.php?q=" + str, true);
        xmlhttp.send();
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
