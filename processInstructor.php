<?php
    if(isset($_POST['instructor_usrname']) && isset($_POST['instructor_psw']) ) {

        if( !empty($_POST['instructor_usrname']) && !empty($_POST['instructor_psw']) ){

            $username = htmlentities($_POST['instructor_usrname']);
			$password = htmlentities($_POST['instructor_psw']);

			require 'connect.php';

			$result = $conn->query("SELECT * FROM `instructor` WHERE `i_id`='$username' AND `password`='$password'");
			if($result->num_rows==1){
				$row = $result->fetch_assoc();

					$_SESSION['i_id']=$row['i_id'];
					$_SESSION['name']=$row['name'];
                    $_SESSION['email']=$row['email_id'];
                    $_SESSION['mobile_no']=$row['mobile_no'];
                    $_SESSION['department']=$row['department'];
					$result->free();
					header("Location: dashboardI.php");

			} else {
				echo "No Rows Selected";
                $msg = 'Wrong Username or Password !';
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
