<?php
session_start();
require 'dbconn.php';


$inInfo = json_decode(file_get_contents("php://input"));
$sensorId = $inInfo->sensorId;
$user_id = $_SESSION['userId'];

$sql = "DELETE FROM `sensors` WHERE sensors.user_id = ? AND sensors.sensor_id = ?";

$stmt = mysqli_stmt_init($conn); 
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ii", $user_id, $sensorId);
mysqli_stmt_execute($stmt);

// $conn->query($sql);
?>