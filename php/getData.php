<?php
session_start();
// CHECK FOR SET COOKIE
if(!isset($_SESSION['userSession'])){
    $outp = 'errorNoUser';
} else {
    // $outp = 'hoho';
    require 'dbconn.php';

    $inInfo = json_decode(file_get_contents("php://input"));
    $sensorId = $inInfo->sensorName;    // it's ID, not NAME

    // CHECK IF SENSOR IS YOURS
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM sensors WHERE sensors.user_id = ? AND sensors.sensor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $userId, $sensorId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($result);
    
    if($num_rows != 1){
        $outp = 'userError';
    } else {
        //  get data from db
        $sql = "SELECT * FROM sensorData WHERE sensor = ? ORDER BY datId";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $sensorId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $outp = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
echo json_encode($outp);
?>