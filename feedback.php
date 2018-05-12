<?php

	require 'connect.php';
	if(isset($_SESSION['roll_no'])){
		if(empty($_SESSION['roll_no']))
			header('Location: index.php');
	}else {
		header('Location: index.php');
	}
	//
	$course_id = 0;
	$title = "";
	$i_id = 0;
	$name = "";
	if(isset($_GET['cid'])){
		$cid = $_GET['cid'];
		if(empty($cid)) {
			header('Location: dashboardS.php');
		} else {
			// echo 'Check validatity of cid '.$cid.' from database';
			$result = $conn->query("SELECT * FROM `course` WHERE `course_id`='{$cid}'");
			if($result){
				if($row = $result->fetch_assoc()) {
					$course_id = $cid;
					$title = $row['title'];
				} else {
					// not valid
					header('Location: dashboardS.php');
				}
			}
		}
	} else {
		header('Location: dashboardS.php');
	}
	// For Instructor
	if(isset($_GET['iid'])){
		$iid = $_GET['iid'];
		if(empty($iid)) {
			header('Location: dashboardS.php');
		} else {
			// echo 'Check validatity of iid '.$iid.' from database';
			$result = $conn->query("SELECT * FROM `instructor` WHERE `i_id`='{$iid}'");
			if($result){
				if($row = $result->fetch_assoc()) {
					$i_id = $iid;
					$name = $row['name'];
				} else {
					// not valid
					header('Location: dashboardS.php');
				}
			}
		}
	} else {
		header('Location: dashboardS.php');
	}
	// For Takes
	$result = $conn->query("SELECT * FROM `takes` WHERE `roll_no`='{$_SESSION['roll_no']}' and `course_id`='{$course_id}'");
	if($result) {
		if($row = $result->fetch_assoc());
		else {
			// not valid
			header('Location: dashboardS.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>FeedBack Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css"> -->
<!--===============================================================================================-->

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<style media="screen">
		#bg-img {
			background-image: url('images/bg-01.jpg');
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			padding-top: 25px;
		}
		#questions div {
			padding-left: 0px;
		}
		#logout {
			font-family: sans-serif;
		}
	</style>
</head>
<body>

	<!-- Navbar -->
	<div class="">
	 <div class="w3-bar w3-white w3-left-align w3-large">
	  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
	  <a href="#" class="w3-bar-item w3-button"><img src="assets/header.svg" style="width:100%; height: auto;"></img></a>
	  <a href="LogOut.php" id="logout" class="w3-bar-item w3-button w3-padding-large w3-right">Logout</a>
	 </div>
	</div>
	<!-- Navbar on small screens -->
	<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
	  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
	  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
	  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
	  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
	</div>
	<!-- Navbar -->


	<div class="container-contact100">
		<div class="wrap-contact100" style="padding:0px; border-radius:0">
			<span id="bg-img" class="contact100-form-title">
				FeedBack
			</span>
		</div>
		<div class="wrap-contact100">
			<form action="processFeedback.php?cid=<?php echo $cid; ?>&iid=<?php echo $iid; ?>" method="post" class="contact100-form validate-form" id="formFeedback">
				<span class="contact100-form-range-value">
					Course No. & Title : <?php echo $course_id.' - '.$title ?>
				</span>
				<div id="questions" class="w-full js-show-service">
					<br>
					<span class="label-input100">About the course</span>
					<!-- Question 1 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value validate-input rs1-alert-validate" data-validate = "Please Type Your Message" display="block">
							A1. A detailed course syllabus was provided at the beginning of the course.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="A1" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="A1" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="A1" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="A1" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="A1" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>

					<!-- Question 2 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							A2. Text books were appropiate for the course.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="A2" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="A2" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="A2" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="A2" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="A2" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>

					<!-- Question 3 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							A3. Reference books provided good support for the course.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="A3" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="A3" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="A3" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="A3" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="A3" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>

					<!-- Question 4 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							A4. The course load was very heavy.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="A4" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="A4" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="A4" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="A4" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="A4" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>

					<!-- Question 5 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							A5. The course was highly enjoyable.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="A5" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="A5" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="A5" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="A5" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="A5" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<br>
					<div class="label-input100">About the Teaching (Instructor)</div>
					<br>
					<div class="contact100-form-range-value">
						Name of the Instructor : <?php echo $name; ?>
					</div>
					<!-- Question 6 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B1. Overall, the instructor was excellent.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B1" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B1" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B1" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B1" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B1" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 7 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B2. The instructor was well prepared for the class.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B2" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B2" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B2" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B2" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B2" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 8 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B3. The concepts were explained properly.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B3" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B3" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B3" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B3" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B3" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 9 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B4. Classes were held regularly as per time-table.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B4" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B4" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B4" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B4" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B4" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 10 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B5. The instructor's voice was audible and understandable.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B5" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B5" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B5" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B5" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B5" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 11 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B6. Black-board work/visual presentations were of good quality.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B6" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B6" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B6" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B6" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B6" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 12 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B7. Topics were covered in a logical sequence.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B7" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B7" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B7" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B7" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B7" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 13 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B8. The coverage of the course was complete.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B8" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B8" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B8" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B8" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B8" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 14 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B9. Questions and discussions were encouraged.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B9" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B9" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B9" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B9" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B9" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
					<!-- Question 15 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B10. Evaluation was done regularly & academic advices were given.
							<br><br>
							<div class="rating">
							  <label>
							    <input type="radio" name="B10" value="5" title="5 stars"> 5
							  </label>
							  <label>
							    <input type="radio" name="B10" value="4" title="4 stars"> 4
							  </label>
							  <label>
							    <input type="radio" name="B10" value="3" title="3 stars"> 3
							  </label>
							  <label>
							    <input type="radio" name="B10" value="2" title="2 stars"> 2
							  </label>
							  <label>
							    <input type="radio" name="B10" value="1" title="1 star"> 1
							  </label>
							</div>
						</div>
					</div>
				</div>

				<div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate = "Please Type Your Message" style="margin-top: 40px;">
					<span class="label-input100">Mention strong and weak points of the course / instructions. Any detailed comments are welcome.
						Also mention suggestions, if any, to improve the course and its teaching methodology so that the course will be more useful and enjoyable.</span>
					<textarea class="input100" name="message" placeholder="Your message here..."></textarea>
				</div>

				<div class="container-contact100-form-btn">
					<input type="submit" class="contact100-form-btn"></input>
				</div>
			</form>
		</div>
	</div>



<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<!-- <script src="vendor/animsition/js/animsition.min.js"></script> -->
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<!-- <script src="vendor/select2/select2.min.js"></script> -->
<!--===============================================================================================-->
	<!-- <script src="vendor/daterangepicker/moment.min.js"></script> -->
	<!-- <script src="vendor/daterangepicker/daterangepicker.js"></script> -->
<!--===============================================================================================-->
	<!-- <script src="vendor/countdowntime/countdowntime.js"></script> -->
<!--===============================================================================================-->
	<!-- <script src="vendor/noui/nouislider.min.js"></script> -->
	<script>
		$('.rating input').change(function () {
			var $radio = $(this);
			// $('.rating .selected').removeClass('selected');
			// console.log($radio.parent().parent().children());
			$radio.parent().parent().children().removeClass('selected');
			$radio.closest('label').addClass('selected');
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
