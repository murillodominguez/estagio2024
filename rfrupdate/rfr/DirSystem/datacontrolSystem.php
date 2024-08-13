<?php

function databaseChangeLog($link, $datacontrolsystem){

    $sql="INSERT INTO `datachangecontrol`(`id_source`, `sourcetable`, `time`, `actionperformed`, `id_user`, `changeddata`, mode) VALUES (?,?,?,?,?,?,?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('isssiss', $datacontrolsystem['id_source'], $datacontrolsystem['sourcetable'], $datacontrolsystem['currentTime'], $datacontrolsystem['actionperformed'], $datacontrolsystem['id_user'], $datacontrolsystem['changeddata'], $datacontrolsystem['mode']);
    $stmt->execute();
    $result = $stmt->get_result();

    return (($stmt->affected_rows >0)?true:false);
}

if(!empty($datacontrolsystem)){
   
    databaseChangeLog($link, $datacontrolsystem);      
   
}
