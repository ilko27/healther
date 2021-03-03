<?php
session_start();

$inInfo = json_decode(file_get_contents("php://input"));

$task = $inInfo->task;

if ($task == 'forgotten_pass') {
    require 'dbconn.php';
    $email = $inInfo->email;
    $code = $inInfo->code;
    $password = $inInfo->password;
    $re_password = $inInfo->re_password;
    
    if (empty($password) || empty($re_password)) {
        $outp = 'There are empty fields.';
    } else if (mb_strlen($password) < 8) {
        $outp = 'Your password is too short.';
    } else if (strcmp($password, $re_password) !== 0) {
        $outp = 'Passwords do not match.';
    } else {
        $sql = "UPDATE users SET users.pass = ?, users.forget = '' WHERE users.email = ? AND users.forget = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $outp = 'error_sql_error';
        } else {
            $hash_pass = md5($password);
            mysqli_stmt_bind_param($stmt, "sss", $hash_pass, $email, $code);
            mysqli_stmt_execute($stmt);
            if (mysqli_affected_rows($conn)!=0) {   //check for changes
                $outp = 'success';
            } else {
                $outp = 'Unable to comply.';
            }
        }
        
        
    }
    
    echo json_encode($outp);
    
}


?>