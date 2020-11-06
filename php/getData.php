<?php
$servername = "localhost";
$username = "ilko";
$password = "ilko";
$db = "healther";

$inInfo = json_decode(file_get_contents("php://input"));
$sensorName = $inInfo->sensorName;

$conn = new mysqli($servername, $username, $password, $db);
$stmt = $conn->prepare("SELECT * FROM sensordata WHERE sensor = ?");
$stmt->bind_param("s", $sensorName);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);


echo json_encode($outp);

?>