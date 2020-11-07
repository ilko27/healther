<?php
$servername = "localhost";
$username = "health645_samuil";
$password = "Samuil_2003";
$db = "health645_healther";

$inInfo = json_decode(file_get_contents("php://input"));
$sensorName = $inInfo->sensorName;

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$sql = "SELECT * FROM sensorData WHERE sensor = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $sensorName);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$outp = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo json_encode($outp);

?>