<?php

function view($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){

    require_once(__DIR__.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'template.php');
    
    return(call_user_func_array($controller.'view', array($link, $linksystem, $controller, $method, $credentials, call_user_func_array($controller.'DataPattern', array($link, $credentials['Mode'],call_user_func_array('getData'.capitalFirstLetterTreatment($controller).'Database', array($link, filter_var($varPost['id']), $credentials['Mode'])))))));
    
}