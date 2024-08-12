<?php

function standard($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){

    require_once(__DIR__.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'template.php');

    return(manufactureComponentContainer(6,userview($link, $linksystem, 'profile', $method, $credentials, getDataUserDatabase($link, $credentials['IdServidor'], $credentials['Mode']))));
    
}