<?php
session_start();
if(!isset($_SESSION['userSession'])){
    header("Location: pages/login.php");
    exit();
} else {
    require 'php/dbconn.php';
}
?>
<script>
if (screen.width <= 991) {
    location.href = "index_mobile.php";
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Healther</title>
    <meta name="description" content="Official home of Healther">
    <link rel="icon" href="images/healther_clean.png" type="image/gif" sizes="16x16">

    <meta property="image" content="https://healther.online/images/healther_clean.png" />
    <meta name="keywords" content="health, air, aqi, temp, well-being, home, healther">

    <script src="https://kit.fontawesome.com/3186fbbd0c.js" crossorigin="anonymous"></script>

    <!-- charts resources  -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <meta charset="UTF-8">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <meta name="author" content="Iliyan Petrov, Samuil Georgiev">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"> -->
    
</head>

<body>   

    <?php include 'pages/header.php';?>
    <button onclick="setLS('en')">EN</button>
    <button onclick="setLS('bg')">BG</button>

    <div id="leftHalf" class="half">

        <?php
        $userId = $_SESSION['userId'];
        $sqlQuery = "SELECT * FROM `sensors` WHERE user_id = ".$userId;
        $result = $conn -> query($sqlQuery);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sensorId = $row['sensor_id'];
                $sensorName = $row['sensor_name'];
                $sensorQuery = "SELECT * FROM sensorData WHERE sensor = ".$sensorId." ORDER BY datId DESC LIMIT 1";
                $sensorReading= $conn -> query($sensorQuery);
                $sensData = $sensorReading->fetch_assoc();
                
                echo "
                    <div class='card text-white bg-secondary mb-3'>
                        <div class='card-body' onclick='getData(".$row['sensor_id'].", `".$row['sensor_name']."`)'>
                            <h3 class='card-title'>".$row['sensor_name']."</h3>
                            <span>".$sensData['readingTime']."</span>
                            <table class='table text-white table-borderless'>
                                <tbody>
                                    <tr><td class='labelTd'><script>translate('concentration', language);</script></td><td class='numberTd'>".($sensData['aqi']/100)." μg/m³</td></tr>
                                    <tr><td class='labelTd'><script>translate('temperature', language);</script></td><td class='numberTd'>".$sensData['temperatureC']." °C</td></tr>
                                    <tr><td class='labelTd'><script>translate('humidity', language);</script></td><td class='numberTd'>".$sensData['humidity']." %</td></tr>
                                    <tr><td class='labelTd'><script>translate('pressure', language);</script></td><td class='numberTd'>".$sensData['pressure']." hPa</td></tr>        
                                </tbody>
                            </table>
                        </div>
                        <div class='card-footer'>
                            <button type='button' class='btn btn btn-outline-light' onclick='editSensor($sensorId)'><script>translate('rename', language);</script></button>
                            <button type='button' class='btn btn btn-outline-light' onclick='removeSensor($sensorId)'><script>translate('remove', language);</script></button>
                            <span class='float-end align-middle'>Id:".$row['sensor_id']."</span>
                        </div>
                    </div>
                ";

            }
            echo "
            <script>
                let chartId = ".$sensorId.";                
                let chartName = '".$sensorName."';
            </script>            
            ";

        } else {
            echo "You don't have any sensors added. You can add one by clicking <a onclick='addSensor()' class='waves-effect waves-light btn'>Here</a>";
        }
        ?>


    </div>

    
    <div id="rightHalf" class="half">
        <div id='chartsDiv'>
            <h4 id="staticBackdropLabel"></h4>
            <div class="charts">
                <div class="chartdiv" id="aqi_chartdiv"></div>
            </div>
            <div class="charts">
                <div class="chartdiv" id="t_chartdiv"></div>
            </div>
            <div class="charts">
                <div class="chartdiv" id="h_chartdiv"></div>
            </div>
        </div>
    </div>

    
    <script src="js/charts.js"></script>
    

    <script>
        function editSensor(sensorId) {
            let new_name = prompt(dictionary["enterNewName"][language], "");
            if (new_name == null || new_name == "") {
            txt = "User cancelled.";
            } else {
                updateSensor(sensorId, new_name);
            }

        }

        function updateSensor(sensor_id, new_name) {
            let sensorId = sensor_id;
            let newName = new_name;
            let dataToSend = JSON.stringify({
                sensorId: sensorId,
                newName: newName
            });
            console.log(dataToSend)
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.assign('index.php');
                }
            };
            xmlhttp.open("POST", "php/updateSensor.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(dataToSend);
        }

        

        function removeSensor(sensorId) {
            let idToSend = JSON.stringify({
                sensorId: sensorId
            });
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xmlhttp.open("POST", "php/deleteSensor.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(idToSend);
        }

        
    </script>
</body>
</html>