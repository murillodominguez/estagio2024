<?PHP

function encryptData($value){

    return(sha1($value));

}

function checkPasswordStrength($value){
   
    $force=0;
    $size=strlen($value);

    if(($size >= 4) and ($size <7)){
        $force += 10;
    }

    if($size >=7){
        $force += 25;
    }

    if(($size >= 8) && (preg_match('/[a-z]/', $value))){
        $force += 10;
    }

    if(($size >= 8) && (preg_match('/[A-Z]/', $value))){
        $force += 20;
    }

    if(($size >= 10) && (preg_match('/[@#$%&;*]/', $value))){
        $force += 25;
    }

    if(($size >= 8) && (preg_match('/[0-9]/', $value))){
        $force += 20;
    }   

    return($force);
}

function analyzePasswords($oldpassword, $newpassword, $repeatpassword){

    if($oldpassword == $newpassword){
        return(false);
    }

    if($newpassword != $repeatpassword){
        return(false);
    }

    return(true);
}

