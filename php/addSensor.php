<?php
session_start();
require 'dbconn.php';

$inInfo = json_decode(file_get_contents("php://input"));
$sensorId = $inInfo->sensorId;
$user_id = $_SESSION['userId'];

$sql = "SELECT id FROM all_sensors_list WHERE sensor_id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    $outp = 'error_sql_error1';
} else {
    mysqli_stmt_bind_param($stmt, "i", $sensorId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if ($resultCheck > 0) { // if sensor is real:
        $sql = "SELECT shareable FROM sensors WHERE sensor_id = ? AND admin = 1";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $outp = 'error_sql_error2';
        } else {
            mysqli_stmt_bind_param($stmt, "i", $sensorId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) { // if sensor is 'active':
                mysqli_stmt_bind_result($stmt, $shareable);
                while (mysqli_stmt_fetch($stmt)) { // check if sensor is shareable
                    // $outp = $shareable;
                    if ($shareable == false) {
                        $outp = 'access_denied';
                    } else {
                        $sql = "INSERT INTO `sensors`(`sensor_name`, `user_id`, `sensor_id`) VALUES (?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            $outp = 'error_sql_error3';
                        } else {
                            mysqli_stmt_bind_param($stmt, "iii", $sensorId, $user_id, $sensorId);
                            mysqli_stmt_execute($stmt);
                            $outp = "new_share";
                        }
                    }
                }
            } else {    // sensor is NOT 'active':
                $sql = "INSERT INTO `sensors`(`sensor_name`, `user_id`, `sensor_id`, `admin`) VALUES (?, ?, ?, 1)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    $outp = 'error_sql_error4';
                } else {
                    mysqli_stmt_bind_param($stmt, "iii", $sensorId, $user_id, $sensorId);
                    mysqli_stmt_execute($stmt);
                    $outp = "new_active_sensor";
                }
            }
        }
    } else {
        $outp = 'error_no_such_sensor_fu'; 
    }

}
echo json_encode($outp);
?>