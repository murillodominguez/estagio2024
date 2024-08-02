<?php
/*
function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once("template".DIRECTORY_SEPARATOR."template.php"); 

    if(function_exists('secretaryForm')){

        if(isset($varPost['id'])){

            echo "<bR>nest";
            return(manufactureComponentContainer(6,secretaryForm($linksystem, 'secretary', 'edit', getDataSecretariatDatabase($link, filter_var($varPost['id']))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'secretary', 'standard', 'standard')));

        }
       
        return(manufactureComponentContainer(6,secretaryForm($linksystem, 'secretary', 'edit', null).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'secretary', 'standard', 'standard')));

    }
    
    return("erro");
}
*/

function form($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    
    require_once("template".DIRECTORY_SEPARATOR."template.php"); 

    if(function_exists('primarydiagnosisForm')){

        if(isset($varPost['id'])){

           return(primarydiagnosisForm($link, $linksystem, 'primarydiagnosis', 'edit', $credentials, primarydiagnosisDataPattern($link, $credentials['Mode'],getDataPrimarydiagnosisDatabase($link, filter_var($varPost['id']), $credentials['Mode']))));

        }

        if(isset($varPost['name'])){

            return(primarydiagnosisForm($link, $linksystem, 'primarydiagnosis', 'edit', $credentials, primarydiagnosisDataPattern($link, $credentials['Mode'], $varPost)));
 
         }
       
        return(primarydiagnosisForm($link, $linksystem, 'primarydiagnosis', 'edit', $credentials, primarydiagnosisDataPattern($link, $credentials['Mode'], null)));

    }
    
    return("erro");
}