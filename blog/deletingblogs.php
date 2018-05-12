<?php

	require 'connect.php';
	if(isset($_SESSION['name'])){
		if(empty($_SESSION['name']))
			header('Location: Login.php');
	}else{
		header('Location: Login.php');
	}

	$Username = $_SESSION['name'].' '.$_SESSION['Lname'];
	$UserID = $_SESSION['UserID'];

	if(isset($_POST['name'])){
		$blogid = $_POST['name'];
	}
	else
		header('Location: Account.php');


	$result = $conn->query("SELECT * FROM `blog` WHERE `id`='{$blogid}'");
	if($result){
		if($row = $result->fetch_assoc()) {
			if($UserID == $row['WriterId']){
				$delete = $conn->query("DELETE FROM `blog` WHERE `blog`.`id`='{$blogid}'");
				echo "Blog Deleted";
				if(!empty($row['ImageName'])){
					unlink($row['ImageName']);
				}
		}
		else
			echo "Not Deleted";
		}
	}
	$result->free();
	mysqli_close($conn);

?>
