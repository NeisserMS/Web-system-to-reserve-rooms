<?php

Class ControladorRestaurante{

	/*=============================================
	Mostrar Restaurante
	=============================================*/

	static public function ctrMostrarRestaurante(){

		$tabla = "restaurante";

		$respuesta = ModeloRestaurante::mdlMostrarRestaurante($tabla);

		return $respuesta;

	}

}