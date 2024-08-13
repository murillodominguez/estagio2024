<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php"; 
    
    if(function_exists('accesscontrolForm') and isset($varPost['id']) and !empty($varPost['id'])){

        return manufactureComponentContainer(6, accesscontrolForm($link, $linksystem, $controller, $method, $credentials, getUserDataBase($link, filteringVar($varPost['id'], 'integer'))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'accesscontrol', $method, null));
        
    }
    
    return "erro";
}