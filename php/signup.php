<?php
require 'dbconn.php';



    $inInfo = json_decode(file_get_contents("php://input"));
    $username = $inInfo->username;
    $password = $inInfo->password;
    $repassword = $inInfo->username;
    $email = $inInfo->username;

    if (empty($email) || empty($password) || empty($re_password) || empty($f_name) || empty($m_name) || empty($l_name)) {
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
            $outp = 'error_sql_error';
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                $outp = 'error_existing_email'; 
            } else {
                $code = rand(100000,999999);
                $sql = "INSERT INTO users (email, password, first_name, middle_name, last_name, code) VALUES (?, ?, ?, ?, ?, $code)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header( "Location: ../pages/login.php?error=sqlerror");
                    exit();
                } else {
                    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $email, $hash_pass, $f_name, $m_name, $l_name);
                    mysqli_stmt_execute($stmt);

                    $message = 
                        "
                        Confirm your account in Kino Klub Ikar.

                        Click the link below to verify your account.
                        http://ikar.bg.cm/pages/confirm.php?email=$email&code=$code
                        ";
                    mail($email,"Ikar Confirmation",$message,"From: donotreply@ikar.bg.cm");

                    header( "Location: ../pages/login.php?success");
                    exit();
                }
            }
        }
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