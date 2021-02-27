<nav id="nav_header" class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
  <div class="container-fluid">
    <a id="navbar-brand" class="navbar-brand" href="./">
        <img class="d-inline-block align-top" id="header_img" src="images/big_healther_clear.png" alt="Healther">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <?php
        if ($_SESSION['userId'] == 0) {
          echo '
            <li class="nav-item">
              <a class="nav-link active" onclick="createSensor()" aria-current="page" href="#">Create Sensor</a>
            </li>
          ';
        }


        ?>
        

        <li class="nav-item">
          <a class="nav-link active" onclick="addSensor()" aria-current="page" href="#">Add Sensor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="map.php">Map</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="user_settings.php">Settings</a></li>
            <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script>
  function addSensor(){
    let sensorId = prompt("Enter sensor id", "");

    if (sensorId == null || sensorId == "") {
    txt = "User cancelled the prompt.";
    } else {
        addInDB(sensorId);
    }
  }

  function addInDB(sensorId){
    let idToSend = JSON.stringify({
        sensorId: sensorId
    });
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(JSON.parse(this.responseText));
            location.reload();
        }
    };
    xmlhttp.open("POST", "php/addSensor.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(idToSend);
  }

  <?php
  if ($_SESSION['userId'] == 0) {
    echo '
    function createSensor(){
      let sensor_id = prompt("Creating sensor with id:", "");

      if (sensor_id == null || sensor_id == "") {
      txt = "User cancelled the prompt.";
      } else {
        let idToSend = JSON.stringify({
          sensor_id: sensor_id
        });
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              alert("Successfully added sensor: ".concat(sensor_id) );
            }
        };
        xmlhttp.open("POST", "php/createSensor.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(idToSend);
      }
    }
    ';
  }
  ?>

</script>