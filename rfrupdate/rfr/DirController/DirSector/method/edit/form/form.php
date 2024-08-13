<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php"; 

    if(function_exists('sectorForm')){

        if(isset($varPost['id'])){

           return sectorForm($link, $linksystem, 'sector', 'edit', $credentials, sectorDataPattern($link, $credentials['Mode'],getDataSectorDatabase($link, filter_var($varPost['id']), $credentials['Mode'])));

        }

        if(isset($varPost['name'])){

            return sectorForm($link, $linksystem, 'sector', 'edit', $credentials, sectorDataPattern($link, $credentials['Mode'], $varPost));
 
         }
       
        return sectorForm($link, $linksystem, 'area', 'edit', $credentials, sectorDataPattern($link, $credentials['Mode'], null));

    }
    
    return "erro";
}