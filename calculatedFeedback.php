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
        $A1 = $A2 = $A3 = $A4 = $A5 = $B1 = $B2 = $B3 = $B4 = $B5 = $B6 = $B7 = $B8 = $B9 = $B10 = 0;
        $result = $conn->query("SELECT * FROM `feedbacks` WHERE `i_id` = '{$_SESSION['i_id']}' and `course_id` = '{$course_id}' ORDER BY `fid` desc");
        $total_records = mysqli_num_rows($result);
        if($result){
            while ($row = $result->fetch_assoc()) {
                $A1 = $A1 + $row['A1'];
                $A2 = $A2 + $row['A2'];
                $A3 = $A3 + $row['A3'];
                $A4 = $A4 + $row['A4'];
                $A5 = $A5 + $row['A5'];
                $B1 = $B1 + $row['B1'];
                $B2 = $B2 + $row['B2'];
                $B3 = $B3 + $row['B3'];
                $B4 = $B4 + $row['B4'];
                $B5 = $B5 + $row['B5'];
                $B6 = $B6 + $row['B6'];
                $B7 = $B7 + $row['B7'];
                $B8 = $B8 + $row['B8'];
                $B9 = $B9 + $row['B9'];
                $B10 = $B10 + $row['B10'];
            }
	    } else {
	           die('No FeedBack Given Till Now');
	    }
        $A1 = $A1 / $total_records;
        $A2 = $A2 / $total_records;
        $A3 = $A3 / $total_records;
        $A4 = $A4 / $total_records;
        $A5 = $A5 / $total_records;
        $B1 = $B1 / $total_records;
        $B2 = $B2 / $total_records;
        $B3 = $B3 / $total_records;
        $B4 = $B4 / $total_records;
        $B5 = $B5 / $total_records;
        $B6 = $B6 / $total_records;
        $B7 = $B7 / $total_records;
        $B8 = $B8 / $total_records;
        $B9 = $B9 / $total_records;
        $B10 = $B10 / $total_records;
     ?>
	 <div class="w3-right w3-margin">
		 <button class="w3-purple w3-btn" onclick="window.print();">Save as PDF</button>
	 </div>
	 <br><br>
	 <div class="w3-card-4 w3-col l2 m8 s12 w3-margin">
		<header class="w3-container w3-light-grey w3-padding-16 w3-center">
		  <h3><?php echo $_SESSION['name']; ?></h3>
		</header>
		<div class="w3-container w3-center w3-padding-16">
		  <img src="assets/images/avatar3.png" alt="Avatar" class="w3-circle w3-margin-right" style="width:150px;">
		  <p>Email Id : <?php echo $_SESSION['email']; ?></p>
		  <p>Mobile Number : <?php echo $_SESSION['mobile_no']; ?></p>
		  <p>Department : <?php echo $_SESSION['department']; ?></p>
		</div>
		<button class="w3-button w3-block w3-dark-grey"><?php echo $title; ?></button>
	 </div>
     <div>
         <canvas id="myChart" style="max-height: 700px; max-width: 800px; display: inline !important"></canvas>
     </div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["A1", "A2", "A3", "A4", "A5", "B1", "B2", "B3", "B4", "B5", "B6", "B7", "B8", "B9", "B10"],
                datasets: [{
                    label: '<?php echo $title; ?>',
                    data: [<?php echo $A1; ?>, <?php echo $A2; ?>, <?php echo $A3; ?>, <?php echo $A4; ?>, <?php echo $A5; ?>, <?php echo $B1; ?>, <?php echo $B2; ?>, <?php echo $B3; ?>, <?php echo $B4; ?>, <?php echo $B5; ?>, <?php echo $B6; ?>, <?php echo $B7; ?>, <?php echo $B8; ?>, <?php echo $B9; ?>, <?php echo $B10; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Average Rating'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 5
                        }
                    }]
                }
            }
        });
    </script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
