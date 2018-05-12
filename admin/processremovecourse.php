<?php
    if(isset($_POST['cid'])) {

        if( !empty($_POST['cid'])){

                $cid = htmlentities($_POST['cid']);
			          require '../connect.php';
          if($insert = $conn->query("DELETE FROM `course` WHERE `course_id` = '{$cid}'")) {
                  $msg = 'Course Removed!';
                  $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                  setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                  header('Location: ../dashboardA.php');
                }
          else {
                  $msg = 'Failed to Remove Course!';
                  $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                  setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                  header('Location: ../dashboardA.php');
                }

        }
        else {
            echo 'Fill the entries !';
        }
    }
 ?>
