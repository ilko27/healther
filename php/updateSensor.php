<?php
session_start();
require 'dbconn.php';


$inInfo = json_decode(file_get_contents("php://input"));
$sensorId = $inInfo->sensorId;
$newName = $inInfo->newName;
$user_id = $_SESSION['userId'];
var_dump($sensorId, $newName, $user_id);

$sql = "DELETE FROM `sensors` WHERE sensors.user_id = $user_id AND sensors.sensor_id = $sensorId";
$conn->query($sql);

$sql1 = "INSERT INTO `sensors`(`sensor_name`, `user_id`, `sensor_id`, `admin`) VALUES ('$newName', $user_id, $sensorId, 1)";
$conn -> query($sql1);
?>