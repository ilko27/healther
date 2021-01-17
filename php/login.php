<?php
session_start();
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$email = $inInfo->email;
$password = $inInfo->password;
// $hash_pass = md5($password);
// $hash_pass = password_hash($password, PASSWORD_BCRYPT);
// $hash_pass = '$2y$10$XQH.viN04JTcVf2aVffgPOR3GRVav/rxh4bb/vSPh4Jx2F97Ot25K';

$sql = "SELECT user_id, pass FROM users WHERE email = ? AND status = 1";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_id, $hash_pass);
if (mysqli_stmt_fetch($stmt)) {
    if (password_verify($password, $hash_pass)) {
        $outp = "success";
    } else {
        $outp = "wrong";
    }
} else {
    $outp = "error";
    echo json_encode($outp);
}
$outp = "success";
$_SESSION['userSession'] = "Hello Mr. User";
echo json_encode($outp);
?>