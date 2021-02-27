<?php
session_start();
if(!isset($_SESSION['userSession'])){
    $outp = 'errorNoUser';
}  else {
    require 'dbconn.php';
    
    $inInfo = json_decode(file_get_contents("php://input"));
    $task = $inInfo->task;

    if ($task == 'change_email') {
        $old_email = $_SESSION['email'];
        $email = $inInfo->new_email;

        if (empty($email)) {
            $outp = 'There are empty fields.';
        } else if ($old_email == $email) {
            $outp = 'The email is the same.';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $outp = 'The email is invalid.';
        } else {
            $sql = "SELECT email FROM users WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $outp = 'error_sql_error1';
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    $outp = 'The email is already in use.'; 
                } else {
                    $sql = "UPDATE users SET users.update_col = ? WHERE users.email = ? AND users.status = 1;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        $outp = 'error_sql_error2';
                    } else {
                        $hash_email = md5($email);
                        mysqli_stmt_bind_param($stmt, "ss", $hash_email, $old_email);
                        mysqli_stmt_execute($stmt);


                        $message = 
                            "
                            This email address has been used for Healther. <br/>
                            If it was you, <br/>
                            go ahead and verify your email by clicking <a href='https://www.healther.online/pages/confirm.php?task=email&email=$email&code=$hash_email'>here</a>. <br/>



                            If it was not you, <br/>
                            please inform us by clicking <a href='https://www.healther.online/pages/false_email.php?code=$hash_email'>here</a>.
                            ";

                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                        $headers .= 'To: '.$username.' <'.$email.'>' . "\r\n";
                        $headers .= 'From: Healther <confirm_no_reply@healther.online>' . "\r\n";

                        mail($email,"Healther Confirmation",$message,$headers);

                        $outp = 'success';
                    }
                }
            }
        }
    } else if ($task == 'change_password') {
        $userId = $_SESSION['userId'];
        $old_password = $inInfo->old_password;
        $password = $inInfo->new_password;
        $re_password = $inInfo->new_re_password;

        if (empty($old_password) ||empty($password) || empty($re_password)) {
            $outp = 'There are empty fields.';
        } else if (mb_strlen($password) < 8) {
            $outp = 'Your password is too short.';
        } else if (strcmp($password, $re_password) !== 0) {
            $outp = 'Passwords do not match.';
        } else {
            $sql = "UPDATE users SET users.pass = ? WHERE users.user_id = ? AND users.pass = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $outp = 'error_sql_error2';
            } else {
                $hash_pass = md5($password);
                $hash_old_pass = md5($old_password);
                mysqli_stmt_bind_param($stmt, "sis", $hash_pass, $userId, $hash_old_pass);
                mysqli_stmt_execute($stmt);
                if (mysqli_affected_rows($conn)!=0) {   //check for changes
                    $outp = 'success';
                } else {
                    $outp = 'Wrond password.';
                }
            }
        } 
    } else if ($task == 'change_username') {
        $userId = $_SESSION['userId'];
        $username = $inInfo->new_username;

        if (empty($username)) {
            $outp = 'There are empty fields.';
        } else {
            $sql = "UPDATE users SET users.username = ? WHERE users.user_id = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $outp = 'error_sql_error2';
            } else {
                mysqli_stmt_bind_param($stmt, "si", $username, $userId);
                mysqli_stmt_execute($stmt);
                $outp = 'success';
            }
        } 
    }







    
}

echo json_encode($outp);

?>