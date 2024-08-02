<?php

function check($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage, &$datacontrolsystem){
    
    require_once(__DIR__.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'sql.php');
      
    $data=getUserDataBase($link, $varPost['id']);

    if($data['registration']!=null and $data['registration']!='') $base=$data['registration'];

    if($data['registration']==null or $data['registration']=='') $base=$data['cpf'];

    if(resetpassword($link, $base, $dayoftheToday)){
   
        $datacontrolsystem= array('id_source' => $varPost['id'], 'sourcetable' => 'password', 'mode' => $credentials['Mode'],'currentTime' => $dayoftheToday." ".$nowTime, 'actionperformed' => 'check', 'id_user' => $credentials['IdServidor'], 'changeddata' => 'password => reset, login =>'.$base);
  

        return(manufactureComponentAlert('success', 'Resetado com sucesso a senha!').listUser($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem));

    }
    
$systemErrorMessage='Falha no reset da senha!';
return(manufactureComponentAlert('danger', $systemErrorMessage).listUser($link, $linksystem, ((isset($varPost['pagina'])and(!empty($pagina=filteringVar($varPost['pagina'], 'integer'))))?$pagina:0), (isset($varPost['filterVar'])?filteringVar($varPost['filterVar'], 'string'):null), (isset($varPost['forOrder'])?filteringVar($varPost['forOrder'], 'string'):null) , (isset($varPost['orderVar'])?filteringVar($varPost['orderVar'], 'string'):null), $credentials, $systemErrorMessage, $datacontrolsystem));

}