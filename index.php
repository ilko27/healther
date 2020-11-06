<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/cut_clouds.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <title>Healther</title>
</head>
<body>

    <!-- <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#">Healther</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="html/signup.html">Sign Up</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="html/signin.html">Log In</a>
              </li>
            </ul>
          </div>
        </div>
      </nav> -->

    <header>
        <!-- <div class="header-right">
            <a href="html/signin.html">Sign In</a>
            <a href="html/signup.html">Sign Up</a>
        </div> -->


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
            var xmlhttp = new XMLHttpRequest();
            let readingsData = [];
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    rs = JSON.parse(this.responseText);
                    for(let i = 0; i < rs.length; i++){
                        console.log(rs[i].temperatureC);
                        console.log(typeof temp);
                        timestamps.push(rs[i].readingTime);
                        temp.push(rs[i].temperatureC);
                        humidity.push(rs[i].humidity);
                    }
                    toChart(temp);
                    console.log(temp);
                    //temp = readingsData;
                }
            };
            xmlhttp.open("GET", "php/getData.php", true);
            xmlhttp.send();
        }
        getData();
    function toChart(temp){
        //console.log(temp);
        //let readingsData = getData();
        
        Chart.platform.disableCSSInjection = true;
        var ctx = document.getElementById('tempChart').getContext('2d');
        var ctx2 = document.getElementById('humidityChart').getContext('2d');
        var tempChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: timestamps,
                datasets: [{
                    label: 'Temperature',
                    data: temp,
                    backgroundColor: 'rgba(255, 115, 105, 0.5)',
                    borderColor: 'rgba(255, 115, 105, 1)',
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
        var humidityChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: timestamps,
                datasets: [{
                    label: 'Humidity',
                    data: humidity,
                    backgroundColor: 'rgba(38, 71, 255, 0.5)',
                    borderWidth: 'rgba(255, 115, 105, 1)',
                    borderWidth: 5
                }]
            }
        });
    }
    </script>
</body>
</html>
