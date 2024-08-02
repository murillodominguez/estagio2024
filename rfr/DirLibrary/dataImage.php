<?php 
    function getNextId($link, $table){
    $query = "select auto_increment from information_schema.tables WHERE TABLE_SCHEMA = 'rfr' AND TABLE_NAME = '$table'";
    $stmt=$link->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows>0){                

        $row=$result->fetch_assoc();
        return($row['auto_increment']);
    
    }
    return(false);
}

function uploadImagetoServer($rowUserReceivedData, $link, $varPost, $controller, $varSql, $action){
        extract(imageDataPattern($rowUserReceivedData, $link, $varPost, $controller, $varSql));
        if ($_FILES[$rowUserReceivedData['label']]['tmp_name'] == ""){
            return false;
        }
            echo('TIPO MIME DA IMAGEM: '.mime_content_type($file['tmp_name'])."<br>".$varPost['id']);
            //Verificação dependente de JS
            echo '<br><br>Possível imagem nova (nome sem substituição): '.$newFileName;
            $newFile = $newFileName;
            if($action == "update"){
                    if($controller == 'profile') $controller = 'user';
                if(file_exists(SearchImagefromDatabase($link, $varPost, $controller, $order))){
                    $oldFileName = explode("/",SearchImagefromDatabase($link, $varPost, $controller, $order));
                    $oldFileName = $oldFileName[count($oldFileName)-1];
                    echo '<br><br>File Nome antigo: '.$oldFileName.'<br><br>';
                    echo "<br><br>DALE DUMP";
                    var_dump($order);
                    echo "<br><br>";
                    $newFileName = $controller.$varPost['id']."_".date("Y-m-d_H-i")."-".$order.".".$ext;
                    $newFile = $newFileName;
                    $newDir = "assets/upload/img/".$control."/deleted";
                    echo "<br>UPDATED:<br>newFile: ".$newFile."<br>New Directory: ".$newDir;
                    if(!is_dir($newDir)){
                        mkdir($newDir, 0777, true);
                    }
                    rename(SearchImagefromDatabase($link, $varPost, $controller, $order),$newDir."/".$oldFileName);
                }
                else{
                    $newFile = $controller.$varPost['id']."_".date("Y-m-d_H-i")."-".$order.".".$ext;
                }
                uploadImagetoDatabase($rowUserReceivedData, $link, $varPost, $controller, $varSql, $newFile, $action);
            }
            echo "<br><br>newFile fora do IF UPDATE: ".$newFile."<br>";
            if(!empty($varPost['dataURL'.$order])){
                $imgreconstruct = base64tojpeg($varPost["dataURL".$order], $newFile, $targetDir);
                echo 'output file do imgreconstruct: ';
                var_dump($imgreconstruct);
                //Verificar imagem reconstruída
                $path = $targetDir."/".$imgreconstruct;
                if(exif_imagetype($path) == IMAGETYPE_JPEG || exif_imagetype($path) == IMAGETYPE_PNG || exif_imagetype($path) == IMAGETYPE_GIF){
                    echo '<p class="alert alert-success">imagem inserida no diretório com sucesso!</p>';
                    // if(is_file(SearchImagefromDatabase($link, $varPost, $controller, $order)))
                    return true;
                }else{
                    echo('<p class="alert alert-danger">nao foi possivel inserir a imagem!</p>');
                    unlink($path);
                }
            }   
            else{
            //Upload em PHP apenas, após certificar-se do MIME type do arquivo enviado (verificação de imagem)
            $path = $targetDir."/".$newFileName;
            echo '<br><br>';
            echo 'Path Upload PHP Only: '.$path;
            echo '<br><br>';
            if(!move_uploaded_file($file['tmp_name'], $path)){
                echo('<p class="alert alert-danger">nao foi possivel inserir a imagem!</p>');
                return false;
            };
                echo('<p class="alert alert-success">imagem inserida com sucesso</p>');
            return true;
        }
}

function uploadImagetoDatabase($rowUserReceivedData, $link, $varPost, $controller, $varSql, $newFileUpload, $action){
    var_dump($_FILES[$rowUserReceivedData['label']]);
    extract(imageDataPattern($rowUserReceivedData, $link, $varPost, $controller, $varSql));
    $newFileUpload=(isset($newFileUpload))?$newFileName:$newFileName;
    echo 'AQUI ESTÁ A AÇÃO: '.$action;
    if($action == 'update'){
        $controllerid = $varPost['id'];

        //mudar path da imagem deletada

            $image = SearchImagefromDatabase($link, $varPost, $controller, $order);
            if($image != null){
            $exp = explode('/',$image);
            $exp[4] = 'deleted';
            $image = implode('/',$exp);
            echo "<br>Imagem deletada: ".$image;

            $path = $targetDir."/".$controller.$controllerid."_".date("Y-m-d_H-i")."-".$order.".".$ext;

            //query id da tabela upload

            $query = "select img.id from ".$controller." join (select * from image join (SELECT MAX(dateupload) as maxdate from image where controller='".$controller."' and ordercontrol=? GROUP by controller_id) recent on image.dateupload = recent.maxdate where controller_id=? and ordercontrol=?) img on ".$controller.".id = img.controller_id";
            $stmt=$link->prepare($query);
            $stmt->bind_Param('iii', $order, $varPost['id'], $order);
            $stmt->execute();
            $result=$stmt->get_result();
            $row = $result->fetch_assoc();
            $lastuploadid = $row['id'];
            
            echo '<br><br>ID DO ÚLTIMO UPLOAD DE ORDEM '.$order." ";
            var_dump($lastuploadid);
            echo '<br><br>';


            //path deleted
            
            $query = 'UPDATE image SET path=? where id=?';
            $stmt=$link->prepare($query);
            $stmt->bind_Param('si', $image, $lastuploadid);
            $stmt->execute();
        }
        $newFileUpload = $controller.$controllerid."_".date("Y-m-d_H-i")."-".$order.".".$ext;
    }
    $path= $targetDir."/".$newFileUpload;
    $userid = $_SESSION['credentials'];
    $query = "INSERT INTO `image` (name,path,controller,controller_id,ordercontrol,user_id) VALUES (?,?,?,?,?,?)";
    $stmt = $link->prepare($query);
    $stmt->bind_Param("sssiii", $newFileUpload, $path, $controller, $controllerid, $order, $userid);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        echo('<p class="alert alert-success">imagem inserida no banco de dados com sucesso!</p>');
        return true;
    }
    echo('<p class="alert alert-danger">falha ao inserir imagem no banco de dados</p>');
    return false;
}

function SearchImagefromDatabase($link, $varPost, $controller, $order){
    // $query="select path, image.name from image inner join ".$controller." on ".$controller.".id=image.controller_id where ".$controller.".id=? and image.dateupload = (select max(dateupload) from image where ordercontrol=? and controller_id =  ".$controller.".id) and image.ordercontrol=?";
    $query="select * from ".$controller." join (select * from image join (SELECT MAX(dateupload) as maxdate from image where controller='".$controller."' and ordercontrol=? GROUP by controller_id) recent on image.dateupload = recent.maxdate where controller_id=? and ordercontrol=?) img on ".$controller.".id = img.controller_id";
    $stmt = $link->prepare($query);
    $stmt->bind_Param("iii", $order, $varPost['id'], $order);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        // echo "<br><br>path sendo retornado da consulta sql: ".$row['path']."<br>".$order."<br>E a query: ".$query;
        echo '<br>Aqui a Row<br>';
        var_dump($row);
        echo '<br><br>';
        return $row['path'];
    }
    return false;
}

function imageExistsinSystem($link, $varPost, $controller){
    $query="select path from image inner join ".$controller." on ".$controller.".id=image.controller_id where ".$controller.".id=? and image.dateupload = (select max(dateupload) from image)";
    $stmt = $link->prepare($query);
    $stmt->bind_Param("i", $varPost['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows>0){
        echo"<br>a imagem existe ok<br>";
        return true;
    }
}

function imageDataPattern($rowUserReceivedData, $link, $varPost, $controller, $varSql, $order = 1){
    extract($rowUserReceivedData);
    $file = $_FILES[$label];
    echo '<br><br>Olá';
    var_dump($file);
    echo '<br><br>';
    $ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
    $year = date('Y');
    $targetDir = "assets/upload/img/".$controller."/".$year;
    if(!is_dir($targetDir)){
        mkdir($targetDir, 0777, true);
    }

    $imageDataPattern = array(
        'file' => $file,
        'ext' => $ext,
        'newFileName' => $controller.getNextId($link, $varPost['table'])."_".date("Y-m-d_H-i")."-".$order.".".$ext,
        'targetDir' => $targetDir,
        'control' => $controller,
        'controllerid' => (isset($file['tmp_name']))?getNextId($link, $varPost['table']):null,
        'order' => $order
    );
    return $imageDataPattern;
}