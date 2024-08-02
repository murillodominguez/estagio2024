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


function writeCsv($file, $dados, $separator=','){
    //ABRE O ARQUIVO PARA ESCRITA
    $csv = fopen($file,'w');

    //CRIA O CORPO DO ARQUIVO CSV

    foreach($dados as $row){
        fputcsv($csv, $row, $separator);
    }

    //FECHA O ARQUIVO
    fclose($csv);
}