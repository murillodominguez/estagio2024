<?php

require_once "assets/composer/vendor/autoload.php";
use Dompdf\Dompdf;
use Dompdf\Options;
// function viewpdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){
// return call_user_func_array('manufacturePdf', array($link, $linksystem, $controller, $method, $credentials, call_user_func_array($controller.'DataPattern', array($link, $credentials['Mode'],call_user_func_array('getData'.capitalFirstLetterTreatment($controller).'Database', array($link, filter_var($varPost['id']), $credentials['Mode']))))));
// }

function manufacturePdf($linksystem, $controller, $method, $credentials, $pdfData){
    $return = '<html>
    <head>
    <style>
        p{
            margin-bottom: 10px;
            font-weight: bold;
        }
        p:nth-child(odd){
            color: black;
            padding: 10px;
            border: 1px solid #A8C8CE;
            background-color: #B8ECF5;
        }
    </style>
    </head>
    <body>
    <h3>PREFEITURA MUNICIPAL DO RIO GRANDE</h3>
    <h3>REDE FAMÍLIA RIOGRANDINA</h3>
    <h3>DIAGNÓSTICO ID: '.$pdfData[3]['value'].'</h3>';
    // $return .= manufactureComponentViewsPrint($linksystem, (array_map('manufactureComponentViews',  $pdfData)));
    foreach($pdfData as $data){
    if(isset($data['value']) and is_array($data['value'])){
        $return.= '<p>'.$data['tag'].'</p><ul>';
        $list = '';
        foreach($data['value'] as $value){
            if($value!='')$list.='<li class="value">'.$value.'</li>';
        }
        if($list == '') $list = '<li class="value">NENHUM CAMPO SELECIONADO.</li>';
        $return.=$list;
        $return.='</ul>';
    }
    else if(isset($data['isdatabase']) and isset($data['typeform']) and $data['typeform'] != 'hidden' and $data['isdatabase']==true) $return .= '<p class="text-danger">'.$data['tag'].'</p><p class="form-control-text">'.$data['value'].'</p>';
    }
    $return .= '</body>
    </html>';
    return $return;
}

function createPdf($linksystem, $controller, $method, $credentials, $pdfData, $pdfinfo){
    require_once "assets/composer/vendor/autoload.php";
    $htmlcontent = manufacturePdf($linksystem, $controller, $method, $credentials, $pdfData);
    $options = new Options();
    $options->setDefaultFont('Courier');
    $options->setChroot(__DIR__);
    $pdf = new Dompdf($options);
    $pdf->loadHtml($htmlcontent);
    $pdf->setPaper('A4');
    $pdf->render();
    $pdf->stream('diagnostico.pdf', ['Attachment' => 0]);
}