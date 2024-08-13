<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php"; 

    if(function_exists('functionForm')){

        if(isset($varPost['id'])){

           return functionForm($link, $linksystem, 'function', 'edit', $credentials, functionDataPattern($link, $credentials['Mode'],getDataFunctionDatabase($link, filter_var($varPost['id']), $credentials['Mode'])));

        }

        if(isset($varPost['name'])){

            return functionForm($link, $linksystem, 'function', 'edit', $credentials, functionDataPattern($link, $credentials['Mode'], $varPost));
 
         }
       
        return functionForm($link, $linksystem, 'function', 'edit', $credentials, functionDataPattern($link, $credentials['Mode'], null));

    }
    
    return "erro";
}