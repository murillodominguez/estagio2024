<?php


function update($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){

$userReceivedData=accesscontrolDataPattern($link, $credentials['Mode'], $varPost);
$varSql=dataPreparationForSql($userReceivedData);

if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){ 

  require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");


  return(manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).accesscontrolForm($link, $linksystem, 'accesscontrol', 'edit', $credentials, getUserDataBase($link, filteringVar($varPost['id_user'], 'integer')))));

}

  if(!empty($getcomparedate=comparedata($userReceivedData, getAccessPermitionsDatabase($link, filter_var($varPost['id']), $credentials['Mode']), $link, $varPost, $controller, $varSql))){

    $datacontrolsystem= array('id_source' => $varPost['id'], 'sourcetable' => 'accesspermissions', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'update', 'id_user' => $credentials['IdServidor'], 'changeddata' => $getcomparedate, 'mode' => $credentials['Mode']);

    if(!updatesqlaccess($link, $linksystem, $varSql, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
      
      $datacontrolsystem='';
      require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");
    
    
      return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').accesscontrolForm($link, $linksystem, 'accesscontrol', 'edit', $credentials, getUserDataBase($link, filteringVar($varPost['id_user'], 'integer')))));
    }

}
require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

return(manufactureComponentContainer( 6,manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').accesscontrolForm($link, $linksystem, 'accesscontrol', 'edit', $credentials, getUserDataBase($link, filteringVar($varPost['id_user'], 'integer')))));

}

function insert($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){
  
  $userReceivedData=accesscontrolDataPattern($link, $credentials['Mode'], $varPost);
  $varSql=dataPreparationForSql($userReceivedData);
 
 if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){

  require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");


  return(manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).accesscontrolForm($link, $linksystem, 'accesscontrol', 'edit', $credentials, getUserDataBase($link, filteringVar($varPost['id_user'], 'integer')))));
 
 }
 
     $varSql=dataPreparationForSql($userReceivedData);
   
     if(!insertsql($link, $linksystem, $userReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
     
       $datacontrolsystem='';

       require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");


       return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').accesscontrolForm($link, $linksystem, 'accesscontrol', 'edit', $credentials, getUserDataBase($link, filteringVar($varPost['id_user'], 'integer'))))); 

     }
     
     $datacontrolsystem= array('id_source' => getIDaccesspermitions($link, $varSql), 'sourcetable' => 'accesspermitions', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'insert', 'id_user' => $credentials['IdServidor'], 'changeddata' => null, 'mode' => $credentials['Mode']);
   
      require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

   return(manufactureComponentContainer(6, manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').accesscontrolForm($link, $linksystem, 'accesscontrol', 'edit', $credentials, getUserDataBase($link, filteringVar($varPost['id_user'], 'integer')))));
 
 }





