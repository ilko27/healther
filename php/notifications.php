<?php
require 'dbconn.php';

$sql = 'SELECT users.email, sensors.sensor_name, sensorData.aqi, sensorData.temperatureC,sensorData.humidity, sensorData.pressure
    FROM sensors
    INNER JOIN users ON sensors.user_id = users.user_id
    INNER JOIN sensorData ON sensors.sensor_id = sensorData.sensor
    WHERE users.notifications = true
    	AND sensorData.readingTime >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
    GROUP BY users.email, sensorData.readingTime';
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

// $row = mysqli_fetch_array($result);
// echo $row[5];
// printf ("%s (%s)\n", $row[0], $row[1]);

$rows = array();
$res = new stdClass();
$res->rows = array();
while($row = mysqli_fetch_object($result)){
    $res->rows[] = $row;
}

$data_email = array();
$data_sensor_name = array();
$data_aqi = array();
$data_temperatureC = array();
$data_humidity = array();
$data_pressure = array();
for ($i = 0; $i < $num_rows; $i++) {
    if (in_array($res->rows[$i]->email, $data_email) && in_array($res->rows[$i]->sensor_name, $data_sensor_name)){

        array_push($data_aqi, $res->rows[$i]->aqi);
        array_push($data_temperatureC, $res->rows[$i]->temperatureC);
        array_push($data_humidity, $res->rows[$i]->humidity);
        array_push($data_pressure, $res->rows[$i]->pressure);

    } else{

        if (!empty($data_email)) {

            $email = $res->rows[$i]->email;
            $sensor_name = $res->rows[$i]->sensor_name;

            $data_aqi = array_filter($data_aqi);
            $average_data_aqi = array_sum($data_aqi)/count($data_aqi);

            $data_temperatureC = array_filter($data_temperatureC);
            $average_data_temperatureC = array_sum($data_temperatureC)/count($data_temperatureC);

            $data_humidity = array_filter($data_humidity);
            $average_data_humidity = array_sum($data_humidity)/count($data_humidity);

            $data_pressure = array_filter($data_pressure);
            $average_data_pressure = array_sum($data_pressure)/count($data_pressure);

            $message = 
                    "
                    Hello from <a href='https://www.healther.online'>Healther</a>,
                    This week your sensor:".$sensor_name." has collected some data.
                    Here are the average results from the sensor:
                    Average Concentration of PM2.5: ".$average_data_aqi." μg/m³
                    Average Temperature: ".$average_data_temperatureC." °C
                    Average Humidity: ".$average_data_humidity." %
                    Average Pressure: ".$average_data_pressure." hPa
                    ";

                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= 'To: '.$email.' <'.$email.'>' . "\r\n";
                $headers .= 'From: Healther <notifications@healther.online>' . "\r\n";

                mail($email,"Healther Weekly Notification",$message,$headers);


        }
            

        $data_email = array();
        $data_sensor_name = array();
        $data_aqi = array();
        $data_temperatureC = array();
        $data_humidity = array();
        $data_pressure = array();

        array_push($data_email, $res->rows[$i]->email);
        array_push($data_sensor_name, $res->rows[$i]->sensor_name);


        array_push($data_aqi, $res->rows[$i]->aqi);
        array_push($data_temperatureC, $res->rows[$i]->temperatureC);
        array_push($data_humidity, $res->rows[$i]->humidity);
        array_push($data_pressure, $res->rows[$i]->pressure);

    }
}







mysqli_free_result($result);

