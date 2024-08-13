<?php

function setEditMethod($action){

    switch ($action) {

        case 'edit':

            return 'edit';   


        case 'new':

             return 'new';   


        case 'save':
            
             return 'save';
        
        
        default:
              
             return false;    

        
    }

}

function formatStatus($value){

    switch ($value) {
        
        case '0':
            return 'CANCELADO';

        case '1':
            return 'NORMAL';

        case '2':
                return 'EDIÇÃO';

        case '3':
                return 'SUPERVISÃO';       

        default:
            return $value;   
        }

}

function formatDate($link, $controller, $idPointer, $labelValue, $value){

    if(($value==null)and($value!=0)){
        return $value;
    }
    
    if(strpos($labelValue, 'status')==true){

        if(function_exists($controller.'formatStatus')){
          
 
             return call_user_func_array($controller.'formatStatus', array($link, $idPointer));

        }
      ;

        return formatStatus($value);
    } 
    
    if(strpos($labelValue, 'prazo')==true){
       
        return date('d/m/Y', strtotime($value));

    }

    if($labelValue=='time'){
   
        return date('d/m/Y H:i', strtotime($value));

    }

    return (strpos($labelValue, 'data')!=false)?date('d/m/Y', strtotime($value)):$value;

}

function checkIfFirstLargest($first, $second){

    
    if($first >= $second){

        return true;

    }

    return false;

}

function comparedata($userReceivedData, $varDatabase, $link, $varPost, $controller, $varSql){

  $return="";

  foreach($userReceivedData as $row){
    // echo '<br>'.print_r($row).'<br>';
    if(isset($row['label']) and !empty($row['label']) and isset($row['isdatabase']) and $row['isdatabase'] == true){
            if(($row['type']=='image' and !isset($row['value'])) || ($row['type']=='image' and isset($row['edit']))){
                extract(imageDataPattern($row, $link, $varPost, $controller, $varSql));
                if($targetDir."/".$newFileName!=$varDatabase['path']){
                    $return.= $targetDir."/".$newFileName." => ".$varDatabase['path'].", ";
                }
            }
            else if(isset($varDatabase[$row['label']])){

                if($row['type']=='checkbox'){
                    foreach($row['value'] as $value => $key)
                    if(treatmentString($key)!=$varDatabase[$row['label']]){
                        $return.= $row['label']." => ".$varDatabase[$row['label']].", ";
                    }
                }
            
                if(treatmentString($row['value'])!=$varDatabase[$row['label']]){

                $return.= $row['label']." => ".$varDatabase[$row['label']].", ";

            }
            }
        }
    }

 return $return;

} 

function dataPreparationForSql($userReceivedData){

    $return=array();
  
  foreach ($userReceivedData as $row) {
    if(isset($row['typeform']) && $row['typeform'] != 'subtitle' && $row['type'] != 'image'){
        // var_dump($row);
        // echo '<br>';
        if(isset($row["isdatabase"]) && $row["isdatabase"] == true && $row['type'] != 'checkbox' && $row['type'] != 'image'){
            $return['database'][] = treatmentString($row['value']);
        }
        if(!is_array($row['value'])){
            $return[$row['label']] = treatmentString($row['value']);
        }
        
        if(is_array($row['value'])){

            foreach ($row['value'] as $key_internal => $value_internal) {
                (isset($row["isdatabase"]) && $row["isdatabase"] == true)?$return['database'][$key_internal] = treatmentString($value_internal):null;
                $return[$key_internal] = treatmentString($value_internal);
            }
        
        }
    }
  }
    
  return $return;
  
  }

  function isMobile() {
        $is_mobile = false;
 
        //Se tiver em branco, não é mobile
        if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
            $is_mobile = false;
 
        //Senão, se encontrar alguma das expressões abaixo, será mobile
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
                $is_mobile = true;
 
        //Senão encontrar nada, não será mobile
        } else {
            $is_mobile = false;
        }
 
        return $is_mobile;
    }

    function authorizedUserAccessMethod($type, $userpermissions){

        return in_array(treatmentString($type), array_column($userpermissions, 'method'))?true:false;

    }

    function checkIfPathExists($controller){

       if($controller=='login') return true;

       if($controller=='standard') return true;

       return file_exists($path = __DIR__."/../DirController/Dir".ucfirst($controller)."/".$controller."Controller.php");

    }


    function lockControllerDataBase($link, $controller, $method, $action){

        $sql="SELECT * FROM `lockcontroller` where `controller`= ? and  (`method` is null or `method`=?)  and  (`action` is null or `action`=?) and `status`='ATIVADO'";
        $stmt = $link->prepare($sql);
        $stmt->bind_Param('sss', $controller, $method, $action);
        $stmt->execute();
        $result = $stmt->get_result();   
        
        return $result->num_rows;
     
     }


     function lockController($link, $controller, $method, $action){
        return (lockControllerDataBase($link, treatmentString($controller), treatmentString($method), treatmentString($action))>0)?true:false;
     
     }


     function checksIfTheLastCallWasFromTheManager($link, $controller, $method, $registration){

        $sql="SELECT method FROM `log` WHERE `controller`=? and method!=? and registration=? order by id desc limit 0,1";
        $stmt = $link->prepare($sql);
        $stmt->bind_Param('sss', $controller, $method, $registration);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        
        return ($row['method']=='tomanage')?'ToManage':'';
    
        }

    return '';

     }

     function startsWith($string, $startStr){
        $len = strlen($startStr);
        return substr($string, 0, $len) === $startStr;
    }

    function base64tojpeg($base64_str, $output_file, $targetDir){
        $ifp = fopen($targetDir."/".$output_file, "w+");
        fwrite($ifp, base64_decode($base64_str));
        fclose($ifp);
        return $output_file;
    }

    function importCsv($file, $tablename, $link, $header = true, $separator = ','){
        //VERIFICA SE O ARQUIVO EXISTE
        if(!file_exists($file)){
            die('Arquivo não encontrado!');
        }
    
        //DADOS DAS LINHAS DO ARQUIVO
        $data = [];
    
        //ABRE O ARQUIVO
        $csv = fopen($file,'r');
    
        //CABEÇALHO DOS DADOS (PRIMEIRA LINHA)
        $headerData = $header ? fgetcsv($csv,0,$separator) : [];
    
        //INSERE OS DADOS PERCORRENDO AS LINHAS DO ARQUIVO CSV
        while($linha = fgetcsv($csv,0,$separator)){
            $data[] = $header ? 
                      array_combine($headerData,$linha) :
                      $linha;
        };
    
        //FECHA O ARQUIVO
        fclose($csv);
        $sql='INSERT INTO `'.$tablename.'` (';
        foreach($data[0] as $key => $value){
            $sql.=$key.',';
        }
        $sql = rtrim($sql, ',');
        $sql.=') VALUES ';
        //SQL PARA IMPORTAR
        foreach($data as $row){
            $sql.= '(';
            foreach($row as $dataitem){
                $sql.='"'.$dataitem.'",';
            }
            $sql = rtrim($sql, ',');
            $sql.='),';
        }
        $sql = rtrim($sql, ',');
        echo $sql;
        $stmt = $link->prepare($sql);
        $stmt->execute();
    
        //RETORNA OS DADOS PROCESSADOS
        return $data;
    }