<?php
require_once('csv.php');

$arquivo = 'teste.csv';
$data = [[
    'ID',
    'NOME',
    'DESCRIÇÃO'
],
[
    1,
    'MURILLO',
    'TUDO BEM'
],
[
    2,
    'carol',
    'tudo certo'   
]];
$dados = readCsv($arquivo,false,',');

// writeCsv('arquivinhofeliz',$data,',');

print_r($dados);