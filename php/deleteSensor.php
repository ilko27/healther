<?php
session_start();
require 'dbconn.php';


$inInfo = json_decode(file_get_contents("php://input"));
$sensorId = $inInfo->sensorId;
$user_id = $_SESSION['userId'];

$sql = "DELETE FROM `sensors` WHERE sensors.user_id = $user_id AND sensors.sensor_id = $sensorId";
$conn->query($sql);
?>