<?php
    if(isset($_POST['s_usrname']) && isset($_POST['s_psw']) && isset($_POST['s_name']) && isset($_POST['s_email']) && isset($_POST['s_mobile']) && isset($_POST['s_branch'])) {

        if( !empty($_POST['s_usrname']) && !empty($_POST['s_psw']) && !empty($_POST['s_name']) && !empty($_POST['s_email']) && !empty($_POST['s_mobile']) && !empty($_POST['s_branch']) ){

                require '../connect.php';
                $username = htmlentities($_POST['s_usrname']);
			          $password = htmlentities($_POST['s_psw']);
                $name = htmlentities($_POST['s_name']);
                $email = htmlentities($_POST['s_email']);
                $mobile_no = htmlentities($_POST['s_mobile']);
                $branch = htmlentities($_POST['s_branch']);

          if($insert = $conn->query("INSERT INTO `student`(`roll_no`, `password`,`name`,`email_id`,`mobile_no`,`branch`) VALUES ('{$username}','{$password}','{$name}','{$email}','{$mobile_no}','{$branch}')")) {
                  $msg = 'User Added !';
                  $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                  setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                  header('Location: ../dashboardA.php');
                }
          else {
                  $msg = 'Failed to Add user!';
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
