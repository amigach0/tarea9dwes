<?php
/**
* Función que obtiene los datos de los autores y libros que coinciden con la variable $cadena que se pasa por parámetro.
* @param string $cadena que contiene el nombre y el titulo que se quieren buscar.
* @return array $info que contiene los datos de los autores y los libros encontrados.
*/
function autores_libros($cadena){
	//Se establece el patrón de sólo caracteres para las búsquedas del título
	$patron = '/[A-Za-z]/';
	//Si el contenido de la cadena coincide con el patrón
	if (preg_match($patron,$cadena)){
		//Se establece la conexión con la base de datos
		$conexionBD = @new mysqli("localhost", "miguelon", "Miguelon#123", "Libros");
				//Si la conexión con la base de datos se ha realizado correctamente
		if (!$conexionBD->connect_error){
			//Se carga el charset correspondiente para la base de datos
			$conexionBD->set_charset("utf8");
			//Se crea la consulta para recorrer la tabla "autor"
			//Se seleccionan aquellos autores cuyo nombre o apellido contengan el valor de la variable $cadena, ordenados por nombre
			$consultaAutores = "SELECT * FROM autor WHERE (nombre LIKE '%$cadena%' OR apellidos LIKE '%$cadena%') ORDER BY nombre";
			//Si la consulta del autor ha generado algún resultado y no se ha generado error alguno
			if (($resultadoAutores = $conexionBD->query($consultaAutores)) && (!$conexionBD->error)) {
				//Se crea un array vacío donde se almacenarán los nombres y los apellidos de los autores
				$info["autores"] = array();
				//Se recorren las filas contenidas en el resultado de la consulta
				while ($fila = $resultadoAutores->fetch_assoc()){
					//Se obtiene el nombre y el apellido del autor de la fila actual
					$nombreAutor = $fila["nombre"] . "" . $fila["apellidos"];
					//Se añade el contenido de la variable $nombreAutor al array "info["autores"]" como array asociativo
					array_push($info["autores"],$nombreAutor);
				}
				//Se crea la consulta para recorrer la tabla "libro"
				//Se seleccionan aquellos autores cuyo título contenga el valor de la variable $cadena, ordenados por título
				$consultaLibros = "SELECT * FROM libro WHERE titulo LIKE '%$cadena%' ORDER BY titulo";
				//Si la consulta de los libros ha generado algún resultado y no se ha generado error alguno
				if (($resultadoLibros = $conexionBD->query($consultaLibros)) && (!$conexionBD->error)) {
					//Se crea un array vacío donde se almacenarán los titulos de los libros
					$info["libros"] = array();
					//Se recorren las filas contenidas en el resultado de la consulta
					while($filaLibro = $resultadoLibros->fetch_assoc()) {
						//Se añade el titulo del libro de la fila actual al array "info["libros"]" como array asociativo
						array_push($info["libros"],$filaLibro["titulo"]);
					}
				}
			}
		}	
		//Se libera el resultado de la consulta	de los autores
		$resultadoAutores->free();
		//Se libera el resultado de la consulta de los libros
		$resultadoLibros->free();
		//Se cierra la conexión con la base de datos
		$conexionBD->close();
	}
	//Se devuelve el array con los autores y los libros
	return $info;
}
?>
