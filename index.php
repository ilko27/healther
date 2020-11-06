<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/healther_clean.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <title>Healther</title>
</head>
<body>
    <header id="header">
        <div class="header-right">
            <img src="images\logo.png">
        </div>
    </header>
    <div id='map'></div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <div id='charts'>
        <canvas id="tempChart"></canvas>
        <canvas id="humidityChart"></canvas>
    </div>
    <main>
        
    </main>

    
    <script src="js/index.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        let datata = [];
        let temp = new Array();
        let humidity = new Array();
        let timestamps = new Array();

        function getData(){
            var toSend = JSON.stringify({
                sensorName: "IlkoSensor",
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
                    toChart();
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
