<?php

function changeTheStatusOfThePublicplace($link, $id, $status, $mode){

    $sql="UPDATE `publicplace` SET `status`=? WHERE `id`=? and mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sis', $status, $id, $mode);
	$stmt->execute();

    return ($stmt->affected_rows >0)?true:false; 

}