<?php

require("sql.php");

function listUser($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE USUARIOS', null, null);
    
    $numberPerPage = (($credentials['Mobile'])?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('', 'IDENTIFICAÇÃO', 'MATRICULA', 'SETOR', 'ESTADO', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('path', 'nickname', 'registration', 'sector', 'status');
    $varDataBase=listRegisteredUser($link, $credentials['Mode'], $start, $numberPerPage);
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'accesscontrol', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredUser($link, $credentials['Mode']), $numberPerPage, 'accesscontrol', null, $pagenumber, null);

     return $return;

}


function accesscontrolToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode){

    $tools=array( 
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),        
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
        array('type' => 'edit',  'btn' => 'password','btn-status' => 'btn-toolbtn', 'action' => 'check')
    );
   
    return $tools;

}

function accesscontrolDataPattern($link, $mode, $varPost){
    
    $userReceivedData= array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'accesspermissions', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden', 'value' => $mode, 'isdatabase' => false),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => (isset($varPost['status'])?$varPost['status']:null), 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "integer", 'label' => 'id_user', 'tag' => 'ID_USER', 'typeform' => 'hidden', "value" => (isset($varPost['id_user'])?$varPost['id_user']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "string", 'label' => 'controller', 'tag' => 'FUNÇÃO', 'typeform' => 'hidden',  "value" => (isset($varPost['controller'])?$varPost['controller']:null), "required" => true, "minimum" => 3, "maximum" => 50, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => 'method', 'tag' => 'FERRAMENTA', 'typeform' => 'hidden',  "value" => (isset($varPost['method'])?$varPost['method']:null), "required" => true, "minimum" => 3, "maximum" => 50, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        // array("type" => "string", 'label' => 'status', 'tag' => 'ESTADO', 'typeform' => 'hidden',  "value" => (isset($varPost['status'])?$varPost['status']:null), "required" => true, "minimum" => 7, "maximum" => 10, 'placeholder' => null),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'TIPO AÇÃO', 'typeform' => 'hidden',  "value" => (isset($varPost['typeaction'])?$varPost['typeaction']:null), "required" => true, "minimum" => 6, "maximum" => 7, 'placeholder' => null),
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => 4, "maximum" => 5, 'placeholder' => null),   
     ); 

     return $userReceivedData;
     
}

function returnFormAccessPermission($linksystem, $controller, $method, $varLabelPointer, $idPointer, $id_btn, $btnStatus, $action, $typeaction){

    return "<form action='".$linksystem."/".$controller."/".$method."/' method='post'><input type=hidden name=".$varLabelPointer." value=".$idPointer.">".((isset($typeaction) and !empty($typeaction))?"<input type=hidden name='typeaction' value='".$typeaction."'>":'')."<button type='submit' class='btn btn-tool-return pull-right hidden-print' name='action'  value='".$action."'>".manufactureComponentIconTool('voltar')."</button></form>";
   
}


function getDirController(){
        
    $path = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
   
    $dir=scandir($path, 0);

    return array_splice($dir, 2);

}

function convertDirectoryNameToControllerName($dirController){

    $controller=array_map(function ($string) {
 
        return strtolower(substr($string, 3));

    }, $dirController);


    return $controller;
}

function mountBarForm($link, $linksystem, $controller, $id_user, $accessibleTools){

    $return="";
    
        
        if(is_array($accessibleTools) and !empty($accessibleTools)){

            arsort($accessibleTools);
    
            foreach ($accessibleTools as $value) {
    
              $permissions=checkAccessPermissionDatabaseForAccessControl($link, $id_user, $controller, $value);             
             
                $return.=formToolButton($linksystem, $controller, $value, ((isset($permissions['id']) and !empty($permissions['id']))?$permissions['id']:null), $id_user, ((isset($permissions['status']) and !empty($permissions['status']))?$permissions['status']:'DESATIVADO'));
             
    
            }
    
        }
    
    return $return;
    
    }

    function  formToolButton($linksystem, $controller, $method, $idPointer, $id_user, $status){

        return "<li class='pull-right'><form action='".$linksystem."/accesscontrol/edit/' method='post'><input type=hidden name='typeaction' value='".((empty($idPointer) or ($idPointer==null))?'insert':'update')."'><input type=hidden name=id value=".$idPointer."><input type=hidden name=id_user value=".$id_user."><input type=hidden name='controller' value=".treatmentString($controller)."><input type=hidden name='method' value=".treatmentString($method)."><input type=hidden name='status' value=".(($status=='ATIVADO')?'DESATIVADO':'ATIVADO')."><button type='submit' class='btn-inline btn-".(($status=='ATIVADO')?'success':'danger')." btn-white' name='action'  value='save'>".$method."</button></form></li>";
       
    }


    function mountBar($link, $controller, $ServidorID){

        $data=searchGeneralTheUserAccessPermissionsDatabase($link, $controller, $ServidorID);

        $return='';

       
    
        if(is_array($data) and !empty($data)){
    
            foreach ($data as $row) {
                
                extract($row);
    
                $return.=manufactureComponentUtilityBar($method, (($status=='ATIVADO')?'success':'danger'));
    
            }
        }
    
    return $return;
    
    }