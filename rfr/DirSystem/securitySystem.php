<?php

require_once(__DIR__.DIRECTORY_SEPARATOR."DirSecuritySystem".DIRECTORY_SEPARATOR."library".DIRECTORY_SEPARATOR."sql.php");
require_once(__DIR__.DIRECTORY_SEPARATOR."DirSecuritySystem".DIRECTORY_SEPARATOR."library".DIRECTORY_SEPARATOR."system.php");

$primaryOrderOfExecutionOfFunctions=[ 'checkIfIpBlocked', 'arrivesControllerWithoutLogin', 'performIpBlockingIfNecessary', 'arrivalIfLoggedIn','checkLoginAndPassword'];

foreach ($primaryOrderOfExecutionOfFunctions as $key => $value) {

  if(call_user_func_array($value, array($link, $linksystem, $varCookie, $controller, $method, (isset($varPost['action'])?$varPost['action']:null),&$credentials, ((isset($varPost['login']) and !empty($varPost['login']))?filteringVar($varPost['login'], 'string'):null), ((isset($varPost['password']) and !empty($varPost['password']))?filteringVar($varPost['password'], 'string'):null),  $IpAcess, $currentTime,  &$ServidorID, &$accessControllerTemplate, &$errorMessage, &$systemErrorMessage))){
    
 /*   echo "<br>////////bloco securitysystem//////////";
   echo "<br>valor da saida:".$value;
   echo "<BR>interfacesida:".$accessControllerTemplate;
    echo "<BR>errorMessage:".$errorMessage;
    echo "<br>systemErrorMessage:".$systemErrorMessage;
   echo "<br>";*/
  break;

  }

}

if($credentials!=''){

  $systemContainer=checksNeedtoChangePassword($link, $linksystem, $varPost, $credentials, $dayoftheToday, $accessControllerTemplate, $errorMessage, $systemErrorMessage, $datacontrolsystem);

  if($systemContainer=='true'){
    $systemContainer=null;    
  }

  

}

$listProhibitedAccessToController=['api', 'ERROR', 'LOGIN'];

if(in_array($controller, $listProhibitedAccessToController)) $controllerkey='LOCK'; 

if(in_array($accessControllerTemplate, $listProhibitedAccessToController)) $controllerkey='LOCK';

 