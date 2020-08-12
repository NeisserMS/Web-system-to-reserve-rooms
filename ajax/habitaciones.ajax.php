<?php

require_once "../controladores/habitaciones.controlador.php";
require_once "../modelos/habitaciones.modelo.php";


class AjaxHabitaciones{

	public $ruta;

	public function ajaxTraerHabitacion(){

		$valor = $this->ruta;

		$respuesta = ControladorHabitaciones::ctrMostrarHabitaciones($valor);

		echo json_encode($respuesta);

	}

}

if(isset($_POST["ruta"])){

	$ruta = new AjaxHabitaciones();
	$ruta -> ruta = $_POST["ruta"];
	$ruta -> ajaxTraerHabitacion();

}

