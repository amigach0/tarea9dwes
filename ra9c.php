<!DOCTYPE html>
<html>
<!-- Cabecera de la página web -->
<head>
	<!-- Codificación de caracteres UTF-8 -->
	<meta charset="UTF-8">
	<!-- Título de la página web -->
	<title>Tarea 9 - Generación Dinámica de Páginas Web Interactivas</title>
	<!-- Encabezado de nivel 1 -->
	<center><h1>GENERADOR ALEATORIO DE USUARIOS</h1></center>
	<!-- Referencia a la hoja de estilos que utiliza la página -->
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<!-- Cuerpo de la página web -->
<body>
	<?php
		//Llamada a la API que genera usuarios aleatorios
		$json=file_get_contents("https://randomuser.me/api/");
		//Se decodifican los datos obtenidos del usuario aleatorio y se almacenan en un array
		$datos=json_decode($json, true);
		//Si el género del usuario aleatorio es "male"
		if($datos["results"][0]["gender"] == "male"){
			//A la variable $genero se le asigna el valor "Masculino"
			$genero = "Masculino";
		}
		//En caso contrario, el género del usuario aleatorio es "female"
		else {
			//A la variable $genero se le asigna el valor "Femenino"
			$genero ="Femenino";
		}
		//Se muestran algunos datos del usuario aleatorio obtenido de la API
		echo "<b>Género:</b> " . $genero . "<br>";
		echo "<b>Nombre:</b> " . $datos["results"][0]["name"]["first"] . "<br>";
		echo "<b>Apellidos:</b> " . $datos["results"][0]["name"]["last"] . "<br>";
		echo "<b>Domicilio:</b> " . $datos["results"][0]["location"]["street"]["name"] . " " . $datos["results"][0]["location"]["street"]["number"] . "<br>";
		echo "<b>Ciudad:</b> " . $datos["results"][0]["location"]["city"] . "<br>";
		echo "<b>Código Postal:</b> " . $datos["results"][0]["location"]["postcode"] . "<br>";
		echo "<b>Estado:</b> " . $datos["results"][0]["location"]["state"] . "<br>";
		echo "<b>Teléfono:</b> " . $datos["results"][0]["phone"] . "<br>";
		echo "<b>Móvil:</b> " . $datos["results"][0]["cell"] . "<br><br><br>";
		//Se almacena la ruta de la foto del usuario en una variable
		$ruta_foto = $datos["results"][0]["picture"]["large"];
		//Se muestra la foto del usuario
		echo "<img src=" . $ruta_foto . "><br><br><br>";
	?>
	<!-- Pie de la página -->
	<footer>
		(C) 2022 - Miguel Angel Rico Márquez
	</footer>
</body>
</html>
