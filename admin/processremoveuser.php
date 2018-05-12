<?php
    if(isset($_POST['s_usrname'])) {

        if( !empty($_POST['s_usrname'])){

                $username = htmlentities($_POST['s_usrname']);
			          require '../connect.php';
          if($insert = $conn->query("DELETE FROM `student` WHERE `roll_no` = '{$username}'")) {
                  $msg = 'User Removed!';
                  $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                  setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                  header('Location: ../dashboardA.php');
                }
          else {
                  $msg = 'Failed to Remove user!';
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
