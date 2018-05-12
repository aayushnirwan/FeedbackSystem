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
    $i_id = 0;
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
                } else {
                    // not valid
                    header('Location: dashboardS.php');
                }
            }
        }
    } else {
        header('Location: dashboardS.php');
    }

    echo $i_id.' : '.$course_id.'<br>';
    if(isset($_POST['A1']) && isset($_POST['A2']) && isset($_POST['A3']) && isset($_POST['A4']) && isset($_POST['A5']) && isset($_POST['B1']) && isset($_POST['B2']) && isset($_POST['B3']) && isset($_POST['B4']) && isset($_POST['B5']) && isset($_POST['B6']) && isset($_POST['B7']) && isset($_POST['B8']) && isset($_POST['B9']) && isset($_POST['B10']) && isset($_POST['message']) ) {

        if( !empty($_POST['A1']) && !empty($_POST['A2']) && !empty($_POST['A3']) && !empty($_POST['A4']) && !empty($_POST['A5']) && !empty($_POST['B1']) && !empty($_POST['B2']) && !empty($_POST['B3']) && !empty($_POST['B4']) && !empty($_POST['B5']) && !empty($_POST['B6']) && !empty($_POST['B7']) && !empty($_POST['B8']) && !empty($_POST['B9']) && !empty($_POST['B10']) && !empty($_POST['message']) ){

            $A1 = htmlentities($_POST['A1']);
            $A2 = htmlentities($_POST['A2']);
            $A3 = htmlentities($_POST['A3']);
            $A4 = htmlentities($_POST['A4']);
            $A5 = htmlentities($_POST['A5']);
            $B1 = htmlentities($_POST['B1']);
            $B2 = htmlentities($_POST['B2']);
            $B3 = htmlentities($_POST['B3']);
            $B4 = htmlentities($_POST['B4']);
            $B5 = htmlentities($_POST['B5']);
            $B6 = htmlentities($_POST['B6']);
            $B7 = htmlentities($_POST['B7']);
            $B8 = htmlentities($_POST['B8']);
            $B9 = htmlentities($_POST['B9']);
            $B10 = htmlentities($_POST['B10']);
			$message = htmlentities($_POST['message']);

            echo $A1.' : '.$A2.' : '.$A3.' : '.$A4.' : '.$A5.' : '.$message;
            $flag = 1;
            if($insert = $conn->query("INSERT INTO `feedbacks`(`i_id`, `course_id`, `comment`, `A1`, `A2`, `A3`, `A4`, `A5`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `B7`, `B8`, `B9`, `B10`) VALUES ('{$i_id}','{$course_id}','{$message}', '{$A1}', '{$A2}', '{$A3}', '{$A4}', '{$A5}', '{$B1}', '{$B2}', '{$B3}', '{$B4}', '{$B5}', '{$B6}', '{$B7}', '{$B8}', '{$B9}', '{$B10}')")) {
                $update = $conn->query("UPDATE `takes` SET `flag`='$flag' WHERE `takes`.`roll_no`='{$_SESSION['roll_no']}' and `takes`.`course_id`='{$course_id}'");
                $msg = 'FeedBack Submitted !';
                $cookie_value = '<script>alert(\''.$msg.'\');</script>';

            }
            else {
                $msg = 'FeedBack Failed to be Submitted !';
                $cookie_value = '<script>alert(\''.$msg.'\');</script>';
            }
            setcookie("message", $cookie_value, time() + (86400 * 30), "/");
            header('Location: dashboardS.php');

        }
        else {
            echo 'Fill the entries !';
            header('Location: dashboardS.php');
        }
    } else {
        header('Location: dashboardS.php');
    }
 ?>
