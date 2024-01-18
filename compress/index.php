<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($_GET['error'])){
        switch($_GET['error']){
            case 1: echo "Formato de arquivo inválido!";
            break;
            case 2: echo "Tamanho de arquivo excedeu o limite (4MB).";
            break;
            default: "";
            break;
        }
        }?>
    <form action="upload.php" method="post" enctype="multipart/form-data" id="form">
        <input type="file" accept="image/*" id="img" name="fileToUpload" src="" alt="inserir imagem" required>
        <button type="submit" id="submit">Upload Image</button>
    </form>

    <div class="feliz"></div>
<script src="script.js" defer></script>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js" defer></script>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" id="img" name="fileToUpload" src="" alt="inserir imagem">
        <input type="submit" name="submit" value="Upload Image">
    </form>

    <div class="feliz"></div>
</body>
</html> -->