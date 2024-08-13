<?php
function getIDuser($link, $varSql){

    $sql="select id from user where name=? and nickname=? and registration=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sss', $varSql['name'], $varSql['nickname'], $varSql['registration']);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['id'];
    
    }

    return 0;

}
