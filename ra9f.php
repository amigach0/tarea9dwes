<!DOCTYPE html>
<html>
<!-- Cabecera de la página web -->
<head>
	<!-- Carga de la biblioteca de JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<!-- Codificación de caracteres UTF-8 -->
	<meta charset="UTF-8">
	<!-- Título de la página web -->
	<title>Tarea 9 - Generación Dinámica de Páginas Web Interactivas</title>
	<!-- Encabezado de nivel 1 -->
	<center><h1>BUSCADOR DE AUTORES Y LIBROS</h1></center>
	<!-- Referencia a la hoja de estilos que utiliza la página -->
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<!-- Script que pasa el conjunto de teclas pulsadas en el campo "texto" como parámetro a la API "api.php" -->
	<script>
		$(document).ready(function(){
			$("#texto").keyup(function(){
				$("#resultados").load("api.php?q=" + $("#texto").val());
			});
		});
	</script>
</head>
<!-- Cuerpo de la página web -->
<body>
	<!-- Se crea el formulario de búsqueda -->
	<form> 
	<!-- Cada vez que se teclea algo en el campo "texto" se ejecuta el script que carga "api.php" -->
	Introduzca el texto a buscar: <input type="text" id="texto" pattern="[A-Za-z].{1,}">
	</form>
	<!-- En el elemento span con id="resultados" se muestran las coincidencias con los autores y los libros -->
	<p><br><span id="resultados" style="color: #334fff;"></span></p><br><br><br>
	<!-- Se muestra el pie de página -->
	<footer>
		(C) 2022 - Miguel Angel Rico Márquez
	</footer>
</body>
</html>
