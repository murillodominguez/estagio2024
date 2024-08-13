<?php


function password($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php"; 

    if(function_exists('passwordForm')){

        if(isset($varPost['id'])){

           return passwordForm($link, $linksystem, $controller, $method, $credentials, $varPost);

        }

    }
    
    return "erro";
}