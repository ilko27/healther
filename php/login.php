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
$sql = "SELECT user_id FROM users WHERE email = ? AND pass = ? AND status = 1";
$stmt = mysqli_stmt_init($conn); 
=======
<<<<<<< HEAD
$sql = "SELECT * FROM users WHERE email = ? AND pass = ? AND status = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hash_pass);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result) != 1){
    $outp = $resultCheck;
=======
$sql = "SELECT user_id, pass FROM users WHERE email = ? AND status = 1";
$stmt = mysqli_stmt_init($conn);
>>>>>>> d17718e8dbcb10a17ccf85004733b0a2893d2cb7
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ss", $email, $hash_pass);
mysqli_stmt_execute($stmt);
<<<<<<< HEAD
mysqli_stmt_store_result($stmt);
$resultCheck = mysqli_stmt_num_rows($stmt);
if($resultCheck != 1){
    $outp = $resultCheck;
=======
mysqli_stmt_bind_result($stmt, $user_id, $hash_pass);
if (mysqli_stmt_fetch($stmt)) {
    if (password_verify($password, $hash_pass)) {
        $outp = "success";
    } else {
        $outp = "wrong";
    }
>>>>>>> 0b9162e22659afd34231627544492ed0ae0e2925
>>>>>>> d17718e8dbcb10a17ccf85004733b0a2893d2cb7
} else {
    $outp = "success";
    $_SESSION['userSession'] = "Hello Mr. User";
}

echo json_encode($outp);
?>