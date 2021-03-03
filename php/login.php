<?php
session_start();

$inInfo = json_decode(file_get_contents("php://input"));

$task = $inInfo->task;

if ($task == 'login') {
    require 'dbconn.php';
    $email = $inInfo->email;
    $password = $inInfo->password;
    $hash_pass = md5($password);
    
    $sql = "SELECT user_id, username FROM users WHERE email = ? AND pass = ? AND status = 1";
    $stmt = mysqli_stmt_init($conn); 
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $hash_pass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $username);
    if (mysqli_stmt_fetch($stmt)) {
            $outp = "success";
            $_SESSION['userSession'] = "Hello Mr. User";
            $_SESSION['email'] = $email;
            $_SESSION['userId'] = $user_id;
            $_SESSION['username'] = $username;
    } else {
        $outp = "Wrong email or password.";
    }
    
} else if ($task == 'change_pass') {
    require 'dbconn.php';
    $email = $inInfo->email;

    if (empty($email)) {
        $outp = "Empty fields.";
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
                $sql = "UPDATE users SET users.forget = ? WHERE users.email = ? AND users.status = 1;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        $outp = 'error_sql_error2';
                    } else {
                        $code = rand(100000,999999);
                        $hash_code = md5($code);
                        mysqli_stmt_bind_param($stmt, "ss", $hash_code, $email);
                        mysqli_stmt_execute($stmt);


                        $message = 
                            "
                            Somebody tried to reset your password for Healther. <br/>
                            If it was you, <br/>
                            go ahead and change your password by clicking <a href='https://www.healther.online/pages/change_pass.php?email=$email&code=$hash_code'>here</a>. <br/>



                            If it was not you, <br/>
                            please inform us by clicking <a href='https://www.healther.online/pages/change_pass.php?code=$hash_code'>here</a>.
                            ";

                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                        $headers .= 'To: '.$username.' <'.$email.'>' . "\r\n";
                        $headers .= 'From: Healther <confirm_no_reply@healther.online>' . "\r\n";

                        mail($email,"Healther Reset Password",$message,$headers);

                        $outp = 'Check your email.';
                    }


            } else {
                $outp = 'Unable to comply.';
            }
        }




        
    }

    
} else {
    header("Location: ../index.php");
    exit();
}


echo json_encode($outp);
?>