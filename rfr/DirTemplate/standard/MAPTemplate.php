<!DOCTYPE html>
<html lang="en">
<head>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>REDE FAMILIA RIOGRANDINA - PMRG</title>
	
	<link rel="shortcut icon" type="image/x-icon"  href="<?php echo $linksystem; ?>/assets/standard/images/favicon.ico">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src='<?php echo $linksystem; ?>/assets/standard/js/leaflet.rotatedMarker.js'></script>
    
    
	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
.legend { text-align: left; line-height: 14px; color: #555; } .legend i { width: 14px; height: 14px; float: left; margin-right: 8px; opacity: 0.7; }
.rotulo {
  position: absolute;
  display: flex;
  flex-direction: column;
  text-align: center;
  order: 1;
  background-color: transparent;
  border-style: none;
  border-color: transparent;
  white-space: nowrap;
  font: 14px/16px Arial, Helvetica, sans-serif;
  font-weight: bold;
  text-shadow: 1px 2px #ffffff;
}
.info { max-width: 300px;padding: 4px 6px; font: 12px/14px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } .info h4 { margin: 0 0 5px; color: #777; } .info h5 { margin: 0 0 3px; color: #777;} .info h6 { text-align: justify; font-style: italic; font-size: 10px; margin: 0 0 1px; color: #CC0000;}
.labelegend {margin: 0 0 3px; color: #777; }
.bordertable {
     width:100%;
     text-align: center;
     border: 1px solid black;
     border-collapse: collapse;
}
.brasao {max-width: 200px;max-height: 45px;}
.logo_map {max-height: 45px;}
.taxa{font-size: 12px; font-style:bold;}
.ntaxa{font-size: 12px; font-style:bold; color:#CC0000;}
.statusgreen{
    border-radius: 10%;
   padding: 4px 6px; 
   color: white;
background-color: green;
}

.statusred{
    border-radius: 10%;
   padding: 4px 6px; 
   color: white;
background-color: red;
}

.statusyellow{
    border-radius: 10%;
   padding: 4px 6px; 
   color: black;
   font-weight: bold;
background-color: yellow;
}

</STYLE><style>body { padding: 0; margin: 0; } #map { height: 100%; width: 100vw; }</style> 
</head>
<body>
<div id='map'></div>
<link rel="stylesheet" href="<?php echo $linksystem; ?>/assets/standard/css/L.Control.Layers.Tree.css" crossorigin=""/>
    <script src="<?php echo $linksystem; ?>/assets/standard/js/L.Control.Layers.Tree.js"></script>
    <script src="<?php echo $linksystem; ?>/assets/standard/js/leaflet-heat.js"></script>

<script>
        <?php
  if(isset($systemContainer)and(!empty($systemContainer))) echo $systemContainer;
  ?>	
  </script>



</body>
</html>