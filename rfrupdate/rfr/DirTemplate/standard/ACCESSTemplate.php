<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="REDE FAMILIA RIOGRANDINA">
	<meta name="author" content="webThemez.com">
	<title>REDE FAMILIA RIOGRANDINA - BY PMRG</title>
	<link rel="shortcut icon" type="image/x-icon"  href="<?php echo $linksystem; ?>/assets/images/favicon.ico">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/style.css">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/jquery-ui.css">
	
	<script src="<?php echo $linksystem; ?>/assets/standard/js/html5shiv.js"></script>
	<script src="<?php echo $linksystem; ?>/assets/standard/js/respond.min.js"></script>
	
	<style type="text/css">
	body{
	background:#f0f0f0;}
	.my_login{
	background:#ffffff;
	margin-top:10rem;
	padding:2rem;
	border-radius:1rem;
	box-shadow: 4px 4px 20px -4px rgba(0,0,0, .1);
	}
	.btn-login:hover {background:#2b374f; color:#fff;}
	
	.cinza{
		background: RGB(220,220,220);
	  border: solid 1px RGB(211,211,211);
	  text-align:center;
	 
	}
	.encapsulador{
      display:block;
	  position: relative;
	  padding-right: 15px;
	  margin-top: 10px;
	  margin-bottom:10px;
	  cursor: pointer;
	  background: RGB(220,220,220);
	  border: none;
	  width: 100%;

	}

	.encapsulador input[type=checkbox]{
		opacity: 0;
		position: absolute;
		cursor: pointer;
	}

	.validador{
   left: 0;
   top:0;
   width: 20px;
   height: 20px;
   background: RGB();
   position: absolute;
	}

	.encapsulador input:checked ~ .validador{
		background: RGB(220,220,220);
		border-radius: 25%;
	}

	.encapsulador .validador:after{
		top:5px;
		left:9px;
		width:5px;
		height:10px;
		border: solid #2b374f;
		border-width: 0 3px 3px 0;
		-webkit-transform:	rotate(45deg);
		-ms-transform: rotate(45deg);
		transform: rotate(45deg);
	}

	.validador:after{
		content:'';
		position: absolute;
		display: none;
	} 

	.encapsulador input:checked ~ .validador:after{
		display:block;
	}

	b {
		cursor: pointer;
	}
	</style>
	

	
</head>

<body>
	<!-- Fixed navbar -->
	<div class="container">
	

    <form action="<?php echo $linksystem; ?>/login/logon" method='post' class='col-lg-4 col-lg-offset-4 my_login'>
	<a href="<?php echo $linksystem; ?>/">
					<img src="<?php echo $linksystem; ?>/assets/images/brasao.png" alt="LOGO MAPA SOLIDÁRIO"></a>
			
		  <p id='demo'></p>
	<script type='text/javascript'>
	 var x=document.getElementById('demo');
			window.onload = function () { 
	 
			   if (navigator.geolocation)
				   {
				   navigator.geolocation.getCurrentPosition(showPosition, showError);
				   }
				 else{x.innerHTML='O seu navegador não suporta Geolocalização.';}
				}

				 function showPosition(position)
	{
	$('input[name=latitude]').val(position.coords.latitude);
	$('input[name=longitude]').val(position.coords.longitude);
	$('input[name=accuracy]').val(position.coords.accuracy);
	}

	function showError(error)
	{
	switch(error.code)
	  {
	  case error.PERMISSION_DENIED:
		x.innerHTML='<h5 class=\'section-title alert alert-danger \'>Envio de Formulário Bloqueado! <br>Favor ativar GPS e autorizar a localização, após reatuAlizar a página, para desbloqueio do login. </h5>';
		document.getElementById('submit').onclick = function() {
			this.disabled = true;

		}
		
		break;
	  case error.POSITION_UNAVAILABLE:
		x.innerHTML='Localização indisponível.';
		$('input[name=error]').val('Localizacao indisponivel.');
		break;
	  case error.TIMEOUT:
		x.innerHTML='A requisição expirou.';
		$('input[name=error]').val('A requisicao expirou.');
		break;
	  case error.UNKNOWN_ERROR:
		x.innerHTML='Algum erro desconhecido aconteceu.';
		$('input[name=error]').val('Algum erro desconhecido aconteceu.');
		break;
	  }
	}
	 </script>
		<?php
		
		if(isset($_SESSION["MsgError"])and (!empty($_SESSION["MsgError"]))){

			echo "<div class='alert alert-danger text-center'>".filteringVar($_SESSION["MsgError"], 'integer')."</div>";						

		 }

		if(isset($_SESSION['ErrorCount'])){

			echo "<div class='alert alert-danger text-center'> TENTATIVA 0".filteringVar($_SESSION['ErrorCount'], 'integer')." de 03</div>"; 

		} 
		
		?>	
		<script>
			function visiblepassword(){
				
				var inputPass = document.getElementById('inputPassword');
				var btnvisible = document.getElementById('btnvisiblepassword');

			

				if(inputPass.type === 'password'){

					inputPass.setAttribute('type', 'text');
					btnvisible.classList.replace('fa-eye', 'fa-eye-slash');					

				}else{
					
					inputPass.setAttribute('type', 'password');
					btnvisible.classList.replace('fa-eye-slash', 'fa-eye');
				
				}
				
			}
		</script>
		<input type='hidden' name='latitude' id='latitude'>
		<input type='hidden' name='longitude' id='longitude'>
		<input type='hidden' name='error' id='error'>
		<input type='hidden' name='accuracy' id='accuracy'>
        <input type='text' id='inputlogin' name='login' class='form-control' placeholder='Login' required autofocus autocomplete='off'>
        <label for='inputPassword' class='sr-only'>Senha</label>
        <div class="input-group">
		<input type='password' id='inputPassword' name='password' class='form-control' placeholder='Senha' required autocomplete='off'>
		<span class="input-group-addon alert-info" id="basic-addon1"><b class='fa fa-eye fa-lg' id='btnvisiblepassword' onclick="visiblepassword()"></b></span>
		
		</div>
<?php

       if(isset($_SESSION['ErrorCount'])){
			echo "<div class='col-sm-12 cinza'><label class='encapsulador'><input type='checkbox' required><span class='validador'></span><small>EU NÃO SOU UM ROBÔ!</small></label></div>";
       }	
?>        <div>
	    <input type=submit class='btn btn-login btn-block' id='submit' value='Enviar'>
	</div>
      </form>
	  
</div> <!-- /container -->
		
			
	



		<script src="<?php echo $linksystem; ?>/assets/standard/js/jquery.min.js"></script>
		<script src="<?php echo $linksystem; ?>/assets/standard/js/bootstrap.min.js"></script>
		<script src="<?php echo $linksystem; ?>/assets/standard/js/custom.js"></script>
		<script src="<?php echo $linksystem; ?>/assets/standard/js/validator.min.js"></script>
	</body>
	</html>
	