<?php
$k = '
<ul id="dropdown1" class="dropdown-content">
    <li><a href="">Settings</a></li>
    <li class="divider"></li>
    <li><a href="php/logout.php">Logout</а></li>
</ul>
<nav>
    <div class="nav-wrapper">
        <a href="./" class="brand-logo">
            <img id="header_img" src="images/big_healther_clear.png" alt="Healther">
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a onclick="addSensor()">Add Sensor</a>
            <li><a href="">Map</a></li>
            <!-- Dropdown Trigger -->
            <li><a class="dropdown-trigger" data-target="dropdown1">Account</a></li>
        </ul>
    </div>
</nav>

<script>$(".dropdown-trigger").dropdown();</script>
';
?>

<!-- <nav id="nav_header" class="navbar-sm navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="./">
        <img class="d-inline-block align-top" id="header_img" src="images/big_healther_clear.png" alt="Healther">
    </a>
  </div>
</nav> -->

<nav id="nav_header" class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">
        <img class="d-inline-block align-top" id="header_img" src="images/big_healther_clear.png" alt="Healther">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" onclick="addSensor()" aria-current="page" href="#">Add Sensor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Map</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>