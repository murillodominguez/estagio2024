<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php"; 

    if(function_exists('userForm')){

        if(isset($varPost['id'])){

           return userForm($link, $linksystem, 'user', 'edit', $credentials, userDataPattern($link, $credentials['Mode'],getDataUserDatabase($link, filter_var($varPost['id']), $credentials['Mode'])));

        }

        if(isset($varPost['name'])){

            return userForm($link, $linksystem, 'user', 'edit', $credentials, userDataPattern($link, $credentials['Mode'], $varPost));
 
         }
       
        return userForm($link, $linksystem, 'user', 'edit', $credentials, userDataPattern($link, $credentials['Mode'], null));

    }
    
    return "erro";
}