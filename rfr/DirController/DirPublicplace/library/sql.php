<?php

function listRegisteredPublicplace($link, $mode, $start, $end){

    $sql="select image.path, publicplace.* from publicplace left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = publicplace.id and image.controller='publicplace' where publicplace.mode=? ORDER BY `publicplace`.`id` ASC limit ?,?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sii', $mode, $start, $end);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return($result->fetch_All(MYSQLI_ASSOC));	
    
    }

    return(0); 
}

function numberOfRegisteredPublicplace($link, $mode){

    $sql="SELECT count(id) as number FROM publicplace where mode=?";  
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

function publicplaceStateQuery($link, $id, $mode){

    $sql="select status from publicplace where id=? and mode=?";
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

function getDataPublicplaceDatabase($link, $id, $mode){

    $sql="select image.path, publicplace.* from publicplace left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = publicplace.id and image.controller='publicplace' where publicplace.id=? and publicplace.mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return($result->fetch_assoc());	
    
    }

    return(0); 
}