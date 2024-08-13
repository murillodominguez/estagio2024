<?php


function update($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){

 
 $userReceivedData=functionDataPattern($link, $credentials['Mode'], $varPost);
 $varSql=dataPreparationForSql($userReceivedData);

if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){

  require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

  return manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentPageBodyTitle('CADASTRO DE FUNÇÃO',null, null).manufactureComponentFormPrint($linksystem, 'function', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'function', 'edit', 'save'));

}

  if(!empty($getcomparedate=comparedata($userReceivedData, getDataFunctionDatabase($link, filter_var($varPost['id']), $credentials['Mode']), $link, $varPost, $controller, $varSql))){
    
    $datacontrolsystem= array('id_source' => $varPost['id'], 'sourcetable' => 'function', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'update', 'id_user' => $credentials['IdServidor'], 'changeddata' => $getcomparedate, 'mode' => $credentials['Mode']);

    if(!updatesql($link, $linksystem, $userReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
      $datacontrolsystem='';
      return manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE FUNCAO',null, null).manufactureComponentFormPrint($linksystem, 'function', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'function', 'edit', 'save'));
    }

}
  
  return manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').listFunction($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem);

}

function insert($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){

 
  $userReceivedData=functionDataPattern($link, $credentials['Mode'], $varPost);
  $varSql=dataPreparationForSql($userReceivedData);

if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){
 
   require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");
 
   return manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentPageBodyTitle('CADASTRO DE FUNÇÃO',null, null).manufactureComponentFormPrint($linksystem, 'Function', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'function', 'edit', 'save'));
 
 }
   
     if(!insertsql($link, $linksystem, $userReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
       $datacontrolsystem='';
       return manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE FUNÇÃO',null, null).manufactureComponentFormPrint($linksystem, 'function', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'function', 'edit', 'save'));
     }

     $datacontrolsystem= array('id_source' => getIDfunction($link, $varSql), 'sourcetable' => 'function', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'insert', 'id_user' => $credentials['IdServidor'], 'changeddata' => null, 'mode' => $credentials['Mode']);
   
 
    echo "<br><br>";
    var_dump($varPost);
    echo "<br><br>";
   return manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').listFunction($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem);
 
 }





