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
	<link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css' rel='stylesheet' />
	<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/stylesgo.css">
	<!--[if lt IE 9]>
	<script src="<?php echo $linksystem; ?>/assets/standard/js/html5shiv.js"></script>
	<script src="<?php echo $linksystem; ?>/assets/standard/js/respond.min.js"></script>
	<![endif]-->
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

	</style>
</head>

<body>
	<!-- Fixed navbar -->
	<div class="container">

        <div class='col-lg-4 col-lg-offset-4 my_login'>
			<a href="<?php echo $linksystem; ?>/">
					<img src="<?php echo $linksystem; ?>/assets/images/brasao.png" alt="LOGO REDE FAMILIA RIOGRANDINA"></a>

        <?php
			
              if(isset($systemContainer)) echo manufactureComponentAlert('danger',  $errorMessage);

			  
			  
            ?>
        
        </div> 
		
    </div> <!-- /container -->
	
</body>

</html>
	