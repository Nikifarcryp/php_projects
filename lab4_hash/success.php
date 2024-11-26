<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Success!</title>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    die();
}
?>
<div class="container">
    <div class="alert alert-success" role="alert">
        <h1>Authenticated! You are into your account, <?= $_SESSION['login']; ?>!</h1><br>
        <p>Podany login: <b><?= $_SESSION['login']; ?></b></p>
        <p>Podane hasło: <b><?= $_SESSION['password']; ?></b></p>
        <p>Zaszyfrowane hasło: <b><?= $_SESSION['password_encrypted']; ?></b></p>
        <img src="https://media.istockphoto.com/id/1451590744/vector/congratulations-beautiful-greeting-card-poster-banner.jpg?s=612x612&w=0&k=20&c=CD60HIUbZNFGDcVWOfBB90Zjp0weQaFBi5CjetIgRSw=" alt="image">
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>