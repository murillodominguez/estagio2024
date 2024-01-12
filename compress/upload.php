<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if(!is_dir($target_dir)){
    mkdir($target_dir);
}
$uploadOk = 1;
$filename_tmp = $_FILES["fileToUpload"]["tmp_name"];
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// if(isset($_POST['submit'])){
//     $check = getimagesize($filename_tmp);
//     if($check !== false){
//         echo "O arquivo é uma imagem - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     }
//     else{
//         echo "O arquivo não é uma imagem.";
//         $uploadOk = 0;
//     }
// }
// Verifica o tipo de imagem -- Lê os primeiros bytes da imagem para checar sua assinatura
function base64tojpeg($base64_str, $output_file){
    $ifp = fopen($output_file, "w+");
    fwrite($ifp, base64_decode($base64_str));
    fclose($ifp);
    return($output_file);
}

$imgreconstruct = base64tojpeg($_POST["dataURL"],"image.jpg");


$imageType = exif_imagetype($filename_tmp);

// Compara o tipo de imagem com constantes definidas na extensão
if ($imageType === IMAGETYPE_JPEG || $imageType === IMAGETYPE_PNG || $imageType === IMAGETYPE_GIF) {
    echo "O arquivo é uma imagem.";
    $uploadOk = 1;
} else {
    $uploadOk = 0;
    echo "O arquivo não é uma imagem.";
}

if($uploadOk == 1){
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        echo "Arquivo válido e enviado com sucesso.\n";
    } else {
        echo "Erro, arquivo não válido\n";
    }
}

echo var_dump($_FILES["fileToUpload"]);
echo ("<br>");
echo var_dump($filename_tmp);
echo ("<br>");
echo var_dump($imageFileType);
echo ("<br>");
echo var_dump($imageType);
echo ("<br>");
echo var_dump($_POST["dataURL"]);
?>