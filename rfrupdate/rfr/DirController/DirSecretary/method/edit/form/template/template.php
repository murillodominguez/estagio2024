<?php

function secretaryForm($link, $linksystem, $controller, $method, $credentials, $userData){

 return manufactureComponentContainer(6,manufactureComponentPageBodyTitle('CADASTRO DE SECRETARIAS',null, null).manufactureComponentFormPrint($linksystem, 'secretary', 'edit',(array_map('manufactureComponentForm',  $userData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, 'save'));

 }