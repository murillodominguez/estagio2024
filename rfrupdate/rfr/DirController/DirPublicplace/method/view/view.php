<?php

function view($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){

    require_once __DIR__.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'template.php';

    return publicplaceview($link, $linksystem, 'publicplace', $method, $credentials, getDataPublicplaceDatabase($link, filteringVar($varPost['id'], 'integer'), $credentials['Mode']));
    
}