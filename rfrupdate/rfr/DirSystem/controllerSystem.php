<?php

if(is_array($credentials) and $controllerkey=='UNLOCKED'){

    if(!isset($path)){ 

      $path = __DIR__."/../DirController/Dir".ucfirst($controller)."/".$controller."Controller.php";

    }

    if(file_exists($path)){
      require_once $path;    
    }

    if(!file_exists($path) and (!in_array($controller, $changedefault))){

      $accessControllerTemplate='ERROR';

    }
}



