<?php
session_start();
if(!isset($_SESSION['userSession'])){
    $outp = 'NOTsuccess';
} else {
    require 'dbconn.php';
    
    $inInfo = json_decode(file_get_contents("php://input"));
    $task = $inInfo->task;
    if ($task == 'change_email') {
        $old_email = $_SESSION['email'];
        $email = $inInfo->new_email;

        if (empty($email)) {
            $outp = 'error_empty_fields';
        } else if ($old_email == $email) {
            $outp = 'error_same_email';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $outp = 'error_invalid_email';
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
                    $outp = 'error_existing_email'; 
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
                            please inform us by clicking <a href='https://www.healther.online/pages/false_email.php?email=$email'>here</a>.
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
    }







    
}

echo json_encode($outp);

?>