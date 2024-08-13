<?php

if($controller!='api'){
  
  $standardtemplate=$accessControllerTemplate."Template.php";

  $model='teste2';

  $templatepath=__DIR__."/../DirTemplate/";

  if(!is_dir($templatepath.$model)){

    $model='standard';

  }

   $template=$templatepath.(is_file($templatepath.$model.DIRECTORY_SEPARATOR.$standardtemplate)?$model.DIRECTORY_SEPARATOR.$standardtemplate:("standard".DIRECTORY_SEPARATOR."standardTemplate.php"));
      try {
    
        if(!file_exists($template)){
    
            throw new Exception('Desculpe o transtorno! Ocorreu um erro fatal, devido a isso não poderemos continuar!', 2);            
          
        }
          
        require_once $template;
          
      } catch (\Exception $e) {
    
        echo "<pre><h3 align='center'>AVISO:</h3><br><blockquote>";
        print_r($e->getMessage());
        echo "<br><br>Informe o Administrador que o erro ocorrido é o do código:";
        print_r($e->getCode());
        echo "</blockquote></pre>";
        
      }
    }

    