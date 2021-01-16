<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sign.css">
</head>
<body>
    <form style="text-align: center;">
        <input type="text" id="email" placeholder="email" class="textplace"> <br>
        <input type="password" id="password" placeholder="Password" class="textplace"> <br>
        <input type="button" onClick="send()" value="Sign Up" class="buttonDes">
        <p>Sign up <a href="signup.php">Here</a></p>
    </form>
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
                        window.location = "../index.php";
                    } else {
                        document.getElementById("message").innerHTML = JSON.parse(this.responseText);
                    }
                }
            };
            xmlhttp.open("POST", "../php/signin.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //alert("Request: " + toSend);
            xmlhttp.send(toSend);
        }
    </script>
</body>
</html>
