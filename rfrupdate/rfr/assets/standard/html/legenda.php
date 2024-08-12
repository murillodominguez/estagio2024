<?php
?>
<div class='col-sm-12'>
<h3 class='text-center'>LEGENDA CÓDIGOS POR TIPO, e ORIENTAÇÕES</h3>
<div class='row'>
<h5 class='alert-info text-center'>ABORDAGEM</h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody><tr><td><strong> 01</strong> </td><td>Caso <STRONG>NÃO</STRONG> vá autuar o condutor e/ ou veiculo!</td><td>Caso vá autuar o condutor e/ ou veiculo, lançar o registro no tipo <strong>AUTUAÇÃO</strong>, conforme código do CTB. </td><td>No relato lançar dados do Veiculo e do cnodutor.</br>Exemplo: Condutor Fulano e tal, CNH xxxxx, Veiculo placa XXX0000, CRLV xxxxx. Tudo em conformidade com o CTB.</td></tr>
    </tbody></table>
</div>

<div class='row'>
<h5 class='alert-info text-center'>ACIDENTE</h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody><tr><td><strong> 09</strong> </td><td>Em caso de acidente entre veiculos sem lesões corporais e/ ou sem óbito.</td><td>* Em caso de Acidente entre veículos com lesões corporais, usar o código <strong>10</strong></br>* Em caso de acidente com morte usar o código <strong>22</strong></td><td>No relato cadastrar número do BOAT gerado.</td></tr>
       <tr><td><strong> 10</strong> </td><td>Em caso de acidente com lesões corporais.</td><td> * Em caso de Acidente entre veículos sem lesões, usar o código <strong>09</strong></br>* Em caso de acidente com morte usar o código <strong>22</strong></td><td>No relato cadastrar dados da viatura de Brigada Militar que atendeu o veiculo, e da ambulancia da SAMU, mais placas dos veiculos envolvidos.</td></tr>
       <tr><td><strong> 22</strong> </td><td>Em caso de acidente com óbito.</td><td> * Em caso de Acidente entre veículos sem lesões, usar o código <strong>09</strong></br>* Em caso de Acidente entre veículos com lesões corporais, usar o código <strong>10</strong></td><td>No relato cadastrar dados da viatura de Brigada Militar que atendeu o veiculo, e da ambulancia da SAMU, mais placas dos veiculos envolvidos.</td></tr>
       <tr><td><strong> 79</strong> </td><td>Em caso de Atropelamento.</td><td> * Em caso de Acidente entre veículos sem lesões, usar o código <strong>09</strong></br>* Em caso de Acidente entre veículos com lesões corporais, usar o código <strong>10</strong></td><td>No relato cadastrar dados da viatura de Brigada Militar que atendeu o veiculo, e da ambulancia da SAMU, mais placas dos veiculos envolvidos.</td></tr>
    </tbody></table>
</div>

<div class='row'>
<h5 class='alert-info text-center'>AUTUAÇÃO</h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody><tr><td> Conforme CTB </br> Exemplo: </br>230V</br> 181IX</br> Não usar espaço e/ ou vírgula entre o artigo e o inciso. </td><td>Em caso de autuar algum condutor e/ ou veiculo. </td><td>Quando não autuar nenhum condutor e/ ou veiculo.</td><td>No relato um resumo da ocorrencia, caso realize a remoção do veiculo lançar a placa do veiculo no campo <strong>Remoção/Apreensão</strong> e lançar no campo <strong>Documentos</strong> o número da AIT gerado, bem como demais documentos gerados pelo agente.</br>Exemplo de relato: Autuado veiculo estacionado a menos de 5 metros da esquina.</td></tr>       
    </tbody></table>
</div>

<div class='row'>
<h5 class='alert-info text-center'>AVERIGUAÇÃO</h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody><tr><td><strong>40</strong></td><td>Usar este código sempre que realizarem um patrulhamento dirigido.</br>Exemplo: Patrulhamento no Rincão.</br>Patrulhamento em um evento. </td><td>Não usar quando for um patrulhamento de diario, não dirigido pela gerencia.</td><td>Exemplo de relato: Realizado patrulhamento e a situação estava tudo em conformidade.</td></tr>
       <tr><td> Lançar código em Conformidade com o fato a ser averiguado.</br>Exemplo:</br>* Frente de garagem código <strong>181,IX</strong></br>* Acidente sem lesão corporal código <strong>09</strong> </td><td>Lançar sempre que receber uma denúncia para se averiguar e a mesma não for confirmada.</td><td>Sempre que for confirmada e denúncia, a mesma deverá ser enquadrada no tipo que a mesma pertence.</td><td>No relato deverá constar o fato denunciado e o que foi apurado pelo Agente.</br>Exemplo de relato: Denúncia de Veiculo estacionado na frente da garagem. O agente ao chegar no local não identificou nenhum veículo estacionado na frente da garagem.</br>Denúncia de acidente entre dois veiculos. O agente não encontrou nenhum veiculo acidentado no local indicado.</td></tr>       
    </tbody></table>
</div>

<div class='row'>
<h5 class='alert-info text-center'>CONTROLE DE TRAFEGO</h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody><tr><td><strong> 52</strong> </td><td>Quando houver necessidade da realização de controle de trânsito a exemplo de semafaro estragado e/ ou inoperante, eventos onde necessite realizar controle do trânsito.</td><td>Quando houver algum conflito de circulação que não se enquadre nos tipos sianlizados antes. Nesses casos usar o código <strong>64</strong></td><td>No relato deverá constar o fato que gerou a necessidade do controle de trânsito no local.</br>Exemplo de relato: Semafaro desligado falta de luz.</td></tr>       
       <tr><td> 64 </td><td>Quando houver conflito de circulação de não esteja enquadrado no código <strong>52</strong>.</td><td>Quando o fato for enquadrado no código <strong>52</strong></td><td>No relato deverá constar o fato que gerou a necessidade do controle de trânsito no local.</br>Exemplo de relato: Fila da caminhões para entrada da balsa bloqueando a circulação de veiculos, necessário intervenção no controle de trânsito do local.</td></tr> 
    </tbody></table>
</div>

<div class='row'>
<h5 class='alert-info text-center'>ESCOLTA</h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody>
       <tr><td><strong> 31</strong> </td><td>Escolta de Ambulância, e ou outros veiculos de Emergencia</td><td></td><td>No relato deverá constar um resumo do fato.</br>Exemplo de relato: * Escoltando ambulancia com dispositivos de emergencia inoperantes.</br> * Escoltando veículo particular para atendimento médico de urgencia e/ ou emergencial.</td></tr>       
       <tr><td><strong> 32</strong> </td><td>Escolta de Carreatas, Passeadas, Procissões e outros eventos... </td><td></td><td>No relato deverá constar qual foi o evento escoltado.</br>Exemplo de relato: * Escolta SuperMaratona .</br> * Escolta Procissão de São Jorge.</td></tr>       
       <tr><td><strong> 33</strong> </td><td>Outros tipos de escoltas realizado.</td><td>Quando o fato for enquadrado no código <strong>31</strong>  ou <strong> 32</strong></td><td>No relato deverá constar o fato que gerou a necessidade da escolta.</td></tr> 
    </tbody></table>
</div>

<div class='row'>
<h5 class='alert-info text-center'>PB</h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody>
       <tr><td><strong> 21</strong> </td><td>Policiamento Administrativo de Trânsito de local.</td><td>Quando for realizar Controle de Trafego, ou Sinalização no local.</td><td></td></tr>       
       </tbody></table>
</div>


<div class='row'>
<h5 class='alert-info text-center'>RECOLHIMENTO</h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody>
       <tr><td><strong> 19</strong> </td><td>Remoção de Animais na via</td><td></td><td>Deverá ser preenchido no campo relato um resumo do fato. Caso seja gerado algum documento relativo a esta remoção o número do mesmo deverá ser inserido no campo <strong>Documento</strong></br>Exemplo de relato: * Realizado remoção de um cavalo na via. </td></tr>       
       <tr><td><strong> 36</strong> </td><td>Remoção de outras fontes de perigo na via. </td><td>Quando for remoção de animais usar o código <strong>19</strong></td><td>No relato deverá constar qual foi o evento escoltado.</br>Exemplo de relato: * Escolta SuperMaratona .</br> * Escolta Procissão de São Jorge.</td></tr>       
        </tbody></table>
</div>

<div class='row'>
<h5 class='alert-info text-center'>SINALIZAÇÂO </h5>
<table class='table table-hover'><thead><tr><th>Código</th><th>Quando usar</th><th>Quando NÃO USAR<th>Observação</th></tr></thead>
       <tbody>
       <tr><td><strong> 37</strong> </td><td>Sinalizar bloqueios de vias e/ ou desvios.</td><td></td><td>Deverá ser preenchido no campo relato o motivo de gerou este fechamento ou desvio de trânsito desta via</br>Exemplo de relato: * Obras da corsan.</br>* Manutenção de Asfalto. </td></tr>       
       <tr><td><strong> 38</strong> </td><td>Sinalizar reservas de estacionamento.</td><td></td><td>Deverá ser preenchido no campo relato o motivo de gerou esta reserva de estacionamento</br>Exemplo de relato: * Reserva de estacionamento para limpeza da via </td></tr>       
       <tr><td><strong> 39</strong> </td><td>Outros.</td><td>Não usar este código caso o fato gerador da sinalização seja enquadrado no código <strong>37</strong> ou <strong>38</strong></td><td>Deverá ser preenchido no campo relato o motivo de gerou esta sinalização.</td></tr>       
        </tbody></table>
</div>


</div>
