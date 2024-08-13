<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php"; 

    if(function_exists('profileForm')){

        if(isset($varPost['id'])){

           return profileForm($link, $linksystem, 'profile', 'edit', $credentials, profileDataPattern($link, $credentials['Mode'],getDataUserDatabase($link, filter_var($varPost['id']), $credentials['Mode'])));

        }

    }
    
    return "erro";
}