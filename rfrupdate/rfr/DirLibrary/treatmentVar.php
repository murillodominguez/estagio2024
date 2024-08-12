<?php

/////////////////////////////////////////////////////
//                                                 //
//                                                 //
//    Biblioteca geral de tratamento de Variaveis  //
//                                                 //
//                                                 // 
/////////////////////////////////////////////////////

function filteringVarString($variavel){

    return(filter_var($variavel, FILTER_SANITIZE_FULL_SPECIAL_CHARS , FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP));
               
}

function filteringVarInteger($variavel){

    return(filter_var(str_replace('-','', str_replace('+','',$variavel)), FILTER_SANITIZE_NUMBER_INT));

}

function filteringVarFloat($variavel){

    return(filter_var(str_replace('-','', str_replace('+','',$variavel)), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND));

}

function filteringVarDate($variavel){

    return(date('Y-m-d', strtotime($variavel)));

}

function filteringVarTime($variavel){

    return(date('H:i:s', strtotime($variavel)));

}

function filteringVarBoolean($variavel){

    return(filter_var($variavel, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE));

}

function filteringVarIp($variavel){

    return(filter_var($variavel, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6));

}

function filteringVarChar($variavel){

    return(filter_var(substr($variavel,0,1), FILTER_SANITIZE_SPECIAL_CHARS , FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP));

}



function filteringVar($variavel, $tipo){

    $tipo='filteringVar'.$tipo;

    if(!function_exists($tipo)) return(null);

    return(call_user_func($tipo, $variavel));

}

function whitespaceRemoval($string){

    $string=preg_replace('/\s+/', ' ',$string);
    $string=trim($string);
    return($string);

}

function treatmentStringOld($texto){

    $new_texto=filter_var($texto, FILTER_DEFAULT);	
$new_texto=filter_var($new_texto, FILTER_SANITIZE_SPECIAL_CHARS);	
$new_texto=strtoupper($new_texto);
$new_texto=mb_strtoupper($new_texto);
$new_texto=preg_replace('/\s+/', ' ',$new_texto);
$new_texto = str_replace("&#13;&#10;", " ", $new_texto);
$new_texto=trim($new_texto);
return($new_texto);

}



function treatmentString($string){
    if($string == null) return $string;
    $string=whitespaceRemoval($string);
    $string=(mb_strtoupper($string));
    $string=filteringVarString($string);

    return($string);

}

function capitalFirstLetterTreatment($string){

    $string=whitespaceRemoval($string);
    $string=ucfirst(mb_strtolower($string));
    $string=filteringVarString($string);

    return($string);

}
?>