<?php
function getIDDistrict($link, $varSql){

    $sql="select id from district where name=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $varSql['name']);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return($row['id']);
    
    }

    return(0);

}
