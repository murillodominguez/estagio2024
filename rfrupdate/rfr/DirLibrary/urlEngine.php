<?php
/////////////////////////////////////////////////////////////////////////////////////////
//                                                                                     // 
//                                                                                     //
//     Aqui se busca a URL, já filtrada no Request, para uso no sistema identificando  //
//      o CONTROLLER E  METHOD solicitado pelo USUARIO.                                //
//                                                                                     //
/////////////////////////////////////////////////////////////////////////////////////////
if(isset($varUri) and (!empty($varUri)) and $varUri != "/"){
    $isolateGetValueUrl = explode('?', $varUri)[0];
    $enginePartsUrl = explode('/', $isolateGetValueUrl);
    $controller = $enginePartsUrl[1];
    array_shift($enginePartsUrl);
    
    if(isset($enginePartsUrl[1]) && !empty($enginePartsUrl[1]))
    {
      $method = $enginePartsUrl[1];
      array_shift($enginePartsUrl);			  
    }
    else{
      $method='standard';  
    }
                
    if(count($enginePartsUrl) > 0)
    {
      $parameters = $enginePartsUrl;
    }
}
else
{
    $method = $controller = 'standard';			
}
