<?php
    if(isset($_POST['admin_usrname']) && isset($_POST['admin_psw']) ) {

        if( !empty($_POST['admin_usrname']) && !empty($_POST['admin_psw']) ){

            $username = htmlentities($_POST['admin_usrname']);
			$password = htmlentities($_POST['admin_psw']);

			require 'connect.php';

            if($username == "admin" && $password=="12345") {
                  $_SESSION['name'] = 'Admin';
			      header("Location: dashboardA.php");
            } else {
                echo 'Wrong !!';
                $msg = 'Missing Entries !';
                $cookie_value = '<script>alert(\''.$msg.'\');</script>';
                setcookie("message", $cookie_value, time() + (86400 * 30), "/");
                header('Location: index.php');
            }

        }
        else {
            echo 'Fill the entries !';
            $msg = 'Missing Entries !';
            $cookie_value = '<script>alert(\''.$msg.'\');</script>';
            setcookie("message", $cookie_value, time() + (86400 * 30), "/");
            header('Location: index.php');
        }
    }
 ?>
