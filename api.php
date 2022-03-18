<?php
// Esta API ofrece las siguientes posibilidades:
// - Mostrar una lista de autores. 
// - Mostrar la información de un autor específico.
// - Mostrar una lista de libros.
// - Mostrar la información de un libro específico.


/**
* Función que obtiene una lista de autores de la base de datos MySQL.
* @param No recibe parámetros.
* @return $lista_autores Array con los datos de los autores obtenidos de la base de datos.
*/
//Función que muestra una lista de autores
function get_lista_autores(){
    //Se realiza la conexión con la base de datos
	$conexionBD = @new mysqli("localhost", "miguelon", "Miguelon#123", "Libros");
	//Si la conexión se ha realizado correctamente
	if (!$conexionBD->connect_error) {
		//Se carga el charset correspondiente para la base de datos
		$conexionBD->set_charset("utf8");
		//Se crea la consulta para recorrer la tabla "autor"
		$consultaAutores = "SELECT * FROM autor";
		//Si la consulta de los autores ha generado algún resultado
		if ($resultadoAutores = $conexionBD->query($consultaAutores)) {
			//Se crea un array vacío donde se almacenarán las distintas filas generadas en la consulta
			$lista_autores = array();
			//Se recorren las filas contenidas en el resultado de la consulta
			while($filaAutor = $resultadoAutores->fetch_assoc()) {
				//Se añade el contenido de la fila actual al array "lista_autores" como array asociativo
				array_push($lista_autores,$filaAutor);
			}
		}
	}
	//Se libera el resultado de la consulta	de los autores
	$resultadoAutores->free();
	//Se cierra la conexión con la base de datos
	$conexionBD->close();
	//Se devuelve el array con la lista de autores
    return $lista_autores;
}


/**
* Función que obtiene los datos de un autor específico y los libros que ha escrito.
* @param string $id que contiene el identificador del autor que se quiere buscar.
* @return array $info_autor que contiene los datos del autor y sus libros.
*/
//Función que muestra la información de un autor específico, en función del parámetro "$id" que se reciba
function get_datos_autor($id){
    //Se realiza la conexión con la base de datos
	$conexionBD = @new mysqli("localhost", "miguelon", "Miguelon#123", "Libros");
	//Si la conexión se ha realizado correctamente
	if (!$conexionBD->connect_error) {
		//Se carga el charset correspondiente para la base de datos
		$conexionBD->set_charset("utf8");
		//Se crea la consulta para recorrer la tabla "autor"
		$consultaAutor = "SELECT * FROM autor WHERE id='$id'";
		//Si la consulta del autor ha generado algún resultado
		if ($resultadoAutor = $conexionBD->query($consultaAutor)) {
			//Se crea un array vacío donde se almacenarán los datos del autor
			$info_autor["datos"] = array();
			//Se recorren las filas contenidas en el resultado de la consulta
			while ($fila = $resultadoAutor->fetch_assoc()){
				//Se añade el contenido de la fila actual al array "info_autor["datos"]" como array asociativo
				array_push($info_autor["datos"],$fila);
			}
			//Se crea la consulta para recorrer la tabla "libro"
			$consultaLibros = "SELECT * FROM libro WHERE id_autor='$id'";
			//Si la consulta de los libros ha generado algún resultado
			if ($resultadoLibros = $conexionBD->query($consultaLibros)) {
				//Se crea un array vacío donde se almacenarán los datos de los libros
				$info_autor["libros"] = array();
				//Se recorren las filas contenidas en el resultado de la consulta
				while($filaLibro = $resultadoLibros->fetch_assoc()) {
					//Se añade el contenido de la fila actual al array "info_autor["libros"]" como array asociativo
					array_push($info_autor["libros"],$filaLibro);
				}
			}
		}
	}
	//Se libera el resultado de la consulta	del autor
	$resultadoAutor->free();
	//Se libera el resultado de la consulta de los libros asociados al autor
	$resultadoLibros->free();
	//Se cierra la conexión con la base de datos
	$conexionBD->close();
	//Se devuelve el array con el autor y sus libros
	return $info_autor;
}


/**
* Función que obtiene una lista de libros de la base de datos MySQL.
* @param No recibe parámetros.
* @return $lista_libros Array con los datos de los 1ibros obtenidos de la base de datos.
*/
//Función que obtiene una lista de libros
function get_lista_libros(){
    //Se realiza la conexión con la base de datos
	$conexionBD = @new mysqli("localhost", "miguelon", "Miguelon#123", "Libros");
	//Si la conexión se ha realizado correctamente
	if (!$conexionBD->connect_error) {
		//Se carga el charset correspondiente para la base de datos
		$conexionBD->set_charset("utf8");
		//Se crea la consulta para recorrer la tabla "libro"
		$consultaLibros = "SELECT * FROM libro";
		//Si la consulta de los libros ha generado algún resultado
		if ($resultadoLibros = $conexionBD->query($consultaLibros)) {
			//Se crea un array vacío donde se almacenarán las distintas filas generadas en la consulta
			$lista_libros = array();
			//Se recorren las filas contenidas en el resultado de la consulta
			while($filaLibro = $resultadoLibros->fetch_assoc()) {
				//Se añade el contenido de la fila actual al array "lista_libros" como array asociativo
				array_push($lista_libros,$filaLibro);
			}
		}
	}
	//Se libera el resultado de la consulta	de los libros
	$resultadoLibros->free();
	//Se cierra la conexión con la base de datos
	$conexionBD->close();
	//Se devuelve el array con la lista de libros
    return $lista_libros;
}


/**
* Función que obtiene los datos de un libro específico y su autor.
* @param string $id que contiene el identificador del autor que se quiere buscar.
* @return array $info_libro que contiene los datos del libro y su autor.
*/
//Función que muestra la información de un libro específico, en función del parámetro "$id" que se reciba
function get_datos_libro($id){
    //Se realiza la conexión con la base de datos
	$conexionBD = @new mysqli("localhost", "miguelon", "Miguelon#123", "Libros");
	//Si la conexión se ha realizado correctamente
	if (!$conexionBD->connect_error) {
		//Se carga el charset correspondiente para la base de datos
		$conexionBD->set_charset("utf8");
		//Se crea la consulta para recorrer la tabla "libro"
		$consultaLibro = "SELECT * FROM libro WHERE id='$id'";
		//Si la consulta del libro ha generado algún resultado
		if ($resultadoLibro = $conexionBD->query($consultaLibro)) {
			//Se crea un array vacío donde se almacenarán los datos del libro
			$info_libro["datos"] = array();
			//Se recorren las filas contenidas en el resultado de la consulta
			while ($fila = $resultadoLibro->fetch_assoc()){
				//Se añade el contenido de la fila actual al array "info_libro["datos"]" como array asociativo
				array_push($info_libro["datos"],$fila);
				//El valor del campo "id_autor" se almacena en la variable "$autor_id"
				//Con el valor de dicha variable se realizará la consulta en la tabla "autor"
				$autor_id = $fila["id_autor"];
			}
			//Se crea la consulta para recorrer la tabla "autor"
			$consultaAutor = "SELECT * FROM autor WHERE id='$autor_id'";
			//Si la consulta de los autores ha generado algún resultado
			if ($resultadoAutor = $conexionBD->query($consultaAutor)) {
				//Se crea un array vacío donde se almacenarán los datos del autor
				$info_libro["autor"] = array();
				//Se recorren las filas contenidas en el resultado de la consulta
				while($filaAutor = $resultadoAutor->fetch_assoc()) {
					//Se añade el contenido de la fila actual al array "info_libro["autor"]" como array asociativo
					array_push($info_libro["autor"],$filaAutor);
				}
			}
			
		}
	}
	//Se libera el resultado de la consulta	del libro
	$resultadoLibro->free();
	//Se libera el resultado de la consulta del autor asociado al libro
	$resultadoAutor->free();
	//Se cierra la conexión con la base de datos
	$conexionBD->close();
	//Se devuelve el array con el libro y su autor
	return $info_libro;
}


//***** CLIENTE.PHP *****
//Se comprueban los parámetros enviados por el cliente.php
if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL)) {
	//Se declaran las posibles URL que puede enviar el cliente.php
	$posibles_URL = array("get_lista_autores", "get_datos_autor", "get_lista_libros", "get_datos_libro");
	//Se declara una variable "$valor" que se devolverá al cliente.php, y se establece su valor inicial
	$valor = "Ha ocurrido un error";
	//Se compara el valor de la acción enviada por el cliente.php
	switch ($_GET["action"]) {
		//Acción para obtener la lista de autores
		case "get_lista_autores":
			$valor = get_lista_autores();
			break;
		//Acción para obtener los datos de un autor determinado y sus libros
		case "get_datos_autor":
			if (isset($_GET["id"]))
				$valor = get_datos_autor($_GET["id"]);
			else
				$valor = "Argumento no encontrado";
			break;
		//Acción para obtener la lista de libros
		case "get_lista_libros":
			$valor = get_lista_libros();
			break;
		//Acción para obtener los datos de un libro determinado y su autor
		case "get_datos_libro":
			if (isset($_GET["id"]))
				$valor = get_datos_libro($_GET["id"]);
			else
				$valor = "Argumento no encontrado";
			break;
			
	}
	//Se devuelven los datos serializados en JSON al cliente.php
	exit(json_encode($valor));
}


/**
* Código que realiza búsquedas de autores y libros en las tablas "autor" y "libro" de la base de datos.
* Si encuentra coincidencias, se muestran en pantalla.
* @param string "q", variable que se recupera mediante el método "$_GET", y contiene el autor y libro a buscar.
*/

//***** BUSCADOR.PHP *****
//Se comprueba el parámetro pasado por el fichero "ra9f.php"
if (isset($_GET["q"])){
	//Se asigna a la variable $cadena el valor del parámetro enviado por el buscador	
	$cadena = $_GET["q"];
	//Se establece el patrón de sólo caracteres para las búsquedas del título
	$patron = '/[A-Za-z]/';
	//Si el contenido de la cadena coincide con el patrón
	if (preg_match($patron,$cadena)){
		//Se establece la conexión con la base de datos
		$conexionBD = @new mysqli("localhost", "miguelon", "Miguelon#123", "Libros");
		//Se crean las variables $autores y $libros, que contendrán los autores y libros
		$autores = "<b><u>Autores:</u></b><br>";
		$libros = "<b><u>Libros:</u></b><br>";
		//Se crea la consulta para recorrer la tabla "autor"
		//Se seleccionan aquellos autores cuyo nombre o apellido contengan el valor de la variable $cadena, ordenados por nombre
		$consultaAutores = "SELECT * FROM autor WHERE (nombre LIKE '%$cadena%' OR apellidos LIKE '%$cadena%') ORDER BY nombre";
		//Si la consulta del autor ha generado algún resultado y no se ha generado error alguno
		if (($resultadoAutores = $conexionBD->query($consultaAutores)) && (!$conexionBD->error)) {
			//Se recorren las filas contenidas en el resultado de la consulta
			while ($fila = $resultadoAutores->fetch_assoc()){
				//Se añaden los campos "nombre" y "apellidos" de la fila actual a la variable $autores
				$autores = $autores . "<br>" . $fila["nombre"] . " " . $fila["apellidos"];
			}
			//Se crea la consulta para recorrer la tabla "libro"
			//Se seleccionan aquellos autores cuyo título contenga el valor de la variable $cadena, ordenados por título
			$consultaLibros = "SELECT * FROM libro WHERE titulo LIKE '%$cadena%' ORDER BY titulo";
			//Si la consulta de los libros ha generado algún resultado y no se ha generado error alguno
			if (($resultadoLibros = $conexionBD->query($consultaLibros)) && (!$conexionBD->error)) {
				//Se recorren las filas contenidas en el resultado de la consulta
				while($filaLibro = $resultadoLibros->fetch_assoc()) {
					//Se añade el campo "titulo" de la fila actual a la variable $libros
					$libros = $libros . "<br>" . $filaLibro["titulo"];
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
	//En caso contrario, el contenido de la cadena no coincide con el patrón
	else{
		//Si la variable $cadena no está vacía
		if ($cadena != ""){
			//Se asigna mensaje de advertencia a la variable $autores
			$autores = "<br>" . "Por favor, introduzca sólo caracteres";
		}
	}
	//Se muestra el contenido de las variables $autores y $libros
	echo $autores;
	echo "<br><br><br>";
	echo $libros;
}
?>
