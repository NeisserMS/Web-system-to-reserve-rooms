<?php

require_once "conexion.php";

Class ModeloRestaurante{

	/*=============================================
	mostrar Restaurante
	=============================================*/
	
	static public function mdlMostrarRestaurante($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}