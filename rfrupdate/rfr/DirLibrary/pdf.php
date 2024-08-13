<?php

require_once "assets/composer/vendor/autoload.php";
use Dompdf\Dompdf;
// function viewpdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){
// return call_user_func_array('manufacturePdf', array($link, $linksystem, $controller, $method, $credentials, call_user_func_array($controller.'DataPattern', array($link, $credentials['Mode'],call_user_func_array('getData'.capitalFirstLetterTreatment($controller).'Database', array($link, filter_var($varPost['id']), $credentials['Mode']))))));
// }

function manufacturePdf($controller, $method, $credentials, $pdfData){
   $return = "";

    foreach($pdfData as $data){
    if(isset($data['value']) and is_array($data['value'])){
        $return.= '<p class="text-danger">'.$data['tag'].'</p><ul>';
        foreach($data['value'] as $value){
            if($value!='')$return.='<li>'.$value.'</li>';
        }
        $return.='</ul>';
    }
    else if(isset($data['isdatabase']) and isset($data['typeform']) and $data['typeform'] != 'hidden' and $data['isdatabase']==true) $return .= '<p class="text-danger">'.$data['tag'].'</p><p class="form-control-text">'.$data['value'].'</p>';
   }
    return $return;
}

function createPdf($controller, $method, $credentials, $pdfData, $pdfinfo){
    require_once "assets/composer/vendor/autoload.php";
    $htmlcontent = manufacturePdf($controller, $method, $credentials, $pdfData);
    $pdf = new Dompdf();
    $pdf->loadHtml($htmlcontent);
    $pdf->setPaper('A4');
    $pdf->render();
    ob_end_clean();
    $pdf->stream();
}