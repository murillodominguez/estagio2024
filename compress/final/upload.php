<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if(!is_dir($target_dir)){
    mkdir($target_dir);
}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST['submit'])){
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false){
        echo "O arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    }
    else{
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }
}

if($uploadOk == 1){
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        echo "Arquivo válido e enviado com sucesso.\n";
    } else {
        echo "Erro, arquivo não válido\n";
    }
}

echo var_dump($_FILES["fileToUpload"]);