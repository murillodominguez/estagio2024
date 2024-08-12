<?php

if(file_exists(__DIR__.DIRECTORY_SEPARATOR."method".DIRECTORY_SEPARATOR.$method.DIRECTORY_SEPARATOR.$method.".php")){
  
  require_once(__DIR__.DIRECTORY_SEPARATOR."library".DIRECTORY_SEPARATOR."library.php"); 
  require_once(__DIR__.DIRECTORY_SEPARATOR."method".DIRECTORY_SEPARATOR.$method.DIRECTORY_SEPARATOR.$method.".php");


   if(function_exists($method)){
    
      $systemContainer=call_user_func_array($method, array($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem));

    } 

  if(!function_exists($method)){

      $systemContainer="<div class='clear'><br></div><div class='alert alert-danger text-center'><h2><strong>ERRO:</strong> Ferramenta não localizada!</h2></div>";

    }
}

if(!file_exists(__DIR__.DIRECTORY_SEPARATOR."method".DIRECTORY_SEPARATOR.$method.DIRECTORY_SEPARATOR.$method.".php")){

  $systemContainer="<div class='clear'><br></div><div class='alert alert-danger text-center'><h2><strong>ERRO:</strong> Ferramenta não localizada!</h2></div>";

}

