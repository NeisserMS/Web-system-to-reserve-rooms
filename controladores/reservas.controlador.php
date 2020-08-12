<?php

Class ControladorReservas{

	/*=============================================
	Mostrar Reservas
	=============================================*/

	static public function ctrMostrarReservas($valor){

		$tabla1 = "habitaciones";
		$tabla2 = "reservas";
		$tabla3 = "categorias";

		$respuesta = ModeloReservas::mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor);

		return $respuesta;

	}


	/*=============================================
	Mostrar Código Reserva Singular
	=============================================*/
	
	static public function ctrMostrarCodigoReserva($valor){

		$tabla = "reservas";

		$respuesta = ModeloReservas::mdlMostrarCodigoReserva($tabla, $valor);

		return $respuesta;

	}

	/*=============================================
	Guardar Reserva
	=============================================*/
	
	static public function ctrGuardarReserva($valor){

		$tabla = "reservas";

		$respuesta = ModeloReservas::mdlGuardarReserva($tabla, $valor);

		if($respuesta != ""){

			$tablaTestimonios = "testimonios";

			$datos = array("id_res" => $respuesta,
						   "id_us" => $valor["id_usuario"],
						   "id_hab" => $valor["id_habitacion"],
						   "testimonio" => "",
						   "aprobado" => 0);

			$crearTestimonio = ModeloReservas::mdlCrearTestimonio($tablaTestimonios, $datos);

			return $crearTestimonio;
		}

	}

	/*=============================================
	Mostrar Reservas por usuario
	=============================================*/

	static public function ctrMostrarReservasUsuario($valor){

		$tabla = "reservas";

		$respuesta = ModeloReservas::mdlMostrarReservasUsuario($tabla, $valor);

		return $respuesta;
		
	}

	/*=============================================
	Mostrar Testimonios
	=============================================*/

	static public function ctrMostrarTestimonios($item, $valor){

		$tabla1 = "testimonios";
		$tabla2 = "habitaciones";
		$tabla3 = "reservas";
		$tabla4 = "usuarios";

		$respuesta = ModeloReservas::mdlMostrarTestimonios($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Actualizar Testimonio
	=============================================*/

	public function ctrActualizarTestimonio(){

		if(isset($_POST["actualizarTestimonio"])){

			if(preg_match('/^[?\\¿\\!\\¡\\:\\,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["actualizarTestimonio"])){

				$tabla = "testimonios";

				$datos = array("id_testimonio"=>$_POST["idTestimonio"],
							   "testimonio"=>$_POST["actualizarTestimonio"]);

				$respuesta = ModeloReservas::mdlActualizarTestimonio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

							swal({
									type:"success",
								  	title: "¡CORRECTO!",
								  	text: "El testimonio ha sido actualizado correctamente",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

				}

			}else{

				echo'<script>

					swal({
							type:"error",
						  	title: "¡CORREGIR!",
						  	text: "¡No se permiten caracteres especiales!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';	

			}
		
		}

	}

}