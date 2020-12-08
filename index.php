<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/3186fbbd0c.js" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/healther_clean.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <title>Healther</title>
</head>
<body>
        <!-- <p id="avValues"> <i class="fas fa-thermometer-half"></i> Average Temparature <span id="avTemp" class="addInfo">0.0</span> Average Humidity <span id="avHumidity" class="addInfo">0.0</span> Last added <span id="lastTemp" class="addInfo"></span><span id="lastHumidity" class="addInfo"></span> on <span id="lastTime" class="addInfo"></span></span></p> -->
        <select id="sensorNames">
            <option value="IlkoSensor">IlkoSensor</option>
            <option value="Kuhnq">Kuhnq</option>
            <option value="Bazata">Bazata</option>
        </select>
        <select id="rowsSelect">
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <button onclick="selectData()">Get Data</button>
    <div id="quickInfo">
        <div class="cardGroup">
            <div class="card">
                <div class="innerCard">
                    <p class="text1">Average Temperature <i class="fas fa-thermometer-half"></i></p>
                    <p id="avTemp" class="text2">0.0</p>
                </div>
            </div>
            <div class="card">
                <div class="innerCard">
                    <p class="text1">Average Humidity <i class="fas fa-tint"></i></p>
                    <p id="avHumidity" class="text2">0.0</p>
                </div>
            </div>
        </div>
        <div class="cardGroup">
            <div class="card">
                <div class="innerCard">
                    <p class="text1">Temperature <i class="fas fa-thermometer-half"></i></p>
                    <p id="lastTemp" class="text2">0.0</p>
                </div>
            </div>

            <div class="card">
                <div class="innerCard">
                    <p class="text1">Humidity <i class="fas fa-tint"></i></p>
                    <p id="lastHumidity" class="text2">0.0</p>
                </div>
            </div>
        </div>    
    </div>
    <div id="chartsAndMap" style="background-color: red">
        <div id='map'></div>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <div id='chartsDiv'>
            <div class="charts"><canvas id="tempChart"></canvas></div>
            <div class="charts" style="margin-top: 20px"><canvas id="humidityChart"></canvas></div>
        </div>
    </div>

    
    <script src="js/index.js"></script>
    <script src="js/charts.js"></script>
    
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
                    toChart();
                    toAverage(temp, "avTemp", "°C");
                    toAverage(humidity, "avHumidity", "%");
                    document.getElementById("lastTemp").innerHTML = String(temp[temp.length-1]) + "°C";
                    document.getElementById("lastHumidity").innerHTML = String(humidity[humidity.length-1]) + "%";
                    document.getElementById("lastTime").innerHTML = String(timestamps[timestamps.length - 1]);
                }
            };
            xmlhttp.open("POST", "php/getData.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(toSend);
        }
        var ctx = document.getElementById('tempChart').getContext('2d');
        var ctx2 = document.getElementById('humidityChart').getContext('2d');
        let tChart = makeChart(ctx, timestamps, temp, 'Temperature', 'rgba(255, 115, 105, 0.5)');
        let hChart = makeChart(ctx2, timestamps, humidity, 'Humidity', 'rgba(38, 71, 255, 0.5)');

        window.onload = selectData();
    </script>
</body>
</html>
