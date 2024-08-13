<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php"; 

    if(function_exists('zoneForm')){

        if(isset($varPost['id'])){

           return zoneForm($link, $linksystem, 'disctrict', 'edit', $credentials, zoneDataPattern($link, $credentials['Mode'],getDataZoneDatabase($link, filter_var($varPost['id']), $credentials['Mode'])));

        }

        if(isset($varPost['name'])){

            return zoneForm($link, $linksystem, 'disctrict', 'edit', $credentials, zoneDataPattern($link, $credentials['Mode'], $varPost));
 
         }
       
        return zoneForm($link, $linksystem, 'disctrict', 'edit', $credentials, zoneDataPattern($link, $credentials['Mode'], null));

    }
    
    return "erro";
}