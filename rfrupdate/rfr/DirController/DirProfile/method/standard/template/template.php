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
</div>".(isset($userData['secretary'])?"<div class='form-group'><label for='txSecretary' >SECRETARIA:</label>
<p class='form-control-text'>".$userData['secretary']."</p>
</div>":null).(isset($userData['area'])?"<div class='form-group'><label for='txArea' >BENEFICIENTE:</label>
<p class='form-control-text'>".$userData['area']."</p>
</div>":null).(isset($userData['sector'])?"<div class='form-group'><label for='txSector' >ENTIDADE:</label>
<p class='form-control-text'>".$userData['sector']."</p>
</div>":null).(isset($userData['office'])?"<div class='form-group'><label for='txOffice' >CARGO:</label>
<p class='form-control-text'>".$userData['office']."</p>
</div>":null).(isset($userData['function'])?"<div class='form-group'><label for='txFunction' >FUNÇÃO:</label>
<p class='form-control-text'>".$userData['function']."</p>
</div>":null);
return manufactureComponentPageBodyTitle('MEU PERFIL', manufactureComponentFormTitleButton($linksystem, 'profile', 'edit', 'id', $credentials['IdServidor'], 'password', 'btn-title') , manufactureComponentFormTitleButton($linksystem, 'profile', 'edit', 'id', $credentials['IdServidor'], 'edit', 'btn-title') ).$view.manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, null);

 }