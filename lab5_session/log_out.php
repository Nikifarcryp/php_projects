<?php
session_start();
$expires = (time() + 25 * 60);
$actual_time = time() + 3600;
setcookie($_SESSION['login'], gmdate("H:i:s", $actual_time), $expires);
unset($_SESSION['login']);
unset($_SESSION['password']);
session_destroy();
header('location: login.php')
?>