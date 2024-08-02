<?php

function view($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){

    require_once(__DIR__.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'template.php');

    return(manufactureComponentContainer(6,accesscontrolview($link, $linksystem, $controller, $method, $credentials, getUserDataBase($link, filteringVar($varPost['id'], 'integer')), searchAccessPermissionsOnUserControllerInDatabase($link, filteringVar($varPost['id'], 'integer'))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'accesscontrol', 'view', null)));
    
}