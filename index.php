<?php
session_start();
if(!isset($_SESSION['userSession'])){
    header("Location: pages/login.php");
    exit();
} else {
    $url = "http://api.openweathermap.org/data/2.5/find?lon=27.8333&lat=43.5667&units=metric&type=accurate&mode=xml&APPID=d53b7d430ab2e82f0aaa4572bdcb38c9";
    $getWeather = simplexml_load_file($url);
    $getTemp = $getWeather->list->item->temperature['value'];
    $getHumidity = $getWeather->list->item->humidity['value'];

    require 'php/dbconn.php';
}
?>
<!-- <script>
if (screen.width <= 1100) {
    location.href = "https://m.healther.online";
}
</script> -->

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

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <meta name="author" content="Iliyan Petrov, Samuil Georgiev">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    
</head>

<body>   

    <?php include 'pages/header.php';?>

    
    <div id="leftHalf">

    <?php
        $userId = $_SESSION['userId'];
        $sqlQuery = "SELECT * FROM `sensors` WHERE user_id = ".$userId;
        $result = $conn -> query($sqlQuery);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sensorId = $row['sensor_id'];
                $sensorQuery = "SELECT * FROM sensorData WHERE sensor = ".$sensorId." ORDER BY datId DESC LIMIT 1";
                $sensorReading= $conn -> query($sensorQuery);
                $sensData = $sensorReading->fetch_assoc();
                echo "  <div class='row'>
                            <div class='col s12 m12'>
                                <div class='card blue-grey darken-1' onclick='getData(".$row['sensor_id'].")'>
                                    <div class='card-content white-text'>
                                        <span class='card-title'>".$row['sensor_name']."</span>
                                        <table>
                                            <tr><td class='labelTd'>PM2.5</td><td class='numberTd'>23</td></tr>
                                            <tr><td class='labelTd'>Temperature</td><td class='numberTd'>".$sensData['temperatureC']."</td></tr>
                                            <tr><td class='labelTd'>Humidity</td><td class='numberTd'>".$sensData['humidity']."</td></tr>
                                            <tr><td class='labelTd'>Pressure</td><td class='numberTd'>".$sensData['pressure']."</td></tr>        
                                        </table>
                                    </div>
                                    <div class='card-action'>
                                        <a onclick='editSensor($sensorId)'>Edit</a>
                                        <a onclick='removeSensor($sensorId)'>Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
            }
            $_SESSION['sensorId'] = $sensorId;
        } else {
            echo "You don't have any sensors added. You can add one by clicking <a onclick='addSensor()' class='waves-effect waves-light btn'>Here</a>";
        }
    ?>


    </div>
    
    <div id="rightHalf">
        <div id='chartsDiv'>
            <div class="charts">
                <div class="chartdiv" id="aqi_chartdiv"></div>
            </div>
            <div class="charts">
                <div class="chartdiv" id="t_chartdiv"></div>
            </div>
            <div class="charts">
                <div class="chartdiv" id="h_chartdiv"></div>
            </div>
            <!-- <div class="charts"><canvas id="humidityChart"></canvas></div> -->
        </div>
    </div>

    
    <!-- <script src="js/index.js"></script> -->
    <script src="js/charts.js"></script>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script> -->

    <script>
        function editSensor(sensorId) {
            window.location = "settings.php?sensorId=" + sensorId;
        }

        function addSensor(){
            var sensorId = prompt("Enter sensor id", "");

            if (sensorId == null || sensorId == "") {
            txt = "User cancelled the prompt.";
            } else {
                addInDB(sensorId);
            }
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

        function addInDB(sensorId){
            let idToSend = JSON.stringify({
                sensorId: sensorId
            });
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(JSON.parse(this.responseText));
                    location.reload();
                }
            };
            xmlhttp.open("POST", "php/addSensor.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(idToSend);
        }
    </script>
</body>
</html>
