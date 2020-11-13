<?php
require 'dbconn.php';



    $inInfo = json_decode(file_get_contents("php://input"));
    $username = $inInfo->username;
    $password = $inInfo->password;
    $repassword = $inInfo->username;
    $email = $inInfo->username;

    if (empty($email) || empty($password) || empty($re_password) || empty($f_name) || empty($m_name) || empty($l_name)) {
        header("Location: ../pages/login.php?error=emptyfields");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../pages/login.php?error=email");
    } else if (mb_strlen($password) < 8) {
        header("Location: ../pages/login.php?error=shortpass");
    } else if (strcmp($password, $re_password) !== 0) {
        $outp = 'password_check_error';
    } else {

    }

    $sql = "SELECT * FROM sensorData WHERE sensor = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $sensorName);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $outp = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($outp);

// } else {
//     header("Location: ../index.php");
//     exit();
// }
?>