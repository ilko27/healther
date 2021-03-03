<?php
session_start();
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$sensor_id = $inInfo->sensor_id;
$user_id = $_SESSION['userId'];

if ($user_id == 0) {
    $sql = "INSERT INTO all_sensors_list(sensor_id) VALUES(?)";
    $stmt = mysqli_stmt_init($conn); 
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $sensor_id);
    mysqli_stmt_execute($stmt);
    $outp = 'success';
}

echo json_encode($outp);
?>