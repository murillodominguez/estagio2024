<?php

function areaview($link, $linksystem, $controller, $method, $credentials, $userData){

    //var_dump($userData);exit();
 $view="
<div class='form-group'><label for='txName' >NOME DA ÁREA:</label>
<p class='form-control-text'>".(isset($userData['name'])?$userData['name']:null)."</p>
</div>
<div class='form-group'><label for='txNickname' >ABREVIAÇÃO:</label>
<p class='form-control-text'>".(isset($userData['nickname'])?$userData['nickname']:null)."</p>
</div>
<div class='form-group'><label for='txSecretary' >SECRETARIA:</label>
<p class='form-control-text'>".(isset($userData['secretary'])?$userData['secretary']:null)."</p>
</div>
<div class='form-group'><label for='txStatus' >ESTADO:</label>
<p class='form-control-text'>".(isset($userData['status'])?$userData['status']:null)."</p>
</div>
<div class='form-group'><label for='txPath' >IMAGEM PRINCIPAL:</label>
<img src='/rfr/".getDataAreaImage($link, $userData['id'], $credentials['Mode'], 1)."'>
</div>
<div class='form-group'><label for='txPath' >IMAGEM 2:</label>
<img src='/rfr/".getDataAreaImage($link, $userData['id'], $credentials['Mode'], 2)."'>
</div>
<div class='form-group'><label for='txPath' >IMAGEM 3:</label>
<img src='/rfr/".getDataAreaImage($link, $userData['id'], $credentials['Mode'], 3)."'>
</div>
<div class='form-group'><label for='txPath' >IMAGEM 4:</label>
<img src='/rfr/".getDataAreaImage($link, $userData['id'], $credentials['Mode'], 4)."'>
</div>";

return manufactureComponentContainer(6,manufactureComponentPageBodyTitle('VISUALIZAR CADASTRO DA AREA', NULL, NULL).$view.manufactureComponentButtonReturn($link, $linksystem, $credentials['Login'], $controller, $method, null));

 }