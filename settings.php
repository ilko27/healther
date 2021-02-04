<?php
echo $_GET['sensorId']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sensor</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div id="leftHalf">
        <form>
            <input type="text" id="sensorName"> <br>
            <input type="button" onclick="send()" value="Update" class="buttonDes">
        </form>
    </div>
    <div id="rightHalf">
    
    </div>    
</body>
</html>