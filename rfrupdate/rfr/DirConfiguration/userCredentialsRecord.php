<?php
//echo "<br>controller['USERCREDENTIAL-antes]:".$controller;
//echo "<br>method['USERCREDENTIAL-antes]:".$method;

if(isset($ServidorID)and(!empty($ServidorID))){

    extract(getUserDataBase($link, $ServidorID));

    $credentials= array (
        'IdServidor' => $ServidorID,
        'ServidorNickname' => $nickname,
        'IdSetor' => $sector,
        'IdArea' => $area,
        'IdSecretary' => $secretary,        
        'Login' => $registration,
        'Mode' => $mode,
        'Mobile' => isMobile()
     );
     
   // 'AllocationName' => identifiesAllocationName($link, identifiesUserAllocation($link, $ServidorID)),
   //'UserFunctionalLevel' => identifiesUserFunctionalLevel($link, $ServidorID),
   //'IdAllocation' =>identifiesUserAllocation($link, $ServidorID),
}else{
  echo "<bR>erro";
}

//echo "<br>controller['USERCREDENTIAL-depois]:".$controller;
//echo "<br>method['USERCREDENTIAL-depois]:".$method;