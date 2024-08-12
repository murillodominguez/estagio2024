<?php
//////////////////////////////////////////////////////////////////////////////////////////
//                                                                                      //
//                                                                                      //
//          AQUI É REALIZADO A DEFINIÇÃO INICIAL DAS VARIAVEIS DE SISTEMA               //
//                                                                                      //   
//                                                                                      //  
//////////////////////////////////////////////////////////////////////////////////////////

require_once(__DIR__."/../DirLibrary/urlEngine.php"); //DEFINIÇÃO INICIAL DO CONTROLLER E METHOD SOLICITADO

date_default_timezone_set('America/Fortaleza');
$dayoftheToday=date("Y-m-d");
$nowTime=date("H:i:s");
$currentTime=$dayoftheToday." ".$nowTime;
$web_protocol = (($_SERVER['SERVER_PORT'] == '443') ? 'https://' : 'http://');
$site = 'rfr';
$linksystem=$web_protocol.$_SERVER['HTTP_HOST'] .'/';
$ServidorID='';
$credentials='';
$systemContainer='';
$systemErrorMessage=((isset($varSession['MsgError']))?(treatmentString($varSession['MsgError'])):'');
$changedefault= array('noexist', 'lock', 'login', 'errorbd', 'standard', 'offpermission', 'api');
$datacontrolsystem=''; 
$checkedlock='DESATIVADO';
$IpAcess=filteringVar($varMethod['REMOTE_ADDR'], 'string');
$accessControllerTemplate='STANDARD'; //STANDARD = PORTAL , ACCESS = TELA LOGIN, ERROR = ERRO
$lockedSystem='ATIVADO';
$errorMessage='';
$controllerkey='UNLOCKED';


