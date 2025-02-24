<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
$url_all = 'http://api.nbp.pl/api/exchangerates/tables/b/?format=json';
 
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, $url_all);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);# in seconds

function edit_str($my_arr) {
    if (count($my_arr) == 1) {
        if($my_arr[0] == 'euro') {
            return 'Europe';
        }
        else {
            return ucfirst($my_arr[0]);
        }
    }
    $elems = [];
    foreach($my_arr as $n) {
        if($n !== $my_arr[0]) {
            $elem = ucfirst(str_replace(['(', ')'], '', $n) . ' ');
            $elems[] = $elem;
        };
    };
    $str_elems = implode(' ', $elems);
    return $str_elems
;}

if(! $result = curl_exec($ch))
{
    echo 'Curl error: ' . curl_error($ch);
}
else {
    $result = json_decode($result, true);
}
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Kursy walut</title>
</head>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="col">
        <h1 class="title">Kursy walut w stusunku do PLN</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Nazwa waluty</th>
                        <th scope="col">Nazwa kraju</th>
                        <th scope="col">Symbol waluty</th>
                        <th scope="col">Aktualny średni kurs</th>
                        <th name="columna ze przeciskiem" scope="col">Historia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result[0]['rates'] as $res): ?>
                        <tr>
                            <td><?php $name = mb_split(' ', $res['currency']);  echo ucfirst($name[0]) ?></td>
                            <td><?php echo edit_str($name) ?></td>
                            <td><?php echo $res['code'] ?></td>
                            <td><?php echo number_format(round(floatval($res['mid']), 4), 4) ?></td>
                            <td><a href="history.php?code=<?php echo $res['code'] ?>&name=<?php echo $res['currency'] ?>" class="btn btn-outline-info">Historia</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>