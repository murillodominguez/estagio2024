<?php

function userview($link, $linksystem, $controller, $method, $credentials, $userData){

 $view="
<div class='form-group'><label for='txName' >NOME (COMPLETO):</label>
                        <p class='form-control-text'>".(isset($userData['name'])?$userData['name']:null)."</p>
</div>
<div class='form-group'><label for='txNickname' >IDENTIFICAÇÃO:</label>
<p class='form-control-text'>".(isset($userData['nickname'])?$userData['nickname']:null)."</p>
</div>
<div class='form-group'><label for='txRegistration' >MATRICULA:</label>
<p class='form-control-text'>".(isset($userData['registration'])?$userData['registration']:null)."</p>
</div>
<div class='form-group'><label for='txEmail' >E-MAIL:</label>
<p class='form-control-text'>".(isset($userData['email'])?$userData['email']:null)."</p>
</div>
<div class='form-group'><label for='txTelephone' >TELEFONE:</label>
<p class='form-control-text'>".(isset($userData['telephone'])?$userData['telephone']:null)."</p>
</div>
<div class='form-group'><label for='txSecretary' >SECRETARIA:</label>
<p class='form-control-text'>".(isset($userData['secretary'])?$userData['secretary']:null)."</p>
</div>
<div class='form-group'><label for='txArea' >ÁREA:</label>
<p class='form-control-text'>".(isset($userData['area'])?$userData['area']:null)."</p>
</div>
<div class='form-group'><label for='txSector' >SETOR:</label>
<p class='form-control-text'>".(isset($userData['sector'])?$userData['sector']:null)."</p>
</div>
<div class='form-group'><label for='txOffice' >CARGO:</label>
<p class='form-control-text'>".(isset($userData['office'])?$userData['office']:null)."</p>
</div>
<div class='form-group'><label for='txFunction' >FUNÇÃO:</label>
<p class='form-control-text'>".(isset($userData['function'])?$userData['function']:null)."</p>
</div>";

return manufactureComponentContainer(6,manufactureComponentPageBodyTitle('VISUALIZAR CADASTRO DE USUARIO', NULL, NULL).$view.manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, null));

 }