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
        <div class="row pt-6 justify-content-md-center">
          <div class="col-4 mx-auto p-2">
            <div class="card text mb-3" style="max-width: 25rem;">
                <div class="card-header"><h2>Podaj dane</h2></div>
                <div class="card-body">
                    <form action="success.php" method="POST">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Dane:</label>
                          <input name="inputData" class="form-control" id="exampleInputEmail1" aria-describedby="tekst">
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