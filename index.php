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

    <meta property="og:image" content="https://healther.online/images/healther_clean.png" />
    <meta name="keywords" content="health, air, aqi, temp, well-being, home">

    <script src="https://kit.fontawesome.com/3186fbbd0c.js" crossorigin="anonymous"></script>

    <!-- charts resources  -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <meta charset="UTF-8">


    <meta name="author" content="Iliyan Petrov, Samuil Georgiev">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    
</head>

<body>
    <header>
        <!-- <p>Welcome! Go to the BETA version by clicking <a href='index_beta.php'>here</a>.</p> -->
        <div id="header_left">
            <a href="">
                <img id="header_img" src="images/big_healther_clear.png" alt="Healther">
            </a>
        </div>
        <div id='header_right'>
            <div id='map_path'>
                <a href="">
                    <p><i class="fas fa-map-marked-alt"></i> Map</p>
                </a>
            </div>
            <div id='account_path'>
                <a href="">
                    <p><i class="fas fa-user-circle"></i> Account</p>
                </a>
            </div>
            <div id='logout_path'>
                <a href="php/logout.php">
                    <p><i class="fas fa-sign-out-alt"></i> Logout</p>
                </a>
            </div>

        </div>
    </header>
    

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
            echo "<div class='card_div'  onclick='getData(".$row['sensor_id'].")'>
            <p class='nameTd'>".$row['sensor_name']."</p>
            <table class='sensorCard'>
            <tr><td class='labelTd'>PM2.5</td><td class='numberTd'>23</td></tr>
            <tr><td class='labelTd'>Temperature</td><td class='numberTd'>".$sensData['temperatureC']."</td></tr>
            <tr><td class='labelTd'>Humidity</td><td class='numberTd'>".$sensData['humidity']."</td></tr>
            <tr><td class='labelTd'>Pressure</td><td class='numberTd'>".$sensData['pressure']."</td><td><button onclick='editSensor(".$sensorId.")'><i class='fas fa-cog'></i> Options</td></button></tr>
            </table></div>";
        }
        } else {
        echo "Your id is ".$userId.$_SESSION['userSession'];
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
            window.location = "https://www.healther.online/settings.php?sensorId=" + sensorId;
        }
        
        

        // window.onload = selectData();
    </script>
</body>
</html>
