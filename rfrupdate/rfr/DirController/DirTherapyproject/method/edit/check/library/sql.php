<?php

function changeTheStatusOfTheTherapyproject($link, $id, $status, $mode){

    $sql="UPDATE `therapyproject` SET `status`=? WHERE `id`=? and mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sis', $status, $id, $mode);
	$stmt->execute();

    return ($stmt->affected_rows >0)?true:false; 

}