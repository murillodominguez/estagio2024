<?php

function listRegisteredFunction($link, $mode, $start, $end){

    $sql="select image.path, function.* from function left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = function.id and image.controller='function' where function.mode=? ORDER BY `function`.`id` ASC limit ?,?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sii', $mode, $start, $end);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return($result->fetch_All(MYSQLI_ASSOC));	
    
    }

    return(0); 
}

function numberOfRegisteredFunction($link, $mode){

    $sql="SELECT count(id) as number from `function` where mode=?";  
	$stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return($row['number']);
    
    }

    return(0);

}

function functionStateQuery($link, $id, $mode){

    $sql="select status from function where id=? and mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return($row['status']); 
    
    }

    return(false);

}

function getDataFunctionDatabase($link, $id, $mode){

    $sql=" select image.path, function.* from function left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = function.id and image.controller='function' where function.id=? and function.mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return($result->fetch_assoc());	
    
    }

    return(0); 
}