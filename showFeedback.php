<?php
	require_once 'checkForFeedback.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>FeedBack Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

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
        label {
            margin-left: 3px;
        }
	</style>
</head>
<body>

	<!-- Navbar -->
	<div class="">
	 <div class="w3-bar w3-white w3-left-align w3-large">
	  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
	  <a href="index.php" class="w3-bar-item w3-button"><img src="assets/header.svg" style="width:100%; height: auto;"></img></a>
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

    <?php

        $result = $conn->query("SELECT * FROM `feedbacks` WHERE `i_id` = '{$_SESSION['i_id']}' and `course_id` = '{$course_id}' ORDER BY `fid` desc");

        // Count the total records
        $total_records = mysqli_num_rows($result);
		if($total_records == 0) {
			echo 'No FeedBack Avaiable';
		} else {
        //Using ceil function to divide the total records on per page
        // $total_pages = ceil($total_records / 5);
        $num_rec_per_page = 1;
        $page = 1;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if($page > $total_records)
                $page = 1;
        }
        $start_from = ($page - 1) * $num_rec_per_page;

        $result = $conn->query("SELECT * FROM `feedbacks` WHERE `i_id` = '{$_SESSION['i_id']}' and `course_id` = '{$course_id}' ORDER BY `fid` desc LIMIT $start_from, $num_rec_per_page");
        if($result){
            if ($row = $result->fetch_assoc()) {

     ?>

	<div class="container-contact100">
		<div class="wrap-contact100" style="padding:0px; border-radius:0">
			<span id="bg-img" class="contact100-form-title">
				FeedBack Form - <?php echo $page; ?>
			</span>
		</div>

		<div class="wrap-contact100">
            <?php
                echo '<div class="w3-bar">';
                if($page > 1){
                    echo '<a class="w3-button" href="showFeedback.php?cid='.$course_id.'&iid='.$i_id.'&page='.($page-1).'">Previous Page &laquo;</a>';
                }

                echo '<a class="w3-button w3-purple">'.$page.'</a>';
                if($page < $total_records){
                    echo '<a class="w3-button" href="showFeedback.php?cid='.$course_id.'&iid='.$i_id.'&page='.($page+1).'">Next Page &raquo;</a>';
                }
				echo '<a class="w3-button w3-purple w3-right" href="calculatedFeedback.php?cid='.$course_id.'&iid='.$i_id.'">Calculate my Average</a>';
                echo '</div><br>';
             ?>
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
                              <?php
                                    $counter = 0;
                                    $total = $row['A1'];
                                    for(; $counter < (5 - $total); $counter++) {
                                        echo '<label></label>';
                                    }
                                    for(; $counter < 5; $counter++) {
                                        echo '<label class="selected"></label>';
                                    }
                               ?>
							</div>
						</div>
					</div>

					<!-- Question 2 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							A2. Text books were appropiate for the course.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['A2'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>

					<!-- Question 3 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							A3. Reference books provided good support for the course.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['A3'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>

					<!-- Question 4 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							A4. The course load was very heavy.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['A4'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>

					<!-- Question 5 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							A5. The course was highly enjoyable.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['A5'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
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
                                <?php
                                      $counter = 0;
                                      $total = $row['B1'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 7 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B2. The instructor was well prepared for the class.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B2'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 8 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B3. The concepts were explained properly.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B3'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 9 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B4. Classes were held regularly as per time-table.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B4'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 10 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B5. The instructor's voice was audible and understandable.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B5'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 11 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B6. Black-board work/visual presentations were of good quality.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B6'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 12 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B7. Topics were covered in a logical sequence.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B7'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 13 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B8. The coverage of the course was complete.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B8'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 14 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B9. Questions and discussions were encouraged.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B9'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
					<!-- Question 15 -->
					<div class="wrap-contact100-form-range stars">
						<div class="contact100-form-range-value" display="block">
							B10. Evaluation was done regularly & academic advices were given.
							<br><br>
							<div class="rating">
                                <?php
                                      $counter = 0;
                                      $total = $row['B10'];
                                      for(; $counter < (5 - $total); $counter++) {
                                          echo '<label></label>';
                                      }
                                      for(; $counter < 5; $counter++) {
                                          echo '<label class="selected"></label>';
                                      }
                                 ?>
							</div>
						</div>
					</div>
				</div>

				<div class="wrap-input100 bg0" style="margin-top: 40px;">
					<div class="label-input100">COMMENT</div>
                    <br>
                    <?php echo $row['comment']; ?>
				</div>

					<?php
	                    }
	                } else {
	                    die('No FeedBack Given Till Now');
	                }
	                    echo '<br><div class="w3-bar">';
	    				if($page > 1){
	    					echo '<a class="w3-button" href="showFeedback.php?cid='.$course_id.'&iid='.$i_id.'&page='.($page-1).'">&laquo;</a>';
	    				}

	    				echo '<a class="w3-button w3-purple">'.$page.'</a>';
	    				if($page < $total_records){
	    					echo '<a class="w3-button" href="showFeedback.php?cid='.$course_id.'&iid='.$i_id.'&page='.($page+1).'">&raquo;</a>';
	    				}
	    				echo '</div>';
					}
                 ?>
		</div>
	</div>


	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
