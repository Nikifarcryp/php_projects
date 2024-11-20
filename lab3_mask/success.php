<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Maskowanie</title>
</head>
<body>
<?php
    if ($_POST) {
        $input = $_POST['inputData'];

        if (empty($input)) {
            echo "<p style='color: red;'>Proszę wprowadzić dane.</p>";
        } 
        else {
            $masked = maskData($input);

            if ($masked) {
                echo "<div class='container'>
                        <div class='row pt-6 justify-content-md-center'>
                            <div class='col-4 mx-auto p-2'>
                                <div class='card text mb-3' style='max-width: 25rem;'>
                                    <div class='card-header'><h2>Wyniki</h2></div>
                                        <div class='card-body'>
                                            <p><strong>Oryginał:</strong> $input</p>
                                            <p><strong>Maskowane:</strong> $masked[0]</p>
                                            <p><strong>Podane jest: </strong> $masked[1]</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            } 
            else {
                echo "<div class='container'>
                        <div class='row pt-6 justify-content-md-center'>
                            <div class='col-4 mx-auto p-2'>
                                <div class='card text mb-3' style='max-width: 25rem;'>
                                    <div class='card-header'><h2>Wyniki</h2></div>
                                        <div class='card-body'>
                                            <p style='color: red;'>Nie rozpoznano typu danych. Proszę wprowadzić poprawne dane.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
        }
    }

    function maskData($data) {
        if (preg_match('/^\d{11}$/', $data)) {
            // Maskowanie PESEL
            return [(substr($data, 0, 2) . '*****' . substr($data, 7, 2) . '*'), "PESEL"];
        } 
        elseif (preg_match('/^[a-zA-ZĄąĆćĘęŁłŃńÓóŚśŹźŻż]{2,}$/', $data)) {
            // Maskowanie imienia/nazwiska
            $length = mb_strlen($data);
            if ($length > 3) {
                $maskedMiddle = str_repeat('*', $length - 3);
                return [(mb_substr($data, 0, 2) . $maskedMiddle . mb_substr($data, -1)), "Imię | Nazwisko"];
            }
            else {

                return [(mb_substr($data, 0, 1) . str_repeat('*', $length - 1)), "Imię | Nazwisko"];
            }
        }
        elseif (filter_var($data, FILTER_VALIDATE_EMAIL)) {
            // Maskowanie e-maila
            $parts = explode('@', $data);
            $local = $parts[0]; 
            $domain = $parts[1];
            
            // Maskowanie lokalnej części
            if (strlen($local) > 2) {
                $maskedLocal = substr($local, 0, 2) . str_repeat('*', strlen($local) - 2);
            } else {
                $maskedLocal = $local . '**';
            }
            // Łączenie zamaskowanej części z domeną
            return [($maskedLocal . '@' . $domain), "Email"];
        }
        
        return null; // Nie rozpoznano typu danych
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>