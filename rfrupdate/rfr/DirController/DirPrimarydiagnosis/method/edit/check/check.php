<?php

function check($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage, $datacontrolsystem){
    
    require_once __DIR__.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'sql.php';
    
    if(changeTheStatusOfThePrimarydiagnosis($link,$varPost['id'], ((($status_old=primarydiagnosisStateQuery($link, $varPost['id'], $credentials['Mode']))=='ATIVADO')?'DESATIVADO':'ATIVADO'), $credentials['Mode'])){

        $datacontrolsystem= array('id_source' => $varPost['id'], 'sourcetable' => 'primarydiagnosis', 'mode' => $credentials['Mode'],'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'check', 'id_user' => $credentials['IdServidor'], 'changeddata' => 'status => '.$status_old);
  

        return manufactureComponentAlert('success', 'Alterado com sucesso o estado do Diagnostico!').call_user_func_array('listPrimarydiagnosis'.checksIfTheLastCallWasFromTheManager($link, $controller, $method, $credentials['Login']), array($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem));

    }
    
$systemErrorMessage='Falha na alteração do estado do Diagnostico!';
return manufactureComponentAlert('danger', $systemErrorMessage).call_user_func_array('listPrimarydiagnosis'.checksIfTheLastCallWasFromTheManager($link, $controller, $method, $credentials['Login']), array($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem));

}