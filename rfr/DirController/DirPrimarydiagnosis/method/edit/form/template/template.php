<?php

function primarydiagnosisForm($link, $linksystem, $controller, $method, $credentials, $userData){

 return(manufactureComponentContainer(12,manufactureComponentPageBodyTitle('CADASTRO DE DIAGNOSTICOS',null, null).manufactureComponentFormPrint($linksystem, 'primarydiagnosis', 'edit',(array_map('manufactureComponentForm',  $userData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, 'save')));

 }