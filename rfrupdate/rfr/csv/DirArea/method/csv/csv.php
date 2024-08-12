<?php

function csv($link, $linksystem, $controller, $method, $varPost, $varGet, $varSession, $credentials, $dayoftheToday, $nowTime, $systemErrorMessage){
    $varDataBase = listRegisteredArea($link, $credentials['Mode'], 0, 1000);

    // $file = areaCsvListPattern($link, $credentials['Mode'], $varDataBase);
    // echo '<a href="area/csv/arquivo.csv" download="arquivo.csv">download</a>';
    // unlink($file);
        
    // // Use basename() function to  
    // // return the file
    // $file_name = basename($url);
         
    // // Use file_get_contents() function  
    // // to get the file from url and use  
    // // file_put_contents() function to  
    // // save the file by using base name  
    // if(file_put_contents($file_name,  
    //       file_get_contents($url))) {  
    //     echo "File downloaded successfully";  
    // }  
    // else {  
    //     echo "File downloading failed.";  
    // }  
}