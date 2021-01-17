<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/healther_clean.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="../css/sign.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>  
    <div id="firsthalf">
        <form class="textform">
            <img class="healtherlogo" src="../images/healther.png"/>
            <p id='message'></p>
            <input type="email" id="email" placeholder="Email" class="textplace"> <br>
            <input type="text" id="username" placeholder="Username" class="textplace"> <br>
            <input type="password" id="password" placeholder="Password" class="textplace"> <br>
            <!-- <div class="g-recaptcha" data-sitekey="6LeUJf4ZAAAAALP-wiQtHkSNIttnWztFPTSImroI"></div> -->
            <input type="password" id="re_password" placeholder="Repeat Password" class="textplace"> <br>
            <input type="button" value="Sign Up" class="buttonDes" onclick="send()">
            <p>Sign in <a href="login.php">Here</a></p>
        </form>
    </div>

    <div id="secondhalf">
        <img class="skyphoto" src="../images/clouds.jpg"/>
    </div>

    <script>
        function send(){
            let username = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            let re_password = document.getElementById("re_password").value;
            let email = document.getElementById("email").value;
            //debugger;
            var xmlhttp = new XMLHttpRequest();
            var toSend = JSON.stringify({
                username: username,
                password: password,
                re_password: re_password,
                email: email
            });
            xmlhttp.onreadystatechange = function(){
                //alert("Response: " + this.responseText );
                if(this.readyState == 4 && this.status == 200){
                    if(JSON.parse(this.responseText) == "success"){
                        // window.location = "../index.php";
                        document.getElementById("message").innerHTML = "Please verify your email address using the link we've sent you.";
                    } else {
                        document.getElementById("message").innerHTML = JSON.parse(this.responseText);
                    }
                }
            };
            xmlhttp.open("POST", "../php/signup.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //alert("Request: " + toSend);
            xmlhttp.send(toSend);
        }
    </script>
</body>
</html>
