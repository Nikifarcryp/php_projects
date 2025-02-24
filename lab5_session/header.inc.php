<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if ($_SESSION['login']) {
    $menu = "<nav class='navbar navbar-expand-lg bg-primary' data-bs-theme='dark'>
  <div class='container-fluid'>
    <a class='navbar-brand' href'#'>Nikifar Markatsynski</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNav'>
      <ul class='navbar-nav'>
        <li class='nav-item'>
          <a class='nav-link' href='about_us.php'>O nas</a>
        <li class='nav-item'>
        <a class='nav-link' href='products.php'>Produkty</a>
        </li>
        <li class='nav-item'>
        <a class='nav-link' href='profile.php'>Profil</a>
        </li>
        <li class='nav-item' style='margin-right: 100'>
        <a class='nav-link' href='log_out.php'>Wyloguj</a>
        </li>
        </div>
    </div>
    </nav>";
} else {
    $menu = "<nav class='navbar navbar-expand-lg bg-primary' data-bs-theme='dark'>
  <div class='container-fluid'>
    <a class='navbar-brand' href'#'>Nikifar Markatsynski</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNav'>
      <ul class='navbar-nav'>
        <li class='nav-item'>
          <a class='nav-link' href='about_us.php'>O nas</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='login.php'>Logowanie</a>
        </li> 
        </ul>
    </div>
  </div>
</nav>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
    print $menu;
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>