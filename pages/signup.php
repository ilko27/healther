<?php
session_start();
if (isset($_SESSION['userSession'])) {
   header("Location: ../");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/healther_clean.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="../css/sign.css">
    <title>Healther Signup</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js"></script>
    <script>
        VANTA.WAVES({
        el: "body",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color: 0x0d548a
        })
    </script>
    
    <script src="../js/languages.js"></script>


    <div id="container">

        <a href="../">
            <img id="header_img_big" src="../images/big_healther_clear.png" alt="Healther">
        </a>

        <div id="form">
            <h5 id="message"></h5>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInputEmail" placeholder="Email address">
                <label for="floatingInputEmail"><script>translate('emailAddress', language);</script></label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInputUsername" placeholder="Username">
                <label for="floatingInputUsername"><script>translate('username', language);</script></label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword"><script>translate('password', language);</script></label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingRepeatPassword" placeholder="Repeat password">
                <label for="floatingRepeatPassword"><script>translate('rePassword', language);</script></label>
            </div>
            <div id="buttons">
                <button type='button' class='btn btn btn-outline-light' onclick='send()'><script>translate('signup', language);</script></button>
                <button type='button' class='btn btn btn-outline-light' onclick="location.href='login.php';"><script>translate('login', language);</script></button>
            </div>
        </div>

    </div>

    <script>
        function send(){
            let username = document.getElementById("floatingInputUsername").value;
            let password = document.getElementById("floatingPassword").value;
            let re_password = document.getElementById("floatingRepeatPassword").value;
            let email = document.getElementById("floatingInputEmail").value;
            var xmlhttp = new XMLHttpRequest();
            var toSend = JSON.stringify({
                username: username,
                password: password,
                re_password: re_password,
                email: email
            });
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(this.responseText);
                        document.getElementById("floatingInputUsername").classList.remove("is-invalid");
                        document.getElementById("floatingPassword").classList.remove("is-invalid");
                        document.getElementById("floatingRepeatPassword").classList.remove("is-invalid");
                        document.getElementById("floatingInputEmail").classList.remove("is-invalid");
                    if (response == "success") {
                        document.getElementById("message").innerHTML = "Please verify your email address.";
                    } else if (response == "error_empty_fields") {
                        document.getElementById("message").innerHTML = "There are empty fields.";
                        document.getElementById("floatingInputUsername").classList.add("is-invalid");
                        document.getElementById("floatingPassword").classList.add("is-invalid");
                        document.getElementById("floatingRepeatPassword").classList.add("is-invalid");
                        document.getElementById("floatingInputEmail").classList.add("is-invalid");
                    } else if (response == "error_invalid_email") {
                        document.getElementById("message").innerHTML = "The entered email is invalid.";
                        document.getElementById("floatingInputEmail").classList.add("is-invalid");
                    } else if (response == "error_short_password") {
                        document.getElementById("message").innerHTML = "Your password should be at least 8 symbols.";
                        document.getElementById("floatingPassword").classList.add("is-invalid");
                        document.getElementById("floatingRepeatPassword").classList.add("is-invalid");
                    } else if (response == "error_password_check") {
                        document.getElementById("message").innerHTML = "Your passwords don't match.";
                        document.getElementById("floatingRepeatPassword").classList.add("is-invalid");
                    } else if (response == "error_existing_email") {
                        document.getElementById("message").innerHTML = "The entered email is already in use.";
                        document.getElementById("floatingInputEmail").classList.add("is-invalid");
                    } else {    // SQL errors
                        console.log(JSON.parse(this.responseText));
                        document.getElementById("message").innerHTML = "Seek God ;).";
                    }
                }
            };
            xmlhttp.open("POST", "../php/signup.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(toSend);
        }
    </script>
</body>
</html>
