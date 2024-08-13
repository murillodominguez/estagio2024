<?php
function viewpdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){



return call_user_func_array('manufacturePdf', array($link, $linksystem, $controller, $method, $credentials, call_user_func_array($controller.'DataPattern', array($link, $credentials['Mode'],call_user_func_array('getData'.capitalFirstLetterTreatment($controller).'Database', array($link, filter_var($varPost['id']), $credentials['Mode']))))));
}

function manufacturePdf($link, $linksystem, $controller, $method, $credentials, $userData){
   $return = "";
    foreach($userData as $data){
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

function createPdf($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $userData, $pdfinfo, $enablestyle, $dayoftheToday, $nowTime, $systemErrorMessage){
    
    require_once 'C:\Program Files (x86)\EasyPHP-Devserver-17\eds-www\rfr\assets\standard\composer\vendor\tecnickcom\tcpdf\tcpdf.php';
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setCreator(isset($pdfinfo['creator'])?$pdfinfo['creator']:PDF_CREATOR);
    $pdf->setAuthor(isset($pdfinfo['author'])?$pdfinfo['author']:'Rede Familia Riograndina');
    $pdf->setTitle(isset($pdfinfo['title'])?$pdfinfo['title']:$controller.' '.$userData['id']);
    $pdf->setSubject(isset($pdfinfo['subject'])?$pdfinfo['subject']:'PDF RELATORIO');
    $pdf->setKeywords(isset($pdfinfo['keywords'])?$pdfinfo['keywords']:'TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->setHeaderData(...isset($pdfinfo['headerdata'])?$pdfinfo['header']:array('brasaoriogrande.jpg', 30, 'Prefeitura do Município de Rio Grande', "\nSecretaria Municipal de Saúde\nRede Família Riograndina", array(0,0,0), array(0,64,128)));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));

    // set header and footer fonts
    $pdf->setHeaderFont(...isset($pdfinfo['headerfont'])?$pdfinfo['headerfont']:array(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN)));
    $pdf->setFooterFont(...isset($pdfinfo['footerfont'])?$pdfinfo['footerfont']:array(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)));

    // set default monospaced font
    $pdf->setDefaultMonospacedFont(isset($pdfinfo['monospacedfont'])?$pdfinfo['monospacedfont']:PDF_FONT_MONOSPACED);

    // set margins
    $pdf->setMargins(...isset($pdfinfo['margins'])?($pdfinfo['margins']):array(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT));
    $pdf->setHeaderMargin(isset($pdfinfo['headermargin'])?($pdfinfo['headermargin']):PDF_MARGIN_HEADER);
    $pdf->setFooterMargin(isset($pdfinfo['footermargin'])?$pdfinfo['footermargin']:PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->setAutoPageBreak(...isset($pdfinfo['autopagebreak'])?$pdfinfo['autopagebreak']:array(TRUE, PDF_MARGIN_BOTTOM));

    // set image scale factor
    $pdf->setImageScale(isset($pdfinfo['imagescaleratio'])?$pdfinfo['imagescaleratio']:PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once dirname(__FILE__).'/lang/eng.php';
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set default font subsetting mode
    $pdf->setFontSubsetting(isset($pdfinfo['fontsubsetting'])?$pdfinfo['fontsubsetting']:true);

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->setFont(isset($pdfinfo['font'])?$pdfinfo['font']:'dejavusans', '', 14, '', true);

    //Allow local files
    $pdf->setAllowLocalFiles(true);

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

    // set text shadow effect
    $pdf->setTextShadow(...isset($pdfinfo['textshadow'])?$pdfinfo['textshadow']:array(array('enabled'=>false, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal')));
    if($enablestyle){
        $pdf->{'html'} = '<style>
        *{
            list-style: none;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
        .alert-warning {
            background-color: #fcf8e3;
            border-color: #faebcc;
            color: #8a6d3b;
        }
        .alert-info {
            background-color: #d9edf7;
            border-color: #bce8f1;
            color: #31708f;
        }
        .text-danger{
            color: #a94442;
        }
        label{
            color: #a94442;
        }
        .form-control-text {
            display: block;
            width: 100%;
            min-height: 41px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 2.428571;
            color: #555;
            background-color: #F7F7F7;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 0px;
        }
        .blankspace{
            background-color: none !important;
        }
    </style>';
    }
    else $pdf->{'html'} = '';
    return $pdf;
}