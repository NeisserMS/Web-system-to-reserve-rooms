<?php

require_once "conexion.php";

Class ModeloHabitaciones{

	/*=============================================
	MOSTRAR CATEGORIAS-HABITACIONES CON INNER JOIN
	=============================================*/

	static public function mdlMostrarHabitaciones($tabla1, $tabla2, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id = $tabla2.tipo_h WHERE ruta = :ruta");

		$stmt -> bindParam(":ruta", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Habitacion Singular
	=============================================*/

	static public function mdlMostrarHabitacion($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_h = :id_h");

		$stmt -> bindParam(":id_h", $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	
	}



}