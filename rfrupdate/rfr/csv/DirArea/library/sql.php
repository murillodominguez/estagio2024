<?php

function listRegisteredArea($link, $mode, $start, $end){

    //todospathscomdata $sql="select image.path, area.* from area left join image on image.controller_id = area.id and image.controller='area' where area.mode=? ORDER BY `area`.`id` ASC limit ?,?";
    $sql = "select img.path, area.* from area left join (select * from image join (SELECT MAX(dateupload) as maxdate from image where controller='area' and ordercontrol=1 GROUP by controller_id) recent on image.dateupload = recent.maxdate where ordercontrol=1) img on area.id = img.controller_id where area.mode=? ORDER BY `area`.`id` ASC limit ?,?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sii', $mode, $start, $end);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
        // var_dump($result->fetch_All(MYSQLI_ASSOC));
        return $result->fetch_All(MYSQLI_ASSOC);	
    }

    return 0; 
}

function numberOfRegisteredArea($link, $mode){

    $sql="SELECT count(id) as number FROM area where mode=?";  
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

function areaStateQuery($link, $id, $mode){

    $sql="select status from area where id=? and mode=?";
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

function getDataAreaDatabase($link, $id, $mode){

    // $sql="select image.path, area.* from area left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = area.id and image.controller='area' where area.id=? and area.mode=?";
    $sql="select img.path, area.* from area left join (select * from image join (SELECT MAX(dateupload) as maxdate from image where controller='area' and ordercontrol=1 GROUP by controller_id) recent on image.dateupload = recent.maxdate where ordercontrol=1) img on area.id = img.controller_id where area.id=? and area.mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();

    if($result->num_rows>0){
        $arrayresult = $result->fetch_assoc();
        return $arrayresult;	
    }

    return 0; 
}

function getDataCountAreaImages($link, $id, $mode){
    
    $sql = "select count(distinct image.path) as count from area left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = area.id and image.controller='area' where area.id=? and area.mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();

    if($result->num_rows>0){
        return ($result->fetch_assoc());	
    }

    return 0; 
}

// function getDataAreaImages($link, $id, $mode){
//     $count = getDataCountAreaImages($link, $id, $mode);
//     $count = $count['count'];
//     $images = [];
//     while($count > 0){
//     $order = $count-(ceil($count/4));
//     $sql = "select image.path from area left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA where ordercontrol=?) image on image.controller_id = area.id and image.controller='area' where area.id=? and area.mode=?";
//     $stmt = $link->prepare($sql);
//     $stmt->bind_Param('iis', $order, $id, $mode);
// 	$stmt->execute();
// 	$result = $stmt->get_result();
//     $arrayimages = $result->fetch_assoc();
//     var_dump($count-(ceil($count/4)));
//     echo '<br><br>';
//     array_push($images, $arrayimages['path']);
//     $count -= 1;
//     }

//     var_dump($images);
//     echo '<br><br>';
//     return $images;
// }

function getDataAreaImage($link, $id, $mode, $order){
    $sql = "select * from area join (select * from image join (SELECT MAX(dateupload) as maxdate from image where controller='area' and ordercontrol=? GROUP by controller_id) recent on image.dateupload = recent.maxdate where controller_id=? and ordercontrol=?) img on area.id = img.controller_id where area.mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('iiis', $order, $id, $order, $mode);
	$stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows>0){
        return $result->fetch_assoc()['path'];
    }
    return null;
}

function isAllImageSetArea($link, $id, $mode, $count){
    $counter = 0;
    $imagecounter = 0;
    while($counter<$count){
        $order = $counter+1;
        // $sql = "select recent.path from area join (SELECT *, MAX(dateupload) as maxdate from image where controller='area' and ordercontrol=? GROUP by controller_id, ordercontrol) recent on controller_id = area.id where area.id=? and area.mode=?";
        $sql = "select * from area join (select * from image join (SELECT MAX(dateupload) as maxdate from image where controller='area' and ordercontrol=? GROUP by controller_id) recent on image.dateupload = recent.maxdate where controller_id=? and ordercontrol=?) img on area.id = img.controller_id where area.mode=?";
        $stmt = $link->prepare($sql);
        $stmt->bind_Param('iiis', $order, $id, $order, $mode);
	    $stmt->execute();
        $result = $stmt->get_result();
        if(isset($result->fetch_assoc()['path'])){
            $imagecounter += 1;
        }
        ++$counter;
    }
    if($imagecounter<$count){
        return false;
    }
    return true;
}