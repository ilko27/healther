<?php
if (isset($_GET["email"]) && isset($_GET["code"])) {
    $email = $_GET["email"];
    $hash_code =  $_GET["code"];

    require '../php/dbconn.php';

    
    $sql = "SELECT email FROM users WHERE email=? AND code = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header( "Location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $email, $code);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck == 1) {
            $sql = "UPDATE users SET active = 1, code = 20030815 WHERE email = ? AND code = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header( "Location: ../index.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "si", $email, $code);
                mysqli_stmt_execute($stmt);

                echo '<br><br><br><p style="text-align: center;">Акаунтът Ви беше успешно активиран.</p>';
            }
        } else {
            header("Location: ../index.php?error");
            exit();
        }
    }    
} else {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/healther_clean.png" type="image/gif" sizes="16x16">
</head>
<body>  
    <div></div>


    <script></script>
</body>
</html>
