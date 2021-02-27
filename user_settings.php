<?php
session_start();
if(!isset($_SESSION['userSession'])){
    header("Location: pages/login.php");
    exit();
} else {
    // require 'php/dbconn.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account Settings</title>
    <meta name="description" content="Official home of Healther">
    <link rel="icon" href="images/healther_clean.png" type="image/gif" sizes="16x16">

    <meta property="image" content="https://healther.online/images/healther_clean.png" />
    <meta name="keywords" content="health, air, aqi, temp, well-being, home, healther">

    <meta charset="UTF-8">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <meta name="author" content="Iliyan Petrov, Samuil Georgiev">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/user_settings.css">
    
</head>

<body>   

    <?php include 'pages/header.php';?>

    <div id="container">

    <h5 id="message"></h5>
    <br>
    <div class="accordion" id="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Change email address
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
            <div class="accordion-body">
                
                        
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInputEmail" placeholder="Email address">
                    <label for="floatingInputEmail">New email address</label>
                </div>
                <div id="buttons">
                    <button type='button' class='btn btn btn-outline-light' onclick='change_email()'>Save</button>
                </div>

            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Change password
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
            <div class="accordion-body">
                
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingRepeatPassword" placeholder="Repeat password">
                    <label for="floatingRepeatPassword">Repeat password</label>
                </div>
                <div id="buttons">
                    <button type='button' class='btn btn btn-outline-light' onclick='change_password()'>Save</button>
                </div>

            
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Change username
            </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
            <div class="accordion-body">
            
            
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInputUsername" placeholder="Username">
                    <label for="floatingInputUsername">Username</label>
                </div>
                <div id="buttons">
                    <button type='button' class='btn btn btn-outline-light' onclick='change_username()'>Save</button>
                </div>

            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Delete account
            </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordion">
            <div class="accordion-body">
            
        
                <div id="buttons">
                    <button type='button' class='btn btn btn-outline-light' onclick='delete_user()'>Delete account</button>
                </div>


            </div>
            </div>
        </div>
    </div>
  
    </div>

    <script>

        function change_email() {
            let task = 'change_email';
            let new_email = document.getElementById("floatingInputEmail").value;
            let dataToSend = JSON.stringify({
                task: task,
                new_email: new_email
            });
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(JSON.parse(this.responseText));
                    document.getElementById("message").innerHTML = "Success";
                }
            };
            xmlhttp.open("POST", "php/user_settings.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(dataToSend);
        }

        function change_password() {
            let task = 'change_email';
            let new_password = document.getElementById("floatingPassword").value;
            let new_re_password = document.getElementById("floatingRepeatPassword").value;
            let dataToSend = JSON.stringify({
                task: task,
                new_password: new_password,
                new_re_password: new_re_password
            });
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("message").innerHTML = "Success";
                }
            };
            xmlhttp.open("POST", "php/user_settings.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(dataToSend);
        }

        function change_username() {
            let task = 'change_email';
            let new_username = document.getElementById("floatingInputUsername").value;
            let dataToSend = JSON.stringify({
                task: task,
                new_username: new_username
            });
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("message").innerHTML = "Success";
                }
            };
            xmlhttp.open("POST", "php/user_settings.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(dataToSend);
        }
        function delete_user() {
            let task = 'delete_user';
            let dataToSend = JSON.stringify({
                task: task
            });
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.assign('php/logout.php');
                }
            };
            xmlhttp.open("POST", "php/user_settings.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(dataToSend);
        }

        
    </script>
</body>
</html>