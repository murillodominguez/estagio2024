<?php

function manufactureComponentFormInputTextarea($userReceivedDatarow){ 
    extract($userReceivedDatarow);  

  if($maximum==null) $maximum=100;

  $return="<script>
              function limite_textarea".$label."(valor) {
                  quant = ".$maximum.";
                  total = valor.length;
                  if(total <= quant) {
                      resto = quant - total;
                      document.getElementById('cont".$label."').innerHTML = resto;
                  } else {
                      document.getElementById('texto".$label."').value = valor.substr(0,quant);
                  }
          }
  </script>";

  $return=$return."<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label><textarea class=form-control onkeyup='limite_textarea".$label."(this.value)' rows='5' maxlength='".$maximum."' id='texto".$label."' name='".$label."' ".(($placeholder!=null)?"placeholder='".$placeholder."' ":"").(($required!=null)?'required/':'').">".(isset($value)?$value:"")."</textarea>
           <span class='text-info' id='cont".$label."'><strong>".$maximum."</strong></span>
            Caracteres Restantes</div>";

   return $return;         
}

function manufactureComponentFormInputText($userReceivedDatarow){

    extract($userReceivedDatarow);  

  return "<div class='form-group'><label for='tx".ucfirst($label)."' ".(isset($style) and $style!=null?"class='text-".$style."'":'').">".$tag.":</label>
  <input type='text' class='form-control' name='".$label."' id='tx".ucfirst($label)."' value='".(isset($value)?$value:null)."' ".(!empty($minimum)?"minlength=".$minimum:'')." ".(!empty($maximum)?"maxlength=".$maximum:'')." autocomplete='off' ".($required==true?"required/":'')." ".((!empty($placeholder))?"placeholder='".$placeholder."'":'')." />
</div>";

}

function manufactureComponentFormInputPassword($userReceivedDatarow, $script){

    extract($userReceivedDatarow);  

  return "<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label>
  <input type='password' class='form-control' name='".$label."' id='".$label."' value='".(isset($value)?$value:null)."' ".(!empty($minimum)?"minlength=".$minimum:'')." ".(!empty($maximum)?"maxlength=".$maximum:'')." autocomplete='off' ".(($required==true)?"required/":'')." ".((!empty($placeholder))?"placeholder='".$placeholder."'":'')."  ".(($script!=null)?"onkeyup='".$script."()'":'')."/>
</div>";

}

function manufactureComponentFormInputNumber($userReceivedDatarow){

    extract($userReceivedDatarow);  
  return "<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label>
  <input type='number' class='form-control' name='".$label."' id='tx".ucfirst($label)."' value='".(isset($value)?$value:null)."' ".(!empty($minimum)?"min=".$minimum:'')." ".(!empty($maximum)?"max=".$maximum:'')." autocomplete='off' ".(($required==true)?"required/":'')." ".((!empty($placeholder))?"placeholder='".$placeholder."'":'')." />
</div>";

}

function manufactureComponentFormInputCpf($userReceivedDatarow){

    extract($userReceivedDatarow);  

  return "<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label>
  <input type='number' class='form-control' name='".$label."' id='tx".ucfirst($label)."' value='".(isset($value)?$value:null)."' min=00000000001 max=99999999999 autocomplete='off' ".(($required==true)?"required/":'')." ".((!empty($placeholder))?"placeholder='".$placeholder."'":'')." />
</div>";

}

function manufactureComponentFormInputCnpj($userReceivedDatarow){

    extract($userReceivedDatarow);  
    
  return "<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label>
  <input type='number' class='form-control' name='".$label."' id='tx".ucfirst($label)."' value='".(isset($value)?$value:null)."' ".(!empty($minimum)?"min=".$minimum:'')." ".(!empty($maximum)?"max=".$maximum:'')." autocomplete='off' ".(($required==true)?"required/":'')." ".((!empty($placeholder))?"placeholder='".$placeholder."'":'')." />
</div>";

}

function manufactureComponentFormInputDate($userReceivedDatarow){

    extract($userReceivedDatarow);  

  return "<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label>
  <input type='date' class='form-control' name='".$label."' id='tx".ucfirst($label)."' value='".(isset($value)?$value:null)."' ".(!empty($minimum)?"min=".$minimum:'')." ".(!empty($maximum)?"max=".$maximum:'')." autocomplete='off' ".(($required==true)?"required/":'')." ".((!empty($placeholder))?"placeholder='".$placeholder."'":'')." />
</div>";

}


function manufactureComponentFormInputTime($userReceivedDatarow){

  extract($userReceivedDatarow);  

return "<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label>
<input type='time' class='form-control' name='".$label."' id='tx".ucfirst($label)."' value='".(isset($value)?$value:null)."' ".(!empty($minimum)?"min=".$minimum:'')." ".(!empty($maximum)?"max=".$maximum:'')." autocomplete='off' ".(($required==true)?"required/":'')." ".((!empty($placeholder))?"placeholder='".$placeholder."'":'')." />
</div>";

}

function manufactureComponentFormInputHidden($userReceivedDatarow){

    extract($userReceivedDatarow);  

  return "<input type=hidden name='".$label."' value='".$value."'>";

}

function manufactureComponentFormInputButton($userReceivedDatarow){
  
    extract($userReceivedDatarow);  
  return "<div class='rows'><button type='submit' class='btn btn-primary pull-left' id='submit' name='".$label."' value='".$value."'>".$tag."</button></form></div>";

}

  function manufactureComponentFormInputButton2($userReceivedDatarow){
  
    extract($userReceivedDatarow);  
  
    return "<div class='rows'><button type='submit' class='btn btn-primary pull-left' id='".$label."' name='".$label."' value='".$value."'>".$tag."</button></form></div>";
  
  }

  function manufactureComponentFormInputMultiselect($userReceivedDatarow)                                       
  {

    extract($userReceivedDatarow);  
  
    $return="<style>
    select option[disabled] {
  /* Oculta os options que estão desabilitados */
  display: none;
  }
  </style> ";
     $select_ini="<option value='SELECIONE'>SELECIONE</option>";
     $select_mei="<option value='SELECIONE'>SELECIONE</option>";
     $select_fin="{ 'SELECIONE': ['SELECIONE'], ";
  
     
       if(is_array($minimum)){
  
       foreach($minimum as $rowminimum){
  
           $select_ini.= "<option value='".$rowminimum['ref']."'";	
  
          if($rowminimum['ref']==$selected[0]) $select_ini.=' selected';
  
          $select_ini.= ">".$rowminimum['ref']."</option>";
          $select_fin.=$rowminimum['ref'].": [";
          foreach ($rowminimum['data'] as $row) {
         
              $select_mei.= "<option value='".$row."'";	
              if($row==$selected[1]) $select_mei.=' selected';
              $select_mei.= ">".$row."</option>";
  
              $select_fin.="'".$row."', ";
          }
          $select_fin.="], ";
  
       }
  
       $select_fin.="}";
  
    }
  
    $return.="<div class='form-group'><label  class='form-group' for='tx".$label[0]."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag[0].":</label> <select name='".$label[0]."' id='tx".$label[0]."' class='form-control' ".(($required[0]==true)?' required/':'').">".$select_ini."</select>
    </div><div class='form-group'><label for='tx".$label[1]."'> ".$tag[1].":</label> <select name='".$label[1]."' id='tx".$label[1]."' class='form-control select2' ".(($required[1]==true)?' required/':'').">".$select_mei."</select>
    </div><script type='text/javascript'>
    jQuery(document).ready(function($){
  
  var ".$label[1]." = ".$select_fin."
  
  \$".$label[1]." = $('#tx".$label[1]." option');
  
  $('#tx".$label[0]."').on('change', function(event){
  
  var ".$label[0]." = this.value;
  
  \$".$label[1].".each(function(index, el){
  
  if (".$label[1]."[".$label[0]."].indexOf(el.value) == -1){ // Não existe
      $(el).prop('disabled', true); 
      $(el).prop('selected', false);// Desabilita secondary
  }else{ // Existe
    $(el).prop('disabled', false); // Habilita secondary 
  }
  });
  }).change(); // Executa o método change uma vez para desabilitar 
           // todas as secondary pois nenhuma primary foi selecionado ainda
  });
  </script>";
  return $return;
  
  }
  
function manufactureComponentFormInputCheckbox($userReceivedDatarow){

    extract($userReceivedDatarow);
  
  $return="<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'')." ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag."</label>";

  foreach ($minimum as $key => $values){

    $var=explode('(', $values);
    $valuesent = (is_array($var)?trim($var[0]):$values);
    // echo"<br>";
    // echo$value[$key];
    // echo"<br>";
    // var_dump($value);
    // echo "<br>";
    $return.="<label class='checkbox'><input type='checkbox' name='".$key."' value='".$valuesent."' ".(isset($value[$key]) && $value[$key]!=null?"checked":null).">".$values."</label>";

  }
					
  $return.="</div>";

  return $return;

}


function manufactureComponentFormInputSelect($userReceivedDatarow){

  extract($userReceivedDatarow); 
  
  $return="<div class='form-group'><label for='tx".ucfirst($label)."' ".((isset($style) and $style!=null)?"class='text-".$style."'":'').">".$tag.":</label>
  <select name='".$label."' id='tx".ucfirst($label)."' class='form-control select2' ".(($required==true)?' required/':'').">
  <option value=''>Selecione</option>";

   if(is_array($minimum)){ 

      foreach($minimum as $row){
        $temp = explode("(", $row['name']);
        if(is_array($temp)){
            $var = trim($temp[0]);
        }else{
            $var = $row['name'];
        }
        // if(isset($rowUserReceivedData['value'])){
    
    //     $temp=explode('(', $rowUserReceivedData['value']);

    //     if(is_array($temp)){
    //         $value=trim($temp[0]);
    //     }else{
    //         $value = $rowUserReceivedData['value'];
    //     }
    // }else{
    //     $value=null;
    // }
        $return.= "<option value='".$var."' ".(($var==$value)?"selected":'')." >".$row['name']."</option>";
        
      } 
   }

  $return.="</select></div>";

  return $return;

}


function manufactureComponentFormInputSubtitle($userReceivedDatarow){

  extract($userReceivedDatarow);

  $return="<h4 class='section-title alert alert-".((isset($style) and $style!=null)?$style:'info')."'><ul class='nav'><li class='".((isset($textstyle) and $textstyle!=null)?$textstyle:'text-start')."'>".$tag."</li><li class='pull-right'><ul class='nav'><li class='pull-left'>".((isset($previousLink) and $previousLink!=null)?$previousLink:'')."</li><li class='pull-right'>".((isset($backLink) and $backLink!=null)?$backLink:'')."</li></ul></li></ul></h5>";

  return $return;    

}

function manufactureComponentFormInputSignature($userReceivedDatarow){
  extract($userReceivedDatarow);
  $return = "<div class='form-group'><label for='".ucfirst($label)."'>".$tag.":</label>
  <canvas id='signatureCanva' width='500px' height='200px' style='display: block; background-color: #F7F7F7; border: 1px solid #ccc; border-radius: 4px;'></canvas>
  <button type='button' onclick='clearSignature()'>Limpar</button>
  <input id='signatureurl' name='signaturebase64' type='hidden' value=''>
  <script>
    const canvas = document.querySelector('#signatureCanva');
    const inputUrl = document.querySelector('#signatureurl');
    var signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(255,255,255)'});
    function clearSignature(){
      signaturePad.clear();
    }
    if(document.querySelector('#forml')){
      document.querySelector('#forml').addEventListener('submit', (e) => {
        getSignatureUrl();
      });
    }
    function getSignatureUrl(){
      let imageUrl = signaturePad.toDataURL('image/jpeg');
      inputUrl.value = imageUrl;
    }
  </script>
  </div>";
  return $return;
}

function manufactureComponentFormInputImg($userReceivedDatarow){

  extract($userReceivedDatarow);
if(isset($value)){
  $return = "<div class='form-group'><label for='img".ucfirst($label)."' ".((isset($style) and $style!=null)?('class=text-'.$style):'').">".$tag.":</label>
  <div>
  <img id='display".ucfirst($label)."' src='/rfr/".$value."' style='max-width 70px; max-height: 50px; width: auto; height: auto;'>";
  if(isset($edit) && $edit){
    $return .= "<input type='file' accept='image/*' capture class='form-control' name='".$label."' id='img".ucfirst($label)."' ".(($required==true)?"required":'').((!empty($placeholder))?"placeholder='".$placeholder."'":'')."/>
    </div>
    <script>
//definir largura da imagem comprimida
var newWidth = 800;
//seleciona o input da imagem
let img_input".$order." = document.getElementById('img".ucfirst($label)."');
//executa função ao mudar o input (enviar arquivo)
img_input".$order.".addEventListener('change', (e) => {
    //arquivo enviado
    let img_file = e.target.files[0];
    console.log(e.target.files);
    //leitor de arquivo
    let reader = new FileReader;
    reader.readAsDataURL(img_file);
    //ler o arquivo ao carregar a página, e executar a função
    reader.onload = (event) => {
        //url da imagem
        let img_url = event.target.result;
        let img = new Image();
        img.src = img_url;
        let container = document.createElement('div');
        let forme = document.getElementById('forml');
        forme.appendChild(container);
        
        //ao carregar a imagem, criar um canvas para compressão, mantendo a proporção da imagem
        img.onload = (e) =>{
          console.log('AQUI A RESOLUÇÃO DA IMAGEM '+e.target.naturalWidth+'x'+e.target.naturalHeight);
            let orgWidth = e.target.naturalWidth;
            if(orgWidth<=newWidth){
              newWidth = orgWidth;
            }
            let canvas = document.createElement('canvas');
            let ratio = newWidth / e.target.width;
            canvas.width = newWidth;
            canvas.height = e.target.height * ratio;
            const context = canvas.getContext('2d');
            context.drawImage(img, 0, 0, canvas.width, canvas.height);
            container.appendChild(img);
            //transforma o conteúdo do canvas em arquivo/blob
                canvas.toBlob(function createBlob(blob){
                    console.log(blob);
                    console.log(blob.size);
                    const fr = new FileReader();
                    fr.readAsDataURL(blob);
                    fr.addEventListener('load', ()=>{
                        const dataURL = fr.result;
                        console.log(dataURL);
                        let base64 = dataURL.substring(dataURL.indexOf(',')+1);
                        //salva o blob em base64 para envio ao servidor
                        let hidden = document.createElement('input');
                        hidden.type='hidden';
                        hidden.name='dataURL".$order."';
                        hidden.value=base64;
                        document.getElementById('forml').appendChild(hidden);
                        //nova imagem comprimida
                        let img2 = new Image();
                        img2.src = dataURL;
                        container.appendChild(img2);
                        console.log(img_input".$order.".files[0]);
                        img_name = img_input".$order.".files[0].name;
                        //substitui a imagem pela comprimida no input
                        let newfile = new File([blob], img_name,{
                        type:'jpeg',
                        lastModified:new Date().getTime()});
                        let containfile = new DataTransfer();
                        containfile.items.add(newfile);
                        console.log(containfile.files[0]);
                        console.log('vamo pau no có'+containfile);
                        img_input".$order.".files = containfile.files;
                    });
                    let link = document.createElement('a');
                    link.download = 'image.jpeg';
                    link.href = URL.createObjectURL(blob);
                    link.textContent += 'Download Comprimido';
                    document.getElementById('forml').appendChild(link);
                }, 'image/jpeg',1);
        }
    }
});
</script>
</div>";
  }
  else{
    $return .= '</div>';
  }
  return $return;
}
return "<div class='form-group'><label for='img".ucfirst($label)."' ".((isset($style) and $style!=null)?('class=text-'.$style):'').">".$tag.":</label>
<input type='file' accept='image/*' capture class='form-control' name='".$label."' id='img".ucfirst($label)."' ".(($required==true)?"required":'').((!empty($placeholder))?"placeholder='".$placeholder."'":'')."/>
</div>
<script>
//definir largura da imagem comprimida
var newWidth = 800;
//seleciona o input da imagem
let img_input".$order." = document.getElementById('img".ucfirst($label)."');
//executa função ao mudar o input (enviar arquivo)
img_input".$order.".addEventListener('change', (e) => {
    //arquivo enviado
    let img_file = e.target.files[0];
    console.log(e.target.files);
    //leitor de arquivo
    let reader = new FileReader;
    reader.readAsDataURL(img_file);
    //ler o arquivo ao carregar a página, e executar a função
    reader.onload = (event) => {
        //url da imagem
        let img_url = event.target.result;
        let img = new Image();
        img.src = img_url;
        let container = document.createElement('div');
        let forme = document.getElementById('forml');
        forme.appendChild(container);
        
        //ao carregar a imagem, criar um canvas para compressão, mantendo a proporção da imagem
        img.onload = (e) =>{
          console.log('AQUI A RESOLUÇÃO DA IMAGEM '+e.target.naturalWidth+'x'+e.target.naturalHeight);
            let orgWidth = e.target.naturalWidth;
            if(orgWidth<=newWidth){
              newWidth = orgWidth;
            }
            let canvas = document.createElement('canvas');
            let ratio = newWidth / e.target.width;
            canvas.width = newWidth;
            canvas.height = e.target.height * ratio;
            const context = canvas.getContext('2d');
            context.drawImage(img, 0, 0, canvas.width, canvas.height);
            container.appendChild(img);
            //transforma o conteúdo do canvas em arquivo/blob
                canvas.toBlob(function createBlob(blob){
                    console.log(blob);
                    console.log(blob.size);
                    const fr = new FileReader();
                    fr.readAsDataURL(blob);
                    fr.addEventListener('load', ()=>{
                        const dataURL = fr.result;
                        console.log(dataURL);
                        let base64 = dataURL.substring(dataURL.indexOf(',')+1);
                        //salva o blob em base64 para envio ao servidor
                        let hidden = document.createElement('input');
                        hidden.type='hidden';
                        hidden.name='dataURL".$order."';
                        hidden.value=base64;
                        document.getElementById('forml').appendChild(hidden);
                        //nova imagem comprimida
                        let img2 = new Image();
                        img2.src = dataURL;
                        container.appendChild(img2);
                        console.log(img_input".$order.".files[0]);
                        img_name = img_input".$order.".files[0].name;
                        //substitui a imagem pela comprimida no input
                        let newfile = new File([blob], img_name,{
                        type:'jpeg',
                        lastModified:new Date().getTime()});
                        let containfile = new DataTransfer();
                        containfile.items.add(newfile);
                        console.log(containfile.files[0]);
                        console.log('vamo pau no có'+containfile);
                        img_input".$order.".files = containfile.files;
                    });
                    let link = document.createElement('a');
                    link.download = 'image.jpeg';
                    link.href = URL.createObjectURL(blob);
                    link.textContent += 'Download Comprimido';
                    document.getElementById('forml').appendChild(link);
                }, 'image/jpeg',1);
        }
    }
});
</script>";
//"' alt='".(isset($alt)?$alt:"imagem'").
}

function manufactureComponentForm($userReceivedDatarow){
  if(!isset($userReceivedDatarow['typeform'])){
    return;
  }
 
  $definefunction="manufactureComponentFormInput".capitalFirstLetterTreatment($userReceivedDatarow['typeform']);

  if(function_exists($definefunction)){

    return call_user_func($definefunction, $userReceivedDatarow);

  }
  
 

}

function manufactureComponentFormPrint($linksystem, $controller, $method, $form){

  $return="<form enctype='multipart/form-data' id='forml' action='".((isset($linksystem))?($linksystem."/".$controller."/".$method):'')."' method='post'>";

  foreach ($form as $key => $value) {
      $return.=$value;
  }

  return $return."</form>";
}
