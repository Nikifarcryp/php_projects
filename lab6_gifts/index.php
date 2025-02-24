<?php
// error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$filename = 'data.json';

function loadGifts() {
    global $filename;
    if (file_exists($filename)) {
        $content = file_get_contents($filename);
        return json_decode($content, true);
    }
    return [];
}

function saveGifts($gifts) {
    global $filename;
    file_put_contents($filename, json_encode($gifts, JSON_PRETTY_PRINT));
}

function showGifts() {
    $number = count(loadGifts());
    if ($number == 1) {
        echo '<b>' . $number . ' para na liście' . '<b>';
    } 
    elseif (1 < $number && $number < 5) {
        echo '<b>' . $number . ' pary na liście' . '<b>';
    }
    else {
        echo '<b>' . $number . ' par na liście' . '<b>';
    }
}


function deleteGift($index) {
    $gifts = loadGifts();
    if (isset($gifts[$index])) {
        unset($gifts[$index]);
        $gifts = array_values($gifts); // Przekształcamy indeksy tablicy, aby były ciągłe
        saveGifts($gifts);
    }
}

if ($_POST && isset($_POST['for_person'], $_POST['sender'])) {

    $gift = $_POST['gift'];
    $recipient = $_POST['for_person'];
    $sender = $_POST['sender'];

    $gifts = loadGifts();
    $gifts[] = ['sender' => $sender, 'for_person' => $recipient];
    saveGifts($gifts);
    if ($_POST && !isset($_POST['submitted'])) {
        $_POST['submitted'] = true;
        header("Location: index.php");
        exit();
    }
}

if (isset($_GET['delete'])) {
    $index = (int) $_GET['delete'];
    deleteGift($index);
    header("Location: index.php");
    exit();
}
$gifts = loadGifts();
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
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title mt-4">Dodaj prezent</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="index.php", method="POST">
                <div class="row">
                    <!-- <div class="row mt-2 mb-5 justify-content-center"> -->
                    <div class="col-sm-4 col-lg-3 mt-2">
                        <input type="text" name="sender" class="form-control" placeholder="Twoje imię i nazwisko" aria-label="Imię i nazwisko">
                    </div>
                    <div class="col-sm-4 col-lg-3 mt-2">
                        <input type="text" name="for_person" class="form-control" placeholder="Dla kogo prezent" aria-label="Dla kogo prezent">
                    </div>
                    <div class="col-sm-3 col-lg-1 mt-2">
                        <button type="submit" name="save" class="btn btn-outline-success">Zapisz</button>
                    </div>
            <!-- </div> -->
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
        <h1 class="title">Tablica</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Lp.</th>
                        <th scope="col">Od kogo</th>
                        <th scope="col">Dla kogo</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gifts as $index => $gift): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($gift['sender']); ?></td>
                        <td><?php echo htmlspecialchars($gift['for_person']); ?></td>
                        <td><a href="?delete=<?php echo $index; ?>" class="btn btn-outline-danger">Usuń</a></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="table-info">
                        <td><b>Wynik</b></td>
                        <td></td>
                        <td></td>
                        <td><?php showGifts() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>