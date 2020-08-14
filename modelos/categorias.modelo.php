<?php

require_once "conexion.php";

Class ModeloCategorias{

	/*=============================================
	mostrar Categorias
	=============================================*/
	
	static public function mdlMostrarCategorias($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Categoria Singular
	=============================================*/

	static public function mdlMostrarCategoria($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id= :id");

		$stmt -> bindParam(":id", $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	
	}

}