<?php

function confirmAccessAuthorization($link, $controller, $method, $ServidorID){

    $sql="SELECT * FROM `accesspermissions` WHERE id_user=? and controller=? and method=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('iss', $ServidorID, $controller, $method);
    $stmt->execute();
    $result = $stmt->get_result(); 
    
    return $result->num_rows;
    
}

function getUserDataBase($link, $id) {

    $sql="SELECT * from user where id=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows>0){

        return $result->fetch_assoc();

    }

    return false;
    
}

function userIdByRegistration($link, $login){

    $sql="SELECT id FROM user WHERE registration=?";  
	$stmt = $link->prepare($sql);
	$stmt->bind_Param('i', $login);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['id'];
    
    }

    return 0;

}

function userIdentifiesLogin($link, $ServidorID){

    $sql="SELECT registration FROM user WHERE id=?";  
	$stmt = $link->prepare($sql);
	$stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['registration'];
    
    }

    return false;

}

function userIdentifiesNickname($link, $ServidorID){

    $sql="SELECT nickname FROM user WHERE id=?";  
	$stmt = $link->prepare($sql);
	$stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['nickname'];
    
    }

    return '';

}

function userIdentifiesSector($link, $ServidorID){

    $sql="SELECT sector FROM user WHERE id=?";  
	$stmt = $link->prepare($sql);
	$stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['sector'];
    
    }

    return 0;

}

function userIdentifiesArea($link, $ServidorID){

    $sql="SELECT area FROM user WHERE id=?";  
	$stmt = $link->prepare($sql);
	$stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['area'];
    
    }

    return 0;

}

function userIdentifiesSecretary($link, $ServidorID){

    $sql="SELECT secretary FROM user WHERE id=?"; 
	$stmt = $link->prepare($sql);
	$stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['secretary'];
    
    }

    return 0;

}

function searchTheUserAccessPermissionsDatabase($link, $controller, $ServidorID){

    $sql="SELECT * FROM `accesspermissions` WHERE id_user=? and controller=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $ServidorID, $controller);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0;

}
function searchGeneralTheUserAccessPermissionsDatabase($link, $controller, $ServidorID){

    $sql="SELECT * FROM `accesspermissions` WHERE id_user=? and controller=? order by method desc";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $ServidorID, $controller);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0;

}

function searchAccessPermissionsOnUserControllerInDatabase($link, $ServidorID){

    $sql="SELECT controller FROM `accesspermissions` WHERE id_user=? group by controller order by controller asc";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $ServidorID);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0;

}

function secretaryIdSearchInName($link, $name){

    $sql="SELECT id FROM secretary WHERE name=?"; 
	$stmt = $link->prepare($sql);
	$stmt->bind_Param('s', $name);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['id'];
    
    }

    return 0;

}


function areaIdSearchInName($link, $name){

    $sql="SELECT id FROM area WHERE name=?"; 
	$stmt = $link->prepare($sql);
	$stmt->bind_Param('s', $name);
    $stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['id'];
    
    }

    return 0;

}

function userStateQuery($link, $id_servidor){

    $sql="SELECT status from user where id=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $id_servidor);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['status']; 
    
    }

    return false;

}

function postStateQuery($link, $id){

    $sql="SELECT status from post where id=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['status']; 
    
    }

    return false;

}

function identifiesUserForName($link, $serv_nickname){

    $sql="SELECT id from user where nickname=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $serv_nickname);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows>0){

        $row=$result->fetch_assoc();
        return $row['id_servidor']; 

    }

    return false;
    
}


function getUserNameDataBase($link) {

    $sql="SELECT nickname from user where status='ATIVADO' order by nickname asc";
    $stmt = $link->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows>0){

        return $result->fetch_all();

    }

    return false;
    
}

function getlistSecretary($link, $mode){

    $sql="select * from secretary where mode=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
	$stmt->execute();
	$result = $stmt->get_result();

    if($result->num_rows>0){                
        return $result->fetch_All(MYSQLI_ASSOC);
    }

    return 0; 
}

function getlistArea($link, $mode){

    $sql="select * from area where mode=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function getlistSector($link, $mode){

    $sql="select * from sector where mode=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function getlistOffice($link, $mode){

    $sql="select * from office where mode=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function getlistFunction($link, $mode){

    $sql="select * from function where mode=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}


function listRegisteredUser($link, $mode,$start, $end){

    $sql="select image.path, user.* from user left join (SELECT image.* FROM `image` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `image` as upl GROUP BY controller_id) recent ON image.controller_id = recent.controller_id AND image.dateupload = recent.MAIOR_DATA) image on image.controller_id = user.id and image.controller='user' where user.mode=? ORDER BY `user`.`id` ASC limit ?,?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('sii', $mode, $start, $end);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function numberOfRegisteredUser($link, $mode){

    $sql="SELECT count(id) as number FROM user where mode=?";  
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


function getlistVehicletype($link, $mode){

    $sql="select * from vehicletype where mode=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function getlistFuel($link, $mode){

    $sql="select * from fuel where mode=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function getlistPublicplace($link, $mode){

    $sql="select * from publicplace where mode=? and status='ATIVADO'";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_All(MYSQLI_ASSOC);	
    
    }

    return 0; 
}

function getDataUserDatabase($link, $id, $mode){

    $sql="select upload.path, user.* from user left join (SELECT upload.* FROM `upload` INNER JOIN (SELECT controller_id, MAX(dateupload) AS MAIOR_DATA FROM `upload` as upl GROUP BY controller_id) recent ON upload.controller_id = recent.controller_id AND upload.dateupload = recent.MAIOR_DATA) upload on upload.controller_id = user.id and upload.controller='user' where user.id=? and user.mode=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('is', $id, $mode);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        return $result->fetch_assoc();	
    
    }

    return 0; 
}