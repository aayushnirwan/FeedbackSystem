<?php
    if(isset($_POST['student_usrname']) && isset($_POST['student_psw']) ) {

        if( !empty($_POST['student_usrname']) && !empty($_POST['student_psw']) ){

            $username = htmlentities($_POST['student_usrname']);
			$password = htmlentities($_POST['student_psw']);

			require 'connect.php';

			$result = $conn->query("SELECT * FROM `student` WHERE `roll_no`='$username' AND `password`='$password'");
			if($result->num_rows==1){
				$row = $result->fetch_assoc();

					$_SESSION['roll_no']=$row['roll_no'];
					$_SESSION['name']=$row['name'];
                    $_SESSION['email']=$row['email_id'];
                    $_SESSION['mobile_no']=$row['mobile_no'];
                    $_SESSION['branch']=$row['branch'];
					$result->free();
					header("Location: dashboardS.php");

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
