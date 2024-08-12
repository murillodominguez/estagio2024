<?php

require("sql.php");

function listDistrict($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE BAIRROS CADASTRADOS', null, ((confirmAccessAuthorization($link, 'district', 'edit', $credentials['IdServidor'])>0)?manufactureComponentFormTitleButton($linksystem, 'district', 'edit', null, null, 'form', 'btn-title'):null));
    
    $numberPerPage = (($credentials['Mobile']==true)?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('','NOME', 'ESTADO', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('path', 'name', 'status');
    $varDataBase=listRegisteredDistrict($link, $credentials['Mode'], $start, $numberPerPage);
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'district', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredDistrict($link, $credentials['Mode']), $numberPerPage, 'district', null, $pagenumber, null);

     return($return);

}


function districtToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode, $ServidorID){

    $tools=array( 
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
    );

    if(authorizedUserAccessMethod('CHECK', searchTheUserAccessPermissionsDatabase($link, 'DISTRICT' , $ServidorID))){ 

       $tools[]=array('type' => 'edit',  'btn' => ((($status=districtStateQuery($link, $idPointer, $mode))=="EDIÇÃO")?'check':'check'),'btn-status' => (($status=='ATIVADO')?'btn-toolbtn':'btn-toolbtn-danger'), 'action' => 'check');
       
    }
  
   
    return($tools);

}

function districtDataPattern($link, $mode, $varPost){

    $userReceivedData= array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'district', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden', 'value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        array("type" => "string", 'label' => 'name', 'tag' => 'NOME DO BAIRRO', 'typeform' => 'text',  "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 3, "maximum" => 200, 'placeholder' => 'ESCREVA O NOME DO BAIRRO POR EXTENSO, SEM ABREVIAÇÕES!', 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "list", 'label' => 'zone', 'tag' => 'ZONA', 'typeform' => 'select', "value" => (isset($varPost['zone'])?$varPost['zone']:null), "required" => true, "minimum" => getDatabaseZone($link, $mode), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "image", 'label' => 'areaimg', 'tag' => 'BRASÃO DA ÁREA', 'typeform' => 'img', "value" => '', "alt" => 'brasão da area', "required" => false, 'isdatabase' => true),
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),    
     );

     return($userReceivedData);    
     
}

