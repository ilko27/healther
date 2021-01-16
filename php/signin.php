<?php
session_start();
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$email = $inInfo->email;
$password = $inInfo->password;
$hash_pass = md5($password);


// $sql = "SELECT email FROM users WHERE email = ? AND password = ?";
// $stmt = mysqli_stmt_init($conn); 
// $conn->prepare($sql);
// mysqli_stmt_bind_param($stmt, "ss", $email, $hash_pass);
// mysqli_stmt_execute($stmt);
// mysqli_stmt_store_result($stmt);

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND pass = ?");
$stmt->bind_param("ss", $email, $hash_pass);
$stmt->execute();
$result = $stmt->get_result();

$resultCheck = mysqli_stmt_num_rows($result);
if($resultCheck != 1){
    $outp = "Fucking hell dude, something is wrong........ good luck :)".$hash_pass;
} else {
    $outp = "success";
    $_SESSION['userSession'] = "Hello Mr. User";
}

echo json_encode($outp);
?>