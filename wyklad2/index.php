<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <form action="index.php", method="POST">
                <div class="mb-3">
                    <h1><label for="uploadedFile" class="form-label">Wgraj plik</label></h1>
                    <input class="form-control" name="uploadedFile" type="file" id="uploadedFile">
                </div>
                <button type="submit" class="btn btn-primary">Wyslij!</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
        <?php
        if ($_POST) {
            if (isset($_FILES['uploadedFile'])) {
                // Данные о файле
                $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
                $fileName = $_FILES['uploadedFile']['name'];
                $fileSize = $_FILES['uploadedFile']['size'];
                $fileType = $_FILES['uploadedFile']['type'];
                $fileNameCmps = pathinfo($fileName);
                $fileExtension = $fileNameCmps['extension'];
            
                // Устанавливаем новое имя файла (по желанию)
                $newFileName = uniqid() . '.' . $fileExtension;
            
                // Папка для сохранения файла
                $uploadFileDir = './uploads/';
                $dest_path = $uploadFileDir . $newFileName;
            
                // Создаем папку, если она не существует
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }
            
                // Перемещаем файл в рабочую директорию
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    echo "Файл успешно загружен в: $dest_path";
                } else {
                    echo "Ошибка при сохранении файла.";
                }
            } else {
                echo "Файл не был загружен или произошла ошибка.";
            }
        }
        ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>