<?php
require 'dbconn.php';

$sql = 'SELECT users.email, sensors.sensor_name, sensorData.aqi, sensorData.temperatureC,sensorData.humidity, sensorData.pressure
    FROM sensors
    INNER JOIN users ON sensors.user_id = users.user_id
    INNER JOIN sensorData ON sensors.sensor_id = sensorData.sensor
    WHERE users.notifications = true
    GROUP BY users.email, sensorData.readingTime';
$result = mysqli_query($conn, $sql);
echo "Returned rows are: " . mysqli_num_rows($result);

$row = mysqli_fetch_array($result);
echo $row[5];
// printf ("%s (%s)\n", $row[0], $row[1]);

// $rows = array();
// $res = new stdClass();
// $res->rows = array();
// while($row = mysqli_fetch_object($result)){
//     $res->rows[] = $row;
// }







mysqli_free_result($result);

