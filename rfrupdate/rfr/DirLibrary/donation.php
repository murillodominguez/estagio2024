<?PHP

function operationmenu($link, $linksystem, $credentials){

   
    $return=manufactureComponentPageBodyTitle('CADASTRO DE DOAÇÕES, NÃO REGISTRADAS', null, ((confirmAccessAuthorization($link, 'donation', 'edit', $credentials['IdServidor'])>0)?((!lockController($link, 'donation', 'edit', null))?manufactureComponentFormTitleButton($linksystem, 'donation', 'edit', null, null, 'form', 'btn-title'):NULL):null));
    $return=$return.manufactureComponentPageBodyTitle('CADASTROS DE DOAÇÕES,  REGISTRADAS', null, ((confirmAccessAuthorization($link, 'registereddonation', 'edit', $credentials['IdServidor'])>0)?((!lockController($link, 'registereddonation', 'edit', null))?manufactureComponentFormTitleButton($linksystem, 'registereddonation', 'edit', null, null, 'form', 'btn-title'):NULL):null));
           

    return $return;

}

function beneficiesDataPattern($link, $mode, $varPost){

    $userReceivedData= array(
         array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null),
         array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
         array("type" => "string", 'label' => 'latitude', 'tag' => 'Latitude:', 'typeform' => 'hidden', "value" => (isset($varPost['latitude'])?$varPost['latitude']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
         array("type" => "string", 'label' => 'longitude', 'tag' => 'Longitude:', 'typeform' => 'hidden', "value" => (isset($varPost['longitude'])?$varPost['longitude']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
         array("type" => "integer", 'label' => 'accuracy', 'tag' => 'Precisão:', 'typeform' => 'hidden', "value" => (isset($varPost['accuracy'])?round($varPost['accuracy']):null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
         array("type" => "string", 'label' => 'name', 'tag' => 'NOME (COMPLETO):', 'typeform' => 'text',  "value" => (isset($varPost['name'])?$varPost['name']:null), "required" => true, "minimum" => 4, "maximum" => 200, 'placeholder' => null),
         array("type" => "cpf", 'label' => 'cpf', 'tag' => 'CPF:', 'typeform' => 'cpf', "value" => (isset($varPost['cpf'])?$varPost['cpf']:null), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => 'INSIRA O CPF, SOMENTE NÚMEROS'), 
         array("type" => "string", 'label' => 'nis', 'tag' => 'NIS:', 'typeform' => 'number',  "value" => (isset($varPost['nis'])?$varPost['nis']:null), "required" => null, "minimum" => null, "maximum" => 99999999999, 'placeholder' => 'INSIRA O NIS, SOMENTE NÚMEROS'), 
         array("type" => "list", 'label' => 'gender', 'tag' => 'SEXO:', 'typeform' => 'select', "value" => (isset($varPost['gender'])?$varPost['gender']:null), "required" => true, "minimum" => array(array('name' => 'FEMININO'), array('name' => 'MASCULINO')), "maximum" => 200, 'placeholder' => null), 
         array("type" => "integer", 'label' => 'dependentquantity', 'tag' => 'Nº DE DEPENDENTES:', 'typeform' => 'number',  "value" => (isset($varPost['dependentquantity'])?$varPost['dependentquantity']:null), "required" => true, "minimum" => 1, "maximum" => 20, 'placeholder' => null),
         array("type" => "list", 'label' => 'publicplace', 'tag' => 'LOGRADOURO:', 'typeform' => 'select', "value" => (isset($varPost['publicplace'])?$varPost['publicplace']:null), "required" => true, "minimum" => getlistPublicplace($link, $mode), "maximum" => 200, 'placeholder' => 'SELECIONE O NOME DO LOGRADOURO'), 
         array("type" => "integer", 'label' => 'number', 'tag' => 'NÚMERO:', 'typeform' => 'number',  "value" => (isset($varPost['number'])?$varPost['number']:null), "required" => null, "minimum" => 1, "maximum" => 5000, 'placeholder' => null),
         array("type" => "string", 'label' => 'complement', 'tag' => 'COMPLEMENTO:', 'typeform' => 'text',  "value" => (isset($varPost['complement'])?$varPost['complement']:null), "required" => null, "minimum" => null, "maximum" => 200, 'placeholder' => 'INFORME AQUI O COMPLEMENTO DO ENDEREÇO. EXEMPLO: CASA A OU BLOCO E APT 201'),
         array("type" => "list", 'label' => 'district', 'tag' => 'BAIRRO:', 'typeform' => 'select', "value" => (isset($varPost['district'])?$varPost['district']:null), "required" => true, "minimum" => getlistDistrict($link, $mode), "maximum" => 200, 'placeholder' => 'SELECIONE O NOME DO BAIRRO OU VILA'), 
         array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),    
      ); 
 
      return $userReceivedData;    
      
 }

 
function insertsqlbeneficies($link, $linksystem, $varSql, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){

    if($varSql['nis']==''){
        $varSql['nis'] = null;
    }

    if($varSql['number']==''){
        $varSql['number'] = null;
    }

    if($varSql['complement']==''){
        $varSql['complement'] = null;
    }
    
    $sql="INSERT INTO `beneficies`(`name`, `cpf`, `nis`, `publicplace`, `number`, `complement`, `district`, `dependentquantity`, `gender`, latitude, longitude, accuracy, `mode`) VALUES (?,?,?,?, ?, ?, ?,?, ?,?,?,?, ?)";
    $stmt = $link->prepare($sql);
	$stmt->bind_Param('ssssississsis', $varSql['name'],$varSql['cpf'], $varSql['nis'], $varSql['publicplace'], $varSql['number'], $varSql['complement'], $varSql['district'],$varSql['dependentquantity'], $varSql['gender'],$varSql['latitude'],$varSql['longitude'],$varSql['accuracy'],$credentials['Mode']);
    $stmt->execute();

    return ($stmt->affected_rows >0)?true:false;    
    
}


function getIDbeneficies($link, $varSql){

    $sql="select id from beneficies where name=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_Param('s', $varSql['name']);
	$stmt->execute();
	$result = $stmt->get_result();
    
    if($result->num_rows>0){                
    
        $row=$result->fetch_assoc();
        return $row['id'];
    
    }

    return 0;

}

 
