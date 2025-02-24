<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obliczanie cyfry kontrolnej</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="row pt-6 justify-content-md-center">
<?php
error_reporting(E_ERROR | E_PARSE);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $part1 = $_POST['part1'];
    $part2 = $_POST['part2'];

    if (strlen($part1) === 4 && strlen($part2) === 8 && ctype_alnum($part1) && ctype_digit($part2)) {
        $combined = $part1 . $part2;
        $weights = [1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7];
        $znakiWartosci = [
            '0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9,
            'X' => 10, 'A' => 11, 'B' => 12, 'C' => 13, 'D' => 14, 'E' => 15, 'F' => 16,
            'G' => 17, 'H' => 18, 'I' => 19, 'J' => 20, 'K' => 21, 'L' => 22, 'M' => 23,
            'N' => 24, 'O' => 25, 'P' => 26, 'R' => 27, 'S' => 28, 'T' => 29, 'U' => 30,
            'W' => 31, 'Y' => 32, 'Z' => 33
        ];
        $sum = 0;
        for ($i = 0; $i < strlen($combined); $i++) {
            $char = $combined[$i];
            if (ctype_digit($char)) {
                $val = intval($char) * $weights[$i];
            }
            else {
                $val = $znakiWartosci[strtoupper($char)] * $weights[$i];
            }
            $sum += $val;
        }

        $controlDigit = $sum % 10;

        $fullNumber = $part1 . '/' . $part2 . '/' . $controlDigit;
        $success[] = "<div class='alert alert-success' role='alert'>Pełny numer KW: " . htmlspecialchars($fullNumber) . " </div>";
    } else {
        $success[] = "<div class='alert alert-success' role='alert'>Wprowadzone dane są nieprawidłowe. Upewnij się, że pierwszy ciąg ma 4 znaki, a drugi 8 cyfr </div>";
    }
    foreach ($success as $i) {
        echo $i;
    }
}
?>
          <div class="col-4 mx-auto p-2">
            <div class="card text mb-3" style="max-width: 25rem;">
                <div class="card-header"><h2>Podaj hasło</h2></div>
                <div class="card-body">
                    <form action="KW.php" method="POST">
                    <div class="mb-3">
                        <label for="part1">Pierwsze 4 znaki numeru KW:</label>
                        <input type="text" id="part1" name="part1" maxlength="4" required>
                    </div>
                        <div class="mb-3">
                        <label for="part2">Osiem cyfr z drugiej sekcji numeru KW:</label>
                        <input type="text" id="part2" name="part2" maxlength="8" required>
                    </div>
                        <button type="submit" class="btn btn-primary">Wyślij!</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
