<?php

function pdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    if(isset($varGet['id'])){
        $userData = getDataPrimarydiagnosisDatabase($link, $varGet['id'], $credentials['Mode']);
    }
    if(isset($varPost['id'])){
        $userData = getDataPrimarydiagnosisDatabase($link, $varPost['id'], $credentials['Mode']);
    }
    $pdfData = primarydiagnosisDataPattern($link, $credentials['Mode'], $userData);

    createPdf($linksystem, $controller, $method, $credentials, $pdfData, null);

}