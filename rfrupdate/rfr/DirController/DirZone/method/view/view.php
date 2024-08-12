<?php

function view($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){

    require_once(__DIR__.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'template.php');

    return(zoneview($link, $linksystem, $controller, $method, $credentials, getDataZoneDatabase($link, filteringVar($varPost['id'], 'integer'), $credentials['Mode'])));
    
}