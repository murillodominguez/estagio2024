<?php

function sectorForm($link, $linksystem, $controller, $method, $credentials, $userData){

 return(manufactureComponentContainer(6,manufactureComponentPageBodyTitle('CADASTRO DE SETORES',null, null).manufactureComponentFormPrint($linksystem, 'sector', 'edit',(array_map('manufactureComponentForm',  $userData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, 'save')));

 }