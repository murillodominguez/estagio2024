<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php";

    if(function_exists('publicplaceForm')){

        if(isset($varPost['id'])){

           return publicplaceForm($link, $linksystem, 'publicplace', 'edit', $credentials, publicplaceDataPattern($link, $credentials['Mode'],getDataPublicplaceDatabase($link, filter_var($varPost['id']), $credentials['Mode'])));

        }

        if(isset($varPost['name'])){

            return publicplaceForm($link, $linksystem, 'publicplace', 'edit', $credentials, publicplaceDataPattern($link, $credentials['Mode'], $varPost));
 
         }
       
        return publicplaceForm($link, $linksystem, 'publicplace', 'edit', $credentials, publicplaceDataPattern($link,$credentials['Mode'],null));

    }
    
    return "erro";
}