<?php

function userForm($link, $linksystem, $controller, $method, $credentials, $userData){

 return(manufactureComponentContainer(6,manufactureComponentPageBodyTitle('CADASTRO DE USUARIO',null, null).manufactureComponentFormPrint($linksystem, 'user', 'edit',(array_map('manufactureComponentForm',  $userData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, 'save')));

 }