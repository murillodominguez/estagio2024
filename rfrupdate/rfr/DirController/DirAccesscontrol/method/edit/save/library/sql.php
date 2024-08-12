<?php

function updatesqlaccess($link, $linksystem, $varSql, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){

    $sql="UPDATE `accesspermissions` SET `controller`=?,`method`=?,`status`=? WHERE id=? and id_user=?";
    $stmt = $link->prepare($sql);
	$stmt->bind_Param('sssii', $varSql['controller'], $varSql['method'], $varSql['status'], $varSql['id'], $varSql['id_user']);
    $stmt->execute();

    return(($stmt->affected_rows >0)?true:false);    
    
}

// function insertsql($link, $linksystem, $varSql, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){

      
//     $sql="INSERT INTO `accesspermissions`(`id_user`, `controller`, `method`, `status`) VALUES (?,?,?,?)";
//     $stmt = $link->prepare($sql);
// 	$stmt->bind_Param('isss', $varSql['id_user'], $varSql['controller'], $varSql['method'], $varSql['status']);
//     $stmt->execute();

//     return(($stmt->affected_rows >0)?true:false);    
    
// }

function getIDaccesspermitions($link, $varSql){

    $sql="select id from accesspermissions where id_user=? and controller=? and method=? and status=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('isss', $varSql['id_user'], $varSql['controller'], $varSql['method'], $varSql['status']);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return($row['id']);
    
    }

    return(0);

}

function getAccessPermitionsDatabase($link, $id, $mode){

    $sql="select * from accesspermissions where id=? and mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return($result->fetch_assoc());

    }

    return(false);

}