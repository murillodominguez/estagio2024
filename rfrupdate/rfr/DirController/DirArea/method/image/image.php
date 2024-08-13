<?php
    echo(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'edit'.DIRECTORY_SEPARATOR.'form'.DIRECTORY_SEPARATOR.'form.php');
    function image($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
            require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'edit'.DIRECTORY_SEPARATOR.'form'.DIRECTORY_SEPARATOR.'form.php';
            // var_dump($varPost);
            return areaForm($link, $linksystem, 'area', 'edit', $credentials, areaImageDataPattern($link, $credentials['Mode'],getDataAreaDatabase($link, filter_var($varPost['id']), $credentials['Mode'])));
    }