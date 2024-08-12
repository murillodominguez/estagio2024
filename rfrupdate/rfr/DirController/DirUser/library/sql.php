<?php

function listRegisteredUserForArea($link, $mode, $area, $start, $end){

    // $sql="select * from user where area=? and user.mode=? limit ?,?";
    $sql = "select image.path, user.* from user left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = user.id and image.controller='user' where user.area=? and user.mode=? ORDER BY `user`.`id` ASC limit ?,?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('ssii', $area, $mode, $start, $end);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return($result->fetch_All(MYSQLI_ASSOC));	
    
    }

    return(0); 
}

function numberOfRegisteredUserForArea($link, $area, $mode){

    $sql="SELECT count(id) as number FROM user where area=? and mode=?";  
	$stmt = $link->prepare($sql);
    $stmt->bind_Param('ss', $area, $mode);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return($row['number']);
    
    }

    return(0);

}
