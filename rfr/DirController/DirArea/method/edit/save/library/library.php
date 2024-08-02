<?php


function update($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){
 
$userReceivedData=areaDataPattern($link, $credentials['Mode'], $varPost);

$varSql=dataPreparationForSql($userReceivedData);

if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){ 

  require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

  return(manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentPageBodyTitle('CADASTRO DE AREAS',null, null).manufactureComponentFormPrint($linksystem, 'area', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'area', 'edit', 'save')));

}
  if(!empty($getcomparedate=comparedata($userReceivedData, getDataAreaDatabase($link, filter_var($varPost['id']), $credentials['Mode']), $link, $varPost, $controller, $varSql))){
    
    $datacontrolsystem= array('id_source' => $varPost['id'], 'sourcetable' => 'area', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'update', 'id_user' => $credentials['IdServidor'], 'changeddata' => $getcomparedate, 'mode' => $credentials['Mode']);

    if(!updatesql($link, $linksystem, $userReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
      $datacontrolsystem='';
      return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE AREAS',null, null).manufactureComponentFormPrint($linksystem, 'area', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'area', 'edit', 'save')));
    }

}
  
  return(manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').call_user_func_array('listArea'.checksIfTheLastCallWasFromTheManager($link, $controller, $method, $credentials['Login']), array($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem)));

}

function insert($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){
  
 
  $userReceivedData=areaDataPattern($link, $credentials['Mode'], $varPost);

  $varSql=dataPreparationForSql($userReceivedData);
  var_dump($varSql);
 if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){

   require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");
 
   return(manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentPageBodyTitle('CADASTRO DE AREAS',null, null).manufactureComponentFormPrint($linksystem, 'area', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'area', 'edit', 'save')));
 
 }

     if(!insertsql($link, $linksystem, $userReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
     
       $datacontrolsystem='';

       return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE AREAS',null, null).manufactureComponentFormPrint($linksystem, 'area', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'area', 'edit', 'save')));

     }
     
     $datacontrolsystem= array('id_source' => getIDarea($link, $varSql), 'sourcetable' => 'area', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'insert', 'id_user' => $credentials['IdServidor'], 'changeddata' => null, 'mode' => $credentials['Mode']);
   
 
 
   
   return(manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').call_user_func_array('listArea'.checksIfTheLastCallWasFromTheManager($link, $controller, $method, $credentials['Login']), array($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem)));
 
 }

function updateimage($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){
  $userReceivedData=areaImageDataPattern($link, $credentials['Mode'], $varPost);

$varSql=dataPreparationForSql($userReceivedData);

if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){ 

  require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

  return(manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentPageBodyTitle('CADASTRO DE AREAS',null, null).manufactureComponentFormPrint($linksystem, 'area', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'area', 'edit', 'save')));

}
  if(!empty($getcomparedate=comparedata($userReceivedData, getDataAreaDatabase($link, filter_var($varPost['id']), $credentials['Mode']), $link, $varPost, $controller, $varSql))){
    
    $datacontrolsystem= array('id_source' => $varPost['id'], 'sourcetable' => 'area', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'update', 'id_user' => $credentials['IdServidor'], 'changeddata' => $getcomparedate, 'mode' => $credentials['Mode']);
    $return = "";
    echo '<br><br>';
    var_dump($_FILES);
    echo '<br><br>';
    foreach ($userReceivedData as $row){
      foreach($_FILES as $key => $img){
        if($key == $row['label']){
          if(!empty($img['tmp_name'])){
            echo '<br><br>ID do INPUT: '. $row['label']. '<br><br>';
            uploadImagetoServer($row, $link, $varPost, $controller, $varSql, 'update');
            // uploadImagetoDatabase($row, $link, $varPost, $controller, $varSql, null, 'update');
            // if(!uploadImagetoServer($row, $link, $varPost, $controller, $varSql,'update')){
            //   $datacontrolsystem='';
            //   return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE AREAS',null, null).manufactureComponentFormPrint($linksystem, 'area', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'area', 'edit', 'save')));
            // }
          }
        }
      }
    }
    // if(!uploadImagetoServer($row, $link, $varPost, $controller, $varSql, 'update')){
    //   $datacontrolsystem='';
    //   return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE AREAS',null, null).manufactureComponentFormPrint($linksystem, 'area', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'area', 'edit', 'save')));
    // }
  
  return(manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').call_user_func_array('listArea'.checksIfTheLastCallWasFromTheManager($link, $controller, $method, $credentials['Login']), array($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem)));
  }
  return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE AREAS',null, null).manufactureComponentFormPrint($linksystem, 'area', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'area', 'edit', 'save')));
}
