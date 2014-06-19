<!DOCTYPE html>
<HTML>
	<head>
		<title><?php echo $titulo ?> - Donación de sangre en Córdoba</title>
		<?php 
		/*En función del controlador y la función que utilicemos, la posicion relativa cambiará, por lo que basandonos en
		 * el título de la página, modificaremos la variable $ruta, que es la que usaremos para construir las mismas*/
			if($titulo=="Ficha" || $titulo== "Crear Ficha" )
				$ruta="../../";
			else if($titulo=="Administración Realizada")
				$ruta="../";
			else
				$ruta="";
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo $ruta;?>../style/style.css" media="screen" />
		<meta charset="UTF-8" />
		<?php if ($titulo == "Ficha" || $titulo =="Home"){echo $map['javascript'];}?>
	</head>
	<body>
	<div id="header">
		<div id="logo">
			<embed width = "50px" height="50px" src="<?php echo$ruta;?>../img/logocordoba.svg"/>
		</div>
		
		<div id="menu">
			<ul>
				<li><a href="<?php echo$ruta;?>home">Home</a></li>
				<li><a href="<?php echo$ruta;?>cita">Cita</a></li>
				<li><a href="<?php echo$ruta;?>estadistica">Estadística</a></li>
				<li><a href="<?php echo$ruta;?>administrar">Administrar</a></li>
				<li><a href="<?php echo$ruta;?>about">About</a></li>
			</ul>
		</div>
	</div>