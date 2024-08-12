<?php

function pdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, &$systemErrorMessage){
    if(isset($varPost['id'])){
    $userData = getDataAreaDatabase($link, $varPost['id'], $credentials['Mode']);
    $order = 1;
    while($order <= 4){
        $images['path'.$order] = getDataAreaImage($link, $varPost['id'], $credentials['Mode'], $order);
        ++$order;
    }
    require_once(__DIR__.DIRECTORY_SEPARATOR.'.'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'sql.php');
    }
// create new PDF document

$pdfinfo = array();

$pdf = createPdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $userData, $pdfinfo, true, $dayoftheToday, $nowTime, $systemErrorMessage);

// Set some content to print
// $html = "<h1>ÁREA</h1>
// <p>Item: ".$itemData['name']."</p>

// ";
$html = '<style>
            h4{
                background-color: #e0ffff;
            }
            p{
                background-color: #fff7ee;
            }
        </style>
<h3>ÁREA ID: '.(isset($userData['id'])?$userData['id']:null).'</h3>
<h4>NOME DA ÁREA:</h4>
<p>'.(isset($userData['name'])?$userData['name']:null).'</p>
<span></span>
<h4>ABREVIAÇÃO:</h4>
<p>'.(isset($userData['nickname'])?$userData['nickname']:null).'</p>
<span></span>
<h4>SECRETARIA:</h4>
<p>'.(isset($userData['secretary'])?$userData['secretary']:null).'</p>
<span></span>
<h4>ESTADO:</h4>
<p>'.(isset($userData['status'])?$userData['status']:null).'</p>
<img src="'.K_PATH_IMAGES.'img.jpg" alt="logo" width="300" height="300" />';

// $html .= isset($images['path1'])?'<span></span><h4>IMAGEM PRINCIPAL:</h4>'.$pdf->Image($images['path1'], 16, 198, 75, 113, 'JPG', null, '', true, 150, '', false, false, false, true, false, false):'';

// $html .= isset($images['path2'])?'<span></span><h4>IMAGEM PRINCIPAL:</h4>'.$pdf->Image($images['path2'], 16, 200, 75, 113, 'JPG', null, '', true, 150, '', false, false, false, true, false, false):'';

// $html .= isset($images['path1'])?'<span></span><h4>IMAGEM PRINCIPAL:</h4>'.$pdf->Image($images['path1'], 15, 190, 75, 113, 'JPG', null, '', true, 150, '', false, false, false, true, false, false):'';

// $html .= isset($images['path1'])?'<span></span><h4>IMAGEM PRINCIPAL:</h4>'.$pdf->Image($images['path1'], 15, 190, 75, 113, 'JPG', null, '', true, 150, '', false, false, false, true, false, false):'';
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', false);
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('area'.$userData['id'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

}