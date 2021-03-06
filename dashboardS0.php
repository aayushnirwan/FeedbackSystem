<?php

	require 'connect.php';
	if(isset($_SESSION['roll_no'])){
		if(empty($_SESSION['roll_no']))
			header('Location: index.php');
	}else {
		header('Location: index.php');
	}
	//
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

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
a {
    text-decoration: none;
}
#profilePic {
	position: absolute;
	right: 26%;
	top: 75%;
	display: none;
	padding: 5px;
	width: 50%;
	height: 23%;
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
<div class="w3-container w3-content" style="max-width:1400px; margin-top: 10px; min-height: 75vh;">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container" id="profile">
         <h4 class="w3-center"><?php echo $_SESSION['name']; ?></h4>
         <p class="w3-center" style="position: relative;">
			 <div onmouseover="onProfilePic(this);" onmouseout="onProfilePic(this);">
				 <label id="profilePic" class="w3-white fa fa-pencil" for="changePicture" type="file" title="Change picture"></label>
				 <img src="assets/images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
				 <form id="profilePictureForm" action="#">
					 <input id="changePicture" class="hidden-input" type="file" style="display: none;">

				 </form>
		 	 </div>
		 </p>
         <hr>
         <p id="email">
			 <i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme" onclick="update(this)"></i>
			 <span id="content">
				 <?php echo $_SESSION['email']; ?>
			 </span>
		 </p>
         <p id="mobile">
			 <i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme" onclick="update(this)"></i>
			 <span id="content">
			 	<?php echo $_SESSION['mobile_no']; ?>
			</span>
		 </p>
         <p id="branch">
			 <i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>
			 <span id="content">
			 	Branch : <?php echo $_SESSION['branch']; ?>
		 	 </span>
		 </p>
		 <p class="w3-center" style="display: none;">
			 <button class="w3-button w3-green" onclick="saveUpdation(this)">Save</button>
		 </p>
        </div>
      </div>
      <br>
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Give FeedBack</button>
          <div id="Demo1" class="w3-hide w3-container">
              <?php
    		        $result = $conn->query("SELECT * FROM `student` natural join `takes` WHERE `roll_no`='{$_SESSION['roll_no']}'");
					$total_records = mysqli_num_rows($result);
					if($result){
    					while($row = $result->fetch_assoc()) {
							$course_id = $row['course_id'];
							$course_name = '';
							$flag = $row['flag'];
							$result2 = $conn->query("SELECT * FROM `course` WHERE `course_id`='{$course_id}'");
							if($result2) {
								if($row2 = $result2->fetch_assoc()) {
									$course_name = $row2['title'];
								}
							}
							 $result3 = $conn->query("SELECT * FROM `instructor` natural join `teaches` WHERE `course_id`='{$course_id}'");
							 if($result3) {
 								while($row3 = $result3->fetch_assoc()) {
									if($flag == 0)
 										echo '<a href="feedback.php?cid='.$row['course_id'].'&iid='.$row3['i_id'].'"><p class="w3-center"><i class="fa fa-bookmark-o"></i> '.$row['course_id'].' - '.$course_name.' <br>By '.$row3['name'].'</p></a>';
									else
										echo '<p class="w3-center"><i class="fa fa-bookmark"></i> '.$row['course_id'].' - '.$course_name.' <br>By '.$row3['name'].'</p>';
 								}
 							}

                        }
                    }

					if($total_records == 0) {
						echo '<p class="w3-center">No course available.</p>';
					}
                ?>
          </div>
       </div>
      </div>

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">
		<?php
			$result = $conn->query("SELECT * FROM `herald`");
			$total_records = mysqli_num_rows($result);
			if($total_records == 0) {
				echo '<div class="w3-card-4 w3-margin w3-white">
				  		<div class="w3-container">
							No Stories yet.
				  		</div>
					  </div>';
			} else {
				while($row = $result->fetch_assoc()) {
					$sid = $row['sid'];
					$WriterName = $row['writerID'];
					$Title = $row['Title'];
					$Content = $row['Content'];
					$ImageName = $row['Image'];
					$storyAdded = $row['storyAdded'];

		 ?>
		<div class="w3-card-4 w3-margin w3-white">
		  <img src="Herald/<?php echo $ImageName; ?>" alt="Nature" style="width:100%">
		  <div class="w3-container">
			<h3><b><?php echo $Title; ?></b></h3>
			<h5><span class="w3-tag	"><?php echo $WriterName.' , '.$storyAdded; ?></span></h5>
		  </div>

		  <div class="w3-container">
			<p>
				<?php echo htmlspecialchars_decode($Content); ?>
			</p>
			<div class="w3-row">
			  <div class="w3-col m8 s12">
				<p><a href="Herald/story.php?sid=<?php echo $sid; ?>">
					<button class="w3-button w3-padding-large w3-white w3-border">
						<b>READ MORE »</b>
					</button>
				</a></p>
			  </div>
			  <div class="w3-col m4 w3-hide-small">
				<p><span class="w3-padding-large w3-right">
					<b>Comments  </b>
					<span class="w3-tag">0</span>
				</span></p>
			  </div>
			</div>
		  </div>
		</div>
		<?php
		  		}
			}
		 ?>
		<hr>
    <!-- End Middle Column -->
    </div>

    <!-- Right Column -->

    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Upcoming Events:</p>
          <img src="#" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button    class="w3-button w3-block w3-theme-l4">Info</button></p>
        </div>
      </div>
      <br>
	  <script type="text/javascript">
		  var chatovodOnLoad = chatovodOnLoad || [];
		  chatovodOnLoad.push(function() {
			  chatovod.addChatButton({host: "iiitg.chatovod.com", align: "bottomRight",
				  width: 600, height: 380, defaultLanguage: "en"});
		  });
		  (function() {
			  var po = document.createElement('script');
			  po.type = 'text/javascript'; po.charset = "UTF-8"; po.async = true;
			  po.src = (document.location.protocol=='https:'?'https:':'http:') + '//st1.chatovod.com/api/js/v1.js?2';
			  var s = document.getElementsByTagName('script')[0];
			  s.parentNode.insertBefore(po, s);
		  })();
		</script>
    <!-- End Right Column -->
    </div>

  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>
<br>


<footer class="w3-container w3-theme-d5 " style="">
  <p class="w3-center w3-padding-16">Powered by <a href="https://www.iiitg.ac.in" target="_blank">IIITG</a></p>
</footer>

<script>
// Accordion
var originalContent = "";

function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}
function onProfilePic(content) {
	var label = content.parentElement.parentElement.childNodes[3].childNodes[0].childNodes[1];
	if(label.style.display == "block") {
		label.style.display = "none";
	}
	else {
		label.style.display = "block";
	}
}
//
function update(content) {
	console.log(content.parentElement.parentElement.childNodes[16]);
	var saveButton = content.parentElement.parentElement.childNodes[16];
	if(saveButton.style.display == "block") {
		content.parentElement.parentElement.innerHTML = originalContent;
		saveButton.style.display = "none";
	} else {
		originalContent = content.parentElement.parentElement.innerHTML;
		ww = "<input type=\"email\" name=\"updated_email\" class=\"w3-input\" style=\"display: inline; width:auto;\" placeholder=\"Type New Email\" value=\"<?php echo $_SESSION['email']; ?>\">";
		content.parentElement.parentElement.childNodes[10].childNodes[3].innerHTML = ww;
		ww = "<input type=\"number\" name=\"updated_number\" class=\"w3-input\" style=\"display: inline; width:auto;\" placeholder=\"Type New Mobile Number\" value=\"<?php echo $_SESSION['mobile_no']; ?>\">";
		content.parentElement.parentElement.childNodes[12].childNodes[3].innerHTML = ww;
		saveButton.style.display = "block";
	}

}
//
function saveUpdation(content) {
		var parent = content.parentElement.parentElement;
		console.log(parent.childNodes[7].childNodes[3].childNodes[0].value);
		console.log(parent.childNodes[9].childNodes[3].childNodes[0].value);
		var email = parent.childNodes[7].childNodes[3].childNodes[0].value;
		var mobile = parent.childNodes[9].childNodes[3].childNodes[0].value;
		var url = "updateStudent.php";
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
</script>

</body>
</html>
