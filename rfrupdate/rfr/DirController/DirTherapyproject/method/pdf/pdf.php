<?php

function pdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    if(isset($varGet['id'])){
        $userData = getDataTherapyprojectDatabase($link, $varGet['id'], $credentials['Mode']);
    }
    if(isset($varPost['id'])){
        $userData = getDataTherapyprojectDatabase($link, $varPost['id'], $credentials['Mode']);
    }
    $pdfData = therapyprojectDataPattern($link, $credentials['Mode'], $userData);

    createPdf($linksystem, $controller, $method, $credentials, $pdfData, null);

}