<?php
require_once('../tfpdf/tfpdf.php');

if($_POST) {
  $dyp = $_POST['dyploma_name'];
  $name = $_POST['name'];
  $dt = strval($_POST['dyploma_date']);

  $pdf = new tFPDF();

  $pdf->AddPage();

  $pdf->AddFont('DejaVuSans','','DejaVuSans.ttf',true);
  $pdf->AddFont('DejaVuSans_o','','DejaVuSans-Oblique.ttf',true);
  $pdf->AddFont('DejaVuSans_b','','DejaVuSans-Bold.ttf',true);

  $pdf->Image('https://szkolnenaklejki.pl/userdata/public/gfx/15794.png', 0, 0, 210);

  $pdf->SetFont('DejaVuSans_o','',14);
  $pdf->Ln(9);
  $pdf->Cell(177, 10, 'Data: ' . $dt, 0, 1, 'R');

  $pdf->SetFont('DejaVuSans_b','',28);
  $pdf->Ln(64);
  $pdf->Cell(190,10,$name,0,1,'C');

  $pdf->SetFont('DejaVuSans_b','',20);
  $pdf->Ln(20);
  $pdf->SetX(46);
  // $pdf->Text(0,0,'Co za dypllom Co za dypllom Co za dypllom');
  $pdf->MultiCell(118,20,$dyp,0,'C');

  $pdf->SetFont('DejaVuSans','',14);
  $pdf->Ln(90);
  $pdf->SetX(45);
  $pdf->Cell(190,10,'Wyrazy szacunku',0,1);

  $pdf->Output('I', 'mypdf.pdf', true);   # I, D
}
// Include the main TCPDF library (search for installation path).
# http://www.fpdf.org/
# https://iwb24.pl/Vendor/fpdf/tutorial/



#$pdf->SetFont('Lato_b','',14);
#$pdf->Cell(40,10,'Hello World! śćłó');

#$pdf->Ln(5);

#$pdf->Image('https://wakacjezpsem.com/wp-content/uploads/2023/03/Rhodesian-Ridgeback-900x500.png', 0, 30, 100, 50);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dyploma</title>
</head>
<body>
  <divclass="row pt-6 justify-content-md-center">
    <div class="col-4 mx-auto p-2">
      <div class="card text mb-3" style="max-width: 25rem;">
        <div class="card-header"><h2>Podaj dane do dyplomu</h2></div>
          <div class="card-body">
            <form action="index.php" method="POST">
                <div class="mb-3">
                  <label for="InputLogin" class="form-label">Podaj osiągniecia dla dyplomu</label>
                  <input name="dyploma_name" type="text" class="form-control" id="InputLink" aria-describedby="tekst">
                </div>
                <div class="mb-3">
                  <label for="InputLogin" class="form-label">Imię i Nazwisko</label>
                  <input name="name" type="text" class="form-control" id="InputLink" aria-describedby="tekst">
                </div>
                <div class="mb-3">
                  <label for="InputLogin" class="form-label">Data na dyplomie</label>
                  <input name="dyploma_date" type="date" class="form-control" id="InputLink" aria-describedby="tekst">
                </div>
                <button type="submit" class="btn btn-primary">Wygeneruj!</button>
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