<?php

function passwordForm($link, $linksystem, $controller, $method, $credentials, $userData){
    $mount=manufactureComponentPageBodyTitle('ALTERAR A SENHA', NULL, NULL).
          "<form  id='AltSenha' action='".((isset($linksystem))?($linksystem."/".$controller."/".$method):'')."' method='post'>".
          manufactureComponentFormInputHidden(array('label'=>'id', 'value'=>$credentials['IdServidor'])).
          manufactureComponentFormInputPassword(array('tag'=>'INSIRA A SENHA ATUAL', 'label'=>'password', 'minimum'=>2,'maximum'=>20,'required'=>true), 'validaSenhaAtual').
          manufactureComponentFormInputPassword(array('tag'=>'INSIRA A NOVA SENHA', 'label'=>'newpassword','minimum'=>8,'maximum'=>20,'required'=>true),'validaSenhaForca').
          manufactureComponentFormInputPassword(array('tag'=>'REPITA A NOVA SENHA', 'label'=> 'repeatpassword','minimum'=>8, 'maximum'=>20, 'required'=>true),'validaRepeat').
          (($controller!='login')?manufactureComponentFormInputHidden(array('label'=>'typeaction','value'=>'password')):'').
          "<div class='col-sm-12' ><p id='password-status'></p></div>".
          manufactureComponentFormInputButton(array('tag'=>'SALVE','label'=>'action','value'=>'save')).
          "         
          </form>
          <div class='col-sm-12'>
          <h5 class='alert alert-danger'>Orientação:</h5>
          <blockquote>A Senha deverá conter: <ul><li> - No mínimo oito(08) caracteres;</li><li> - No máximo vinte(20) caracteres;</li><li>- Letra(s) Maiuscula(s);</li><li>- Letra(s) Minuscula(s);</li><li>- Número(s);</li><li>- Caracter(es) Especial(ais): *-_%#@?´|\/;</li></ul></blockquote>

          </div>

          <script>

          document.getElementById('submit').disabled = true;       
          var forca;

          function validaSenhaAtual(){

            var oldsenha = document.getElementById('password').value;

            if(oldsenha.length < 4){               
                document.getElementById('password-status').innerHTML = \"Preencha a senha atual!\";
                document.getElementById('submit').disabled = true;
            }else{
                document.getElementById('password-status').innerHTML = \"Senha atual preenchida!\";
            }

          }

          function validaSenhaForca(){

            var oldsenha = document.getElementById('password').value;
            var senha = document.getElementById('newpassword').value;
            var repeatsenha = document.getElementById('repeatpassword').value;
            forca = 0;           
        
                
            if(oldsenha.length < 4){               
                document.getElementById('password-status').innerHTML = \"Preencha a senha atual!\";
            }else{
                    if((senha.length >= 4) && (senha.length <= 7)){
                        forca += 10;
                    }else if(senha.length > 7){
                        forca += 25;
                    }
                
                    if((senha.length >= 8) && (senha.match(/[a-z]+/))){
                        forca += 10;
                    }
                
                    if((senha.length >= 8) && (senha.match(/[A-Z]+/))){
                        forca += 20;
                    }
                
                    if((senha.length >= 8) && (senha.match(/[@#$%&;*]/))){
                        forca += 20;
                    }

                    if((senha.length >= 10) && (senha.match(/[@#$%&;*]/))){
                        forca += 15;
                    }
                
                    if(senha.match(/[0-9]/)){
                        forca += 10;
                    }

                    if(oldsenha !== senha){
                      
                        if(forca < 80){
                            document.getElementById('submit').disabled = true;
                            document.getElementById('password-status').innerHTML = \"Senha fraca! Obrigatorio inserir Letras Maiusculas e minusculas e números na senha, com o mínimo de 8 caracteres.\";
                        }else{
                            document.getElementById('password-status').innerHTML = \"Senha Forte!\";
                        }   
                    }else{
                        document.getElementById('submit').disabled = true;
                        document.getElementById('password-status').innerHTML = \"Insira uma senha diferente da senha atual!\";
                    }
                }
                   
                
        }

        function validaRepeat(){

            var oldsenha = document.getElementById('password').value;
            var senha = document.getElementById('newpassword').value;
            var repeatsenha = document.getElementById('repeatpassword').value;

        if(oldsenha !== senha){
            if(forca >= 70){
                if(repeatsenha === senha){
                    document.getElementById('submit').disabled = false;
                    document.getElementById('password-status').innerHTML = \"Liberado!\";
                }else{
                    document.getElementById('password-status').innerHTML = \"A confirmação da senha, não confere com a nova senha inserida!\";
                }
            }else{
                document.getElementById('password-status').innerHTML = \"Senha fraca! Obrigatorio inserir Letras Maiusculas e minusculas e números na senha, com o mínimo de 8 caracteres.\";
            }

        }else{
            document.getElementById('password-status').innerHTML = \"Insira uma senha diferente da senha atual!\";
        }
                 
    }

       

      
          </script>
         ";
          
        
    return manufactureComponentContainer(6, $mount);

 }