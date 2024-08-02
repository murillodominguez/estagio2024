<?php

function officeForm($link, $linksystem, $controller, $method, $credentials, $userData){

 return(manufactureComponentContainer(6,manufactureComponentPageBodyTitle('CADASTRO DE CARGOS',null, null).manufactureComponentFormPrint($linksystem, 'office', 'edit',(array_map('manufactureComponentForm',  $userData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, 'save')));

 }