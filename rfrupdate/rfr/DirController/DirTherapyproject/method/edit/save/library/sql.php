<?php
function getIDtherapyproject($link, $varSql){

    $sql="select id from therapyproject where name=? and matriculafunc=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('ss', $varSql['name'], $varSql['matriculafunc']);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['id'];
    
    }

    return 0;

}
