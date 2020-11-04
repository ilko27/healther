<?php

$servername = "localhost";


$dbname = "health645_healther";
$username = "health645_samuil";
$password = "Samuil_2003";



$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $sensor = $temp = $pressure = $humidity = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $sensor = test_input($_POST["sensor"]);
        $temp = test_input($_POST["temp"]);
        $pressure = test_input($_POST["pressure"]);
        $humidty = test_input($_POST["humidty"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO `sensorData`(`sensor`, `temperatureC`, `pressure`, `humidity`) VALUES ('$sensor', '$temp', '$pressure', '$humidity')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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