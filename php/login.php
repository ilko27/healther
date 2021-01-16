<?php
session_start();
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$email = $inInfo->email;
$password = $inInfo->password;
$hash_pass = md5($password);
// $hash_pass = password_hash($password, PASSWORD_DEFAULT);
// $hash_pass = '$2y$10$XQH.viN04JTcVf2aVffgPOR3GRVav/rxh4bb/vSPh4Jx2F97Ot25K';

$sql = "SELECT * FROM users WHERE email = ? AND pass = ? AND status = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hash_pass);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result) != 1){
    $outp = $resultCheck;
} else {
    $outp = "success";
    $_SESSION['userSession'] = "Hello Mr. User";
}

echo json_encode($outp);
?>