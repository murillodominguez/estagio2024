<?php

//Criando diretório e ponteiro do arquivo da imagem

$target_dir = "uploads/";
//Caso o diretório alvo não exista, criá-lo.
if(!is_dir($target_dir)){
    mkdir($target_dir);
}
$target_file = $target_dir . incrementFilename($_FILES["fileToUpload"]["name"], $target_dir);

function splitLast($str, $delim){
    $explode = explode($delim,$str);
    $count = count($explode);
    if(!$explode || $count === 1){
        $before=$str;
        $after="";
    }else{
        $after = array_pop($explode);
        $before = implode($delim, $explode);
    }
    return array($before,$after);
}


//Caso haja imagens de mesmo nome da imagem enviada no diretório
function incrementFilename($name, $path){
    if(!array_search($name,scandir($path))){
        return $name;
    }
    else{
        $ext = splitLast($name,".")[1];
        $baseFileName = splitLast(splitLast($name,".")[0], "(")[0];
        $num = intval(splitLast(splitLast(splitLast($name,".")[0], "(")[1], ")")[0])+1;
        return incrementFilename($baseFileName."(".$num.")".".".$ext,$path);
    }
}

//Verificação da imagem
function startsWith($string, $startStr){
    $len = strlen($startStr);
    return(substr($string, 0, $len) === $startStr);
}
if(!startsWith(mime_content_type($_FILES['fileToUpload']['tmp_name']), "image")){
    header ('Location: index.php?error=1');
    die();
}else if ($_FILES['fileToUpload']['size'] > 4000000) {
    header ('Location: index.php?error=2');
    die();
}
else{
    $newFileName = incrementFilename($_FILES["fileToUpload"]["name"], $target_dir);
    if(!empty($_POST['dataURL'])){
        echo(mime_content_type($_FILES['fileToUpload']['tmp_name'])."<br>");
        //Verificação dependente de JS
        echo var_dump($_POST["dataURL"]);
        function base64tojpeg($base64_str, $output_file){
            $ifp = fopen("uploads".DIRECTORY_SEPARATOR.$output_file, "w+");
            fwrite($ifp, base64_decode($base64_str));
            fclose($ifp);
            return($output_file);
        }
        $imgreconstruct = base64tojpeg($_POST["dataURL"], $newFileName);
        var_dump($imgreconstruct);

        //Verificar imagem reconstruída
        $path = "uploads".DIRECTORY_SEPARATOR.$imgreconstruct;
        if(exif_imagetype($path) == IMAGETYPE_JPEG || exif_imagetype($path) == IMAGETYPE_PNG || exif_imagetype($path) == IMAGETYPE_GIF){
            echo "imagem inserida no diretório<br>";
        }else{
            unlink("uploads".DIRECTORY_SEPARATOR.$imgreconstruct);
        }
    }else{
        //Upload em PHP apenas, após certificar-se do MIME type do arquivo enviado (verificação de imagem)
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
    }
    // echo '<img src="uploads/Placa 1(1).jpg"/>';
}


// if(is_file($imgreconstruct)){
//     $imageType = exif_imagetype($imgreconstruct);
//     if ($imageType === IMAGETYPE_JPEG || $imageType === IMAGETYPE_PNG || $imageType === IMAGETYPE_GIF) {
//         echo "O arquivo é uma imagem.<br>";
//         $uploadOk = 1;
//     } else {
//         $uploadOk = 0;
//         echo "O arquivo não é uma imagem.";
//     }
// }

//     // Verifica o tipo de imagem -- Lê os primeiros bytes da imagem para checar sua assinatura
//     $imageType = exif_imagetype($_FILES["fileToUpload"]["tmp_name"]);
//     // Compara o tipo de imagem com constantes definidas na extensão
//     if ($imageType === IMAGETYPE_JPEG || $imageType === IMAGETYPE_PNG || $imageType === IMAGETYPE_GIF) {
//         $uploadOk = 1;
//     } else {
//         $uploadOk = 0;
//     }
// }

// else{
// $uploadOk = 0;
// }

// if($uploadOk == 1){
// move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file) or die('valheim');
// }
echo var_dump($_FILES["fileToUpload"]);
echo ("<br>");
echo var_dump($_FILES["fileToUpload"]["tmp_name"]);
echo ("<br>");
echo '<img src="'.$target_dir.$newFileName.'"/>';