<?php

require("sql.php");

function listZone($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE ZONAS', null, manufactureComponentFormTitleButton($linksystem, 'zone', 'edit', null, null, 'form', 'btn-title'));
    
    $numberPerPage = (($credentials['Mobile']==true)?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('', 'TIPO', 'ESTADO', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('path', 'name', 'status');
    $varDataBase=listRegisteredZone($link, $credentials['Mode'], $start, $numberPerPage);
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'zone', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredZone($link, $credentials['Mode']), $numberPerPage, 'zone', null, $pagenumber, null);

     return($return);

}


function zoneToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode, $ServidorID){

    $tools=array(
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
    );

    if(authorizedUserAccessMethod('CHECK', searchTheUserAccessPermissionsDatabase($link, 'ZONE' , $ServidorID))){ 

       $tools[]=array('type' => 'edit',  'btn' => ((($status=zoneStateQuery($link, $idPointer, $mode))=="EDIÇÃO")?'check':'check'),'btn-status' => (($status=='ATIVADO')?'btn-toolbtn':'btn-toolbtn-danger'), 'action' => 'check');
       
    }
  
   
    return($tools);

}

function zoneDataPattern($link, $mode, $varPost){

    $userReceivedData= array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'zone', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden', 'value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        array("type" => "string", 'label' => 'name', 'tag' => 'NOME', 'typeform' => 'text',  "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 3, "maximum" => 200, 'placeholder' => 'ESCREVA O NOME DA ZONA POR EXTENSO, SEM ABREVIAÇÕES!', 'isdatabase' => 'true', 'typedata' => 's'),
        array("type" => "integer", 'label' => 'code', 'tag' => 'CÓDIGO', 'typeform' => 'number',  "value" => (isset($varPost['code'])?$varPost['code']:null), "required" => true, "minimum" => 1, "maximum" => 50, 'placeholder' => NULL, 'isdatabase' => 'true', 'typedata' => 's'),
        array("type" => "string", 'label' => 'perimeter', 'tag' => 'PERÍMETRO', 'typeform' => 'textarea',  "value" => (isset($varPost['perimeter'])?$varPost['perimeter']:null), "required" => true, "minimum" => null, "maximum" => 50000, 'placeholder' => 'ESCREVA AQUI AS COORDENADAS DO PERIMETRO DESTA ZONA. PADRÃO É: [ LATITUDE, LONGITUDE ], [ LATITUDE, LONGITUDE ]...', 'isdatabase' => 'true', 'typedata' => 's'),
        array("type" => "string", 'label' => 'ref_latitude', 'tag' => 'LATITUDE DE REFERÊNCIA', 'typeform' => 'text',  "value" => (isset($varPost['ref_latitude'])?$varPost['ref_latitude']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => 'ESCREVA AQUI A LATITUDE REFERENCIA DA ZONA!', 'isdatabase' => 'true', 'typedata' => 's'),
        array("type" => "string", 'label' => 'ref_longitude', 'tag' => 'LONGITUDE DE REFERÊNCIA', 'typeform' => 'text',  "value" => (isset($varPost['ref_longitude'])?$varPost['ref_longitude']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => 'ESCREVA AQUI A LONGITUDE REFERENCIA DA ZONA!', 'isdatabase' => 'true', 'typedata' => 's'),
        array("type" => "integer", 'label' => 'zoom', 'tag' => 'ZOOM DE REFERÊNCIA', 'typeform' => 'number',  "value" => (isset($varPost['zoom'])?$varPost['zoom']:null), "required" => true, "minimum" => 10, "maximum" => 20, 'placeholder' => NULL, 'isdatabase' => 'true', 'typedata' => 's'),
        array("type" => "image", 'label' => 'areaimg', 'tag' => 'BRASÃO DA ÁREA', 'typeform' => 'img', "value" => '', "alt" => 'brasão da area', "required" => false, 'isdatabase' => true),
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),    
     ); 

     return($userReceivedData);    
     
}

