<?php
    if(isset($_POST['i_id'])) {

        if( !empty($_POST['i_id'])){

                $username = htmlentities($_POST['i_id']);
			          require '../connect.php';
          if($insert = $conn->query("DELETE FROM `instructor` WHERE `i_id` = '{$username}'")) {
                  $msg = 'Instructor Removed!';
                  $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                  setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                  header('Location: ../dashboardA.php');
                }
          else {
                  $msg = 'Failed to Remove Instructor!';
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
