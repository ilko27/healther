<?php
session_start();
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$email = $inInfo->email;
$password = $inInfo->password;
$hash_pass = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT email FROM users WHERE email = ? AND password = ?";
$stmt = mysqli_stmt_init($conn); 
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ss", $email, $hash_pass);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$resultCheck = mysqli_stmt_num_rows($stmt);
if($resultCheck != 1){
    $outp = "Fucking hell dude, something is wrong........ good luck :)";
} else {
    $outp = "success";
    $_SESSION['userSession'] = "Hello Mr. User";
}

echo json_encode($outp);
?>