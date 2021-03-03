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
    
}


echo json_encode($outp);
?>