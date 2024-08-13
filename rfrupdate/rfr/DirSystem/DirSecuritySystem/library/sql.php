<?php

function checkIfIpBlockedInTheDatabase($link, $IpAcess){

    ///////////////////////////////////////////////////////////////////
    //                                                               //
    //   VERIFICA NO BANCO DE DADOS SE IP CONSTA COM                 //
    //   STATUS "ATIVADO" E RETORNA A QUANTIDADE DE VEZES            //
    //                                                               //
    ///////////////////////////////////////////////////////////////////

    $sql="select * from ipblocking where ip=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $IpAcess);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows;
 
 }
    
 function fetchesErrorsFromTheDatabaseLogWithinATimeg($link, $registration, $password, $IpAcess, $currentTime, $setArrivalTime){

    ///////////////////////////////////////////////////////////////////
    //                                                               //
    //   VERIFICA NO BANCO DE DADOS SE IP CONSTA COM                 //
    //   MAIS DE UM ERRO DE ACESSO NO TEMPO DETERMINADO              //
    //                                                               //
    ///////////////////////////////////////////////////////////////////
 
   $sql="SELECT * FROM `log` WHERE (ip=?) and ((`error`='ACESSO BLOQUEADO!')OR(`error`='ERRO DE LOGIN!')) and TIMEDIFF( ? , `time`)<?";  
   $stmt = $link->prepare($sql);
   $stmt->bind_Param('sss', $IpAcess, $currentTime, $setArrivalTime);
   $stmt->execute();
   $result = $stmt->get_result(); 

   return $result->num_rows;

}

function enterIpBlocking($link, $IpAcess, $currentTime, $log){

    $sql="INSERT INTO `ipblocking`(`ip`, `time`, `status`, `log`) VALUES (?,?,'ATIVADO',?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sss', $IpAcess, $currentTime, $log);
    $stmt->execute();
    
    return $stmt->affected_rows;

}

function fetchesErrorsFromTheDatabaseLog($link, $registration, $currentTime, $setArrivalTime){

    ///////////////////////////////////////////////////////////////////
    //                                                               //
    //   VERIFICA NO BANCO DE DADOS SE O REGISTRATION CONSTA COM     //
    //   MAIS DE UM ERRO DE LOGIN NOS ÚLTIMOS 4 REGISTROS DO LOG     //
    //                                                               //
    ///////////////////////////////////////////////////////////////////
   $sql="SELECT * FROM `log` WHERE (registration=?) and (`error`='ERRO DE LOGIN!') and TIMEDIFF( ? , `time`)<?";  
   $stmt = $link->prepare($sql);
   $stmt->bind_Param('sss', $registration, $currentTime, $setArrivalTime);
   $stmt->execute();
   $result = $stmt->get_result(); 

   return $result->num_rows;

}

function enterUserLock($link, $registration, $currentTime, $log){

    $sql="INSERT INTO `userlock`(`id_user`, `time`, `status`, `log`) VALUES (?,?,'ATIVADO',?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sss', $registration, $currentTime, $log);
    $stmt->execute();
    
    return $stmt->affected_rows;

}

function checkUserPasswordInDatabase($link, $registration, $password){

    $sql="SELECT *  FROM `password` WHERE `registration` = ? and `password`= ? and status='ATIVA'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('ss', $registration, $password);
    $stmt->execute();
    $result = $stmt->get_result(); 
   
    return $result->num_rows;
 
 }

 function arrivalInTheDatabaseIfBlockedUser($link, $ServidorID){

    $sql="SELECT * FROM `userlock` where id_user=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
    $result = $stmt->get_result(); 
 
    return $result->num_rows;
 
 }

 function arrivalInTheDatabaseIfActiveUser($link, $ServidorID){

    $sql="SELECT * FROM `user` where id=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
    $result = $stmt->get_result(); 
 
    return $result->num_rows;
 
 }

 function checkAccessPermissionDatabase($link, $ServidorID, $controller, $method, $action){

   $sql="SELECT * FROM `accesspermissions` WHERE id_user=? and controller=? and (method=? or method=?) and status='ATIVADO'";
   $stmt = $link->prepare($sql);
   $stmt->bind_Param('isss', $ServidorID, $controller, $method, $action);
   $stmt->execute();
   $result = $stmt->get_result(); 

   return $result->num_rows;

 }

function updatepassword($link, $registration, $oldpassword, $newstatus){

   $status='ATIVA';

   if($newstatus=='ATIVA') $status='DESATIVADA';

   $sql="UPDATE `password` SET `status`=? WHERE `registration`=? and `password`=? and `status`=?";
   $stmt = $link->prepare($sql);
   $stmt->bind_Param('siss', $newstatus, $registration, $oldpassword, $status);
   $stmt->execute();  
    
    return $stmt->affected_rows;

}

function insertpassword($link, $registration, $password, $dayoftheToday){

   $password=encryptData($password);
   
   $sql="INSERT INTO `password`(`password`, `registration`, `registrationdate`, `expirationdate`, `status`) VALUES (?,?,?,NULL,'ATIVA')";
   $stmt = $link->prepare($sql);
   $stmt->bind_Param('sss', $password, $registration, $dayoftheToday);
   $stmt->execute();
   
   return ($stmt->affected_rows >0)?true:false;    
   
   }


function checksNeedtoChangePasswordSql($link, $registration, $dayoftheToday){

   $password=encryptData($registration);

   $sql="SELECT * FROM `password` WHERE registration=? and (`password`=? or expirationdate <=?) and status='ATIVA'";
   $stmt = $link->prepare($sql);
   $stmt->bind_Param('iss', $registration, $password, $dayoftheToday);
   $stmt->execute();
   $result = $stmt->get_result(); 

   return $result->num_rows;

 }