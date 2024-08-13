<?php

function getvarPost($varPost){

  $return="Dados recebidos pelo metodo post ( ";

  foreach ($varPost as $key => $value) {

    if($key!='password'){

      $return=$return."[".$key." , ".$value."] - "; 
    }
    
  }

  $return=$return." ) Final";

  return $return;
}

function buildLog($link, $varSession, $varPost, $varHeaders, $systemContainer, $ServidorID, $mode, $systemErrorMessage){

    $log="Registro de Log de Acessos ao SGO :: { Dados Headers - ";
    $log=$log.((isset($varHeaders["sec-ch-ua-mobile"])and(!empty($varHeaders["sec-ch-ua-mobile"])))?(" [ Mobile = ".$varHeaders["sec-ch-ua-mobile"]." ] ::"):'');
    $log=$log.((isset($varHeaders["sec-ch-ua-platform"])and(!empty($varHeaders["sec-ch-ua-platform"])))?(" [ Plataform = ".$varHeaders["sec-ch-ua-platform"]." ] ::"):'');
    $log=$log.((isset($varHeaders["User-Agent"])and(!empty($varHeaders["User-Agent"])))?(" [ Navegador = ".$varHeaders["User-Agent"]." ] ::"):'');
    $log=$log.((isset($varHeaders["Cookie"])and(!empty($varHeaders["Cookie"])))?(" [ Navegador = ".$varHeaders["Cookie"]." ] ::"):'');
    $log=$log.((isset($varPost["latitude"])and(!empty($varPost["latitude"])))?(" [ Latitude = ".filteringVar($varPost["latitude"], 'string')." ] ::"):'');
    $log=$log.((isset($varPost["longitude"])and(!empty($varPost["longitude"])))?(" [ Longitude = ".filteringVar($varPost["longitude"], 'string')." ] ::"):'');
    $log=$log.((isset($varPost["error"])and(!empty($varPost["error"])))?(" [ Error GPS = ".filteringVar($varPost["error"], 'string')." ] ::"):'');
    $log=$log.((isset($varPost["accuracy"])and(!empty($varPost["accuracy"])))?(" [ Precisão GPS = ".filteringVar($varPost["accuracy"], 'string')." ] ::"):'');
    $log=$log.((isset($varPost["login"])and(!empty($varPost["login"])))?" } - { Matricula [".filteringVar($varPost['login'], 'string')."] ":'');
    $log=$log.(($ServidorID!='')?" } - { Matricula [".userIdentifiesLogin($link, $ServidorID)."] ":'');
    $log=$log.((isset($mode) and !empty($mode))?" -  Modo [".$mode."] ":'');
    $log=$log.((isset($varPost["login"])and(!empty($varPost["login"])))?" } - { Matricula [".filteringVar($varPost['login'], 'string')."] ":'');
    $log=$log." } - { Dados Session - ".((isset($varSession["Credentials"])and(!empty($varSession["Credentials"])))?(" [ CREDENTIALS = ".$varSession["Credentials"]." ] ::"):'');
    $log=$log.((isset($_SESSION["ErrorCount"])and(!empty($_SESSION["ErrorCount"])))?(" [ Contagem de Erros de Login = ".$_SESSION["ErrorCount"]." ] ::"):'');
    if($systemErrorMessage!=''){
      $log=$log.(($systemErrorMessage!='')?(" [ Mensagem de Erro = ".$systemErrorMessage." ] ::"):'');    
      $log=$log.(is_array($varPost)?("} - { ".getvarPost($varPost)):'');
    }    
    $log=$log."} ".(($systemContainer=='reload')?"[ Reload Automático pelo sistema. ]":'')." :: Final do Registro de Log ::";
    
    return $log;

}

function logRegister($link, $instante, $login, $IpAcess, $error, $varUri, $log, $controller, $method, $pagina, $filter, $id_acessed, $mode, $action, $typeaction){

    $sql="INSERT INTO `log`(`time`, `registration`,`ip`, `error`, `uri`, `descriptive`,  `controller`, `method`, `page`, `filter`, `id_acessed`, mode, action, typeaction) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('ssssssssisisss', $instante, $login, $IpAcess, $error, $varUri, $log, $controller, $method, $pagina, $filter, $id_acessed, $mode, $action, $typeaction);
    $stmt->execute();

    return ($stmt->affected_rows >0)?true:false;

}

function determinesWhetherToRecordTheLog($controller, $method, $login){

  if($controller=='api') return false;

  if($controller=='assets') return false;

  if($controller=='standard' and $method=='standard' and empty($login)) return false;  

  if($controller=='login' and $method=='standard' and empty($login)) return false;
  
  return true;
}


/*echo "<br>////////bloco securitysystem//////////";
echo "<br>valor da saida:".$value;
echo "<BR>interfacesida:".$accessControllerTemplate;
echo "<BR>errorMessage:".$errorMessage;
echo "<br>systemErrorMessage:".$systemErrorMessage;
echo "<br>controller:".$controller;
echo "<br>method:".$method;
ECHO "<BR>LOGIN:".(((isset($varPost['login']) and !empty($varPost['login']))?$varPost['login']: ((isset($credentials['Login']) and !empty($credentials['Login']))?$credentials['Login']:((isset($ServidorID)and !empty($ServidorID))?userIdentifiesLogin($link, $ServidorID):null))));
echo "<br>";*/

if(determinesWhetherToRecordTheLog($controller, $method, (((isset($varPost['login']) and !empty($varPost['login']))?$varPost['login']: ((isset($credentials['Login']) and !empty($credentials['Login']))?$credentials['Login']:((isset($ServidorID)and !empty($ServidorID))?userIdentifiesLogin($link, $ServidorID):null)))))){

    if(!logRegister($link, $currentTime, (isset($varPost['login'])?$varPost['login']:(isset($credentials['Login'])?$credentials['Login']:userIdentifiesLogin($link, $ServidorID))), $varMethod['REMOTE_ADDR'], ((!empty($errorMessage))?$errorMessage:null), $varUri, buildLog($link, $varSession, $varPost, $varHeaders, $systemContainer, $ServidorID,((isset($credentials['Mode']) and !empty($credentials['Mode']))?$credentials['Mode']:null) ,$systemErrorMessage), $controller, $method, (isset($varPost['pagina'])?filteringVar($varPost['pagina'], 'integer'):null), (isset($varPost['filter'])?filteringVar($varPost['filter'], 'string'):null), (isset($varPost['id'])?filter_var($varPost['id']):null), (isset($credentials['Mode'])?$credentials['Mode']:null), (isset($varPost['action'])?filter_var($varPost['action']):null), (isset($varPost['typeaction'])?filter_var($varPost['typeaction']):null))){

      echo "<br>Erro Registro do log</br>";

    }

}

if (($systemContainer!='reload') and (isset($_SESSION["MsgError"]))) unset($_SESSION["MsgError"]);

