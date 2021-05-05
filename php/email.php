<?php

// require 'dbconn.php';

$email = "samuilgeorgiev@abv.bg";
// $email = "samuil.georgiev@outlook.com";
// $email = "admin@healther.online";

$email1 = "admin@healther.online";
mail($email, 'Test', 'Test');
mail($email1, 'Test', 'Test');
// $email = "samuil.georgiev@outlook.com";
// $headers .= 'From: Healther <confirm_no_reply@healther.online>' . "\r\n";

// mail($email,"IsThisWorking","It is working",$headers);