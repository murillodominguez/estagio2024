<?php

function edit($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){

 
    $action=filter_var($varPost['action']);

    if($action=='edit') $action='form';   

      if(file_exists(__DIR__.DIRECTORY_SEPARATOR.$action.DIRECTORY_SEPARATOR.$action.".php")){  
      
        require_once __DIR__.DIRECTORY_SEPARATOR.$action.DIRECTORY_SEPARATOR.$action.".php";
      
      
         if(function_exists($action)){
          
            $systemContainer=call_user_func_array($action, array($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem));
      
          } 
      
        if(!function_exists($action)){
      
            $systemContainer="<div class='clear'><br></div><div class='alert alert-danger text-center'><h2><strong>ERRO:</strong> Ferramenta não localizada!</h2></div>";
      
          }
      }
      
      if(!file_exists(__DIR__.DIRECTORY_SEPARATOR.$action.DIRECTORY_SEPARATOR.$action.".php")){
      
        $systemContainer="<div class='clear'><br></div><div class='alert alert-danger text-center'><h2><strong>ERRO:</strong> Ferramenta não localizada!</h2></div>";
      
      }


    return $systemContainer;
    
}