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