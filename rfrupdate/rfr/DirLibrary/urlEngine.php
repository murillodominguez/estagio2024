<?php
/////////////////////////////////////////////////////////////////////////////////////////
//                                                                                     // 
//                                                                                     //
//     Aqui se busca a URL, já filtrada no Request, para uso no sistema identificando  //
//      o CONTROLLER E  METHOD solicitado pelo USUARIO.                                //
//                                                                                     //
/////////////////////////////////////////////////////////////////////////////////////////
if(isset($varGet['url'])and (!empty($varGet['url']))){

    $enginePartsUrl = explode('/', $varGet['url']);
    $controller = $enginePartsUrl[0];
    array_shift($enginePartsUrl);
    
    if((isset($enginePartsUrl[0])) && !empty($enginePartsUrl[0]))
    {
      $method = $enginePartsUrl[0];
      array_shift($enginePartsUrl);			  
    }
    else{
      $method='standard';  
    }
                
    if(count($enginePartsUrl) >0)
    {
      $parameters = $enginePartsUrl;
    }
}
else
{
    $method = $controller = 'standard';			
}
