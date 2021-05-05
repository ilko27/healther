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
    <title>Healther Login</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>
<body>
    <script src="../js/languages.js"></script>
    <div id="container">

        <a href="../">
            <img id="header_img_big" src="../images/big_healther_clear.png" alt="Healther">
        </a>

        <div id="form">
            <h5 id="message"></h5>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput"><script>translate('emailAddress', language);</script></label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword"><script>translate('password', language);</script></label>
            </div>
            <div id="buttons">
                <button type='button' class='btn btn btn-outline-light' onclick='send()'><script>translate('login', language);</script></button>
                <button type='button' class='btn btn btn-outline-light' onclick="location.href='signup.php';"><script>translate('signup', language);</script></button>
                <button id='button_modal' type="button" class="btn btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal"><script>translate('forgottenPassword', language);</script></button>
            </div>



        </div>

    </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><script>translate('forgottenPassword', language);</script></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput_CP" placeholder="name@example.com">
                            <label for="floatingInput_CP"><script>translate('emailAddress', language);</script></label>
                        </div>
                </div>
                <div class="modal-footer">
                    <h6 id="modal_message"></h6>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><script>translate('close', language);</script></button>
                    <button type="button" class="btn btn-primary" onclick="change_pass()"><script>translate('continue', language);</script></button>
                </div>
                </div>
            </div>
            </div>

    
    <script>

        function send(){
            let task = 'login';
            let email = document.getElementById("floatingInput").value;
            let password = document.getElementById("floatingPassword").value;
            var xmlhttp = new XMLHttpRequest();
            var toSend = JSON.stringify({
                task: task,
                email: email,
                password: password
            });
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    if(JSON.parse(this.responseText) == "success"){
                        window.location.href = "../";
                    } else {
                        document.getElementById("message").innerHTML = JSON.parse(this.responseText);
                        document.getElementById("floatingInput").classList.add("is-invalid");
                        document.getElementById("floatingPassword").classList.add("is-invalid");
                    }
                }
            };
            xmlhttp.open("POST", "../php/login.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(toSend);
        }

        
        function change_pass(){
            let task = 'change_pass';
            let email = document.getElementById("floatingInput_CP").value;
            var xmlhttp = new XMLHttpRequest();
            var toSend = JSON.stringify({
                task: task,
                email: email
            });
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("modal_message").innerHTML = JSON.parse(this.responseText);
                }
            };
            xmlhttp.open("POST", "../php/login.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(toSend);
        }
    </script>

</body>
</html>
