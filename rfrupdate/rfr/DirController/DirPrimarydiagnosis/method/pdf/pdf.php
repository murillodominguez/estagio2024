<?php

function pdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    if(isset($varPost['id'])){
        $userData = getDataPrimarydiagnosisDatabase($link, $varPost['id'], $credentials['Mode']);
    }
    $pdfData = primarydiagnosisDataPattern($link, $credentials['Mode'], $userData);

    createPdf($controller, $method, $credentials, $pdfData, null);

}