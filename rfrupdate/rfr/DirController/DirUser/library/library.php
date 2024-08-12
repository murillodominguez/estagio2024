<?php

require("sql.php");

function listUser($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE USUARIOS', null, manufactureComponentFormTitleButton($linksystem, 'user', 'edit', null, null, 'form', 'btn-title'));
    
    $numberPerPage = (($credentials['Mobile'])?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('', 'NOME', 'IDENTIFICAÇÃO', 'MATRICULA', 'ESTADO', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('path', 'name', 'nickname', 'registration', 'status');
    $varDataBase=listRegisteredUserForArea($link, $credentials['Mode'], $credentials['Area'],$start, $numberPerPage);
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'user', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredUserForArea($link, $credentials['Area'], $credentials['Mode']), $numberPerPage, 'user', null, $pagenumber, null);

     return($return);

}


function userToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode){

    $tools=array( 
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
        array('type' => 'edit',  'btn' => ((($status=userStateQuery($link, $idPointer, $mode))=="EDIÇÃO")?'check':'check'),'btn-status' => (($status==0)?'btn-toolbtn':'btn-toolbtn-danger'), 'action' => 'check')
    );
   
    return($tools);

}

function userDataPattern($link, $mode, $varPost){
    
    $userReceivedData= array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'user', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden', 'value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => ((isset($varPost['id']) and !empty($varPost['id']))?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        array("type" => "string", 'label' => 'name', 'tag' => 'NOME (COMPLETO)', 'typeform' => 'text',  "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => 'nickname', 'tag' => 'IDENTIFICAÇÃO', 'typeform' => 'text', "value" => (isset($varPost['nickname'])?$varPost['nickname']:null), "required" => true, "minimum" => 2, "maximum" => 50, 'placeholder' => 'Exemplos: AT 75 - MORAES , GM 01 - MARCELO, FP - MAICON, FO - BRUNO', 'isdatabase' => true, 'typedata' => 's'),    
        array("type" => "bigint", 'label' => 'registration', 'tag' => 'MATRICULA', 'typeform' => 'number', "value" => (isset($varPost['registration'])?$varPost['registration']:null), "required" => true, "minimum" => 2, "maximum" => 99999999999, 'placeholder' => 'INSERIR A MATRICULA, APENAS NÚMEROS', 'isdatabase' => true, 'typedata' => 's'),    
        array("type" => "cpf", 'label' => 'cpf', 'tag' => 'CPF', 'typeform' => 'cpf', "value" => (isset($varPost['cpf'])?$varPost['cpf']:null), "required" => true, "minimum" => null, "maximum" => 11, 'placeholder' => 'INSIRA O CPF, SOMENTE', 'isdatabase' => true, 'typedata' => 's'),    
        array("type" => "string", 'label' => 'email', 'tag' => 'E-MAIL', 'typeform' => 'text', "value" => (isset($varPost['email'])?$varPost['email']:null), "required" => false, "minimum" => 9, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),    
        array("type" => "bigint", 'label' => 'telephone', 'tag' => 'TELEFONE', 'typeform' => 'number', "value" => (isset($varPost['telephone'])?$varPost['telephone']:null), "required" => false, "minimum" => 10000000, "maximum" => 9999999999999, 'placeholder' => 'INSIRA SOMENTE NÚMEROS.', 'isdatabase' => true, 'typedata' => 's'),           
        array("type" => "list", 'label' => 'secretary', 'tag' => 'SECRETARIA', 'typeform' => 'select', "value" => (isset($varPost['secretary'])?$varPost['secretary']:null), "required" => true, "minimum" => getlistSecretary($link, $mode), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'), 
        array("type" => "list", 'label' => 'area', 'tag' => 'AREA', 'typeform' => 'select', "value" => (isset($varPost['area'])?$varPost['area']:null), "required" => true, "minimum" => getlistArea($link, $mode), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),  
        array("type" => "list", 'label' => 'sector', 'tag' => 'SETOR', 'typeform' => 'select', "value" => (isset($varPost['sector'])?$varPost['sector']:null), "required" => true, "minimum" => getlistSector($link, $mode), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),  
        array("type" => "list", 'label' => 'office', 'tag' => 'CARGO', 'typeform' => 'select', "value" => (isset($varPost['office'])?$varPost['office']:null), "required" => true, "minimum" => getlistOffice($link, $mode), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "list", 'label' => 'function', 'tag' => 'FUNÇÃO', 'typeform' => 'select', "value" => (isset($varPost['function'])?$varPost['function']:null), "required" => false, "minimum" => getlistFunction($link, $mode), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "image", 'label' => 'areaimg', 'tag' => 'BRASÃO DA ÁREA', 'typeform' => 'img', "value" => '', "alt" => 'brasão da area', "required" => false, 'isdatabase' => true), 
       array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),    
     ); 

     return($userReceivedData);    
     
}

function listUserToManage($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE USUARIOS - GERAL', null, manufactureComponentFormTitleButton($linksystem, 'user', 'edit', null, null, 'form', 'btn-title'));
    
    $numberPerPage = (($credentials['Mobile'])?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('','NOME', 'IDENTIFICAÇÃO', 'MATRICULA', 'ESTADO', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('path', 'name', 'nickname', 'registration', 'status');
    $varDataBase=listRegisteredUser($link, $credentials['Mode'], $start, $numberPerPage);
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'user', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredUser($link, $credentials['Mode']), $numberPerPage, 'user', null, $pagenumber, null);

     return($return);

}

