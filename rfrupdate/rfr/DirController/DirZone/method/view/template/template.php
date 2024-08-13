<?php

function zoneview($link, $linksystem, $controller, $method, $credentials, $userData){

    //var_dump($userData);exit();
 $view="
<div class='form-group'><label for='txName' >NOME DA ZONA:</label>
                        <p class='form-control-text'>".(isset($userData['name'])?$userData['name']:null)."</p>
</div>
<div class='form-group'><label for='txCode' >CÓDIGO:</label>
                        <p class='form-control-text'>".(isset($userData['code'])?$userData['code']:null)."</p>
</div>
<div class='form-group'><label for='txZoom' >ZOOM REFERÊNCIA:</label>
                        <p class='form-control-text'>".(isset($userData['zoom'])?$userData['zoom']:null)."</p>
</div>
<div class='form-group'><label for='txStatus' >ESTADO:</label>
<p class='form-control-text'>".(isset($userData['status'])?$userData['status']:null)."</p>
</div>";

return manufactureComponentContainer(6,manufactureComponentPageBodyTitle('VISUALIZAR CADASTRO DE ZONAS', NULL, NULL).$view.manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, null));

 }