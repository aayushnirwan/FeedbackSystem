<?php
    if(isset($_POST['s_usrname']) && isset($_POST['s_psw']) && isset($_POST['s_name']) && isset($_POST['s_email']) && isset($_POST['s_mobile']) && isset($_POST['s_branch'])) {

        if( !empty($_POST['s_usrname']) && !empty($_POST['s_psw']) && !empty($_POST['s_name']) && !empty($_POST['s_email']) && !empty($_POST['s_mobile']) && !empty($_POST['s_branch']) ){

                require 'connect.php';
                $username = htmlentities($_POST['s_usrname']);
			          $password = htmlentities($_POST['s_psw']);
                $name = htmlentities($_POST['s_name']);
                $email = htmlentities($_POST['s_email']);
                $mobile_no = htmlentities($_POST['s_mobile']);
                $branch = htmlentities($_POST['s_branch']);
                //echo $username;
          if($insert = $conn->query("UPDATE `student` SET `roll_no`='{$username}',`password`='{$password}',`name`='{$name}',`email_id`='{$email}',`mobile_no`='{$mobile_no}',`branch`='{$branch}' WHERE `roll_no`='{$username}'")) {
                  $msg = 'User Updated !';
                  $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                  setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                  header('Location: ../dashboardA.php');
                }
          else {
                  $msg = 'Failed to Update User!';
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
