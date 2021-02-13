<?php
session_start();
require 'dbconn.php';


$inInfo = json_decode(file_get_contents("php://input"));
$sensorId = $inInfo->sensorId;
$newName = $inInfo->newName;
$user_id = $_SESSION['userId'];
// var_dump($sensorId, $newName, $user_id);

$sql = "UPDATE `sensors` SET sensors.sensor_name = ? WHERE sensors.user_id = ? AND sensors.sensor_id = ?";

$stmt = mysqli_stmt_init($conn); 
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "sii", $newName, $user_id, $sensorId);
mysqli_stmt_execute($stmt);


?>