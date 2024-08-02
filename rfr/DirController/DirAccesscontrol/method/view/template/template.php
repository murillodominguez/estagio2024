<?php



function accesscontrolview($link, $linksystem, $controller, $method, $credentials, $userData, $accesspermissions){

 
$view="
<div class='form-group'><label for='txNickname' >IDENTIFICAÇÃO:</label>
<p class='form-control-text'>".(isset($userData['nickname'])?$userData['nickname']:null)."</p>
</div>
<div class='form-group'><label for='txRegistration' >MATRICULA:</label>
<p class='form-control-text'>".(isset($userData['registration'])?$userData['registration']:null)."</p>
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

if(is_array($accesspermissions) and !empty($accesspermissions)){

$view.=manufactureComponentBodySubtitle('LISTA DE PERMISSÕES', NULL, NULL, 'info');
$view.="<table class='table table-striped table-hover table-sgo'><thead><tr><th scope='cols' style='vertical-align:middle'>FUNÇÃO</th><th scope='cols' style='vertical-align:middle'>FERRAMENTAS</th></tr></thead><tbody>";

   foreach ($accesspermissions as $row) {

        

        if(file_exists(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Dir".ucfirst(strtolower($row['controller'])).DIRECTORY_SEPARATOR."tag.php")){
            
            require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Dir".ucfirst(strtolower($row['controller'])).DIRECTORY_SEPARATOR."tag.php");
           
        }else{

            $tag=$row['controller'];

        }

        $view.="<tr><td data-label='FUNÇÃO: ' style='vertical-align:middle'>".$tag."</td><td data-label='FERRAMENTAS: ' style='vertical-align:middle'><ul class='nav'>".mountBar($link, $row['controller'], $userData['id'])."</ul></td></tr>";
            
    }
}

$view.="</tbody></table>";
return(manufactureComponentPageBodyTitle('VISUALIZAR PERMISSÕES DE ACESSO DO USUÁRIO', NULL, NULL).$view);

 }