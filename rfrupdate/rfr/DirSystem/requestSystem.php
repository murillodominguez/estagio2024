<?php
session_cache_expire(30);
session_start();
session_regenerate_id();
//////////////////////////////////////////////////////////////////////////////////////////
//                                                                                      //
//                                                                                      //
//      Aqui é realizado o recebimento e tratamento inicial das variaveis externas      //
//                                                                                      //   
//                                                                                      //  
//////////////////////////////////////////////////////////////////////////////////////////
$varPost = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP);
$varGet=filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP);
$varSession = filter_var_array($_SESSION, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP);
$varCookie = filter_input_array(INPUT_COOKIE, FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP);
$varMethod = filter_var_array($_SERVER, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH  | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP);
$varHeaders = filter_var_array(getallheaders(), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH  | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP);
$varUri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH  | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_ENCODE_AMP);