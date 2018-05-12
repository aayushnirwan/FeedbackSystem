<?php
    if(isset($_POST['email']) && isset($_POST['mobile']) ) {
        if( !empty($_POST['email']) && !empty($_POST['mobile']) ){
            $email = htmlentities($_POST['email']);
            $mobile = htmlentities($_POST['mobile']);

            require 'connect.php';
            if($update = $conn->query("UPDATE `student` SET `email_id`='$email', `mobile_no`='$mobile' WHERE `student`.`roll_no`='{$_SESSION['roll_no']}'")) {
                echo 'Updated';
                $_SESSION['email'] = $email;
                $_SESSION['mobile_no'] = $mobile;
            }
            else {
                echo 'Failed';
            }
        }
    }

?>
