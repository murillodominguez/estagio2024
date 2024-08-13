<?php

function sectorview($link, $linksystem, $controller, $method, $credentials, $userData){

 $view="
<div class='form-group'><label for='txName' >NOME (COMPLETO):</label>
                        <p class='form-control-text'>".(isset($userData['name'])?$userData['name']:null)."</p>
</div>
<div class='form-group'><label for='txNickname' >NOME (ABREVIADO):</label>
<p class='form-control-text'>".(isset($userData['nickname'])?$userData['nickname']:null)."</p>
</div>
<div class='form-group'><label for='txArea' >ÁREA:</label>
<p class='form-control-text'>".(isset($userData['area'])?$userData['area']:null)."</p>
</div>";

return manufactureComponentContainer(6,manufactureComponentPageBodyTitle('VISUALIZAR CADASTRO De SETOR', NULL, NULL).$view.manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, null));

 }