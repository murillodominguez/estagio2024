<?php


function update($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){

 
$userReceivedData=profileDataPattern($link, $credentials['Mode'], $varPost); 
$varSql=dataPreparationForSql($userReceivedData);

if(!validateUserReceivedData($userReceivedData, $link, $systemErrorMessage, $varPost, $controller, $varSql)){ 

  require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

  return(manufactureComponentContainer(6,manufactureComponentAlert('danger', $systemErrorMessage).manufactureComponentPageBodyTitle('ALTERAÇÃO NO PERFIL',null, null).manufactureComponentFormPrint($linksystem, 'profile', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'profile', 'edit', 'save')));

}

  if(!empty($getcomparedate=comparedata($userReceivedData, getDataUserDatabase($link, $credentials['IdServidor'], $credentials['Mode']), $link, $varPost, $controller, $varSql))){

    $datacontrolsystem= array('id_source' => $credentials['IdServidor'], 'sourcetable' => 'user', 'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'update', 'id_user' => $credentials['IdServidor'], 'changeddata' => $getcomparedate, 'mode' => $credentials['Mode']);

    if(!updatesql($link, $linksystem, $userReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage)){
      $datacontrolsystem='';
      return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na inserção dos dados no banco de dados!').manufactureComponentPageBodyTitle('CADASTRO DE PERFIL',null, null).manufactureComponentFormPrint($linksystem, 'profile', 'edit',(array_map('manufactureComponentForm', $userReceivedData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], 'profile', 'edit', 'save')));
    }

}

  require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.'standard'.DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");  
  return(manufactureComponentContainer(6,manufactureComponentAlert('success', 'Realizado a atualização com sucesso!').userview($link, $linksystem, 'profile', $method, $credentials, getDataUserDatabase($link, $credentials['IdServidor'], $credentials['Mode']))));

}

function password($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){
 
    
    $passwordStrength=checkPasswordStrength($varPost['newpassword']);

    $analyzePasswords=analyzePasswords($varPost['password'], $varPost['newpassword'], $varPost['repeatpassword']);

    $validPassword=checkUserPasswordInDatabase($link, $credentials['Login'], encryptData($varPost['password']));

    if(($passwordStrength>=70)and($analyzePasswords==true)and($validPassword>0)){

      if(updatepassword($link, $credentials['Login'], encryptData($varPost['password']), 'DESATIVADA')){

          if(!(insertpassword($link, $credentials['Login'], $varPost['newpassword'], $dayoftheToday))){
       
            updatepassword($link, $credentials['Login'], encryptData($varPost['password']), 'ATIVA');

        
            require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."password".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

            return(manufactureComponentContainer(12,manufactureComponentAlert('danger', 'Falha na atualização da senha!')).passwordForm($link, $linksystem, $controller, $method, $credentials, null));

          }
         
      }

      return(manufactureComponentContainer(12,manufactureComponentAlert('success', 'Atualizado com sucesso!')));

    }

    require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."password".DIRECTORY_SEPARATOR."template".DIRECTORY_SEPARATOR."template.php");

    return(manufactureComponentContainer(12,manufactureComponentAlert('danger', 'Senha não atende critérios minimos de segurança!')).passwordForm($link, $linksystem, $controller, $method, $credentials, null));

}





