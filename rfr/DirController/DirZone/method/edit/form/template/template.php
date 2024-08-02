<?php

function zoneForm($link, $linksystem, $controller, $method, $credentials, $userData){

 return(manufactureComponentContainer(6,manufactureComponentPageBodyTitle('CADASTRO DA ZONA',null, null).manufactureComponentFormPrint($linksystem, 'zone', 'edit',(array_map('manufactureComponentForm',  $userData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, 'save')));

 }