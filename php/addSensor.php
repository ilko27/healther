<?php
session_start();
require 'dbconn.php';


$inInfo = json_decode(file_get_contents("php://input"));
$sensorId = $inInfo->sensorId;
$user_id = $_SESSION['userId'];

$sql = "INSERT INTO `sensors`(`sensor_name`, `user_id`, `sensor_id`, `admin`) VALUES ($sensorId, $user_id, $sensorId, 1)";
$conn -> query($sql);
// $stmt = mysqli_stmt_init($conn); 
// mysqli_stmt_prepare($stmt, $sql);
// mysqli_stmt_bind_param($stmt, "ssss", $sensorId, $user_id, $sensorId, 1);
// mysqli_stmt_execute($stmt);

$out = "good";

echo json_encode($out);

?>