<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="REDE FAMILIA RIO GRANDINA">
	<meta name="author" content="webThemez.com">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>REDE FAMILIA RIO GRANDINA - BY PMRG</title>
	<link rel="shortcut icon" type="image/x-icon"  href="<?php echo $linksystem; ?>/assets/images/favicon.ico">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/style.css">	
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/stylesacesso.css">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/stylesgo.css">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/stylesgomvc.css">
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/jquery-ui.css">
	<link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css' rel='stylesheet' />	
	<script src="<?php echo $linksystem; ?>/assets/standard/js/jquery.min.js"></script>	
	<script src="<?php echo $linksystem; ?>/assets/standard/js/html5shiv.js"></script>
	<script src="<?php echo $linksystem; ?>/assets/standard/js/respond.min.js"></script>
	<script type="text/javascript" src="<?php echo $linksystem; ?>/assets/standard/js/loader.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
	
	
</head>

<body>

	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<div class='col-sm-12'>
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-custom navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<a class="navbar-brand" href="<?php echo $linksystem; ?>/">
					<img class='logo' src="<?php echo $linksystem; ?>/assets/images/brasao.png" alt="LOGO REDE FAMILIA RIOGRANDINA"></a>
</div>
			</div>
			<!--<div class='col-sm-12'> -->
			<div class="navbar-collapse collapse">
<?php
				/* localização do menu superior*/
                    if(isset($menuSystemContainer)and(!empty($menuSystemContainer))) echo $menuSystemContainer;                    
?>
			</div>
			<BR>
<!--</div>-->
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<header id="head" class="secondary hidden-print">
		<div class="container">
			<div class="row">
				  <div class="col-sm-12"> 
				  <h3 class='text-right'><?php echo $credentials['ServidorNickname']; ?></h3>
				  <p class='text-right'><?php echo $credentials['Secretary']; ?></p>
				  <p class='text-right'><?php echo $credentials['Area']; ?></p>
				  <p class='text-right'><?php echo $credentials['Setor']; ?></p>
                </div>
			</div>
		</div>
	</header>
	<div id="heading" class="container">
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
		x.innerHTML='<h3 class=\'section-title alert alert-danger text-center\'>Favor ativar o GPS e dar permissão para sua localização, caso contrario, algumas ações serão bloqueadas.</h3>';
		document.getElementById('submit').onclick = function() {
			this.disabled = true;
		}
		document.getElementById('submitreturn').onclick = function() {
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
	 <p id='status'></p>
	 <script>
const checkOnlineStatus = async () => {  
	try {    const online = await fetch("<?php echo $linksystem; ?>/api/");    
		return online.status >= 200 && online.status < 300; // either true or false 
 } catch (err) { 
	   return false; // definitely offline 
 }};

setInterval(async () => {  
	const result = await checkOnlineStatus();  
	const statusDisplay = document.getElementById("status");  
	statusDisplay.innerHTML = result ? "" : "<h3 class=\'section-title alert alert-danger text-center\'>ALERTA:  Sistema esta <strong>Offline</strong>!</h3>";
}, 5000); // probably too often, try 30000 for every 30 seconds

		</script>
       
		<?php
		if(!empty($errorMessage)){
			
              echo "<div class='alert alert-danger text-center'><h3>".$errorMessage."</h3></div>";

		}
		
	/*	if(isset($systemErrorMessage) and !empty($systemErrorMessage)){
			echo "<div class='alert alert-danger text-center'><h3>".treatmentString($systemErrorMessage)."</h3></div>";
		}*/
        
		if(isset($systemContainer)and(!empty($systemContainer))) echo $systemContainer;		
        ?>
		
	</div>
	
	
	<footer id="footer">
		<div class="footer2">
			<div class="container">
				<div class="row">

					<div class="col-md-6 panel">
						<div class=hidden>
						<?php
                         /*    echo "Session<pre>";
						     var_dump($varSession);
							 echo "</pre></br>";

							 echo "Session::<pre>";
						     var_dump($_SESSION);	
							 echo "</pre></br>";
							 echo "Cookie<pre>";
						     var_dump($varCookie);
							 echo "</pre></br>
						     Data:".$currentTime;*/
						 ?>
</div>
						<div class="panel-body">
							<p class="simplenav hidden-print">
							
							</p>
						</div>
					</div>

					<div class="col-md-6 panel">
						<div class="panel-body">
							<p class="text-right hidden-print">
								Copyright &copy; 2023.  <a href="https://riogrande.atende.net/cidadao" target="_blank">PREFEITURA MUNICIPAL DO RIO GRANDE</a> - Desenvolvedor Moraes.
							</p>
						</div>
					</div>

				</div>
				<!-- /row of panels --></div>
		</div>
	</footer>




	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="<?php echo $linksystem; ?>/assets/standard/js/bootstrap.min.js"></script>
	<script src="<?php echo $linksystem; ?>/assets/standard/js/validator.min.js"></script>
	<script src="<?php echo $linksystem; ?>/assets/standard/js/gaintime.br-validator.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
</body>
</html>
