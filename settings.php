<?php
session_start();
// IS COOKIE SET
if(!isset($_SESSION['userSession'])){
    header("Location: pages/login.php");
    exit();
}
require 'php/dbconn.php';

// CHECK IF SENSOR IS YOURS
$sensorId = $_GET['sensorId'];
$userId = $_SESSION['userId'];
$sql = "SELECT * FROM sensors WHERE sensors.user_id = $userId AND sensors.sensor_id = $sensorId";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
//echo $result;
if($num_rows != 1){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sensor</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <!-- <p>Welcome! Go to the BETA version by clicking <a href='index_beta.php'>here</a>.</p> -->
        <div id="header_left">
            <a href="index.php">
                <img id="header_img" src="images/big_healther_clear.png" alt="Healther">
            </a>
        </div>
        <div id='header_right'>
            <div class="headerSec">
                <a href="">
                    <p class='menu_option'><i class="fas fa-map-marked-alt"></i> Map</p>
                </a>
            </div>
            <div class="headerSec">
                <a href="">
                    <p class='menu_option'><i class="fas fa-user-circle"></i> Account</p>
                </a>
            </div>
            <div class="headerSec">
                <a href="php/logout.php">
                    <p class='menu_option'><i class="fas fa-sign-out-alt"></i> Logout</p>
                </a>
            </div>

        </div>
    </header>
    <div id="leftHalf">
    <br>
        <form>
            <input type="text" id="sensorName"> <br>
            <input type="button" onClick="updateSensor()" value="Update" class="buttonDes">
        </form>
    </div>
    <div id="rightHalf">
    
    </div>

    <script>
        
        function updateSensor() {
            let params = new URLSearchParams(location.search);
            let sensorId = params.get('sensorId');
            let newName = document.getElementById("sensorName").value;
            let dataToSend = JSON.stringify({
                sensorId: sensorId,
                newName: newName
            });
            console.log(dataToSend)
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert("Sensor updated");
                    window.locaton = "index.php";
                }
            };
            xmlhttp.open("POST", "php/updateSensor.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(dataToSend);
        }
    </script>
</body>
</html>