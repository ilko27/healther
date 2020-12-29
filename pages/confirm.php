<?php
if (isset($_GET["email"]) && isset($_GET["code"])) {    //check url for relevant data
    $email = $_GET["email"];
    $code =  $_GET["code"];

    require '../php/dbconn.php';

    
    $sql = "UPDATE users SET status = 1 WHERE email = ? AND status = ?;";  // activate user if email and code concur
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header( "Location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $email, $code);
        mysqli_stmt_execute($stmt);
        if (mysqli_affected_rows($conn)!=0) {   //check if changes have been made
            $out = true;
        } else {
            $out = false;
        }
        header('Refresh: 5; URL=https://www.healther.online/');
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
    <link rel="icon" href="../images/healther_clean.png" type="image/gif" sizes="16x16">
</head>
<body>  
    <div>
        <p>
            <?php
                if ($out == true) {
                    echo "Your account is now active.";
                } else {
                    echo "Unable to verify email.";
                }
            ?>
        </p>
        <p>We will automatically redirected you in a moment.</p>
    </div>


    <script></script>
</body>
</html>
