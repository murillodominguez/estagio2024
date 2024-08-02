<?php

function save($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){
   
    $typeaction=(isset($varPost['typeaction'])?filter_var($varPost['typeaction']):null);

    require_once("library".DIRECTORY_SEPARATOR."library.php");
    require_once("library".DIRECTORY_SEPARATOR."sql.php");

    if(function_exists($typeaction)){

        return(call_user_func_array($typeaction, array($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem)));
          

    }
 
    return("erro");
}
