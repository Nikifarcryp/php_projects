<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profil</title>
</head>
<body>
<?php
    include('header.inc.php');
    $info = $_COOKIE[$_SESSION['login']];
    
    print "<div class='card text-center'>
  <div class='card-header'>
    <h1>Konto</h1>
  </div>
  <div class='card-body'>
    <h5 class='card-title'>Informacja</h5>
    <p class='card-text'>Twój login: <b>" . $_SESSION['login'] . "</b></p>
    <a href='log_out.php' class='btn btn-danger'>Wyloguj</a>
  </div>";
    if ($info) {
        print "<div class='card-footer text-body-secondary'>Ostatnie wylogowanie odbyło się o "
        . $info .
        " dzisiaj. Nie przechowywuję cookies dłuzej niz 25 min. </div>
        </div>";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>