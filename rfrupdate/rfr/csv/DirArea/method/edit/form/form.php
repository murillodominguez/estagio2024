<?php
/*
function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once "template".DIRECTORY_SEPARATOR."template.php"; 

    if(function_exists('secretaryForm')){

        if(isset($varPost['id'])){

            echo "<bR>nest";
            return manufactureComponentContainer(6,secretaryForm($linksystem, 'secretary', 'edit', getDataSecretariatDatabase($link, filter_var($varPost['id']))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'secretary', 'standard', 'standard'));

        }
       
        return manufactureComponentContainer(6,secretaryForm($linksystem, 'secretary', 'edit', null).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'secretary', 'standard', 'standard'));

    }
    
    return "erro";
}
*/
require_once "template".DIRECTORY_SEPARATOR."template.php";
function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){

    require_once "template".DIRECTORY_SEPARATOR."template.php";
    
    if(function_exists('areaForm')){

        if(isset($varPost['id'])){

           return areaForm($link, $linksystem, 'area', 'edit', $credentials, areaDataPattern($link, $credentials['Mode'],getDataAreaDatabase($link, filter_var($varPost['id']), $credentials['Mode'])));

        }

        if(isset($varPost['name'])){

            return areaForm($link, $linksystem, 'area', 'edit', $credentials, areaDataPattern($link, $credentials['Mode'], $varPost));
 
         }

        return areaForm($link, $linksystem, 'area', 'edit', $credentials, areaDataPattern($link, $credentials['Mode'], null));

    }
    
    return "erro";
}