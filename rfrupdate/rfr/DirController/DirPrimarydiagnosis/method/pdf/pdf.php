<?php

function pdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    if(isset($varPost['id'])){
    $userData = getDataPrimarydiagnosisDatabase($link, $varPost['id'], $credentials['Mode']);
    }

// create new PDF document

$pdfinfo = array(
    'margins' => array(15, 40, 15)
);

$pdf = createPdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $userData, $pdfinfo, true, $dayoftheToday, $nowTime, $systemErrorMessage);

$pdf->AddPage();

//create view html cell;
$view = viewPdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage);
$before = ['"', '\'', '<li', '</li>'];
$after = ['\'', '"', '<p', '</p>'];
$view = str_replace($before, $after, $view);
$pdf->html .= '<body>'.$view."</body>";

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $pdf->html, 0, 1, 0, true, '', false);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('diagnostico'.$userData['id'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

}