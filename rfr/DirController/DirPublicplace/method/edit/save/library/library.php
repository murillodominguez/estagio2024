<?php


function update($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){

 
 $userReceivedData=publicplaceDataPattern($link, $credentials['Mode'], $varPost);
 $varSql=dataPreparationForSql($userReceivedData);

if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){

  require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

  return(manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentPageBodyTitle('CADASTRO DE LOGRADOURO',null, null).manufactureComponentFormPrint($linksystem, 'publicplace', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'publicplace', 'edit', 'save')));

}

  if(!empty($getcomparedate=comparedata($userReceivedData, getDataPublicplaceDatabase($link, filter_var($varPost['id']), $credentials['Mode']), $link, $varPost, $controller, $varSql))){
    
    $datacontrolsystem= array('id_source' => $varPost['id'], 'sourcetable' => 'publicplace', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'update', 'id_user' => $credentials['IdServidor'], 'changeddata' => $getcomparedate, 'mode' => $credentials['Mode']);
    
    if(!updatesql($link, $linksystem, $userReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
      $datacontrolsystem='';
      return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE LOGRADOURO',null, null).manufactureComponentFormPrint($linksystem, 'publicplace', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'publicplace', 'edit', 'save')));
    }

}
  
  return(manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').listPublicplace($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem));

}

function insert($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){

 
  $userReceivedData=publicplaceDataPattern($link, $credentials['Mode'], $varPost);
  $varSql=dataPreparationForSql($userReceivedData);

  if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){
 
   require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");
 
   return(manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentPageBodyTitle('CADASTRO DE LOGRADOURO',null, null).manufactureComponentFormPrint($linksystem, 'publicplace', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'publicplace', 'edit', 'save')));
 
 }
   
     if(!insertsql($link, $linksystem, $userReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
       $datacontrolsystem='';
       return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE LOGRADOURO',null, null).manufactureComponentFormPrint($linksystem, 'publicplace', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'publicplace', 'edit', 'save')));
     }

     $datacontrolsystem= array('id_source' => getIDPublicplace($link, $varSql), 'sourcetable' => 'publicplace', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'insert', 'id_user' => $credentials['IdServidor'], 'changeddata' => null, 'mode' => $credentials['Mode']);
   
 
 
   
   return(manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').listPublicplace($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem));
 
 }





