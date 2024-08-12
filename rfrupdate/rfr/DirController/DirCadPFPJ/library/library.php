<?php

require("sql.php");

function listPrimarydiagnosis($link, $linksystem, $pagenumber, $filterVar, $forOrder, $orderVar, $credentials, &$systemErrorMessage){

    $return=manufactureComponentPageBodyTitle('LISTA DE DIAGNÓSTICOS CADASTRADOS', null, manufactureComponentFormTitleButton($linksystem, 'primarydiagnosis', 'edit', null, null, 'form', 'btn-title'));
    
    $numberPerPage = (($credentials['Mobile'])?5:10);
    
    $start=(($pagenumber * $numberPerPage ) - $numberPerPage);
    
    if($start<0) $start=0;
    
    $varTableHeader = array ('', 'NOME', 'MATRÍCULA', 'STATUS', 'FERRAMENTA(S)');
    $varLabelDataBase = array ('', 'name', 'matriculafunc', 'status');
    $varDataBase=listRegisteredPrimarydiagnosis($link, $credentials['Mode'], $start, $numberPerPage);
    //$return=$return.manufactureComponentListingDataFilter($link, $linksystem, 'user', 'list' , (($filterVar!=null)?$filterVar:null), (($forOrder!=null)?$forOrder:null), (($orderVar=='ASC')?'ASC':(($orderVar=='DESC')?'DESC':null)));
    $return=$return.manufactureComponentList($link, $linksystem, $varTableHeader, $varLabelDataBase, $varDataBase, 'primarydiagnosis', 'list', 'id', $credentials['IdServidor'], null, $start, $credentials['Mode']);
    $return=$return.manufactureComponentPaginationBar($linksystem, numberOfRegisteredPrimarydiagnosis($link, $credentials['Mode']), $numberPerPage, 'primarydiagnosis', null, $pagenumber, null);

     return($return);

}


function primarydiagnosisToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode){

    $tools=array( 
        array('type' => 'view', 'btn' => 'view', 'btn-status' => 'btn-toolbtn'),
        array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
        array('type' => 'edit',  'btn' => 'print', 'btn-status' => 'btn-toolbtn', 'action' => 'pdf'),
        array('type' => 'edit',  'btn' => ((($status=primarydiagnosisStateQuery($link, $idPointer, $mode))=="EDIÇÃO")?'check':'check'),'btn-status' => (($status==0)?'btn-toolbtn':'btn-toolbtn-danger'), 'action' => 'check')
    );
   
    return($tools);

}

function primarydiagnosisDataPattern($link, $mode, $varPost){

    $userReceivedData= array(
        //ID
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => '', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden','value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, "typedata" => "i"),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => ((isset($varPost['id']) and !empty($varPost['id']))?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        
        //DADOS DA SOCIEDADE
        array('typeform' => 'subtitle', 'tag' => 'DADOS DA SOCIEDADE', 'style' => 'info'),

        array("type" => "string", 'label' => 'corporatename', 'tag' => 'Razão Social*', 'typeform' => 'text', "value" => (isset($varPost['corporatename'])?$varPost['corporatename']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "cnpj", 'label' => 'cnpj', 'tag' => 'CNPJ*', 'typeform' => 'text',  "value" => (isset($varPost['cnpj'])?$varPost['cnpj']:null), "required" => true, "minimum" => 0, "maximum" => 14, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'quantfunc', 'tag' => 'Quant. Funcionários*', 'typeform' => 'number',  "value" => (isset($varPost['quantfunc'])?$varPost['quantfunc']:null), "required" => true, "minimum" => 0, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),
        array("type" => "string", 'label' => 'mainactivity', 'tag' => 'Atividade Principal*', 'typeform' => 'text', "value" => (isset($varPost['mainactivity'])?$varPost['mainactivity']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'tributationtype', 'tag' => 'Tipo de Tributação*', 'typeform' => 'text', "value" => (isset($varPost['tributationtype'])?$varPost['tributationtype']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "date", 'label' => 'constitutiondate', 'tag' => 'Data de Constituição*', 'typeform' => 'date', "value" => (isset($varPost['constitutiondate'])?$varPost['constitutiondate']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "list", 'label' => 'import', 'tag' => 'Importa*', 'typeform' => 'select', "value" => (isset($varPost['import'])?$varPost['import']:null), "required" => true, "minimum" => array(array('name' => 'SIM'), array('name' => 'NAO')), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "list", 'label' => 'export', 'tag' => 'Exporta*', 'typeform' => 'select', "value" => (isset($varPost['export'])?$varPost['export']:null), "required" => true, "minimum" => array(array('name' => 'SIM'), array('name' => 'NAO')), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "list", 'label' => 'subsidiary', 'tag' => 'Possui Filiais*', 'typeform' => 'select', "value" => (isset($varPost['subsidiary'])?$varPost['subsidiary']:null), "required" => true, "minimum" => array(array('name' => 'SIM'), array('name' => 'NAO')), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "list", 'label' => 'familyadmin', 'tag' => 'Administração Familiar*', 'typeform' => 'select', "value" => (isset($varPost['familyadmin'])?$varPost['familyadmin']:null), "required" => true, "minimum" => array(array('name' => 'SIM'), array('name' => 'NAO')), "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'annualbilling', 'tag' => 'Faturamento Anual*', 'typeform' => 'number',  "value" => (isset($varPost['annualbilling'])?$varPost['annualbilling']:null), "required" => true, "minimum" => 0, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'socialcapital', 'tag' => 'Capital Social*', 'typeform' => 'number',  "value" => (isset($varPost['socialcapital'])?$varPost['socialcapital']:null), "required" => true, "minimum" => 0, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'networth', 'tag' => 'Patrimônio Líquido*', 'typeform' => 'number',  "value" => (isset($varPost['networth'])?$varPost['networth']:null), "required" => true, "minimum" => 0, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),

        //DADOS DO REPRESENTANTE LEGAL
        array('typeform' => 'subtitle', 'tag' => 'DADOS DO REPRESENTANTE LEGAL', 'style' => 'info'),

        array("type" => "string", 'label' => 'legalrepname', 'tag' => 'Nome Completo*', 'typeform' => 'text', "value" => (isset($varPost['legalrepname'])?$varPost['legalrepname']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "legalrepcpf", 'label' => 'cpf', 'tag' => 'CPF*', 'typeform' => 'text',  "value" => (isset($varPost['legalrepcpf'])?$varPost['legalrepcpf']:null), "required" => true, "minimum" => 11, "maximum" => 11, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'legalrepoffice', 'tag' => 'Cargo*', 'typeform' => 'text', "value" => (isset($varPost['legalrepoffice'])?$varPost['legalrepoffice']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'legalrepcontact', 'tag' => 'Contato*', 'typeform' => 'text', "value" => (isset($varPost['legalrepcontact'])?$varPost['legalrepcontact']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        //ENDEREÇO SOCIEDADE/CONTATOS
        array('typeform' => 'subtitle', 'tag' => 'ENDEREÇO SOCIEDADE/CONTATOS', 'style' => 'info'),
        
        array("type" => "string", 'label' => 'street', 'tag' => 'Logradouro*', 'typeform' => 'text', "value" => (isset($varPost['street'])?$varPost['street']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'addressnumber', 'tag' => 'Número*', 'typeform' => 'number', "value" => (isset($varPost['addressnumber'])?$varPost['addressnumber']:null), "required" => true, "minimum" => 1, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'complement', 'tag' => 'Complemento*', 'typeform' => 'text', "value" => (isset($varPost['complement'])?$varPost['complement']:null), "required" => true, "minimum" => 1, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'neighborhood', 'tag' => 'Bairro*', 'typeform' => 'text', "value" => (isset($varPost['neighborhood'])?$varPost['neighborhood']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'city', 'tag' => 'Cidade*', 'typeform' => 'text', "value" => (isset($varPost['city'])?$varPost['city']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'uf', 'tag' => 'UF*', 'typeform' => 'text', "value" => (isset($varPost['uf'])?$varPost['uf']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'cep', 'tag' => 'CEP*', 'typeform' => 'text', "value" => (isset($varPost['cep'])?$varPost['cep']:null), "required" => true, "minimum" => 8, "maximum" => 8, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "number", 'label' => 'dddandtelephone', 'tag' => 'DDD + Telefone*', 'typeform' => 'number', "value" => (isset($varPost['dddandtelephone'])?$varPost['dddandtelephone']:null), "required" => true, "minimum" => 5, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "number", 'label' => 'dddandcellphone', 'tag' => 'DDD + Celular', 'typeform' => 'number', "value" => (isset($varPost['dddandcellphone'])?$varPost['dddandcellphone']:null), "required" => false, "minimum" => 5, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "number", 'label' => 'dddandfax', 'tag' => 'DDD + Fax', 'typeform' => 'number', "value" => (isset($varPost['dddandfax'])?$varPost['dddandfax']:null), "required" => false, "minimum" => 5, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "email", 'label' => 'email', 'tag' => 'E-mail Principal da Sociedade*', 'typeform' => 'text', "value" => (isset($varPost['email'])?$varPost['email']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'contact', 'tag' => 'E-mail Principal da Sociedade*', 'typeform' => 'text', "value" => (isset($varPost['contact'])?$varPost['contact']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        //COMPOSIÇÃO DO CAPITAL SOCIAL
        array('typeform' => 'subtitle', 'tag' => 'COMPOSIÇÃO DO CAPITAL SOCIAL', 'style' => 'info'),
        
        array("type" => "string", 'label' => 'shareholder', 'tag' => 'Acionistas', 'typeform' => 'textarea', "value" => (isset($varPost['shareholder'])?$varPost['shareholder']:null), "required" => true, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'shareholdercpfcnpj', 'tag' => 'CPF/CNPJ', 'typeform' => 'textarea', "value" => (isset($varPost['shareholdercpfcnpj'])?$varPost['shareholdercpfcnpj']:null), "required" => true, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'socialcapitalpercentage', 'tag' => '% do Capital Social', 'typeform' => 'number', "value" => (isset($varPost['socialcapitalpercentage'])?$varPost['socialcapitalpercentage']:null), "required" => true, "minimum" => 0, "maximum" => 99999999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),

        //PRINCIPAIS CLIENTES
        array('typeform' => 'subtitle', 'tag' => 'PRINCIPAIS CLIENTES', 'style' => 'info'),
        
        array("type" => "string", 'label' => 'clientname', 'tag' => 'Nome do Cliente', 'typeform' => 'textarea', "value" => (isset($varPost['clientname'])?$varPost['clientname']:null), "required" => true, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'clientcpfcnpj', 'tag' => 'CPF/CNPJ', 'typeform' => 'textarea', "value" => (isset($varPost['clientcpfcnpj'])?$varPost['clientcpfcnpj']:null), "required" => true, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'clienttelephone', 'tag' => 'Telefone', 'typeform' => 'textarea', "value" => (isset($varPost['clienttelephone'])?$varPost['clienttelephone']:null), "required" => true, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        //PRINCIPAIS FORNECEDORES
        array('typeform' => 'subtitle', 'tag' => 'PRINCIPAIS FORNECEDORES', 'style' => 'info'),
        
        array("type" => "string", 'label' => 'suppliername', 'tag' => 'Nome do Fornecedor', 'typeform' => 'textarea', "value" => (isset($varPost['suppliername'])?$varPost['suppliername']:null), "required" => true, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'suppliercpfcnpj', 'tag' => 'CPF/CNPJ', 'typeform' => 'textarea', "value" => (isset($varPost['suppliercpfcnpj'])?$varPost['suppliercpfcnpj']:null), "required" => true, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'suppliertelephone', 'tag' => 'Telefone', 'typeform' => 'textarea', "value" => (isset($varPost['suppliertelephone'])?$varPost['suppliertelephone']:null), "required" => true, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        //DADOS BANCÁRIOS PARA O CRÉDITO
        array('typeform' => 'subtitle', 'tag' => 'DADOS BANCÁRIOS PARA O CRÉDITO', 'style' => 'info'),
        
        array("type" => "string", 'label' => 'bank', 'tag' => 'Banco*', 'typeform' => 'text', "value" => (isset($varPost['bank'])?$varPost['bank']:null), "required" => true, "minimum" => 1, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'agency', 'tag' => 'Agência*', 'typeform' => 'text', "value" => (isset($varPost['agency'])?$varPost['agency']:null), "required" => true, "minimum" => 1, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'account', 'tag' => 'Conta*', 'typeform' => 'text', "value" => (isset($varPost['account'])?$varPost['account']:null), "required" => true, "minimum" => 1, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        //Save
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null)
    );

     return($userReceivedData);    
     
}
function primarydiagnosisDataPattern1($link, $mode, $varPost){
    
    $userReceivedData= array(
        //ID
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => '', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden','value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),

        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, "typedata" => "i"),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => ((isset($varPost['id']) and !empty($varPost['id']))?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        
        //DADOS PESSOAIS
        array('typeform' => 'subtitle', 'tag' => 'DADOS PESSOAIS', 'style' => 'info'),

        array("type" => "string", 'label' => 'name', 'tag' => 'Nome Completo*', 'typeform' => 'text', "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "date", 'label' => 'dateofbirth', 'tag' => 'Data de Nascimento*', 'typeform' => 'date', "value" => (isset($varPost['dateofbirth'])?$varPost['dateofbirth']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'), 
        array("type" => "cpf", 'label' => 'cpf', 'tag' => 'CPF*', 'typeform' => 'text',  "value" => (isset($varPost['cpf'])?$varPost['cpf']:null), "required" => true, "minimum" => 11, "maximum" => 11, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'rg', 'tag' => 'Identidade n°*', 'typeform' => 'text', "value" => (isset($varPost['rg'])?$varPost['rg']:null), "required" => true, "minimum" => 1, "maximum" => 10, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'issuedrg', 'tag' => 'Emissor*', 'typeform' => 'text', "value" => (isset($varPost['issuedrg'])?$varPost['issuedrg']:null), "required" => true, "minimum" => 1, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "date", 'label' => 'dateofissuerg', 'tag' => 'Data de Emissão*', 'typeform' => 'date', "value" => (isset($varPost['dateofissuerg'])?$varPost['dateofissuerg']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'), 
        array("type" => "string", 'label' => 'gender', 'tag' => 'Sexo*', 'typeform' => 'text', "value" => (isset($varPost['gender'])?$varPost['gender']:null), "required" => false, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'scholarity', 'tag' => 'Escolaridade*', 'typeform' => 'text', "value" => (isset($varPost['scholarity'])?$varPost['scholarity']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'fathername', 'tag' => 'Nome do Pai*', 'typeform' => 'text', "value" => (isset($varPost['fathername'])?$varPost['fathername']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'mothername', 'tag' => 'Nome da Mãe*', 'typeform' => 'text', "value" => (isset($varPost['mothername'])?$varPost['mothername']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'nationality', 'tag' => 'Nacionalidade*', 'typeform' => 'text', "value" => (isset($varPost['nationality'])?$varPost['nationality']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'placeofbirth', 'tag' => 'Naturalidade (Cidade/UF)*', 'typeform' => 'text', "value" => (isset($varPost['placeofbirth'])?$varPost['placeofbirth']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'profession', 'tag' => 'Profissão*', 'typeform' => 'text', "value" => (isset($varPost['profession'])?$varPost['profession']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'maritalstatus', 'tag' => 'Estado Civil*', 'typeform' => 'text', "value" => (isset($varPost['maritalstatus'])?$varPost['maritalstatus']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        //SITUAÇÃO PATRIMONIAL
        array('typeform' => "subtitle", 'tag' => 'SITUAÇÃO PATRIMONIAL', 'style' => 'info'),
       
        array("type" => "string", 'label' => 'patrimony', 'tag' => 'Patrimônio', 'typeform' => 'text', "value" => (isset($varPost['patrimony'])?$varPost['patrimony']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'patrimonyvalue', 'tag' => 'Valor', 'typeform' => 'number', "value" => (isset($varPost['patrimonyvalue'])?$varPost['patrimonyvalue']:null), "required" => true, "minimum" => 0, "maximum" => 99999999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'patrimonyfree', 'tag' => 'Livre', 'typeform' => 'number', "value" => (isset($varPost['patrimonyfree'])?$varPost['patrimonyfree']:null), "required" => true, "minimum" => 0, "maximum" => 99999999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'patrimonydebtorbalance', 'tag' => 'Saldo Devedor', 'typeform' => 'number', "value" => (isset($varPost['patrimonydebtorbalance'])?$varPost['patrimonydebtorbalance']:null), "required" => true, "minimum" => 0, "maximum" => 99999999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),

        //REFERÊNCIA PESSOAL
        array('typeform' => "subtitle", 'tag' => 'REFERÊNCIA PESSOAL', 'style' => 'info'),

        array("type" => "string", 'label' => 'name', 'tag' => 'Nome Completo*', 'typeform' => 'text', "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'name', 'tag' => 'Telefone*', 'typeform' => 'text', "value" => (isset($varPost['telephone'])?$varPost['telephone']:null), "required" => true, "minimum" => 5, "maximum" => 9999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        //DADOS DO CÔNJUGE
        array('typeform' => "subtitle", 'tag' => 'DADOS DO CÔNJUGE/COMPANHEIRO(A)', 'style' => 'info'),

        array("type" => "string", 'label' => 'partnername', 'tag' => 'Nome Completo*', 'typeform' => 'text', "value" => (isset($varPost['partnername'])?$varPost['partnername']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnerdateofbirth', 'tag' => 'Data de Nascimento*', 'typeform' => 'date', "value" => (isset($varPost['partnerdateofbirth'])?$varPost['partnerdateofbirth']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'), 
        array("type" => "cpf", 'label' => 'cpf', 'tag' => 'CPF*', 'typeform' => 'text',  "value" => (isset($varPost['cpf'])?$varPost['cpf']:null), "required" => true, "minimum" => 11, "maximum" => 11, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnerrg', 'tag' => 'Identidade n°*', 'typeform' => 'text', "value" => (isset($varPost['partnerrg'])?$varPost['partnerrg']:null), "required" => true, "minimum" => 1, "maximum" => 10, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnerissuedrg', 'tag' => 'Emissor*', 'typeform' => 'text', "value" => (isset($varPost['partnerissuedrg'])?$varPost['partnerissuedrg']:null), "required" => true, "minimum" => 1, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnerdateofissuerg', 'tag' => 'Data de Emissão*', 'typeform' => 'date', "value" => (isset($varPost['partnerdateofissuerg'])?$varPost['partnerdateofissuerg']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'), 
        array("type" => "string", 'label' => 'partnergender', 'tag' => 'Sexo*', 'typeform' => 'text', "value" => (isset($varPost['partnergender'])?$varPost['partnergender']:null), "required" => false, "minimum" => 5, "maximum" => 500, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnerscholarity', 'tag' => 'Escolaridade*', 'typeform' => 'text', "value" => (isset($varPost['partnerscholarity'])?$varPost['partnerscholarity']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnerprofession', 'tag' => 'Profissão*', 'typeform' => 'text', "value" => (isset($varPost['partnerprofession'])?$varPost['partnerprofession']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnerfathername', 'tag' => 'Nome do Pai*', 'typeform' => 'text', "value" => (isset($varPost['partnerfathername'])?$varPost['partnerfathername']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnermothername', 'tag' => 'Nome da Mãe*', 'typeform' => 'text', "value" => (isset($varPost['partnermothername'])?$varPost['partnermothername']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnernationality', 'tag' => 'Nacionalidade*', 'typeform' => 'text', "value" => (isset($varPost['partnernationality'])?$varPost['partnernationality']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'partnerplaceofbirth', 'tag' => 'Naturalidade (Cidade/UF)*', 'typeform' => 'text', "value" => (isset($varPost['partnerplaceofbirth'])?$varPost['partnerplaceofbirth']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        //ENDEREÇO RESIDENCIAL
        array('typeform' => "subtitle", 'tag' => 'ENDEREÇO RESIDENCIAL', 'style' => 'info'),

        array("type" => "string", 'label' => 'street', 'tag' => 'Logradouro*', 'typeform' => 'text', "value" => (isset($varPost['street'])?$varPost['street']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'addressnumber', 'tag' => 'Número*', 'typeform' => 'number', "value" => (isset($varPost['addressnumber'])?$varPost['addressnumber']:null), "required" => true, "minimum" => 1, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'complement', 'tag' => 'Complemento*', 'typeform' => 'text', "value" => (isset($varPost['complement'])?$varPost['complement']:null), "required" => true, "minimum" => 1, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'neighborhood', 'tag' => 'Bairro*', 'typeform' => 'text', "value" => (isset($varPost['neighborhood'])?$varPost['neighborhood']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'city', 'tag' => 'Cidade*', 'typeform' => 'text', "value" => (isset($varPost['city'])?$varPost['city']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'uf', 'tag' => 'UF*', 'typeform' => 'text', "value" => (isset($varPost['uf'])?$varPost['uf']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'cep', 'tag' => 'CEP*', 'typeform' => 'text', "value" => (isset($varPost['cep'])?$varPost['cep']:null), "required" => true, "minimum" => 8, "maximum" => 8, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "number", 'label' => 'dddandtelephone', 'tag' => 'DDD + Telefone*', 'typeform' => 'number', "value" => (isset($varPost['dddandtelephone'])?$varPost['dddandtelephone']:null), "required" => true, "minimum" => 5, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "number", 'label' => 'dddandcellphone', 'tag' => 'DDD + Celular', 'typeform' => 'number', "value" => (isset($varPost['dddandcellphone'])?$varPost['dddandcellphone']:null), "required" => false, "minimum" => 5, "maximum" => 999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "email", 'label' => 'email', 'tag' => 'E-mail*', 'typeform' => 'text', "value" => (isset($varPost['email'])?$varPost['email']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "string", 'label' => 'timeresident', 'tag' => 'Tempo na residência atual', 'typeform' => 'text', "value" => (isset($varPost['timeresident'])?$varPost['timeresident']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),

        array('typeform' => "subtitle", 'tag' => 'PARTICIPAÇÃO SOCIETÁRIA', 'style' => 'info'),

        array("type" => "string", 'label' => 'societyname', 'tag' => 'Nome da(s) Sociedade(s)', 'typeform' => 'text', "value" => (isset($varPost['societyname'])?$varPost['societyname']:null), "required" => true, "minimum" => 5, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'cnpj', 'tag' => 'Valor', 'typeform' => 'number', "value" => (isset($varPost['cnpj'])?$varPost['cnpj']:null), "required" => true, "minimum" => 0, "maximum" => 99999999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),
        array("type" => "integer", 'label' => 'capitalpercentage', 'tag' => '% do Capital', 'typeform' => 'number', "value" => (isset($varPost['capitalpercentage'])?$varPost['capitalpercentage']:null), "required" => true, "minimum" => 0, "maximum" => 99999999999999999, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i', 'style' => 'danger'),

        //Save
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null)
    );

     return($userReceivedData);    
     
}

