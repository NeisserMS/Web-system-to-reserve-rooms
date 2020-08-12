<?php

Class ControladorPlanes{

	/*=============================================
	Mostrar Planes
	=============================================*/

	static public function ctrMostrarPlanes(){

		$tabla = "planes";

		$respuesta = ModeloPlanes::mdlMostrarPlanes($tabla);

		return $respuesta;

	}

}