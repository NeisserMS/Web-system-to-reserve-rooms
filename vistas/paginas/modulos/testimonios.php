<?php

$valor = $_GET["pagina"];

$habitaciones = ControladorHabitaciones::ctrMostrarHabitaciones($valor);

$testimonios = ControladorReservas::ctrMostrarTestimonios("id_hab", $habitaciones[0]["id_h"]);
?>

<!--=====================================
TESTIMONIOS
======================================-->
<div class="testimonios container-fluid py-5 text-white">
	
	<div class="container mb-3">
			
		<h1 class="text-center py-5">TESTIMONIOS</h1>

		<div class="row">

		<?php

		$cantidadTestimonios = 0;
		$idTestimonios = array();
	

		foreach ($testimonios as $key => $value) {

			if($value["aprobado"] != 0){

				++$cantidadTestimonios;
				array_push($idTestimonios, $value["id_testimonio"]);

			}

		}

		if($cantidadTestimonios >= 4){	

			for($i = 0; $i < count($idTestimonios); $i++){
				
				echo '<div class="col-12 col-lg-3 text-center p-4">';

					if($testimonios[$i]["foto"] == ""){

						echo '<img src="'.$servidor.'vistas/img/usuarios/default/default.png" class="img-fluid rounded-circle w-50">';

					}else{

						if($testimonios[$i]["modo"] == "directo"){

							echo '<img src="'.$servidor.$testimonios[$i]["foto"].'" class="img-fluid rounded-circle w-50">';

						}else{

							echo '<img src="'.$testimonios[$i]["foto"].'" class="img-fluid rounded-circle w-50">';
						}

					}					

					echo '<h4 class="py-4">'.$testimonios[$i]["nombre"].'</h4>

					<p>'.$testimonios[$i]["testimonio"].'</p>

				</div>';

			}			

		}else{

			echo '<div class="col-12 text-white text-center">¡Esta habitación aún no tiene testimonios!</div>';

		}	

		
					
		echo '</div>';

		if($cantidadTestimonios > 4){

		echo '<button class="btn btn-default float-right px-4 verMasTestimonios">VER MÁS</button>';

		}

		?>

	</div>

</div>