<?PHP


function searchCenterZone($link, $name, $mode){

        $sql="SELECT * FROM `zone` WHERE mode=? and name=? and status='ATIVADO' order by name, code";
        $stmt = $link->prepare($sql);
        $stmt->bind_Param('ss', $mode, $name);
        $stmt->execute();
	    $result = $stmt->get_result();
    
        if($result->num_rows>0){                
        
            $row=$result->fetch_assoc();
            return('[ '.$row['ref_latitude'].", ".$row['ref_longitude']." ], ".$row['zoom']);
        
        }
    
        return(0);
    
    }