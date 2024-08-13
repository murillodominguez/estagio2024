<?php

//////////////////////////////////////////////////////////////////////////////////////////
//                                                                                      //
//                                                                                      //
//      Aqui é realizado a conexão com o banco de dados
//                                                                                      //   
//                                                                                      //  
//////////////////////////////////////////////////////////////////////////////////////////

define ( 'cUser',  'rfr');
define ( 'cPass', '8Wa9GQXNhKNySQ5U');
define ( 'cBd', 'rfr');
//define ( 'cSrv', '192.168.0.101');
define ( 'cSrv', 'localhost');

$link= mysqli_connect(cSrv, cUser, cPass, cBd);
  
 try{

  if(mysqli_connect_errno()) {
    
    throw new Exception(("Falha na conexao: [". mysqli_connect_error($link)."]". mysqli_connect_errno($link)), 1);
  
  }

 }
catch (\Exception $e) {
  
  
  if($e->getCode()=='1'){
    echo "<pre><h3 align='center'>AVISO:</h3><br><blockquote>";
    echo "<br><strong align='center'>Erro fatal no sistema!</strong><br><br>Informe o Administrador que o erro ocorrido é o do código: ".$e->getCode()."!";
    echo "</blockquote></pre>";
    exit();
    
  }
}


//library
function refValues($arr){
  if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
  {
      $refs = array();
      foreach($arr as $key => $value)
          $refs[$key] = &$arr[$key];
      return $refs;
  }
  return $arr;
}