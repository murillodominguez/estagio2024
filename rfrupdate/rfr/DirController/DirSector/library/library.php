<?php

require("sql.php");

function listSector($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE SETORES CADASTRADAS', null, manufactureComponentFormTitleButton($linksystem, 'sector', 'edit', null, null, 'form', 'btn-title'));
    
    $numberPerPage = (($credentials['Mobile'])?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('', 'SETOR', 'ABREVIAÇÂO', 'AREA', 'ESTADO', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('path', 'name', 'nickname', 'area', 'status');
    $varDataBase=listRegisteredSector($link, $credentials['Mode'], $start, $numberPerPage);
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'sector', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredSector($link, $credentials['Mode']), $numberPerPage, 'sector', null, $pagenumber, null);

     return $return;

}


function sectorToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode){

    $tools=array( 
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
        array('type' => 'edit',  'btn' => ((($status=sectorStateQuery($link, $idPointer, $mode))=="EDIÇÃO")?'check':'check'),'btn-status' => (($status==0)?'btn-toolbtn':'btn-toolbtn-danger'), 'action' => 'check')
    );
   
    return $tools;

}

function sectorDataPattern($link, $mode, $varPost){
    
    $userReceivedData= array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'sector', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden', 'value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => ((isset($varPost['id']) and !empty($varPost['id']))?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        array("type" => "string", 'label' => 'name', 'tag' => 'NOME (COMPLETO)', 'typeform' => 'text',  "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => 'true', 'typedata' => 's'),
        array("type" => "string", 'label' => 'nickname', 'tag' => 'NOME (ABREVIADO)', 'typeform' => 'text', "value" => (isset($varPost['nickname'])?$varPost['nickname']:null), "required" => true, "minimum" => 2, "maximum" => 50, 'placeholder' => null, 'isdatabase' => 'true', 'typedata' => 's'),
        array("type" => "list", 'label' => 'area', 'tag' => 'AREA', 'typeform' => 'select', "value" => (isset($varPost['area'])?$varPost['area']:null), "required" => true, "minimum" => getlistArea($link, $mode), "maximum" => 50, 'placeholder' => null),
        array("type" => "integer", 'label' => 'id_area', 'tag' => 'ID_AREA', 'typeform' => 'hidden', "value" => (isset($varPost['area'])?areaIdSearchInName($link, $varPost['area']):null), "required" => null, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => 'true', 'typedata' => 'i'),  
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),    
     ); 
    var_dump((areaIdSearchInName($link, $varPost['area'])));
     return $userReceivedData;    
     
}

