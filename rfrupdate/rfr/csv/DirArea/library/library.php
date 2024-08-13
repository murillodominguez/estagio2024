<?php

require("sql.php");
function listArea($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $numberPerPage = (($credentials['Mobile'])?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    if($start<0) $start=0;
    $varDataBase=listRegisteredArea($link, $credentials['Mode'], $start, $numberPerPage);
    var_dump($varDataBase);
    $return=manufactureComponentPageBodyTitle('LISTA DE AREAS CADASTRADAS', null, manufactureComponentFormTitleButton($linksystem, 'area', 'edit', null, null, 'form', 'btn-title'), manufactureComponentButtonDownloadCsv($link, $linksystem, 'area', areaCsvListPattern($link, $credentials['Mode'], $varDataBase)));

    $varTableHeader = array ('', 'Area', 'ABREVIAÇÃO', 'SECRETARIA', 'ESTADO', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('path', 'name', 'nickname', 'secretary', 'status');
    // $return.= manufactureComponentButtonDownloadCsv($link, $linksystem, 'area', areaCsvListPattern($link, $credentials['Mode'], $varDataBase));
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'area', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredArea($link, $credentials['Mode']), $numberPerPage, 'area', null, $pagenumber, null);

     return $return;

}

function areaCsvListPattern($link, $mode, $varDataBase){
    $varTableLabel = array('LISTA DE AREAS CADASTRADAS');
    $varTableHeader = array('Area', 'Abreviaçao', 'Secretaria', 'Estado');
    $varLabelDataBase = array('name','nickname','secretary','status');
    $varTableFooter = array('EXPORTADO EM '.date("d/m/Y")." ÀS ".date("H:i"));
    $file = csvList($varTableLabel, $varTableHeader, $varLabelDataBase, $varTableFooter, $varDataBase, ';', 'area.csv', 'area');

    return $file;
}
function areaToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode){

    $tools=array( 
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
        array('type' => 'edit',  'btn' => 'print', 'btn-status' => 'btn-toolbtn', 'action' => 'pdf'),
        array('type' => 'edit',  'btn' => ((($status=areaStateQuery($link, $idPointer, $mode))=="EDIÇÃO")?'check':'check'),'btn-status' => (($status==0)?'btn-toolbtn':'btn-toolbtn-danger'), 'action' => 'check'),
        array('type' => 'edit',  'btn' => 'image', 'btn-status' => 'btn-toolbtn', 'action' => 'image', 'hidden' => isAllImageSetArea($link, $idPointer, $mode, 4))
    );
    echo '<br><br>';
    var_dump(isAllImageSetArea($link, $idPointer, $mode, 4));
    echo '<br><br>';
    return $tools;

}

function areaDataPattern($link, $mode, $varPost){
    $userReceivedData= array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'area', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden', 'value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        //INSERT INTO `area`(mode,status,name,nickname,secretary) VALUES ('STANDARD', 'ATIVADO','Murillo','ma','SECRETARIA DE MUNICIPIO DE CIDADANIA E AÇÃO SOCIAL');
        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => ((isset($varPost['id']) and !empty($varPost['id']))?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => false),
        array("type" => "string", 'label' => 'name', 'tag' => 'NOME (COMPLETO)', 'typeform' => 'text',  "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => 'nickname', 'tag' => 'NOME (ABREVIADO)', 'typeform' => 'text', "value" => (isset($varPost['nickname'])?$varPost['nickname']:null), "required" => true, "minimum" => 2, "maximum" => 50, 'placeholder' => null, 'style'=> 'danger', 'isdatabase' => true, 'typedata' => 's'),    
        array("type" => "list", 'label' => 'secretary', 'tag' => 'SECRETARIA', 'typeform' => 'select', "value" => (isset($varPost['secretary'])?$varPost['secretary']:null), "required" => true, "minimum" => getlistSecretary($link, $mode), "maximum" => 50, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "image", 'label' => 'areaimg1', 'tag' => 'BRASÃO DA ÁREA', 'typeform' => 'img', "value" => ((getDataAreaImage($link, $varPost['id'], $mode, 1) != null)?getDataAreaImage($link, $varPost['id'], $mode, 1):null), "alt" => 'brasão da area', "expirationupld" => "", "required" => false, 'isdatabase' => true, 'order' => 1, 'edit' => true),
        array("type" => "image", 'label' => 'areaimg2', 'tag' => 'IMAGEM ÁREA', 'typeform' => 'img', "value" => ((getDataAreaImage($link, $varPost['id'], $mode, 2) != null)?getDataAreaImage($link, $varPost['id'], $mode, 2):null), "alt" => 'brasão da area', "expirationupld" => "", "required" => false, 'isdatabase' => true, 'order' => 2, 'edit' => true),
        array("type" => "image", 'label' => 'areaimg3', 'tag' => 'IMAGEM ÁREA', 'typeform' => 'img', "value" => ((getDataAreaImage($link, $varPost['id'], $mode, 3) != null)?getDataAreaImage($link, $varPost['id'], $mode, 3):null), "alt" => 'brasão da area', "expirationupld" => "", "required" => false, 'isdatabase' => true, 'order' => 3, 'edit' => true),
        array("type" => "image", 'label' => 'areaimg4', 'tag' => 'IMAGEM ÁREA', 'typeform' => 'img', "value" => ((getDataAreaImage($link, $varPost['id'], $mode, 4) != null)?getDataAreaImage($link, $varPost['id'], $mode, 4):null), "alt" => 'brasão da area', "expirationupld" => "", "required" => false, 'isdatabase' => true, 'order' => 4, 'edit' => true),
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => false)
     );
     if(isset($varPost)){
     var_dump ($varPost);
     }
     if(isset($_FILES['areaimg'])){
     var_dump($_FILES['areaimg']);
     echo '<br><br>';
     }
     return $userReceivedData;
}

function areaImageDataPattern($link, $mode, $varPost){
    $userReceivedData = array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'image', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden', 'value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),

        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => 'updateimage', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => false),
        array("type" => "image", 'label' => 'areaimg1', 'tag' => 'BRASÃO DA ÁREA', 'typeform' => 'img', "value" => ((getDataAreaImage($link, $varPost['id'], $mode, 1) != null)?getDataAreaImage($link, $varPost['id'], $mode, 1):null), "alt" => 'brasão da area', "expirationupld" => "", "required" => false, 'isdatabase' => true, 'order' => 1),
        array("type" => "image", 'label' => 'areaimg2', 'tag' => 'IMAGEM ÁREA', 'typeform' => 'img', "value" => ((getDataAreaImage($link, $varPost['id'], $mode, 2) != null)?getDataAreaImage($link, $varPost['id'], $mode, 2):null), "alt" => 'brasão da area', "expirationupld" => "", "required" => false, 'isdatabase' => true, 'order' => 2),
        array("type" => "image", 'label' => 'areaimg3', 'tag' => 'IMAGEM ÁREA', 'typeform' => 'img', "value" => ((getDataAreaImage($link, $varPost['id'], $mode, 3) != null)?getDataAreaImage($link, $varPost['id'], $mode, 3):null), "alt" => 'brasão da area', "expirationupld" => "", "required" => false, 'isdatabase' => true, 'order' => 3),
        array("type" => "image", 'label' => 'areaimg4', 'tag' => 'IMAGEM ÁREA', 'typeform' => 'img', "value" => ((getDataAreaImage($link, $varPost['id'], $mode, 4) != null)?getDataAreaImage($link, $varPost['id'], $mode, 4):null), "alt" => 'brasão da area', "expirationupld" => "", "required" => false, 'isdatabase' => true, 'order' => 4),

        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => false)
    );
    return $userReceivedData;
}
