<?php

require("sql.php");


function profileToolbarlist($link, $UserFunctionalLevel, $idPointer, $mode){

    $tools=array( 
          array('type' => 'edit',  'btn' => 'edit', 'btn-status' => 'btn-toolbtn', 'action' => 'form'),
      );
   
    return $tools;

}

function profileDataPattern($link, $mode, $varPost){
    
    $userReceivedData= array(
        array("type" => 'string', 'label' => 'table', 'typeform' => 'hidden', 'value' => 'user', 'isdatabase' => false),
        array("type" => "string", 'label' => "mode", 'typeform' => 'hidden','value' => $mode, 'isdatabase' => true, 'typedata' => 's'),
        array("type" => "string", 'label' => "status", 'typeform' => 'hidden', 'value' => "ATIVADO", 'isdatabase' => true, 'typedata' => 's'),
        
        array("type" => "integer", 'label' => 'id', 'tag' => 'ID', 'typeform' => 'hidden', "value" => (isset($varPost['id'])?$varPost['id']:null), "required" => NULL, "minimum" => null, "maximum" => null, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 'i'),
        array("type" => "string", 'label' => 'typeaction', 'tag' => 'Typeaction', 'typeform' => 'hidden', "value" => ((isset($varPost['id']) and !empty($varPost['id']))?'update':'insert'), "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),
        array("type" => "email", 'label' => 'email', 'tag' => 'E-MAIL', 'typeform' => 'text', "value" => (isset($varPost['email'])?$varPost['email']:null), "required" => false, "minimum" => 9, "maximum" => 200, 'placeholder' => null, 'isdatabase' => true, 'typedata' => 's'),    
        array("type" => "bigint", 'label' => 'telephone', 'tag' => 'TELEFONE', 'typeform' => 'number', "value" => (isset($varPost['telephone'])?$varPost['telephone']:null), "required" => false, "minimum" => 10000000, "maximum" => 9999999999999, 'placeholder' => 'INSIRA SOMENTE NÚMEROS.', 'isdatabase' => true, 'typedata' => 's'),           
        array("type" => "string", 'label' => 'action', 'tag' => 'SALVAR', 'typeform' => 'button', "value" => 'save', "required" => true, "minimum" => null, "maximum" => null, 'placeholder' => null),    
     ); 

     return $userReceivedData;    
     
}