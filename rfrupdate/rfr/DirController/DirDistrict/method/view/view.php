<?php

function view($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){

    require_once(__DIR__.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'template.php');

    return(functionview($link, $linksystem, 'district', 'method', $credentials, getDataFunctionDatabase($link, filteringVar($varPost['id'], 'integer'), $credentials['Mode'])));
    
}