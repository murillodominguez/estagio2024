<?php


function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once("template".DIRECTORY_SEPARATOR."template.php"); 

    if(function_exists('officeForm')){

        if(isset($varPost['id'])){

           return(officeForm($link, $linksystem, 'office', 'edit', $credentials, officeDataPattern($link, $credentials['Mode'],getDataOfficeDatabase($link, filter_var($varPost['id']), $credentials['Mode']))));

        }

        if(isset($varPost['name'])){

            return(officeForm($link, $linksystem, 'office', 'edit', $credentials, officeDataPattern($link, $credentials['Mode'], $varPost)));
 
         }
       
        return(officeForm($link, $linksystem, 'office', 'edit', $credentials, officeDataPattern($link, $credentials['Mode'], null)));

    }
    
    return("erro");
}