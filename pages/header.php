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

<nav class="navbar navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="./">
        <img id="header_img" src="images/big_healther_clear.png" alt="Healther">
    </a>
  </div>
</nav>
