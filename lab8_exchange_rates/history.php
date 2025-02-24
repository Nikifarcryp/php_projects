<?php
session_start();
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $name = $_GET['name'];
    

    $url = 'https://api.nbp.pl/api/exchangerates/rates/b/' . strval($code) .'/last/30/';

    $ch = curl_init();
 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);

    if(! $result = curl_exec($ch))
    {
        echo 'Curl error: ' . curl_error($ch);
    }
    else {
        $result = json_decode($result, true);
    }
}
else {
    echo "Kod nie był przekazany!";
    exit;
};

$data_chart_all = [];

foreach($result['rates'] as $res) {
    $a = $res['effectiveDate'];
    $b = round(floatval($res['mid']), 4);
    $data_chart_all[] = [$a, $b];
}

$chartData = json_encode($data_chart_all);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Kurs waluty</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load Google Charts
        google.charts.load('current', {'packages':['corechart', 'bar']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // PHP data converted to JavaScript
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Data');
            data.addColumn('number', 'Cena');
            data.addRows(<?php echo $chartData ?>);

            var options = {
                title: 'Kurs waluty za 30 dni',
                chartArea: {width: '70%'},
                hAxis: {
                    title: 'Data',
                    format: 'yyyy-MM-dd',
                },
                vAxis: {
                    title: 'Średni kurs'
                },
                legend: { position: 'top' },
                curveType: 'function' // Optional: This smoothens the line
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="col">
        <h1 class="title">Kursy waluty <?php echo $code ?> za ostatnie 30 dni</h1>
        <h3 class="title" style="color:cornflowerblue"><?php echo ucfirst($name); ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Średni kurs</th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result['rates'] as $res): ?>
                        <tr>
                            <td><?php echo $res['effectiveDate'] ?></td>
                            <td><?php echo number_format(round(floatval($res['mid']), 4), 4) ?></td>
                        </tr>
                    <?php $data_all[] = [$res['effectiveDate'], $res['mid']] ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="chart_div" style="width: 900px; height: 500px;"></div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>