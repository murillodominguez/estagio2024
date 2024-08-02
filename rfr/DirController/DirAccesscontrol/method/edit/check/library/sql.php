<?php

function disablepassword($link, $registration, $status){

    $sql="UPDATE `password` SET `status`=? WHERE `registration`=? order by id desc limit 1";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('si', $status, $registration);
	$stmt->execute();

}

function resetpassword($link, $base, $dayoftheToday){

    disablepassword($link, $base, 'DESATIVADA');
    
    if(!(insertpassword($link, $base, $base, $dayoftheToday))){
       
        disablepassword($link, $base, 'ATIVA');
          
        return(false);

      }

    return(true); 

}

