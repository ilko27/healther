<?php
$servername = "localhost";
$username = "health645_samuil";
$password = "Samuil_2003";
$db = "health645_healther";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    // printf("Connect failed: %s\n", mysqli_connect_error());
    die("Connection failed: ".mysqli_connect_error());
}