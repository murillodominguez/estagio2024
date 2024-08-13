<?php

function listRegisteredSector($link, $mode, $start, $end){

    $sql="select image.path, sector.* from sector left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = sector.id and image.controller='sector' where sector.mode=? ORDER BY `sector`.`id` ASC limit ?,?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sii', $mode, $start, $end);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function numberOfRegisteredSector($link, $mode){

    $sql="SELECT count(id) as number FROM sector where mode=?";  
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

function sectorStateQuery($link, $id, $mode){

    $sql="select status from sector where id=? and mode=?";
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

function getDataSectorDatabase($link, $id, $mode){

    $sql="select image.path, sector.* from sector left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = sector.id and image.controller='sector' where sector.id=? and sector.mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_assoc();	
    
    }

    return 0; 
}