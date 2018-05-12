<?php
    if(isset($_POST['i_id']) && isset($_POST['i_psw']) && isset($_POST['i_name']) && isset($_POST['i_email']) && isset($_POST['i_mobile']) && isset($_POST['i_dept'])) {

        if( !empty($_POST['i_id']) && !empty($_POST['i_psw']) && !empty($_POST['i_name']) && !empty($_POST['i_email']) && !empty($_POST['i_mobile']) && !empty($_POST['i_dept']) ){

                $username = htmlentities($_POST['i_id']);
			          $password = htmlentities($_POST['i_psw']);
                $name = htmlentities($_POST['i_name']);
                $email = htmlentities($_POST['i_email']);
                $mobile_no = htmlentities($_POST['i_mobile']);
                $branch = htmlentities($_POST['i_dept']);
			          require '../connect.php';
            if($insert = $conn->query("UPDATE `instructor` SET `i_id`='{$username}',`password`='{$password}',`name`='{$name}',`department`='{$branch}',`email_id`='{$email}',`mobile_no`='{$mobile_no}' WHERE `i_id`='{$username}'")) {
                  $msg = 'Instructor Updated !';
                  $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                  setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                  header('Location: ../dashboardA.php');
                }
          else {
                  $msg = 'Failed to Update Instructor!';
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
