<?php
//$menubuilder='';

function checkAuthorizedDrivers($link, $ServidorID){    

        $sql="SELECT controller FROM accesspermissions WHERE id_user=? and status='ATIVADO' GROUP BY CONTROLLER"; 
        $stmt = $link->prepare($sql);
        $stmt->bind_Param('i', $ServidorID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows>0){
    
          return($result->fetch_All(MYSQLI_ASSOC));
            
        }
    
        return(false);

    }

    function checkAuthorizedDriversToManage($link, $controller, $ServidorID){    

        $sql="SELECT controller FROM accesspermissions WHERE id_user=? and method='tomanage' and controller=? and status='ATIVADO' GROUP BY CONTROLLER"; 
        $stmt = $link->prepare($sql);
        $stmt->bind_Param('is', $ServidorID, $controller);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows>0){
    
          return(true);
            
        }
    
        return(false);

    }

    function getTagController($controller){

    $pathtag=__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."DirController".DIRECTORY_SEPARATOR."Dir".ucfirst($controller).DIRECTORY_SEPARATOR."tag.php";
    
    if(file_exists($pathtag)){

        require($pathtag);

        return($tag);
    }
    
    return(ucfirst($controller));

    }

    if(isset($credentials) and !empty($credentials)){

        $checkAuthorizedDrivers=checkAuthorizedDrivers($link, $credentials['IdServidor']);

        $menubuilder="<ul class='nav navbar-nav mainNav'>";


        if(is_array($checkAuthorizedDrivers) and !empty($checkAuthorizedDrivers)){         
        

            foreach ($checkAuthorizedDrivers as $row) {
        
                $row['controller']=strtolower($row['controller']);

                $menubuilder.="<li".(($row['controller']==$controller)?" class='active'":'')." ><a href='".$linksystem."/".$row['controller']."/".((checkAuthorizedDriversToManage($link, $row['controller'], $credentials['IdServidor']))?'tomanage':'')."'>".getTagController($row['controller'])."</a></li>";
            }           

       }

       $menubuilder.="<li><a href='".$linksystem."/login/logoff'><b class='fa fa-power-off fa-lg'></b>  SAIR</a></li></ul>";

$menuSystemContainer=$menubuilder;

    }

   // echo $menuSystemContainer;
  //  exit();
