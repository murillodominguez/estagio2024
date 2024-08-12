<?php

function checksNeedtoChangePassword($link, $linksystem, $varPost, $credentials, $dayoftheToday, &$accessControllerTemplate, &$errorMessage, &$systemErrorMessage, &$datacontrolsystem){
  if(!isset($varPost['typeaction']) and (isset($varPost['password']) and !empty($varPost['password'])) and (isset($varPost['newpassword']) and !empty($varPost['newpassword']))and (isset($varPost['repeatpassword']) and !empty($varPost['repeatpassword']))){

    $return=checkpassword($link, $linksystem, 'LOGIN', 'LOGON', $varPost, null, null, $credentials, $dayoftheToday, null, $systemErrorMessage, $datacontrolsystem);
    

    if(strpos( $return, 'danger')) $accessControllerTemplate='PASSWORD';

    return($return);
   
  }

  IF(checksNeedtoChangePasswordSql($link, $credentials['Login'], $dayoftheToday)>0){
    $accessControllerTemplate='PASSWORD';

  }  
         
}

function checkIfIpBlocked($link,$linksystem, $varCookie, $controller, $method, $action, &$credentials, $registration, $password, $IpAcess, $currentTime, &$ServidorID, &$accessControllerTemplate, &$errorMessage, &$systemErrorMessage){

    ///////////////////////////////////////////////////////////////////
    //                                                               //
    //   VERIFICA NO BANCO DE DADOS SE IP ESTA BLOQUEADO,            //
    //   CASO ESTEJA DEVOLVE A RESPOSTA "TRUE", SENÃO "FALSE"        //
    //                                                               //
    ///////////////////////////////////////////////////////////////////

    $return=((checkIfIpBlockedInTheDatabase($link, $IpAcess)>0)?true:false);

    if($return==true){

        $systemErrorMessage="ACESSO BLOQUEADO POR IP ESTA BLOQUEADO [".$IpAcess."]";
        $errorMessage="ACESSO BLOQUEADO!";
        $accessControllerTemplate='ERROR';
    }

    return($return);
    
}

function arrivesControllerWithoutLogin($link, $linksystem, $varCookie, $controller, $method, $action, &$credentials, $registration, $password, $IpAcess, $currentTime, &$ServidorID, &$accessControllerTemplate, &$errorMessage, &$systemErrorMessage){

     ///////////////////////////////////////////////////////////////////
    //                                                               //
    //   VERIFICA SE ESTE CONTROLLER NECESSITA CONTINUAR PROCESSO    //
    //   DE LOIGN OU NÃO, CONFERINDO NA LISTA DE ARRAY CONTROLLERS   //
    //    LIBERADOS O ACESSO DE LOGIN                                //
    //                                                               //
    ///////////////////////////////////////////////////////////////////

      $array=['api']; 
      return(in_array($controller, $array));
      $accessControllerTemplate='';
    
}

function performIpBlockingIfNecessary($link, $linksystem, $varCookie, $controller, $method, $action, &$credentials, $registration, $password, $IpAcess, $currentTime,  &$ServidorID, &$accessControllerTemplate, &$errorMessage, &$systemErrorMessage){

    ///////////////////////////////////////////////////////////////////
   //                                                               //
   //   VERIFICA SE É NECESSARIO REALIZAR O BLOQUEIO DE IP          //
   //   ATRAVES DA CONSULTA NO BANCO DE DADOS TABELA DE LOG         //
   //    POR COLUNA 'ERROR' PELO ERRO "ACESSO BLOQUEADO!"           //
   //       NUM PERIODO DE TEMPO DETERMINADO PELO CAMPO             //      
   //  $setArrivalTime, BEM COMO O NUMERO MAXIMO PERMITIDO DE       //
   //     FALHAS ESTIPULADO PELO CAMPO $maximumFailures             // 
   //                                                               //
   ///////////////////////////////////////////////////////////////////

   $setArrivalTime='00:15:00';
 
   $maximumFailures=5;

   if(fetchesErrorsFromTheDatabaseLogWithinATimeg($link, $registration, $password, $IpAcess, $currentTime, $setArrivalTime)>$maximumFailures){
    

         /////////////////////////////////////////////////////////////////////////
         //                                                                     //
         //                                                                     //
         //  CASO NUMERO DE FALHAS MAIOR QUE PERMITIDO REALIZA BLOQUEIO DO IP   //
         //                          E RETORNA "TRUE".                          // 
         //                                                                     //
         //                                                                     //
         /////////////////////////////////////////////////////////////////////////

         $systemErrorMessage="ACESSO BLOQUEADO POR IP ESTA BLOQUEADO [".$IpAcess."]";
         $errorMessage="ACESSO BLOQUEADO!";
         $accessControllerTemplate='ERROR';

         if(enterIpBlocking($link, $IpAcess, $currentTime, "REALIZADO O BLOQUEIO DE IP PELO MESMO POSSUIR MAIS DE ".$maximumFailures." FALHAS DE ACESSO REGISTRADAS NO LOG COM O ERRO [ACESSO BLOQUEADO!], NO PRAZO DOS ULTIMOS ".$setArrivalTime."!")==0){
             
            $systemErrorMessage.= " - FALHA NO BLOQUEIO DESTE IP NA TABELA IPBLOCKING";

         }

         return(true);

   }

   return(false);

}

function performUserBlockingIfNecessary($link, $registration, $currentTime, &$systemErrorMessage){

   ///////////////////////////////////////////////////////////////////
   //                                                               //
   //   VERIFICA SE É NECESSARIO REALIZAR O BLOQUEIO DE USER        //
   //   ATRAVES DA CONSULTA NO BANCO DE DADOS TABELA DE LOG         //
   //    POR COLUNA 'DESCRIPTIVE' PELO ERRO "ERRO DE LOGIN!"        //
   //       NOS ULTIMOS 3 REGISTROS DESTE USER [ REGISTRATION]      //      
   //                                                               //
   ///////////////////////////////////////////////////////////////////

   $maximumFailures=3;

   $setArrivalTime='00:05:00';

   if((fetchesErrorsFromTheDatabaseLog($link, $registration, $currentTime, $setArrivalTime)>2) or (isset($_SESSION['ErrorCount']) and $_SESSION['ErrorCount']>3)){

         /////////////////////////////////////////////////////////////////////////
         //                                                                     //
         //                                                                     //
         //  CASO NUMERO DE FALHAS MAIOR QUE PERMITIDO REALIZA BLOQUEIO DO      //
         //                          USER E RETORNA "TRUE".                     // 
         //                                                                     //
         //                                                                     //
         /////////////////////////////////////////////////////////////////////////

        if(enterUserLock($link, $registration, $currentTime, "REALIZADO O BLOQUEIO DE USUARIO PELO MESMO POSSUIR MAIS DE ".$maximumFailures." FALHAS DE ACESSO REGISTRADAS NO LOG COM O ERRO [ERRO DE LOGIN!], NOS ULTIMOS QUATRO(03) REGISTROS!")==0){
             
            $systemErrorMessage.= " - FALHA NO BLOQUEIO DESTE USUARIO NA TABELA USERLOCK";

         }

         unset($_SESSION['ErrorCount']);

         return(true);

   }

   return(false);

}

function checkLoginAndPassword($link, $linksystem, $varCookie, $controller, $method, $action, &$credentials, $registration, $password,  $IpAcess, $currentTime,  &$ServidorID, &$accessControllerTemplate, &$errorMessage, &$systemErrorMessage){

   ///////////////////////////////////////////////////////////////////
   //                                                               //
   //   VERIFICA SE O USUARIO E A SENHA SÃO ENCONTRADOS             //
   //                    NO BANCO DE DADOS                          //
   //               CASO ENCONTRE RETORNA "FALSE"                   //
   //             CASO NÃO ENCONTRE RETORNA "TRUE"                  //
   //                                                               //
   ///////////////////////////////////////////////////////////////////
    if(empty($registration) and empty($password)){

        $accessControllerTemplate='ACCESS';
       
        return(true);
        
    }
   
    if(checkUserPasswordInDatabase($link, $registration, encryptData($password))==0){
        $systemErrorMessage.="ERRO DE LOGIN!";
        $errorMessage="ERRO DE LOGIN!";
        
        $_SESSION['ErrorCount']=((isset($_SESSION['ErrorCount']) and (!empty($_SESSION['ErrorCount'])) )?$_SESSION['ErrorCount']+1:2);
        $accessControllerTemplate='ACCESS';

        if(performUserBlockingIfNecessary($link, $registration, $currentTime, $systemErrorMessage)){

            $errorMessage="ACESSO BLOQUEADO!";
            $accessControllerTemplate='ERROR';

        }
        
        return(false);
    }

    if(isset($_SESSION['ErrorCount'])) unset($_SESSION['ErrorCount']);

    $ServidorID = userIdByRegistration($link, $registration);

    $_SESSION['credentials'] = $ServidorID;

    checkIfThereIsARegisteredKeyForThisUser($link, $ServidorID, $currentTime, $errorMessage, $systemErrorMessage);

    if(randomKeyRegistrationProcess($link, $linksystem, $ServidorID, $currentTime)){

        if(secondaryAccessControl($link, $controller, $method, $action, $ServidorID, $credentials, $errorMessage, $systemErrorMessage, $accessControllerTemplate )){

            return(true);

         }
        
        logoff($link, $ServidorID); 
        return(false);
    }

   
  
    return(true);
  
}


function arrivalIfLoggedIn($link, $linksystem, $varCookie, $controller, $method, $action, &$credentials, $registration, $password,  $IpAcess, $currentTime,  &$ServidorID, &$accessControllerTemplate, &$errorMessage, &$systemErrorMessage){

   ///////////////////////////////////////////////////////////////////
   //                                                               //
   //   VERIFICA SE O USUARIO JÁ ESTA LOGADO OU NÃO                 //   
   //                                                               //
   ///////////////////////////////////////////////////////////////////
   if(isset($_SESSION['credentials'])){

        $ServidorID= $_SESSION['credentials'];

        if(randomKeyRegistrationProcess($link, $linksystem, $ServidorID, $currentTime)){

            if(secondaryAccessControl($link, $controller, $method, $action, $ServidorID, $credentials, $errorMessage, $systemErrorMessage, $accessControllerTemplate )){

                return(true);

            }
            
            logoff($link, $ServidorID); 
            return(false);
        }   
  
    return(true);

   }

   if(isset($varCookie['credentials'])){
   // if((isset($_SESSION['credentials'])) and (!empty($_SESSION['credentials']))){

         //$ServidorID=$_SESSION['credentials'];

        // return(secondaryAccessControl($link, $controller, $method, $action, $ServidorID, $credentials, $errorMessage, $systemErrorMessage, $accessControllerTemplate ));

        if(keyValidationProcess($link, $linksystem, $ServidorID, $varCookie['credentials'], $currentTime, $errorMessage, $systemErrorMessage, $accessControllerTemplate)){

            return(secondaryAccessControl($link, $controller, $method, $action, $ServidorID, $credentials, $errorMessage, $systemErrorMessage, $accessControllerTemplate ));

        }

        return(false);
    
    }

return(false);

}

function checkIfBlockedUser($link, $ServidorID){

    ///////////////////////////////////////////////////////////////////
   //                                                               //
   //   VERIFICA SE O USUARIO JÁ BLOQUEADO OU NÃO                   //   
   //                                                               //
   ///////////////////////////////////////////////////////////////////
    
   if(arrivalInTheDatabaseIfBlockedUser($link, $ServidorID)>0){

    return(true);

   }

   return(false);

}


function checkIfActiveUser($link, $ServidorID){

    ///////////////////////////////////////////////////////////////////
   //                                                               //
   //   VERIFICA SE O USUARIO JÁ ATIVADO OU NÃO                     //   
   //                                                               //
   ///////////////////////////////////////////////////////////////////

   if(arrivalInTheDatabaseIfActiveUser($link, $ServidorID)>0){

       return(false);

   }

   return(true);

}

function checkAccessPermission($link, $ServidorID, $controller, $method, $action){

    $controller=treatmentString($controller);
    $method=treatmentString($method);

if(($controller=='LOGIN') or ($controller=='STANDARD')){

    return(true);

}
    if($method=='STANDARD') $method='VIEW';

    if(checkAccessPermissionDatabase($link, $ServidorID, $controller, $method, $action)>0){

        return(true);

    }

    return(false);

}

function setCredentials($link, $ServidorID, &$credentials){

   if(is_array($getDate=getUserDataBase($link, $ServidorID))){

        extract($getDate);

        $credentials= array (
            'IdServidor' => $ServidorID,
            'ServidorNickname' => $nickname,
            'ServidorName' => $name,
            'Setor' => $sector,
            'Area' => $area,
            'Secretary' => $secretary,        
            'Login' => $registration,
            'Mode' => $mode,
            'Mobile' => isMobile()
         );


         return(true);

    }

    return(false);

}

function logoff($link, $ServidorID){

    unset($_SESSION['credentials']);   
    unset($_SESSION['ErrorCount']);  
    setcookie("credentials", "", time() -7200, '/');
    removeToken($link, $ServidorID);
 

}

function secondaryAccessControl($link, $controller, $method, $action, $ServidorID, &$credentials, &$errorMessage, &$systemErrorMessage, &$accessControllerTemplate){

    if($method=='logoff'){

        logoff($link, $ServidorID);
        $accessControllerTemplate='ACCESS';

        return(false);

    } 
   
    if(checkIfBlockedUser($link, $ServidorID)){

        $errorMessage='ACESSO BLOQUEADO';
        $systemErrorMessage.="USUARIO BLOQUEADO [".userIdentifiesLogin($link, $ServidorID)."]";
        $accessControllerTemplate='ERROR';           
        unset($_SESSION['credentials']);

        return(true);

    }

    if(checkIfActiveUser($link, $ServidorID)){

        $errorMessage='ACESSO BLOQUEADO';
        $systemErrorMessage.="USUARIO DESATIVADO [".userIdentifiesLogin($link, $ServidorID)."]";
        $accessControllerTemplate='ERROR';            
        unset($_SESSION['credentials']);

        return(false);

    }

    if(!checkIfPathExists($controller)){
        
        $errorMessage='FERRAMENTA NÃO LOCALIZADA!';
        $systemErrorMessage.="CONTROLADOR SOLICITADA NÃO EXISTE, ".$controller.", [".userIdentifiesLogin($link, $ServidorID)."]";
        $accessControllerTemplate='ERROR';  

        return(true);

    }

    if(lockController($link, $controller, $method, $action)){

        $errorMessage='MODULO OU FUNÇÃO TEMPORARIAMENTE INDISPONIVEL!';
        $systemErrorMessage.="CONTROLADOR E/ OU METODO SOLICITADO ESTA DESATIVADO TEMPORARIAMENTE, CONTROLADO [ ".$controller." ] - METODO [ ".$method." ], [".userIdentifiesLogin($link, $ServidorID)."]";
        $accessControllerTemplate='ERROR';  

        return(true);


    }

    if(!checkAccessPermission($link, $ServidorID, $controller, $method, $action)){

        $errorMessage='ACESSO BLOQUEADO';
        $systemErrorMessage.="USUARIO [".userIdentifiesLogin($link, $ServidorID)."], SEM PERMISSÃO DE ACESSO AO CONTROLLER [".$controller."] E/ OU Metodo [".$method."]";
        $accessControllerTemplate='ERROR';

        return(true);

    }

    if(!setCredentials($link, $ServidorID, $credentials)){

        $errorMessage='ERRO DE ACESSO TENTE NOVAMENTE';
        $systemErrorMessage.="NÃO FOI POSSIVEL BUSCAR DADOS DO USUARIO NA BANCO DE DADOS PARA CRIAÇÃO DAS CREDENCIAIS [".userIdentifiesLogin($link, $ServidorID)."]";
        $accessControllerTemplate='ERROR';
        unset($_SESSION['credentials']);

        return(true);

    }

    $accessControllerTemplate='STANDARD';
  
    return(true);


}

function randomGenerator(){

$maximumSize = 128;
 
$repository = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
$password = '';

for ($i = 0; $i <$maximumSize; $i++) {

  $password .=$repository[rand(0, strlen($repository) - 1)];

}
 
return($password);

}

function removeToken($link, $ServidorID){
    $sql="DELETE FROM `token` where id_user=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
    
    return $stmt->affected_rows;

}

function getToken($link, $token, $currentTime){

    $setArrivalTime="01:00:00";
       
    $sql="SELECT * FROM `token` WHERE `token`=? and TIMEDIFF( ? , `time`) < ?";  
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sss', $token, $currentTime, $setArrivalTime);
    $stmt->execute();    
    $result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return($row['id_user']);
    
    }

    return(0);

}


function setRandomKeyDataBase($link, $randomKey, $ServidorID, $currentTime){

    $sql="INSERT INTO `token`(`id_user`, `token`, `time`) VALUES (?,?,?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('iss', $ServidorID, $randomKey, $currentTime);
    $stmt->execute();
    
    return($stmt->affected_rows);

}

function setRandomKeyCookie($randomKey){

    setcookie("credentials", $randomKey, time() +3600, '/');     

}

function randomKeyRegistrationProcess($link, $linksystem, $ServidorID, $currentTime){
    
    removeToken($link, $ServidorID);

    $randomKey=md5($currentTime.$ServidorID).randomGenerator();

    if(setRandomKeyDataBase($link, $randomKey, $ServidorID, $currentTime)){

        setRandomKeyCookie($randomKey);        

        return(true);

    }


    return(false);


}

function keyValidationProcess($link, $linksystem, &$ServidorID, $token, $currentTime, $errorMessage, $systemErrorMessage, $accessControllerTemplate){

    if(($ServidorID=getToken($link, $token, $currentTime))==0){

        $errorMessage='ERRO DE LOGIN';
        $systemErrorMessage='TOKEN NÃO ENCONTRADO NO BANCO DE DADOS!';
        $accessControllerTemplate='ERROR';

        return(false);

    }

    if(!removeToken($link, $ServidorID)){

        $errorMessage='ERRO DE LOGIN';
        $systemErrorMessage='FALHA NA REMOÇÃO DE TOKEN ANTIGO!';
        $accessControllerTemplate='ERROR';

        return(false);
    }


    if(!randomKeyRegistrationProcess($link, $linksystem, $ServidorID, $currentTime)){

        $errorMessage='ERRO DE LOGIN';
        $systemErrorMessage='FALHA NO PROCESSO DE REGISTRO DE NOVO TOKEN!';
        $accessControllerTemplate='ERROR';

        return(false);
    }


    return(true);


}

function checksIfThereIsAKeyRegisteredInTheDatabaseForThisUser($link, $ServidorID){

    $sql="select * from token where id_user=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $ServidorID);
    $stmt->execute();    
    $result = $stmt->get_result();
    return($result->num_rows);

}

function getKeyValidity($link, $ServidorID){

    $sql="select * from token where id_user=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $ServidorID);
    $stmt->execute();    
    $result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return($row['time']);
    
    }

    return(0);

}

function checkKeyValidity($link, $ServidorID, $currentTime){

    return(((strtotime($currentTime) - strtotime(getKeyValidity($link, $ServidorID)))>=3600)?true:false);

}

function checkIfThereIsARegisteredKeyForThisUser($link, $ServidorID, $currentTime, &$errorMessage, &$systemErrorMessage){

    if(checksIfThereIsAKeyRegisteredInTheDatabaseForThisUser($link, $ServidorID)>0){

        $systemErrorMessage = "ENCONTRADA TOKEN REGISTRADO NO SISTEMA, ".(checkKeyValidity($link, $ServidorID, $currentTime))?"COM VALIDADE":"SEM VALIDADE "."!";
        $errorMessage= "AVISO:<bR>JÁ EXISTIA SESSÃO LOGADA ANTERIORMENTE, A MESMA SERÁ FECHADA!";        
        
        removeToken($link, $ServidorID);

    }


}


function checkpassword($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){
 
    
    $passwordStrength=checkPasswordStrength($varPost['newpassword']);

    $analyzePasswords=analyzePasswords($varPost['password'], $varPost['newpassword'], $varPost['repeatpassword']);

    $validPassword=checkUserPasswordInDatabase($link, $credentials['Login'], encryptData($varPost['password']));

    if(($passwordStrength>=70)and($analyzePasswords==true)and($validPassword>0)){

      if(updatepassword($link, $credentials['Login'], encryptData($varPost['password']), 'DESATIVADA')){

          if(!(insertpassword($link, $credentials['Login'], $varPost['newpassword'], $dayoftheToday))){
       
            updatepassword($link, $credentials['Login'], encryptData($varPost['password']), 'ATIVA');
         
            return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Falha na atualização da senha!')));

          }
         
      }

      return('true');

    }

       return(manufactureComponentContainer(6,manufactureComponentAlert('danger', 'Senha não atende critérios minimos de segurança!')));

}