<?php

 function therapyprojectView($link, $linksystem, $controller, $method, $credentials, $userData){

    return manufactureComponentContainer(6,manufactureComponentPageBodyTitle('VISUALIZAR DIAGNOSTICO',null, null).manufactureComponentViewsPrint($linksystem, (array_map('manufactureComponentViews',  $userData))).manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, 'view'));
   
}