<?php

function insertsql($link, $linksystem, $rowUserReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    $action = 'insert';
    $sql = "INSERT INTO `".$varSql['table']."`(";
    $sql2 = ") VALUES (";
    $sqlbindstring = "";
    $recordvalues = $varSql['database'];

    foreach($rowUserReceivedData as $row){

        if(isset($row['type']) and $row['type'] == 'image' and !isset($row['value'])){
            if(uploadImagetoServer($row, $link, $varPost, $controller, $varSql, $action)) uploadImagetoDatabase($row, $link, $varPost, $controller, $varSql,null,$action);
        }
        else if(isset($row['isdatabase']) and $row['isdatabase'] == true and isset($row['typedata'])){
            if($row['type'] == 'checkbox'){
                foreach($row['value'] as $key => $item){
                    $sql.=$key.",";
                    $sql2.="?,";
                    $sqlbindstring .= $row['typedata'];
                }
            }
            else{
                $sql.=$row['label'].","; 
                $sql2.="?,";
                $sqlbindstring.= $row['typedata'];
            }  

        }
    }
    $sql = rtrim($sql,',');
    $sql2 = rtrim($sql2,',');
    $sql.=$sql2.")";

    $stmt = $link->prepare($sql);
    //  echo '<br>';
    //  var_dump($link);

    //  echo '<hr>';
    //  var_dump($stmt);
         
      $bind_arguments = [];
      $bind_arguments[] = $sqlbindstring;
      foreach ($recordvalues as $recordkey => $recordvalue)
      {
          $bind_arguments[] = & $recordvalues[$recordkey];   
      }

          
      call_user_func_array(array($stmt, 'bind_Param'), $bind_arguments);     
      $stmt->execute();


    //   if(($stmt->affected_rows >0)){
    //     echo "Verdadeiro";
    //   }
    //   else{echo "Falso";}
      return ($stmt->affected_rows >0)?true:false;
}

function updatesql($link, $linksystem, $rowUserReceivedData, $varSql, $varPost, $controller, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    $action = 'update';
    $sql="UPDATE `".$varSql['table']."` SET ";
    $sqlend = " WHERE id=? and mode=?";
    $sqlbindstring = "";
    $recordvalues = array();
    $c = 0;
    echo '<br>Número de recorded values: ';
    foreach($varSql['database'] as $data){
    if($c > 2){
    array_push($recordvalues, $data);
    }
    echo $c;
    $c = $c+1;
    }
    array_push($recordvalues, $varSql['database'][2],$varSql['database'][0]);
    echo '<br>Recorded Values: ';
    var_dump($recordvalues);
    echo '<br><br>User Id: ';
    var_dump($_SESSION['credentials']);
    foreach($rowUserReceivedData as $row){
        if(isset($row['type']) and $row['type'] == 'image'){
            if(uploadImagetoServer($row, $link, $varPost, $controller, $varSql, $action) == true) $changeimage = true;
        }
        if(isset($row['label']) && ($row['label'] == 'id' || $row['label'] == 'mode' || $row['label'] == 'status')){
            $sql .= "";
        }
        else if(isset($row['isdatabase']) and $row['isdatabase'] == true and isset($row['typedata'])){
            if($row['type'] == 'checkbox'){
                foreach($row['value'] as $key => $item){
                    $sql.=$key."=?, ";
                    $sqlbindstring .= $row['typedata'];
                }
            }
            else{
                $sql.="`".$row['label']."`=?, "; 
                $sqlbindstring.= $row['typedata'];
            }  
        }
        }
    $sql = rtrim($sql,', ');
    $sql .= $sqlend;
    $sqlbindstring .= "is";


    $stmt = $link->prepare($sql);

    $bind_arguments = [];
    $bind_arguments[] = $sqlbindstring;
    foreach ($recordvalues as $recordkey => $recordvalue)
    {
        $bind_arguments[] = & $recordvalues[$recordkey];   
    }
    var_dump($bind_arguments);
        
    call_user_func_array(array($stmt, 'bind_Param'), $bind_arguments);     
    $stmt->execute();
    // $stmt = $link->prepare($sql);
	// $stmt->bind_Param('sssis', $varSql['name'], $varSql['nickname'], $varSql['secretary'], $varSql['id'], $credentials['Mode']);
    // $stmt->execute();

    return ($stmt->affected_rows >0 || $changeimage=true)?true:false; 
}

