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


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
    <div class="leftDiv">
        <div class="row center-align">
            <form class="textform">
                <p id='message'></p>
                <!-- <input type="email" id="email" placeholder="email" class="validate"> <br>
                <input type="password" id="password" placeholder="Password"> <br> -->
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="text" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <input type="button" onclick="send()" value="Log In" class="waves-effect waves-light btn" style="outline: none">
                <p>Sign up <a href="signup.php">Here</a></p>
            </form>
        </div>
    </div>
    
    <script>
        function send(){
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            //debugger;
            var xmlhttp = new XMLHttpRequest();
            var toSend = JSON.stringify({
                email: email,
                password: password
            });
            xmlhttp.onreadystatechange = function(){
                //alert("Response: " + this.responseText );
                if(this.readyState == 4 && this.status == 200){
                    if(JSON.parse(this.responseText) == "success"){
                        document.getElementById("message").innerHTML = "Success";
                        window.location.href = "../";
                    } else {
                        document.getElementById("message").innerHTML = JSON.parse(this.responseText);
                    }
                }
            };
            xmlhttp.open("POST", "../php/login.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //alert("Request: " + toSend);
            xmlhttp.send(toSend);
        }
    </script>
</body>
</html>
