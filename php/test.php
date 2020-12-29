<?php

$hash_code = md5(rand(666,69420));
echo $hash_code;


// $servername = "localhost";
// $username = "health645_samuil";
// $password = "Samuil_2003";
// $db = "health645_healther";

// $email = "ilko.petrov27@gmail.com";
// $message = 
//                         "
//                         oooooo <br/>
//                         it's working, mate <br/>
//                         <br/>
//                         <br/>
//                         <br/>
//                         evet got some html magic <br/>
//                         to see the best site ever(dont't check if it's true), click <a href='https://www.healther.online'>here</a>.
//                         ";

//                     $headers  = 'MIME-Version: 1.0' . "\r\n";
//                     $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
//                     $headers .= 'To: '.$email. "\r\n";
//                     $headers .= 'From: Healther <confirm_no_reply@healther.online>' . "\r\n";

//                     mail($email,"Healther Registration",$message,$headers);
// echo rand(100000,999999);




// $sensorName = 'IlkoSensor';

// $conn = mysqli_connect($servername, $username, $password, $db);
// if (!$conn) {
//     printf("Connect failed: %s\n", mysqli_connect_error());
//     exit();
// }
// $sql = "SELECT datId FROM sensorData WHERE sensor = ?";
// $stmt = mysqli_prepare($conn, $sql);
// mysqli_stmt_bind_param($stmt, 's', $sensorName);
// mysqli_stmt_execute($stmt);
// mysqli_stmt_bind_result($stmt, $datId, $sensor, $temperatureC, $pressure, $humidity, $readingTime);
// while (mysqli_stmt_fetch($stmt)) {
//     echo ('<br> д');
// }


// if (mysqli_stmt_fetch($stmt)) {
//     echo ("hell yeah");
// } else echo ("here bitch");




?>