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
while($row = mysqli_fetch_array($result)){
    array_push($tempArray, $row['temperatureC']);
}

echo json_encode($tempArray);

?>