<?php

Class ControladorCategorias{

	/*=============================================
	Mostrar Categorias
	=============================================*/

	static public function ctrMostrarCategorias(){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla);

		return $respuesta;

	}

	/*=============================================
	Mostrar Categoría Singular
	=============================================*/
	
	static public function ctrMostrarCategoria($valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategoria($tabla, $valor);

		return $respuesta;

	}

}