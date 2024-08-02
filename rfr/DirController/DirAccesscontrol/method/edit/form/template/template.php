<?php

function accesscontrolForm($link, $linksystem, $controller, $method, $credentials, $userData){

    $listController=convertDirectoryNameToControllerName(getDirController());

$form="
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

if(is_array($listController) and !empty($listController)){

    $form.=manufactureComponentBodySubtitle('LISTA DE PERMISSÕES', NULL, NULL, 'info')."<table class='table table-striped table-hover table-sgo'><thead><tr><th scope='cols' style='vertical-align:middle'>FUNÇÃO</th><th scope='cols' style='vertical-align:middle'>FERRAMENTAS</th></tr></thead><tbody>";

    foreach ($listController as $data) {
    
        if(file_exists(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Dir".ucfirst(strtolower($data)).DIRECTORY_SEPARATOR."tag.php")){
                    
            $accessibleTools=null;

            require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Dir".ucfirst(strtolower($data)).DIRECTORY_SEPARATOR."tag.php");

            if(isset($accessibleTools) and is_array($accessibleTools) and !empty($accessibleTools)){

                $form.="<tr><td data-label='FUNÇÃO: ' style='vertical-align:middle'>".$tag."</td><td data-label='FERRAMENTAS: ' style='vertical-align:middle'><ul class='nav'>".mountBarForm($link, $linksystem, $data, $userData['id'], $accessibleTools)."</ul></td></tr>";                 

            }

        }else{

            $accessibleTools=null;

        }

    }

$form.="</tbody></table>";

}


 return(manufactureComponentPageBodyTitle('GERENCIAMENTO DE PERMISSÕES POR USUARIO', null, null).$form);
 
 }