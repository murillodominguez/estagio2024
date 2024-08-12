<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once("template".DIRECTORY_SEPARATOR."template.php"); 

    if(function_exists('districtForm')){

        if(isset($varPost['id'])){

           return(districtForm($link, $linksystem, 'disctrict', 'edit', $credentials, districtDataPattern($link, $credentials['Mode'], getDataDistrictDatabase($link, filter_var($varPost['id']), $credentials['Mode']))));

        }

        if(isset($varPost['name'])){

            return(districtForm($link, $linksystem, 'disctrict', 'edit', $credentials, districtDataPattern($link, $credentials['Mode'],$varPost)));
 
         }
       
        return(districtForm($link, $linksystem, 'disctrict', 'edit', $credentials, districtDataPattern($link, $credentials['Mode'], null)));

    }
    
    return("erro");
}