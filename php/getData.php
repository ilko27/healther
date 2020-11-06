<?php
$servername = "localhost";
$username = "ilko";
$password = "ilko";
$db = "healther";

$tempArray = [];

$conn = new mysqli($servername, $username, $password, $db);
$stmt = $conn->prepare("SELECT * FROM sensordata WHERE sensor = 'IlkoSensor'");
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);


echo json_encode($outp);

?>