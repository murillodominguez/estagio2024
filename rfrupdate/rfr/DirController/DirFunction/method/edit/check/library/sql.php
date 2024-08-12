<?php

function changeTheStatusOfTheFunction($link, $id, $status, $mode){

    $sql="UPDATE `function` SET `status`=? WHERE `id`=? and mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sis', $status, $id, $mode);
	$stmt->execute();

    return(($stmt->affected_rows >0)?true:false); 

}