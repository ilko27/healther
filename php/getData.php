<?php
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$sensorName = $inInfo->sensorName;

$sql = "SELECT * FROM sensorData WHERE sensor = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $sensorName);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$outp = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo json_encode($outp);

?>