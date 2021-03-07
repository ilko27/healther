<?php
require 'dbconn.php';



$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $sensor = $temp = $pressure = $humidity = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $sensor = test_input($_POST["sensor"]);
        $temp = test_input($_POST["temp"]);
        $aqi = test_input($_POST["aqi"]);
        $pressure = test_input($_POST["pressure"]);
        $humidity = test_input($_POST["humidity"]);
        
        
        $sql = "INSERT INTO `sensorData`(`sensor`, `aqi`, `temperatureC`, `pressure`, `humidity`) VALUES ('$sensor', '$aqi', '$temp', '$pressure', '$humidity')";
        
        if ($temp > -100) {
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: -144";
        }
        
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}