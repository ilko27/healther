<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js">
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <title>Healther</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
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
      </nav>

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
        let temp = [];

        function getData(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let readingsData = JSON.parse(this.responseText);
                    temp = readingsData;
                    console.log(temp);
                    // tempToChart(temp);
                }
            };
            xmlhttp.open("GET", "php/getData.php", true);
            xmlhttp.send();
        }
        // console.log(temp);
        // getData();
        // function tempToChart(temp){
        // //let readingsData = getData();
        // let humidity = [];
        // let timestamps = ["2020-10-14 20:15:45","2020-10-14 20:16:06","2020-10-14 20:18:07","2020-10-14 20:28:20","2020-10-14 20:33:21","2020-10-14 20:38:22","2020-10-14 20:43:26","2020-10-14 20:48:27","2020-10-14 20:53:28","2020-10-14 20:58:29","2020-10-14 21:03:30","2020-10-14 21:08:35","2020-10-14 21:13:37","2020-10-14 21:18:38","2020-10-14 21:23:39","2020-10-14 21:28:41","2020-10-14 21:33:42","2020-10-14 21:38:43","2020-10-14 21:43:44","2020-10-14 21:48:45","2020-10-14 21:53:46","2020-10-14 21:58:47","2020-10-14 22:03:48","2020-10-14 22:08:49","2020-10-14 22:13:50","2020-10-14 22:18:51","2020-10-14 22:23:52","2020-10-14 22:28:53","2020-10-14 22:33:54","2020-10-14 22:38:55","2020-10-14 22:43:56","2020-10-14 22:48:57","2020-10-14 22:53:58","2020-10-14 22:58:59","2020-10-14 23:04:00","2020-10-14 23:09:02","2020-10-14 23:14:03","2020-10-14 23:19:04","2020-10-14 23:24:05","2020-10-14 23:29:06","2020-10-14 23:34:07","2020-10-14 23:39:09","2020-10-14 23:44:10","2020-10-14 23:49:11","2020-10-14 23:54:12","2020-10-14 23:59:20","2020-10-15 12:45:09","2020-10-15 19:09:52","2020-10-15 19:14:53","2020-10-15 19:19:54","2020-10-15 19:24:55","2020-10-15 19:29:57","2020-10-15 19:34:58","2020-10-15 19:39:59","2020-10-15 19:45:00","2020-10-15 19:50:02","2020-10-15 19:55:03","2020-10-15 20:00:04","2020-10-15 20:05:05","2020-10-15 20:10:06","2020-10-15 20:15:07","2020-10-15 20:20:08","2020-10-15 20:25:09","2020-10-15 20:30:10","2020-10-15 20:35:12","2020-10-15 20:40:13","2020-10-15 20:45:14","2020-10-15 20:50:15","2020-10-15 20:55:16","2020-10-15 21:00:17","2020-10-15 21:05:18","2020-10-15 21:10:20","2020-10-15 21:15:21","2020-10-15 21:20:22","2020-10-15 21:25:23","2020-10-15 21:30:24","2020-10-15 21:35:25","2020-10-15 21:40:26","2020-10-15 21:45:27","2020-10-15 21:50:28","2020-10-15 21:55:29","2020-10-15 22:00:30","2020-10-15 22:05:31","2020-10-15 22:10:32","2020-10-15 22:15:33","2020-10-15 22:20:34","2020-10-15 22:25:35","2020-10-15 22:30:36","2020-10-15 22:35:37","2020-10-15 22:40:38","2020-10-15 22:45:38","2020-10-15 22:50:40","2020-10-15 22:55:41","2020-10-15 23:00:41","2020-10-15 23:05:43","2020-10-15 23:10:44","2020-10-15 23:15:45","2020-10-15 23:20:46","2020-10-15 23:25:47","2020-10-15 23:30:48","2020-10-15 23:35:49","2020-10-15 23:40:50","2020-10-19 12:53:20","2020-10-19 18:35:37","2020-10-19 18:40:41","2020-10-19 18:45:42","2020-10-19 18:50:43","2020-10-19 18:55:44","2020-10-19 19:00:45","2020-10-19 19:05:46","2020-10-19 19:10:47","2020-10-19 19:15:48","2020-10-19 19:20:49","2020-10-19 19:25:50","2020-10-19 19:30:51","2020-10-19 19:35:52","2020-10-19 19:40:53","2020-10-19 19:45:54","2020-10-19 19:50:55","2020-10-19 19:55:56","2020-10-19 20:00:57","2020-10-19 20:05:59","2020-10-19 20:11:00","2020-10-19 20:16:01","2020-10-19 20:21:02","2020-10-19 20:26:03","2020-10-19 20:31:04","2020-10-19 20:36:06","2020-10-19 20:41:07","2020-10-19 20:46:08","2020-10-19 20:51:09","2020-10-19 20:56:11","2020-10-19 21:01:12","2020-10-19 21:06:13","2020-10-19 21:11:13","2020-10-19 21:16:15","2020-10-20 12:50:19","2020-10-20 12:55:20","2020-10-20 13:00:21","2020-10-20 13:05:22","2020-10-20 13:10:23","2020-10-20 13:15:24","2020-10-20 13:20:25","2020-10-20 13:25:26","2020-10-20 13:30:27","2020-10-20 13:35:28","2020-10-20 13:40:29","2020-10-20 13:45:30","2020-10-20 13:50:31","2020-10-20 13:55:32","2020-10-20 14:00:33","2020-10-20 14:05:34","2020-10-20 14:10:35","2020-10-20 14:15:36","2020-10-20 14:20:37","2020-10-20 14:25:38","2020-10-20 14:30:39","2020-10-20 14:35:40","2020-10-20 14:40:41","2020-10-20 14:45:42","2020-10-20 14:50:43","2020-10-20 14:55:44","2020-10-20 15:00:45","2020-10-20 15:05:46","2020-10-20 15:10:50","2020-10-20 15:15:52","2020-10-20 15:20:53","2020-10-20 15:25:54","2020-10-20 15:30:56","2020-10-20 15:35:57","2020-10-20 15:40:58","2020-10-20 15:45:59","2020-10-20 15:51:00","2020-10-20 15:56:01","2020-10-20 16:01:02","2020-10-20 16:06:03","2020-10-20 16:11:04","2020-10-20 16:16:05","2020-10-20 16:21:06","2020-10-20 16:25:21","2020-10-20 16:30:22","2020-10-20 16:35:23","2020-10-20 16:40:24","2020-10-20 16:45:25","2020-10-20 16:50:27","2020-10-20 16:55:28","2020-10-20 17:00:29","2020-10-20 17:05:30","2020-10-20 17:10:32","2020-10-20 17:15:33","2020-10-20 17:20:34","2020-10-20 17:25:35","2020-10-20 17:30:36","2020-10-20 17:35:37","2020-10-20 17:40:38","2020-10-20 17:45:39","2020-10-20 17:50:40","2020-10-20 17:55:41","2020-10-20 18:00:42","2020-10-20 18:05:43","2020-10-20 18:10:44","2020-10-20 18:15:45","2020-10-20 18:20:46","2020-10-20 18:25:47","2020-10-20 18:30:48","2020-10-20 18:35:49","2020-10-20 18:40:50","2020-10-20 18:45:51","2020-10-20 18:50:52","2020-10-20 18:55:53","2020-10-20 19:00:54","2020-10-20 19:05:55","2020-10-20 19:10:56","2020-10-20 19:15:57","2020-10-20 19:20:58","2020-10-20 19:25:59","2020-10-20 19:31:01","2020-10-20 19:36:02","2020-10-20 19:41:03","2020-10-20 19:46:04","2020-10-20 19:51:05","2020-10-20 19:56:05","2020-10-20 20:01:07","2020-10-20 20:06:08","2020-10-20 20:11:09","2020-10-20 20:16:10","2020-10-20 20:21:11","2020-10-20 20:26:12","2020-10-20 20:31:17","2020-10-21 12:05:22","2020-10-21 12:05:36","2020-10-21 12:10:37","2020-10-21 12:15:39","2020-10-21 12:20:40","2020-10-21 12:25:41","2020-10-21 12:30:42","2020-10-21 12:35:43","2020-10-21 12:40:44","2020-10-21 12:45:45","2020-10-21 12:50:46","2020-10-21 12:55:47","2020-10-21 13:00:48","2020-10-21 13:05:49","2020-10-21 13:10:50","2020-10-21 13:15:51","2020-10-21 13:20:52","2020-10-21 13:25:53","2020-10-21 13:30:55","2020-10-21 13:35:55","2020-10-21 13:40:56","2020-10-21 13:45:57","2020-10-21 13:50:58","2020-10-21 13:55:59","2020-10-21 14:01:00","2020-10-21 14:06:01","2020-10-21 14:11:02","2020-10-21 14:16:03","2020-10-21 14:21:04","2020-10-21 14:26:05","2020-10-21 14:31:06","2020-10-21 14:36:07","2020-10-21 14:41:09","2020-10-21 14:46:10","2020-10-21 14:51:11","2020-10-21 14:56:12","2020-10-21 15:01:13","2020-10-21 15:06:14","2020-10-21 15:11:15","2020-10-21 15:16:16","2020-10-21 15:21:17","2020-10-21 15:26:18","2020-10-21 15:31:19","2020-10-21 15:36:20","2020-10-21 15:41:21","2020-10-21 15:46:22","2020-10-21 15:51:23","2020-10-21 15:56:24","2020-10-21 16:01:25","2020-10-21 16:06:26","2020-10-21 16:11:27","2020-10-21 16:16:28","2020-10-21 16:21:29","2020-10-21 16:26:30","2020-10-21 16:31:31","2020-10-21 16:36:32","2020-10-21 16:41:33","2020-10-21 16:46:34","2020-10-21 16:51:35","2020-10-21 16:56:36","2020-10-21 17:01:37","2020-10-21 17:06:38","2020-10-21 17:11:39","2020-10-21 17:16:40","2020-10-21 17:21:41","2020-10-21 17:26:42","2020-10-21 17:31:43","2020-10-21 17:36:44","2020-10-21 17:41:45","2020-10-21 17:46:46","2020-10-21 17:51:47","2020-10-21 17:56:49","2020-10-21 18:01:50","2020-10-21 18:06:53","2020-10-21 18:11:54","2020-10-21 18:16:55","2020-10-21 18:21:56","2020-10-21 18:26:57","2020-10-21 18:31:58","2020-10-21 18:36:59","2020-10-21 18:42:00","2020-10-21 18:47:01","2020-10-21 18:52:02","2020-10-21 18:57:03","2020-10-21 19:02:04","2020-10-21 19:07:05","2020-10-21 19:12:06","2020-10-21 19:17:07","2020-10-21 19:22:08","2020-10-21 19:27:09","2020-10-21 19:32:10","2020-10-21 19:37:11","2020-10-21 19:42:12","2020-10-21 19:47:13","2020-10-21 19:52:14","2020-10-21 19:57:15","2020-10-21 20:02:17","2020-10-21 20:07:18","2020-10-21 20:12:19","2020-10-21 20:17:20","2020-10-21 20:22:21","2020-10-21 20:27:23","2020-10-21 20:32:25","2020-10-21 20:37:26","2020-10-21 20:42:26","2020-10-21 20:47:28","2020-10-21 20:52:29","2020-10-21 20:57:30","2020-10-21 21:02:31","2020-10-21 21:07:32","2020-10-21 21:12:33","2020-10-21 21:17:35","2020-10-30 00:23:14","2020-10-30 00:28:15","2020-10-30 00:28:45","2020-10-30 00:28:59","2020-10-31 13:57:15","2020-10-31 14:02:16","2020-10-31 14:07:17","2020-10-31 14:12:18","2020-10-31 14:17:19","2020-10-31 14:22:20","2020-10-31 14:27:21","2020-10-31 14:32:22","2020-10-31 14:37:23","2020-10-31 14:42:24","2020-10-31 14:47:25","2020-10-31 14:52:26","2020-10-31 14:57:27","2020-10-31 15:02:28","2020-10-31 15:07:29","2020-10-31 15:12:30","2020-10-31 15:17:31","2020-10-31 15:22:32","2020-10-31 15:27:33","2020-10-31 15:32:34","2020-10-31 15:37:35","2020-10-31 15:42:36","2020-10-31 15:47:37","2020-10-31 15:52:38","2020-10-31 15:57:39","2020-10-31 16:02:40","2020-10-31 16:07:41","2020-10-31 16:12:43","2020-10-31 16:17:44","2020-10-31 16:22:45","2020-10-31 16:27:46","2020-10-31 16:32:47","2020-10-31 16:37:48","2020-10-31 16:42:49","2020-10-31 16:47:50","2020-10-31 16:52:51","2020-10-31 16:57:52","2020-10-31 17:02:53","2020-10-31 17:07:54","2020-10-31 17:12:55","2020-10-31 17:17:56","2020-10-31 17:22:57","2020-10-31 17:27:58","2020-10-31 17:32:59","2020-10-31 17:38:00","2020-10-31 17:43:01","2020-10-31 17:48:02","2020-10-31 17:53:03","2020-10-31 17:58:05","2020-10-31 18:03:06","2020-10-31 18:08:07","2020-10-31 18:13:08","2020-10-31 18:18:09","2020-10-31 18:23:10","2020-10-31 18:28:11","2020-10-31 18:33:12","2020-10-31 18:38:13","2020-10-31 18:43:14","2020-10-31 18:48:15","2020-10-31 18:53:16","2020-10-31 18:58:17","2020-10-31 19:03:18","2020-10-31 19:08:19","2020-10-31 19:13:20","2020-10-31 19:18:21","2020-10-31 19:23:22","2020-10-31 19:28:23","2020-10-31 19:33:24","2020-10-31 19:38:25","2020-10-31 19:43:26","2020-10-31 19:48:27","2020-10-31 19:53:28","2020-10-31 19:58:29","2020-10-31 20:03:30","2020-10-31 20:08:31","2020-10-31 20:13:32","2020-10-31 20:18:33","2020-10-31 20:23:34","2020-10-31 20:28:35","2020-10-31 20:33:36","2020-10-31 20:38:37","2020-10-31 20:43:38","2020-10-31 20:48:39","2020-10-31 20:53:40","2020-10-31 20:58:41","2020-10-31 21:03:42","2020-10-31 21:08:43","2020-10-31 21:13:44","2020-10-31 21:18:45","2020-10-31 21:23:46","2020-10-31 21:28:47","2020-10-31 21:33:48","2020-10-31 21:38:49","2020-10-31 21:43:50","2020-10-31 21:48:51","2020-10-31 21:53:52","2020-10-31 21:58:53","2020-10-31 22:03:54","2020-10-31 22:08:55","2020-10-31 22:13:56","2020-10-31 22:18:57","2020-10-31 22:23:58","2020-10-31 22:28:59","2020-10-31 22:34:00","2020-10-31 22:39:01","2020-10-31 22:44:02","2020-10-31 22:49:03","2020-10-31 22:54:04","2020-10-31 22:59:05","2020-10-31 23:04:06","2020-10-31 23:09:07","2020-10-31 23:14:08","2020-10-31 23:19:09","2020-10-31 23:24:10","2020-10-31 23:29:11","2020-10-31 23:34:12","2020-10-31 23:39:13","2020-10-31 23:44:14","2020-10-31 23:49:18","2020-11-01 22:37:55","2020-11-01 22:38:50","2020-11-01 22:42:47","2020-11-03 10:29:04","2020-11-03 10:35:46","2020-11-03 10:38:34","2020-11-03 10:51:06","2020-11-03 10:56:11"];
        
        
        //     console.log(temp);
        //     Chart.platform.disableCSSInjection = true;
        //     var ctx = document.getElementById('tempChart').getContext('2d');
        //     var ctx2 = document.getElementById('humidityChart').getContext('2d');
        //     var tempChart = new Chart(ctx, {
        //         type: 'line',
        //         data: {
        //             labels: timestamps,
        //             datasets: [{
        //                 label: 'Temperature',
        //                 data: temp,
        //                 backgroundColor: 'rgba(255, 115, 105, 0.5)',
        //                 borderColor: 'rgba(255, 115, 105, 1)',
        //                 borderWidth: 5
        //             }]

        //         },
        //         options: {
        //             scales: {
        //                 yAxes: [{
        //                     ticks: {
        //                         beginAtZero: true
        //                     }
        //                 }]
        //             }
        //         }
        //     });
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
        // }
    </script>
</body>
</html>
