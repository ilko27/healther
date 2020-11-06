<?php
$servername = "localhost";
$username = "samuil";
$password = "samuil";
$db = "healther";

$tempArray = [];

$conn = new mysqli($servername, $username, $password, $db);
$stmt = $conn->prepare("SELECT * FROM sensordata WHERE sensor = 'IlkoSensor'");
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);


echo json_encode($outp);

?>