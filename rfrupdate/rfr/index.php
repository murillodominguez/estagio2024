<?php

require_once(__DIR__."/DirSystem/requestSystem.php"); // Aqui é realizado o recebimento e tratamento inicial das variaveis externas   

require_once(__DIR__."/DirConfiguration/engineDatabase.php"); //  Aqui é realizado a conexão com o banco de dados
require_once(__DIR__."/DirCore/basicLibrary.php"); //  Inserir aqui só bibliotecas de uso Geral    
require_once(__DIR__."/DirConfiguration/systemsettings.php"); // Inicialização de configurações basicas do sistema
require_once(__DIR__."/DirSystem/securitySystem.php");



require_once(__DIR__."/DirSystem/controllerSystem.php");  // Inicialização do controle de aplicações

include_once(__DIR__."/DirSystem/datacontrolSystem.php");  // inclusão de middleware - para registro dos logs do sistema

include_once(__DIR__."/DirSystem/menuSystem.php");  // inclusão de middleware - para registro dos logs do sistema


require_once(__DIR__."/DirSystem/templateSystem.php");  // Inicialização do sistema de template

include_once(__DIR__."/DirSystem/logSystem.php");  // inclusão de middleware - para registro dos logs do sistema

require_once(__DIR__."/DirSystem/driverSystem.php");

/*if($systemContainer=='reload'){

 header("Location:".$linksystem); exit();
    
}*/





