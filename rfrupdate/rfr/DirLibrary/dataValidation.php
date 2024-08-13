<?PHP

function validationErrorMessage($rowUserReceivedData){

return("Dado informado não fora do padrão estabelecido!<bR>".$rowUserReceivedData['tag']." => ".$rowUserReceivedData['value']." 
<bR>[ Padão: Tipo => ".$rowUserReceivedData['type'].",  Minimo: ".(!is_array($rowUserReceivedData['minimum'])?(($rowUserReceivedData['type']!='cpf')?$rowUserReceivedData['minimum'].", Máximo: ".$rowUserReceivedData['maximum']:"CPF INVÁLIDO"):"NÃO CONSTA NA LISTAGEM!")." ]");

}

function validationErrorMessageNotList($rowUserReceivedData){

    return("Dado informado não fora do padrão estabelecido!<bR>".$rowUserReceivedData['tag'][0]." => ".$rowUserReceivedData['value'][0]." ou  ".$rowUserReceivedData['tag'][1]." => ".$rowUserReceivedData['value'][1]."
    <bR>[ Padão: Tipo => ".$rowUserReceivedData['type'].",  Minimo: NÃO CONSTA NA LISTAGEM! ]");
    
    }

function validationErrorMessageRequired($rowUserReceivedData){

        return "Dado obrigatório não informado!<bR>".$rowUserReceivedData['tag'];
        
}

function validationErrorMessageInvalid($rowUserReceivedData){

    return "Dado informado inválido!<bR>".$rowUserReceivedData['tag'];
    
}

function validationErrorImageFormatInvalid($rowUserReceivedData){
    $file = $_FILES[$rowUserReceivedData['label']];
    return "Arquivo enviado inválido!<br>".$rowUserReceivedData['tag']." => \"".$file['name']."\" não está em um formato válido! (JPG ou PNG)<br>".var_dump($rowUserReceivedData);   
}

function validationErrorImageSizeInvalid($rowUserReceivedData){
    $file = $_FILES[$rowUserReceivedData['label']];
    return "Arquivo enviado inválido!<br>".$rowUserReceivedData['tag']." => \"".$file['name']."\" excede o tamanho máx. de arquivo! (Máx: 3MB)<br>".var_dump($rowUserReceivedData);
}

function dataValidationString($rowUserReceivedData, $link, $varPost, $controller, $varSql){

    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $minimum=((isset($rowUserReceivedData['minimum']) and $rowUserReceivedData['minimum']!=null)?$rowUserReceivedData['minimum']:0);

    $maximum=((isset($rowUserReceivedData['maximum']) and $rowUserReceivedData['maximum']!=null)?$rowUserReceivedData['maximum']:200);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null) return validationErrorMessageRequired($rowUserReceivedData);

    if(!is_string($value)) return validationErrorMessage($rowUserReceivedData);

    $countValue=strlen($value);

    if(($minimum <= $countValue) and ($countValue <= $maximum)) return 'true';

    return validationErrorMessage($rowUserReceivedData);

} 

function dataValidationBigint($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $minimum=((isset($rowUserReceivedData['minimum']) and $rowUserReceivedData['minimum']!=null)?$rowUserReceivedData['minimum']:0);

    $maximum=((isset($rowUserReceivedData['maximum']) and $rowUserReceivedData['maximum']!=null)?$rowUserReceivedData['maximum']:200);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

     if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    if(!is_numeric($value)) return validationErrorMessage($rowUserReceivedData);        

    if(($minimum <= $value) and ($value <= $maximum)) return 'true';

    return validationErrorMessage($rowUserReceivedData);

}

function dataValidationInteger($rowUserReceivedData, $link, $varPost, $controller, $varSql){    
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $minimum=((isset($rowUserReceivedData['minimum']) and $rowUserReceivedData['minimum']!=null)?$rowUserReceivedData['minimum']:0);

    $maximum=((isset($rowUserReceivedData['maximum']) and $rowUserReceivedData['maximum']!=null)?$rowUserReceivedData['maximum']:1000);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    $value=ltrim($value, "0");
     
    if(($minimum>=0) and ($maximum>0)) return (filter_var($value, FILTER_VALIDATE_INT,["options" => ["min_range" => $minimum , "max_range"=> $maximum]]))?true:validationErrorMessage($rowUserReceivedData);
         
    return (filter_var($value, FILTER_VALIDATE_INT))?'true':validationErrorMessage($rowUserReceivedData);

}

function dataValidationDate($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $minimum=((isset($rowUserReceivedData['minimum']) and $rowUserReceivedData['minimum']!=null)?$rowUserReceivedData['minimum']:null);

    $maximum=((isset($rowUserReceivedData['maximum']) and $rowUserReceivedData['maximum']!=null)?$rowUserReceivedData['maximum']:null);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    $arrayDate = explode('-', $value);

    if(!checkdate($arrayDate[1], $arrayDate[2], $arrayDate[0])) return validationErrorMessage($rowUserReceivedData);

    if($minimum!=null and $minimum>$value) return validationErrorMessage($rowUserReceivedData);

    if($maximum!=null and $maximum<$value) return validationErrorMessage($rowUserReceivedData);

    return 'true';

}

function dataValidationTime($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $minimum=((isset($rowUserReceivedData['minimum']) and $rowUserReceivedData['minimum']!=null)?$rowUserReceivedData['minimum']:'00:00:00');

    $maximum=((isset($rowUserReceivedData['maximum']) and $rowUserReceivedData['maximum']!=null)?$rowUserReceivedData['maximum']:'23:59:59');

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    if (!strpos($value, ':')) return validationErrorMessage($rowUserReceivedData);

    if(($value<'00:00:00') or ($value>'23:59:59')) return validationErrorMessage($rowUserReceivedData);

    if(($value<$minimum) or ($value>$maximum)) return validationErrorMessage($rowUserReceivedData);

    return 'true';

}

function dataValidationCpf($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    $value = str_replace(array('.','-','/'), "", $value);

    $cpf = str_pad(preg_replace('[^0-9]', '', $value), 11, '0', STR_PAD_LEFT);
    
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'){
    
        return validationErrorMessageInvalid($rowUserReceivedData);
    
    }

    for ($t = 9; $t < 11; $t++){

        for ($d = 0, $c = 0; $c < $t; $c++) {

            $d += $cpf[$c] * (($t + 1) - $c);

        }

        $d = ((10 * $d) % 11) % 10;

        if ($cpf[$c] != $d){

            return validationErrorMessageInvalid($rowUserReceivedData);
        }
    }

    return 'true';

}

function dataValidationCnpj($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    $cnpj = str_pad(str_replace(array('.','-','/'),'',$value),14,'0',STR_PAD_LEFT);
    
    if (strlen($cnpj) != 14){

        return validationErrorMessageInvalid($rowUserReceivedData);

    }

    for($t = 12; $t < 14; $t++){

        for($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++){

            $d += $cnpj[$c] * $p;
            $p  = ($p < 3) ? 9 : --$p;
        }

        $d = ((10 * $d) % 11) % 10;
        
        if($cnpj[$c] != $d){

            return validationErrorMessageInvalid($rowUserReceivedData);

        }
    }

    return 'true';    

}

function dataValidationPhone($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    return (preg_match('/^\([0-9]{2}\)?\s?[0-9]{4,5}-[0-9]{4}$/', $value))?'true':validationErrorMessageInvalid($rowUserReceivedData);    

}

function dataValidationEmail($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    return (filter_var($value, FILTER_VALIDATE_EMAIL))?'true':validationErrorMessageInvalid($rowUserReceivedData);

}

function dataValidationIp($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    return (filter_var($value, FILTER_VALIDATE_IP))?'true':validationErrorMessageInvalid($rowUserReceivedData);

}

function dataValidationBoolean($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);
    
    $varBoolean= array('1','true', 'on', 'yes', '0', 'false', 'off', 'no', 'TRUE', 'FALSE', 'ON', 'YES', 'OFF', 'NO');

    return in_array($value, $varBoolean)?'true':validationErrorMessageInvalid($rowUserReceivedData);

}

function dataValidationList($rowUserReceivedData, $link, $varPost, $controller, $varSql){
    
    // $required=((isset($rowUserReceivedData['required']))?$rowUserReceivedData['required']:false);

    // $minimum=((isset($rowUserReceivedData['minimum']) and $rowUserReceivedData['minimum']!=null)?$rowUserReceivedData['minimum']:null);

    // $value=(isset($rowUserReceivedData['value'])?$rowUserReceivedData['value']:null);

    extract($rowUserReceivedData);
    
    
    if($required==false and $value==null) return 'true';

    if($required!=false and $value==null)  return validationErrorMessageRequired($rowUserReceivedData);

    if(!is_array($minimum)) return validationErrorMessage($rowUserReceivedData);
    
    foreach($minimum as $key => $values){
        $temp = explode("(", $values['name']);
        if(is_array($temp)) $values['name']=trim($temp[0]);    
        if(treatmentString($value) == $values['name']) return true;

    }

        return validationErrorMessage($rowUserReceivedData);  

}

function dataValidationMultiselect($rowUserReceivedData, $link, $varPost, $controller, $varSql){

    extract($rowUserReceivedData);

    if(!is_array($value) or !is_array($minimum)){

        return validationErrorMessageNotList($rowUserReceivedData);

    }

    if(!in_array(treatmentString($value[0]),array_column($minimum, 'ref'))){

        return validationErrorMessageNotList($rowUserReceivedData);
    }
   
    foreach (array_column($minimum, 'data') as $row) {

        if(in_array($value[1], $row)){

           return 'true';

        }

    }    

    return validationErrorMessageNotList($rowUserReceivedData);
  
}

function dataValidationCheckbox($rowUserReceivedData, $link, $varPost, $controller, $varSql){

    extract($rowUserReceivedData);

    $cont=0;

    if(!is_array($minimum) or !is_array($value)) return validationErrorMessageInvalid($rowUserReceivedData);

    foreach ($value as $key => $values) {

        if(!array_key_exists($key, $minimum)) return validationErrorMessageInvalid($rowUserReceivedData);
        
        $temp=explode('(', $minimum[$key]);

        if(is_array($temp)){
            $var=trim($temp[0]);
        }else{
            $var=$minimum[$key];
        }

        if($values!=$var and $values!=null) return validationErrorMessageInvalid($rowUserReceivedData);

        if($values==$var) ++$cont;
    }
                
    if($required==true and $cont<1) return validationErrorMessageRequired($rowUserReceivedData);

    return 'true';

}

function dataValidationImage($rowUserReceivedData, $link, $varPost, $controller, $varSql){

    extract($rowUserReceivedData);
    extract(imageDataPattern($rowUserReceivedData, $link, $varPost, $controller, $varSql));
    if($file['tmp_name'] != ""){
        if(!startsWith(mime_content_type($file['tmp_name']), "image") || $ext != 'png' && $ext != 'jpg' && $ext != 'jpeg'){
            return validationErrorImageFormatInvalid($rowUserReceivedData);
        }
        
        if ($file['size'] > 3145728) {
            return validationErrorImageSizeInvalid($rowUserReceivedData);
        }
            return true;
    }
    return true;
}

function validateUserReceivedData($userReceivedData, $link, &$systemErrorMessage, $varPost, $controller, $varSql){

    foreach ($userReceivedData as $rowUserReceivedData) {
 
        if(isset($rowUserReceivedData['type'])){
        if($rowUserReceivedData['type'] == 'image' && $rowUserReceivedData['value'] != null || $rowUserReceivedData['type'] == 'image' && !isset($rowUserReceivedData['edit'])){
            $returnofverification = true;
        }
        else{
        $definefunction='dataValidation'.capitalFirstLetterTreatment($rowUserReceivedData['type']);
        if(function_exists($definefunction)){

            $returnofverification=call_user_func_array($definefunction, array($rowUserReceivedData, $link, $varPost, $controller, $varSql));         
        }
        }
            if($returnofverification!='true'){             

                $systemErrorMessage=$returnofverification;

                return false;

            }          
            
    }

    }
 
    return true;
 
 }