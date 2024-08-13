<?php

function listRegisteredSecretary($link, $mode, $start, $end){

    $sql="select image.path, secretary.* from secretary left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = secretary.id and image.controller='secretary' where secretary.mode=? ORDER BY `secretary`.`id` ASC limit ?,?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sii', $mode, $start, $end);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function numberOfRegisteredSecretary($link, $mode){

    $sql="SELECT count(id) as number FROM secretary where mode=?";  
	$stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['number'];
    
    }

    return 0;

}

function secretaryStateQuery($link, $id, $mode){

    $sql="select status from secretary where id=? and mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['status']; 
    
    }

    return false;

}

function getDataSecretaryDatabase($link, $id, $mode){

    $sql="select image.path, secretary.* from secretary left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = secretary.id and image.controller='secretary' where secretary.id=? and secretary.mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_assoc();	
    
    }

    return 0; 
}