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
        <p id="avValues">Average Temparature <span id="avTemp">0.0</span> Average Humidity <span id="avHumidity">0.0</span></p>
    </header>

    <div id='map'></div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <div id='chartsDiv'>
        <div class="charts"><canvas id="tempChart"></canvas></div>
        <div class="charts"><canvas id="humidityChart"></canvas></div>
    </div>
    <main>
        
    </main>

    
    <script src="js/index.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        let temp = new Array();
        let humidity = new Array();
        let timestamps = new Array();

        function getData(){
            var toSend = JSON.stringify({
                sensorName: "Kuhnq",
            });
            var xmlhttp = new XMLHttpRequest();
            let readingsData = [];
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    rs = JSON.parse(this.responseText);
                    for(let i = 0; i < rs.length; i++){
                        timestamps.push(rs[i].readingTime.substring(10));
                        temp.push(rs[i].temperatureC);
                        humidity.push(rs[i].humidity);
                    }
                    toChart();
                    toAverage();
                }
            };
            xmlhttp.open("POST", "php/getData.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(toSend);
        }
        getData();
        function toChart(){
            
            Chart.platform.disableCSSInjection = true;
            var ctx = document.getElementById('tempChart').getContext('2d');
            var ctx2 = document.getElementById('humidityChart').getContext('2d');
            makeChart(ctx, timestamps, temp, 'Temperature', 'rgba(255, 115, 105, 0.5)');
            makeChart(ctx2, timestamps, humidity, 'Humidity', 'rgba(38, 71, 255, 0.5)');
        }
        function toAverage(){
            var sum = 0;
            for( var i = 0; i < temp.length; i++ ){
                sum += parseInt( temp[i], 10 ); //don't forget to add the base
            }

            var avg = sum/temp.length;
            document.getElementById("avTemp").innerHTML = avg.toFixed(2);
            var sumH = 0;
            for( var i = 0; i < humidity.length; i++ ){
                sum += parseInt( humidity[i], 10 ); //don't forget to add the base
            }

            var avgH = sumH/humidity.length;
            document.getElementById("avHumidity").innerHTML = avgH.toFixed(2);
        }
        function makeChart(ctxi, timestampsarr, dataarr, label, color){
            var graph = new Chart(ctxi, {
            type: 'line',
            data: {
                labels: timestampsarr,
                datasets: [{
                    label: label,
                    data: dataarr,
                    backgroundColor: color,
                    borderColor: color,
                    borderWidth: 5
                }]

            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });
        }
        // var tempChart = new Chart(ctx, {
        //     type: 'line',
        //     data: {
        //         labels: timestamps,
        //         datasets: [{
        //             label: 'Temperature',
        //             data: temp,
        //             backgroundColor: 'rgba(255, 115, 105, 0.5)',
        //             borderColor: 'rgba(255, 115, 105, 1)',
        //             borderWidth: 5
        //         }]

        //     },
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero: false
        //                 }
        //             }]
        //         }
        //     }
        // });
        // var humidityChart = new Chart(ctx2, {
        //     type: 'line',
        //     data: {
        //         labels: timestamps,
        //         datasets: [{
        //             label: 'Humidity',
        //             data: humidity,
        //             backgroundColor: 'rgba(38, 71, 255, 0.5)',
        //             borderWidth: 'rgba(255, 115, 105, 1)',
        //             borderWidth: 5
        //         }]
        //     }
        // });
    </script>
</body>
</html>
