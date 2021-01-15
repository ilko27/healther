<?php
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$username = $inInfo->username;
$password = $inInfo->password;
$re_password = $inInfo->re_password;
$email = $inInfo->email;

if (empty($email) || empty($password) || empty($re_password) || empty($username)) {
    $outp = 'error_empty_fields';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $outp = 'error_invalid_email';
} else if (mb_strlen($password) < 8) {
    $outp = 'error_short_password';
} else if (strcmp($password, $re_password) !== 0) {
    $outp = 'error_password_check';
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
            $hash_code = md5(rand(666,69420)); //easter egg, kind of
            // mysqli_stmt_close($stmt);
            // mysqli_close($conn);
            // require 'dbconn.php';
            $sql = "INSERT INTO users (email, pass, username, status) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $outp = 'error_sql_error2';
            } else {
                $hash_pass = md5($password);
                // $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssss", $email, $hash_pass, $username, $hash_code);
                mysqli_stmt_execute($stmt);

                // $confirm_link = "http://www.healther.online/pages/confirm.php?email=$email&code=$hash_code";
                // $cancel_link = "https://www.healther.online/pages/false_email.php?email=$email";

                $message = 
                    "
                    This email address has been used as a registration email for Healther. <br/>
                    If it was you who registered, <br/>
                    go ahead and verify your account by clicking <a href='https://www.healther.online/pages/confirm.php?email=$email&code=$hash_code'>here</a>. <br/>



                    If it was not you who registered, <br/>
                    please inform us by clicking <a href='https://www.healther.online/pages/false_email.php?email=$email'>here</a>.
                    ";

                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= 'To: '.$username.' <'.$email.'>' . "\r\n";
                $headers .= 'From: Healther <confirm_no_reply@healther.online>' . "\r\n";

                mail($email,"Healther Registration",$message,$headers);

                $outp = 'success';
            }
        }
    }
}

echo json_encode($outp);

?>