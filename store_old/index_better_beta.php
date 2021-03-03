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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/3186fbbd0c.js" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/healther_clean.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/index_beta.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <title>Healther</title>
</head>
<body>
    <header>
        <p>Welcome! Click on the card that you want to know more about.</p>
    </header>
        <select id="sensorNames">
            <option value="IlkoSensor">IlkoSensor</option>
            <option value="Kuhnq">Kuhnq</option>
            <option value="Bazata">Bazata</option>
            <option value="Terasa">Terasa</option>
        </select>
        <select id="rowsSelect">
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <button onclick="selectData()">Get Data</button>
    <div id="quickInfo">
        <div class="cardGroup">
            <div id="" class="card" onclick="toChart('temp')">
                <div class="innerCard">
                    <p class="text1">Temperature <i class="fas fa-thermometer-half"></i></p>
                    <p id="lastTemp" class="text2">0.0</p>
                </div>
            </div>
            <div id="" class="card" onclick="toChart('humidity')">
                <div class="innerCard">
                    <p class="text1">Humidity <i class="fas fa-tint"></i></p>
                    <p id="lastHumidity" class="text2">0.0</p>
                </div>
            </div>
        <!-- </div> -->
        
        <!-- <div class="cardGroup excessGroup"> -->
            <div id="" class="card" onclick="toChart('airQI')">
                <div class="innerCard">
                    <p class="text1">AQI <i class="fas fa-cloud"></i></p>
                    <p class="text2">69</p>
                </div>
            </div>
            <div id="" class="card" onclick="toChart('pressure')">
                <div class="innerCard">
                    <p class="text1">Air Pressure <i class="fab fa-cloudscale"></i></p>
                    <p class="text2">420</p>
                </div>
            </div>
        </div> 
    </div>
        <!-- <div id='map'></div>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> -->
    <div id='chartsDiv'>
        <div class="charts">
            <canvas id="bigChart">
                
            </canvas>
            <!-- <canvas id="humidityChart">

            </canvas> -->
        </div>
    </div>

    
    <script src="js/index_beta.js"></script>
    <script src="js/charts_beta.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>

    <script>
        function selectData(){
            var strUser = document.getElementById("sensorNames").value;
            var rowsSelect = document.getElementById("rowsSelect").value;
            getData(strUser, rowsSelect);
        }
        let temp = new Array();
        let humidity = new Array();
        let timestamps = new Array();

        function getData(sensorn, rowsSelect){
            
            temp = [];
            humidity = [];
            timestamps = [];
            var toSend = JSON.stringify({
                sensorName: sensorn,
                rowsSelect: rowsSelect
            });
            var xmlhttp = new XMLHttpRequest();
            let readingsData = [];
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    rs = JSON.parse(this.responseText);
                    for(let i = rs.length - 1; i >= 0; i--){
                        timestamps.push(rs[i].readingTime);
                        temp.push(rs[i].temperatureC);
                        humidity.push(rs[i].humidity);
                    }
                    toChart('temp');
                    colorCards(toAverage(temp), toAverage(humidity), temp[temp.length-1], humidity[humidity.length - 1]);
                    // toAverage(temp, "avTemp", "°C");
                    // toAverage(humidity, "avHumidity", "%");
                    // document.getElementById("lastTemp").innerHTML = String(temp[temp.length-1]) + "°C";
                    // document.getElementById("lastHumidity").innerHTML = String(humidity[humidity.length-1]) + "%";
                }
            };
            xmlhttp.open("POST", "php/getData.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(toSend);
        }

        var ctx = document.getElementById('bigChart').getContext('2d');
        // var ctx2 = document.getElementById('humidityChart').getContext('2d');
        let bChart = makeChart(ctx, timestamps, temp, 'Temperature', 'rgba(255, 115, 105, 0.5)');
        // let hChart = makeChart(ctx2, timestamps, humidity, 'Humidity', 'rgba(38, 71, 255, 0.5)');

        window.onload = selectData();
    </script>
</body>
</html>