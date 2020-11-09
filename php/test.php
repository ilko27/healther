<?php
$servername = "localhost";
$username = "health645_samuil";
$password = "Samuil_2003";
$db = "health645_healther";


$sensorName = 'IlkoSensor';

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$sql = "SELECT datId FROM sensorData WHERE sensor = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $sensorName);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $datId, $sensor, $temperatureC, $pressure, $humidity, $readingTime);
while (mysqli_stmt_fetch($stmt)) {
    echo ('<br> д');
}
// if (mysqli_stmt_fetch($stmt)) {
//     echo ("hell yeah");
// } else echo ("here bitch");




?>