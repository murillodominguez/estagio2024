<?php

function districtForm($link, $linksystem, $controller, $method, $credentials, $userData){

 return(manufactureComponentContainer(6,manufactureComponentPageBodyTitle('CADASTRO DE BAIRRO',null, null).manufactureComponentFormPrint($linksystem, 'district', 'edit',(array_map('manufactureComponentForm',  $userData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, 'save')));

 }