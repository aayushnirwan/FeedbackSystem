<?php
    if(isset($_POST['cid']) && isset($_POST['title']) && isset($_POST['dept']) && isset($_POST['credit'])) {

        if( !empty($_POST['cid']) && !empty($_POST['title']) && !empty($_POST['dept']) && !empty($_POST['credit'])) {

                $cid = htmlentities($_POST['cid']);
			          $title = htmlentities($_POST['title']);
                $dept = htmlentities($_POST['dept']);
                $credit = htmlentities($_POST['credit']);
                echo $cid;
			          require 'connect.php';
            if($insert = $conn->query("UPDATE `course` SET `course_id`='{$cid}',`title`='{$title}',`department`='{$dept}',`credits`='{$credit}' WHERE `course_id`='{$cid}'")) {
                  $msg = 'Course Updated!';
                  $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                  setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                  header('Location: ../dashboardA.php');
                }
          else {
                  $msg = 'Failed to Update Course!';
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
