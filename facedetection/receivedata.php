<?php
if(isset($_POST) && !empty($_POST)){
    var_dump($_POST);

    $img = $_POST['imgBase64'];
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);
    //saving
    $fileName = 'new.jpeg';
    file_put_contents($fileName, $fileData);
}