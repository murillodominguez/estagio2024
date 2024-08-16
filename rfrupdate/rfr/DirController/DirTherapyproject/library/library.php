<?php

require("sql.php");

function listTherapyproject($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, $systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE PTS CADASTRADOS', null, manufactureComponentFormTitleButton($linksystem, 'therapyproject', 'edit', null, null, 'form', 'btn-title'));
    
    $numberPerPage = (($credentials['Mobile'])?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('', 'NOME', 'STATUS', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('', 'name', 'status');
    $varDataBase=listRegisteredTherapyproject($link, $credentials['Mode'], $start, $numberPerPage);
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'therapyproject', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredTherapyproject($link, $credentials['Mode']), $numberPerPage, 'therapyproject', null, $pagenumber, null);

     return $return;

}


function therapyprojectToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode){

    $tools=array( 
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
        array('type' => 'pdf',  'btn' => 'print', 'btn-status' => 'btn-toolbtn', 'action' => 'pdf'),
        array('type' => 'edit',  'btn' => ((($status=therapyprojectStateQuery($link, $idPointer, $mode))=="EDIÇÃO")?'check':'check'),'btn-status' => (($status==0)?'btn-toolbtn':'btn-toolbtn'), 'action' => 'check')
    );
   
    return $tools;

}

function therapyprojectDataPattern($link, $mode, $varPost){
    
    $userReceivedData= array(
        //ID
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'therapyproject', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden','value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, "typedata" => "i"),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => ((isset($varPost['id']) and !empty($varPost['id']))?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        
        //1. Dados de Identificação do Usuário:
        array('typeform' => 'subtitle', 'tag' => 'Dados de Identificação do Usuário', 'style' => 'info', 'textstyle' => 'text-center'),
        
        array("type" => "string", 'label' => 'name', 'tag' => 'Nome', 'typeform' => 'text',  "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 1, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'address', 'tag' => 'Endereço', 'typeform' => 'text', 'value' => (isset($varPost['address'])?$varPost['address']:null), "required" => true, "minimum" => 1, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'age', 'tag' => 'Idade', 'typeform' => 'text', 'value' => (isset($varPost['age'])?$varPost['age']:null), "required" => true, "minimum" => 1, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'dateofbirth', 'tag' => 'Data de nascimento', 'typeform' => 'date', "value" => (isset($varPost['dateofbirth'])?$varPost['dateofbirth']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),    
        array("type" => "string", 'label' => 'originservice', 'tag' => 'Serviço de origem', 'typeform' => 'text', "value" => (isset($varPost['originservice'])?$varPost['originservice']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'ubs', 'tag' => 'UBSF ou UBS', 'typeform' => 'text', "value" => (isset($varPost['ubs'])?$varPost['ubs']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'cras', 'tag' => 'CRAS', 'typeform' => 'text', "value" => (isset($varPost['cras'])?$varPost['cras']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        
        array('typeform' => 'subtitle', 'tag' => 'Rede de Referência do Usuário', 'style' => 'info', 'textstyle' => 'text-center'),
        array("type" => "string", 'label' => 'referenceservices', 'tag' => 'Serviços de referência', 'typeform' => 'textarea', "value" => (isset($varPost['referenceservices'])?$varPost['referenceservices']:null), "required" => false, "minimum" => null, "maximum" => 500, 'placeholder' => 'Digite aqui os serviços de referência', 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => 'nettechnicians', 'tag' => 'Técnicos da rede de referência', 'typeform' => 'textarea', "value" => (isset($varPost['nettechnicians'])?$varPost['nettechnicians']:null), "required" => false, "minimum" => null, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => 'referencetechnician', 'tag' => 'Técnico de referência do caso', 'typeform' => 'text', "value" => (isset($varPost['referencetechnician'])?$varPost['referencetechnician']:null), "required" => false, "minimum" => null, "maximum" => 500, 'placeholder' => "Insira aqui o técnico que possui mais vínculo com a pessoa e sua família", 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => 'guardianshipcouncil', 'tag' => 'ILPI', 'typeform' => 'textarea', "value" => (isset($varPost['guardianshipcouncil'])?$varPost['guardianshipcouncil']:null), "required" => false, "minimum" => null, "maximum" => 500, 'placeholder' => "Insira aqui o órgão acolhedor (ILPI) e o nome do responsável na instituição respectivo do idoso", 'isdatabase' => true, 'typedata' => 's'),

        array('typeform' => 'subtitle', 'tag' => 'Foco principal', 'style' => 'info', 'textstyle' => 'text-center'),
        array("type" => "string", 'label' => 'mainfocus', 'tag' => 'Foco principal', 'typeform' => 'textarea', "value" => (isset($varPost['mainfocus'])?$varPost['mainfocus']:null), "required" => false, "minimum" => null, "maximum" => 500, 'placeholder' => "Insira aqui a problemática principal do caso.", 'isdatabase' => true, 'typedata' => 's'),

        array('typeform' => 'subtitle', 'tag' => 'Justificativa', 'style' => 'info', 'textstyle' => 'text-center'),
        array("type" => "string", 'label' => 'justification', 'tag' => 'Justificativa', 'typeform' => 'textarea', "value" => (isset($varPost['justification'])?$varPost['justification']:null), "required" => false, "minimum" => null, "maximum" => 500, 'placeholder' => "A dinâmica familiar do usuário: Insira aqui, de forma cronológica, os acontecimentos de vida importantes do usuário, até o momento, relacionando com o movimento familiar que ocasionou tais acontecimentos. Não se esqueça de incluir datas e locais.\nO movimento na Rede de Atendimento: Insira aqui, de forma cronológica, como o usuário se relaciona com a rede até o momento. Não se esqueça de incluir datas e locais. 
        ", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "text", 'label' => 'carestrategies', 'tag' => 'Estratégias de cuidado', 'typeform' => 'textarea', "value" => (isset($varPost['carestrategies'])?$varPost['carestrategies']:null), "required" => false, "minimum" => null, "maximum" => 500, 'placeholder' => "Insira as ação pactuadas na rede a serem realizadas pelos serviços em atuação no caso. Também inserir uma devolutiva das ações já realizadas.", 'isdatabase' => true, 'typedata' => 's'),

        
        //Save
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),    
    
    );

    return $userReceivedData;    
     
}

