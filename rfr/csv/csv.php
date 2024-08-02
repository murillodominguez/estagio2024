<?php

function readCsv($file, $header = true, $separator = ','){
    //VERIFICA SE O ARQUIVO EXISTE
    if(!file_exists($file)){
        die('Arquivo não encontrado!');
    }

    //DADOS DAS LINHAS DO ARQUIVO
    $data = [];

    //ABRE O ARQUIVO
    $csv = fopen($file,'r');

    //CABEÇALHO DOS DADOS (PRIMEIRA LINHA)
    $headerData = $header ? fgetcsv($csv,0,$separator) : [];

    //INSERE OS DADOS PERCORRENDO AS LINHAS DO ARQUIVO CSV
    while($linha = fgetcsv($csv,0,$separator)){
        $data[] = $header ? 
                  array_combine($headerData,$linha) :
                  $linha;
    };

    //FECHA O ARQUIVO
    fclose($csv);

    //RETORNA OS DADOS PROCESSADOS
    return $data;
}


function writeCsvToServer($file, $dados, $controller, $separator=','){
    //ABRE O ARQUIVO PARA ESCRITA
    $filename = $file;
    $file = 'C:\Program Files (x86)\EasyPHP-Devserver-17\eds-www\rfr'.DIRECTORY_SEPARATOR.'DirController'.DIRECTORY_SEPARATOR.'Dir'.ucfirst($controller).DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.$file;
    echo '<br><br>';
    echo '<br><br>';
    var_dump($file);
    echo '<br><br>';
    echo '<br><br>';
    $csv = fopen($file,'w');

    //CRIA O CORPO DO ARQUIVO CSV

    foreach($dados as $row){
        fputcsv($csv, $row, $separator);
    }

    //FECHA O ARQUIVO
    fclose($csv);
    return $filename;
}

function csvList($varTableLabel, $varTableHeader, $varLabelDataBase, $varTableFooter, $varDataBase, $separator, $filename, $controller){
    $data = array();
    //filtrar acentos
    
    $search = array('&Aacute;', '&aacute;', '&Acirc;', '&acirc;', '&Agrave;', '&agrave;', '&Atilde;', '&atilde;', '&Eacute;', '&eacute;', '&Ecirc;', '&ecirc;', '&Egrave;', '&egrave;', '&Iacute;', '&iacute;', '&Icirc', '&icirc', '&Igrave;', '&igrave;', '&Oacute', '&oacute;', '&Ocirc;', '&ocirc;', '&Ograve;', '&ograve;', '&Otilde;', '&otilde;', '&Uacute;', '&uacute;', '&Ucirc;', '&ucirc;', '&Ugrave;', '&ugrave;', '&Ccedil;', '&ccedil;');
    $replace = array('Á', 'á', 'Â', 'â', 'À', 'à', 'Ã', 'ã', 'É', 'é', 'Ê', 'ê', 'È', 'è', 'Í', 'í', 'Î', 'î', 'Ì', 'ì', 'Ó', 'ó', 'Ô', 'ô', 'Ò', 'ò', 'Õ', 'õ', 'Ú', 'ú', 'Û', 'û', 'Ù', 'ù', 'Ç', 'ç');

    array_push($data, $varTableLabel);
    foreach($varTableHeader as $headerValue){
       $headerValue = str_replace($search, $replace, $headerValue);
        $dataHeader[] = $headerValue;
    }
    array_push($data, $dataHeader);
    foreach($varDataBase as $rowDataBase){
        $dataItem = array();
        foreach($varLabelDataBase as $label){
            $item = $rowDataBase[$label];
            $item = str_replace($search, $replace, $item);
            var_dump($item);
            echo '<br>';
            $dataItem[] = $item;
        }
        array_push($data, $dataItem);
    }

    array_push($data, $varTableFooter);
    echo '<br><br>';
    var_dump($data);
    echo '<br><br>';

    return writeCsvToServer($filename, $data, $controller, $separator);
}