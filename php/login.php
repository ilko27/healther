<?php
session_start();
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$email = $inInfo->email;
$password = $inInfo->password;
$hash_pass = md5($password);
// $hash_pass = password_hash($password, PASSWORD_DEFAULT);
// $hash_pass = '$2y$10$XQH.viN04JTcVf2aVffgPOR3GRVav/rxh4bb/vSPh4Jx2F97Ot25K';

<<<<<<< HEAD
$sql = "SELECT user_id, pass FROM users WHERE email = ? AND status = 1";
$stmt = mysqli_stmt_init($conn);
=======
$sql = "SELECT user_id, username FROM users WHERE email = ? AND pass = ? AND status = 1";
$stmt = mysqli_stmt_init($conn); 
>>>>>>> 25cbd018403bcf5e2d3a54c2a21862e27b9c27da
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ss", $email, $hash_pass);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_id, $username);
if (mysqli_stmt_fetch($stmt)) {
    // mysqli_stmt_store_result($stmt);
    // $resultCheck = mysqli_stmt_num_rows($stmt);
    // if($resultCheck != 1){
        // 
    // } else {
        $outp = "success";
<<<<<<< HEAD
    } else {
        $outp = "wrong";
    }
=======
        $_SESSION['userSession'] = "Hello Mr. User";
        $_SESSION['email'] = $email;
        $_SESSION['userId'] = $user_id;
        $_SESSION['username'] = $username;
    // }
>>>>>>> 25cbd018403bcf5e2d3a54c2a21862e27b9c27da
} else {
    $outp = "Wrong email or password.";
}
echo json_encode($outp);
?>