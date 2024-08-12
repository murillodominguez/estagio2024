<?php

function checkAccessPermissionDatabaseForAccessControl($link, $ServidorID, $controller, $method){

    $sql="SELECT * FROM `accesspermissions` WHERE id_user=? and controller=? and method=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('iss', $ServidorID, $controller, $method);
    $stmt->execute();
    $result = $stmt->get_result(); 
 
    if($result->num_rows>0){

    return($row=$result->fetch_assoc());
 
    }

    return(false);
 
  }
