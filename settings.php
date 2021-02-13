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
    <link rel="icon" href="images/healther_clean.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">

    <!-- jQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

    <!-- materialize -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <meta name="author" content="Iliyan Petrov, Samuil Georgiev">

    <!-- Compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <!-- Compiled and minified JavaScript -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
</head>
<body>
    
    <?php include 'pages/header.php';?>

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
                    // alert("Sensor updated");
                    window.location.assign('index.php');
                }
            };
            xmlhttp.open("POST", "php/updateSensor.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(dataToSend);
        }
    </script>
</body>
</html>