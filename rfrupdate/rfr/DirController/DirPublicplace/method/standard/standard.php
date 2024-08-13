<?php

function standard($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){

    $userReceivedData= array(
        array("type" => "integer", "value" => (isset($varPost['pagina'])?$varPost['pagina']:null), "required" => false, "minimum" => null, "maximum" => null),    
        array("type" => "string", "value" => (isset($varPost['filter'])?$varPost['filter']:null), "required" => false, "minimum" => null, "maximum" => null),    
        array("type" => "string", "value" => (isset($varPost['filterVar'])?$varPost['filterVar']:null), "required" => false, "minimum" => null, "maximum" => null),    
        array("type" => "string", "value" => (isset($varPost['orderVar'])?$varPost['orderVar']:null), "required" => false, "minimum" => null, "maximum" => null),    
        array("type" => "string", "value" => (isset($varPost['forOrder'])?$varPost['forOrder']:null), "required" => false, "minimum" => null, "maximum" => null),    
     );    
    
    if(validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, null)){
       
    $return=listPublicplace($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem);
     
     }

     if(!isset($return)){

        $systemErrorMessage="Falha na verificação dos dados informados!";
        $return=manufactureComponentContainer(6, manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'publicplace', 'edit', null));

     }

    return $return;
    
}