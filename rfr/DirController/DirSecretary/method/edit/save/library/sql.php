<?php
function getIDsecretary($link, $varSql){

    $sql="select id from secretary where name=? and nickname=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('ss', $varSql['name'], $varSql['nickname']);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return($row['id']);
    
    }

    return(0);

}
