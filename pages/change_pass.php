<?php
session_start();
if (isset($_GET["email"]) && isset($_GET["code"])) { //  change pass
    $email = $_GET["email"];
    $code =  $_GET["code"];
    $outp = 'change';
} else if (isset($_GET["code"])) {
    session_start();
    require '../php/dbconn.php';
    $code =  $_GET["code"];
    $sql = "UPDATE users SET users.forget = '' WHERE users.forget = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $outp = 'error_sql_error';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $code);
        mysqli_stmt_execute($stmt);
        $outp = 'success';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/healther_clean.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="../css/sign.css">
    <title>Healther</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>
<body>
    <div id="container">

        <a href="../">
            <img id="header_img_big" src="../images/big_healther_clear.png" alt="Healther">
        </a>

        <?php
        if ($outp == 'change') {
            echo '
            <div id="form">
                <h5 id="message"></h5>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">New password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingRepeatPassword" placeholder="Repeat password">
                    <label for="floatingRepeatPassword">Repeat new password</label>
                </div>
                <div id="buttons">
                    <button type="button" class="btn btn btn-outline-light" onclick="send()">Save</button>
                </div>
            </div>            
            ';
        } else if ($outp == 'success') {
            echo '<p>Thank you.</p>';
        } else {
            echo '<p>Error.</p>';
        }

        

        ?>

    </div>



    
    <script>
        function send(){
            let task = 'forgotten_pass';
            let email = '<?php echo $email; ?>';
            let code = '<?php echo $code; ?>';
            let password = document.getElementById("floatingPassword").value;
            let re_password = document.getElementById("floatingRepeatPassword").value;
            let xmlhttp = new XMLHttpRequest();
            let toSend = JSON.stringify({
                task: task,
                email: email,
                code: code,
                password: password,
                re_password: re_password
            });
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    if(JSON.parse(this.responseText) == "success"){
                        window.location.href = "../";
                    } else {
                        document.getElementById("message").innerHTML = JSON.parse(this.responseText);
                        document.getElementById("floatingPassword").classList.add("is-invalid");
                        document.getElementById("floatingRepeatPassword").classList.add("is-invalid");
                    }
                }
            };
            xmlhttp.open("POST", "../php/change_pass.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(toSend);
        }
    </script>


</body>
</html>
