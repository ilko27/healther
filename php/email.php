<?php

// require 'dbconn.php';

// $email = "samuilgeorgiev@abv.bg";
$email = "samuil.georgiev@outlook.com";
// $email = "admin@healther.online";


//
//background: linear-gradient(34deg, rgba(13,84,138,1) 0%, rgb(31, 119, 121) 100%);

$message = "
<html>
<head>
<title>Healther Weekly Notification</title>
</head>
<body>
<img src='https://healther.online/images/big_healther_clear.png'/>

<p>Hello from <a href='https://www.healther.online'>Healther</a>,</p> <br><br>
<p>This week your sensor '".$sensor_name."' has collected some data.</p> <br>
<p>Here are the average results from the sensor:</p> <br>
<p>Average Concentration of PM2.5: ".$average_data_aqi." μg/m³</p> <br>
<p>Average Temperature: ".$average_data_temperatureC." °C</p> <br>
<p>Average Humidity: ".$average_data_humidity." %</p> <br>
<p>Average Pressure: ".$average_data_pressure." hPa</p> <br>

</body>
</html>";




$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";




// $email1 = "admin@healther.online";
mail($email, 'Test', $message, $headers);
// mail($email1, 'Test', 'Test');
// $email = "samuil.georgiev@outlook.com";
// $headers .= 'From: Healther <confirm_no_reply@healther.online>' . "\r\n";

// mail($email,"IsThisWorking","It is working",$headers);