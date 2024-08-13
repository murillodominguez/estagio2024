<?php

require("sql.php");

function listFunction($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE FUNÇÕES CADASTRADAS', null, ((!lockController($link, 'FUNCTION', 'EDIT', null))?manufactureComponentFormTitleButton($linksystem, 'function', 'edit', null, null, 'form', 'btn-title'):NULL));
    $numberPerPage = (($credentials['Mobile']==true)?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('', 'FUNÇÃO', 'ESTADO', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('path', 'name', 'status');
    $varDataBase=listRegisteredFunction($link, $credentials['Mode'], $start, $numberPerPage);
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'function', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredFunction($link, $credentials['Mode']), $numberPerPage, 'function', null, $pagenumber, null);

     return $return;

}


function functionToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode, $ServidorID){

    $tools=array( 
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
    );

    if(authorizedUserAccessMethod('CHECK', searchTheUserAccessPermissionsDatabase($link, 'FUNCTION' , $ServidorID))){ 

       $tools[]=array('type' => 'edit',  'btn' => ((($status=functionStateQuery($link, $idPointer, $mode))=="EDIÇÃO")?'check':'check'),'btn-status' => (($status=='ATIVADO')?'btn-toolbtn':'btn-toolbtn-danger'), 'action' => 'check');
       
    }
  
   
    return $tools;

}

function functionDataPattern($link, $mode, $varPost){

    $userReceivedData= array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'function', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden', 'value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        array("type" => "string", 'label' => 'name', 'tag' => 'NOME DA FUNÇÃO', 'typeform' => 'text',  "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 4, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => 'signature', 'tag' => 'ASSINATURA', 'typeform' => 'signature'),
        array("type" => "image", 'label' => 'areaimg', 'tag' => 'BRASÃO DA ÁREA', 'typeform' => 'img', "alt" => 'brasão da area', "required" => false, 'isdatabase' => true, 'order' => 1, 'edit' => true),
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null)
     );

     return $userReceivedData;    
     
}

