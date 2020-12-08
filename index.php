<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/healther_clean.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <title>Healther</title>
</head>
<body>
    <header id="header">    
        <p id="avValues">Average Temparature <span id="avTemp" class="addInfo">0.0</span> Average Humidity <span id="avHumidity" class="addInfo">0.0</span> Last added <span id="lastTemp" class="addInfo"></span><span id="lastHumidity" class="addInfo"></span> on <span id="lastTime" class="addInfo"></span></span></p>
        <select id="sensorNames">
            <option value="IlkoSensor">IlkoSensor</option>
            <option value="Kuhnq">Kuhnq</option>
            <option value="Bazata">Bazata</option>
        </select>
        <select id="timeSelect">
            <option value="86400000">1 Day</option>
            <option value="604800000">1 Week</option>
            <option value="2419200000">1 Month</option>
        </select>
        <button onclick="selectData()">Get Data</button>
    </header>

    <div id='map'></div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <div id='chartsDiv'>
        <div class="charts"><canvas id="tempChart"></canvas></div>
        <div class="charts" style="margin-top: 20px"><canvas id="humidityChart"></canvas></div>
    </div>

    
    <script src="js/index.js"></script>
    <script src="js/charts.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>

    <script>
        function selectData(){
            var strUser = document.getElementById("sensorNames").value;
            var timeSelect = document.getElementById("timeSelect").value;
            console.log(timeSelect);
            getData(strUser, timeSelect);
        }
        let temp = new Array();
        let humidity = new Array();
        let timestamps = new Array();
        let newTimes = new Array();

        function deductTime(timeSelect){
            newTimes = [];
            let desiredTime = Date.now() - timeSelect;
            for(let i = 0; i <= timestamps.length; i++){
                let timestampMilis = Date.parse(timestamps[i]);
                if(desiredTime < timestampMilis){
                    newTimes.push(timestamps[i]);
                }
            }
        }

        function getData(sensorn, timeSelect){
            
            temp = [];
            humidity = [];
            timestamps = [];
            var toSend = JSON.stringify({
                sensorName: sensorn,
            });
            var xmlhttp = new XMLHttpRequest();
            let readingsData = [];
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    rs = JSON.parse(this.responseText);
                    for(let i = 0; i < rs.length; i++){
                        timestamps.push(rs[i].readingTime);
                        temp.push(rs[i].temperatureC);
                        humidity.push(rs[i].humidity);
                    }
                    deductTime(timeSelect);
                    toChart(newTimes, temp, humidity);
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
    </script>
</body>
</html>
