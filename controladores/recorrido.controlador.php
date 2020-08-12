<?php

Class ControladorRecorrido{

	/*=============================================
	Mostrar Recorrido
	=============================================*/

	static public function ctrMostrarRecorrido(){

		$tabla = "recorrido";

		$respuesta = ModeloRecorrido::mdlMostrarRecorrido($tabla);

		return $respuesta;

	}

}