<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Logging</title>
</head>
<body>



<!-- 

LOGINY I HASŁA UZUTKOWNIKÓW:
1.  Login: Michał
    Hasło: Michał_876543456
2.  Login: Adrian
    Hasło:Toyota_the_best_123
3.  Login: Anna
    Hasło: Ania_lubi_psa_000

-->

    <div class="container">
      <?php
      session_start();
      require('config.inc.php');
      if($_POST)
      {
          error_reporting(E_ERROR | E_PARSE);
          $login = $_POST['login'];
          $psw_provided = $_POST['password'];
          $psw_encrypted = myhash($_POST['password']);

          $is_auth = authenticate($login, $psw_encrypted);
          if ($is_auth) {
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $psw_provided;
            $_SESSION['password_encrypted'] = $psw_encrypted;
            header("Location: success.php");
          }
          else {
              $success = "<div class='alert alert-danger' role='alert'>
              Incorrect data, try again!
              </div>";
              print $success;
          }
          
        }
      ?>
        <div class="row pt-6 justify-content-md-center">
          <div class="col-4 mx-auto p-2">
            <div class="card text mb-3" style="max-width: 25rem;">
                <div class="card-header"><h2>Podaj hasło</h2></div>
                <div class="card-body">
                    <form action="index.php" method="POST">
                    <div class="mb-3">
                          <label for="InputLogin" class="form-label">Login</label>
                          <input name="login" type="login" class="form-control" id="InputLogin" aria-describedby="tekst">
                        </div>
                        <div class="mb-3">
                          <label for="InputPassword" class="form-label">Hasło</label>
                          <input name="password" type="password" class="form-control" id="InputPassword" aria-describedby="tekst">
                        </div>
                        <button type="submit" class="btn btn-primary">Wyślij!</button>
                    </form>
                </div>
              </div>
          </div>
        </div>
      </div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>