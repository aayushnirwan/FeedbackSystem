<?php

	require 'connect.php';
	if(isset($_SESSION['name'])){
		if(empty($_SESSION['name']))
			header('Location: Login.php');
	}else{
		header('Location: Login.php');
	}	

	$Username = $_SESSION['name'];
	$UserID = $_SESSION['UserID'];
	$Lname = $_SESSION['Lname'];

	if(isset($_POST['content']) && !empty($_POST['content'])){
		$bid = $_POST['id'];
		$b = htmlentities($_POST['content']);
		$b = htmlspecialchars($b,ENT_QUOTES);
		$content = "";
		$result = $conn->query("SELECT * FROM `blog` WHERE `id`='{$bid}'");
		if($result){
			if($row = $result->fetch_assoc()) {
				if(!empty($row['Content']))
					$content = $row['Content'];
			}
		}
		$result->free();
		$content = $content."<p>".$b."</p>";
		if($update = $conn->query("UPDATE `blog` SET `Content`='$content' WHERE `blog`.`id`='{$bid}'"))
			echo htmlspecialchars_decode($b);
		else
			echo 'Error';
		mysqli_close($conn);
	}
	else if(isset($_FILES['blogimage']['name']) && !empty($_FILES['blogimage']['name'])){
		$bid = $_GET['bid'];
		$file = $_FILES['blogimage']['name'];
		$tmp_name = $_FILES['blogimage']['tmp_name'];
		$extension = substr($file, strlen($file)-4);
		$file = md5($file);
		$file = 'blog/'.$file.$extension;
		move_uploaded_file($tmp_name, $file);
		$content = "";
		$result = $conn->query("SELECT * FROM `blog` WHERE `id`='{$bid}'");
		if($result){
			if($row = $result->fetch_assoc()) {
				if(!empty($row['Content']))
					$content = $row['Content'];
			}
		}
		$content = $content.'<div style="text-align:center;"><img src="'.$file.'" style="max-width:80%; max-height:300px;"></div>';
		$update = $conn->query("UPDATE `blog` SET `Content`='$content' WHERE `blog`.`id`='{$bid}'");
		mysqli_close($conn);
		header('Location: WriteBlog.php?bid='.$bid.'');
	}
	else if(isset($_POST['blogcodesnippet']) && !empty($_POST['blogcodesnippet'])){
		$bid = $_GET['bid'];
		$code = $_POST['blogcodesnippet'];
		$content = "";
		$result = $conn->query("SELECT * FROM `blog` WHERE `id`='{$bid}'");
		if($result){
			if($row = $result->fetch_assoc()) {
				if(!empty($row['Content']))
					$content = $row['Content'];
			}
		}
		$content = $content.'<div class="w3-panel w3-leftbar w3-pale-red w3-border-red"><pre>'.$code.'</pre></div>';
		$update = $conn->query("UPDATE `blog` SET `Content`='$content' WHERE `blog`.`id`='{$bid}'");
		mysqli_close($conn);
		header('Location: WriteBlog.php?bid='.$bid.'');
	}
	else if(isset($_POST['blogquote']) && !empty($_POST['blogquote'])) {
		$bid = $_GET['bid'];
		$quote = htmlentities($_POST['blogquote']);
		$quote = htmlspecialchars($quote);
		$content = "";
		$result = $conn->query("SELECT * FROM `blog` WHERE `id`='{$bid}'");
		if($result){
			if($row = $result->fetch_assoc()) {
				if(!empty($row['Content']))
					$content = $row['Content'];
			}
		}
		$content = $content.'<div class="w3-panel w3-leftbar w3-light-grey w3-border-grey"><i><p>" '.$quote.' "</p></i></div>';
		$update = $conn->query("UPDATE `blog` SET `Content`='$content' WHERE `blog`.`id`='{$bid}'");
		mysqli_close($conn);
		header('Location: WriteBlog.php?bid='.$bid.'');
	}
	else if(isset($_POST['bloglink']) && !empty($_POST['bloglink']) && isset($_POST['bloglinktitle']) && !empty($_POST['bloglinktitle'])) {
		$bid = $_GET['bid'];

		$linktitle = htmlentities($_POST['bloglinktitle']);
		$linktitle = htmlspecialchars($linktitle);

		$link = htmlentities($_POST['bloglink']);
		$link = htmlspecialchars($link);
		$content = "";
		$result = $conn->query("SELECT * FROM `blog` WHERE `id`='{$bid}'");
		if($result){
			if($row = $result->fetch_assoc()) {
				if(!empty($row['Content']))
					$content = $row['Content'];
			}
		}
		$content = $content.'<div class="w3-panel w3-padding-4 w3-leftbar w3-pale-green w3-border-green w3-text-blue"><a href="'.$link.'">'.$linktitle.'</a></div>';
		$update = $conn->query("UPDATE `blog` SET `Content`='$content' WHERE `blog`.`id`='{$bid}'");
		mysqli_close($conn);
		header('Location: WriteBlog.php?bid='.$bid.'');
	}
?>