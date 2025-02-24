<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
define('DB_SERVER', 'iwb24.pl');
define('DB_NAME', 'iwb24cf_238510');
define('DB_USER', 'iwb24cf_238510');
define('DB_PASS', '0GCrMqR*k#');

if ($_SESSION['ALARM']) {
    print "<div class='alert alert-danger' role='alert'>" .
            "Database Error: Email juz jest zarejestrowany!"
            . "</div>";
    $_SESSION['ALARM'] = false;
}

function redirect() {
    if ($_POST && !isset($_POST['submitted'])) {
        $_POST['submitted'] = true;
        header("location: index.php");
        exit();
    }
}

try {
    $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare("SELECT * FROM newsletter");
    $stmt->execute();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}


if ($_POST) {
    if (isset($_POST['id_delete'])) {
        $id = $_POST['id_delete'];
        $sql = "DELETE FROM newsletter WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        redirect();
    }
    $name = $_POST['name'];
    if (count(explode(' ', $name)) < 2) {
        print "<div class='alert alert-danger' role='alert'>
        Wprowadziłeś imię lub nazwisko. Musisz wprowadzić obodwa.
      </div>";
    }
    else {
        try {
            $email = $_POST['email'];
            $sql = "INSERT INTO newsletter (name, email)
                VALUES (:name, :email)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt -> execute();
            redirect();
        }
        catch (PDOException $e) {
            $_SESSION['ALARM'] = true;
            // Czy to jest dobre rozwiązanie łapania ponownie wprowadzonego maila?
            // ||
            redirect();
            }
        }    
    }
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>SQL</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title mt-4">Dodaj się do newslettera!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="index.php" method="POST">
                <div class="row">
                    <!-- <div class="row mt-2 mb-5 justify-content-center"> -->
                    <div class="col-sm-4 col-lg-3 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="Twoje imię i nazwisko" aria-label="Imię i nazwisko">
                    </div>
                    <div class="col-sm-4 col-lg-3 mt-2">
                        <input type="email" name="email" class="form-control" placeholder="Twój email" aria-label="Twój email">
                    </div>
                    <div class="col-sm-3 col-lg-1 mt-2">
                        <button type="submit" name="save" class="btn btn-outline-success">Zapisz!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
        <h1 class="title">Subskrypcje</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table mt-3" method="DELETE">
                <thead>
                    <tr>
                        <th scope="col">Imię</th>
                        <th scope="col">Poczta mailowa</th>
                        <th scope="col">Data subskrypcji</th>
                        <th scope="col">Przycisk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['email']); ?></td>
                        <td><?php echo htmlspecialchars($item['creation_date']); ?></td>
                        <form action="index.php" method="POST">
                        <input type="hidden" name="id_delete" value="<?php echo $item['id']; ?>">
                            <td><button type="submit" name="delete" class="btn btn-outline-danger">Wypisać się</button></td>
                        </form>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>