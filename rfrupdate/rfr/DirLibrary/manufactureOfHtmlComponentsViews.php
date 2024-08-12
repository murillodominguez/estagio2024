<?php
/*
<div class='form-group'><label for='txName' >NOME (COMPLETO):</label>
                        <p class='form-control-text'>".(isset($userData['name'])?$userData['name']:null)."</p>
</div>

*/
function manufactureComponentViewsTextarea($userReceivedDatarow){ 

    extract($userReceivedDatarow);  

   return("<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><p class='form-control-text'>".(isset($value)?$value:null)."</p></div>");         

}

function manufactureComponentViewsText($userReceivedDatarow){

    extract($userReceivedDatarow);  

    return("<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><p class='form-control-text'>".(isset($value)?$value:null)."</p></div>");         

}

function manufactureComponentViewsNumber($userReceivedDatarow){

    extract($userReceivedDatarow); 

    return("<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><p class='form-control-text'>".(isset($value)?$value:null)."</p></div>");         

}

function manufactureComponentViewsCpf($userReceivedDatarow){

    extract($userReceivedDatarow);  

  return("<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><p class='form-control-text'>".(isset($value)?$value:null)."</p></div>");         

}

function manufactureComponentViewsCnpj($userReceivedDatarow){

    extract($userReceivedDatarow);  
    
    return("<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><p class='form-control-text'>".(isset($value)?$value:null)."</p></div>");         

}

function manufactureComponentViewsDate($userReceivedDatarow){

    extract($userReceivedDatarow);  

    return("<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><p class='form-control-text'>".(isset($value)?date('d/m/Y', strtotime($value)):null)."</p></div>");         

}


function manufactureComponentViewsTime($userReceivedDatarow){

  extract($userReceivedDatarow);  

  return("<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><p class='form-control-text'>".(isset($value)?date('H:m', strtotime($value)):null)."</p></div>");         

}

function manufactureComponentViewsMultiselect($userReceivedDatarow)                                       
  {

    extract($userReceivedDatarow);  
  
    return("<div class='form-group'><label  class='form-group' for='tx".$label[0]."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag[0].":</label><p class='form-control-text'>".(isset($value[0])?$value[0]:null)."</p>
    </div><div class='form-group'><label for='tx".$label[1]."'> ".$tag[1].":</label><p class='form-control-text'>".(isset($value[1])?$value[1]:null)."</p>
    </div>");
  
  }
  
function manufactureComponentViewsCheckbox($userReceivedDatarow){

    extract($userReceivedDatarow);  
  
    $return="<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'')." ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag."</label>";

  foreach ($value as $key => $values){

    if($values!=null) $return.="<p class='form-control-text'>".$values."</p>";

  }
					
  $return.="</div>";

  return($return);

}


function manufactureComponentViewsSelect($userReceivedDatarow){

  extract($userReceivedDatarow); 
  
  return("<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><p class='form-control-text'>".(isset($value)?$value:null)."</p></div>");      

}


function manufactureComponentViewsSubtitle($userReceivedDatarow){

  extract($userReceivedDatarow);

  $return="<h5 class='section-title alert alert-".((isset($style) and $style!=null)?$style:'info')."'><ul class='nav'><li class='pull-left'>".$tag."</li><li class='pull-right'><ul class='nav'><li class='pull-left'>".((isset($previousLink) and $previousLink!=null)?$previousLink:'')."</li><li class='pull-right'>".((isset($backLink) and $backLink!=null)?$backLink:'')."</li></ul></li></ul></h5>";

return($return);    

}


function manufactureComponentViews($userReceivedDatarow){
 
  $definefunction="manufactureComponentViews".capitalFirstLetterTreatment($userReceivedDatarow['typeform']);

  if(function_exists($definefunction)){

    return(call_user_func($definefunction, $userReceivedDatarow));

  } 

}


function manufactureComponentViewsPrint($linksystem, $form){

    $return='';
  
    foreach ($form as $key => $value) {
        $return.=$value;
    }
  
    return($return);
  }