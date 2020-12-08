<?php
require 'dbconn.php';

// if (window.XMLHttpRequest) {

    $inInfo = json_decode(file_get_contents("php://input"));
    $sensorName = $inInfo->sensorName;
    $rowsLimit = $inInfo->rowsSelect;

    $sql = "SELECT * FROM sensorData WHERE sensor = ? ORDER BY datId DESC LIMIT ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $sensorName, $rowsLimit);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $outp = mysqli_fetch_all($result, MYSQLI_ASSOC);


    echo json_encode($outp);

// } else {
//     header("Location: ../index.php");
//     exit();
// }
?>