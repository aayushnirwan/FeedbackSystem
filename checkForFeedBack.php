<?php

	require 'connect.php';
	if(isset($_SESSION['i_id'])){
		if(empty($_SESSION['i_id']))
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
					header('Location: dashboardI.php');
				}
			}
		}
	} else {
		header('Location: dashboardI.php');
	}
	// For Instructor
	if(isset($_GET['iid'])){
		$iid = $_GET['iid'];
		if(empty($iid)) {
			header('Location: dashboardI.php');
		} else {
			// echo 'Check validatity of iid '.$iid.' from database';
			$result = $conn->query("SELECT * FROM `instructor` WHERE `i_id`='{$iid}'");
			if($result){
				if($row = $result->fetch_assoc()) {
					$i_id = $iid;
					$name = $row['name'];
				} else {
					// not valid
					header('Location: dashboardI.php');
				}
			}
		}
	} else {
		header('Location: dashboardI.php');
	}
	// preventing any hack
	if($_SESSION['i_id'] != $i_id)
		header('Location: index.php');
	// for teaches
	$result = $conn->query("SELECT * FROM `teaches` WHERE `i_id`='{$_SESSION['i_id']}' and `course_id`='{$course_id}'");
	if($result) {
		if($row = $result->fetch_assoc());
		else {
			// not valid
			header('Location: dashboardI.php');
		}
	}
?>
