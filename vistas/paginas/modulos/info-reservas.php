<?php

if(isset($_POST["id-habitacion"])){

	$valor = $_POST["id-habitacion"];

	$reservas = ControladorReservas::ctrMostrarReservas($valor);

	$indice = 0;

	if(!$reservas){

		$valor = $_POST["ruta"];

		$reservas = ControladorHabitaciones::ctrMostrarHabitaciones($valor);

		foreach ($reservas as $key => $value) {
			
			if($value["id_h"] == $_POST["id-habitacion"]){

				$indice = $key;

			}
		}
	}

	$planes = ControladorPlanes::ctrMostrarPlanes();

	/*=============================================
	DEFINIR PRECIOS DE TEMPORADA
	=============================================*/

	date_default_timezone_set("America/Bogota");

	$hoy = getdate();
	
	if($hoy["mon"] == 12 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||
	   $hoy["mon"] == 1 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15 ||
	   $hoy["mon"] == 6 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||
	   $hoy["mon"] == 7 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15){

		$precioContinental = $reservas[$indice]["continental_alta"];
		$precioAmericano = $reservas[$indice]["americano_alta"];
		$precioRomantico = $reservas[$indice]["americano_alta"] + $planes[0]["precio_alta"];
		$precioLunaDeMiel = $reservas[$indice]["americano_alta"] + $planes[1]["precio_alta"];
		$precioAventura = $reservas[$indice]["americano_alta"] + $planes[2]["precio_alta"];
		$precioSPA = $reservas[$indice]["americano_alta"] + $planes[3]["precio_alta"];

	}else{

		$precioContinental = $reservas[$indice]["continental_baja"];
		$precioAmericano = $reservas[$indice]["americano_baja"];
		$precioRomantico = $reservas[$indice]["americano_baja"] + $planes[0]["precio_baja"];
		$precioLunaDeMiel = $reservas[$indice]["americano_baja"] + $planes[1]["precio_baja"];
		$precioAventura = $reservas[$indice]["americano_baja"] + $planes[2]["precio_baja"];
		$precioSPA = $reservas[$indice]["americano_baja"] + $planes[3]["precio_baja"];

	}

	/*=============================================
	DEFINIR CANTIDAD DE DIAS DE LA RESERVA
	=============================================*/

	$fechaIngreso = new DateTime($_POST["fecha-ingreso"]);
	$fechaSalida = new DateTime($_POST["fecha-salida"]);
	$diff = $fechaIngreso->diff($fechaSalida);
	$dias = $diff->days;

	if($dias == 0){

		$dias = 1;
	}

}else{

	echo '<script> window.location="'.$ruta.'"</script>';

}


?>

<!--=====================================
INFO RESERVAS
======================================-->

<div class="infoReservas container-fluid bg-white p-0 pb-5" idHabitacion="<?php echo $_POST["id-habitacion"]; ?>" fechaIngreso="<?php echo $_POST["fecha-ingreso"]; ?>" fechaSalida="<?php echo $_POST["fecha-salida"]; ?>" dias="<?php echo $dias; ?>">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqReservas p-0">
				
				<!--=====================================
				CABECERA RESERVAS
				======================================-->
				
				<div class="pt-4 cabeceraReservas">
					
					<a href="javascript:history.back()" class="float-left lead text-white pt-1 px-3">
						<h5><i class="fas fa-chevron-left"></i> Regresar</h5>
					</a>

					<div class="clearfix"></div>

					<h1 class="float-left text-white p-2 pb-lg-5">RESERVAS</h1>	

					<h6 class="float-right px-3">

					<?php if (isset($_SESSION["validarSesion"])): ?>

						<?php if ($_SESSION["validarSesion"] == "ok"): ?>

							<br>
							<a href="<?php echo $ruta;  ?>perfil" style="color:#FFCC29">Ver tus reservas</a>

						<?php endif ?>

					<?php else: ?>
						
						<br>
						<a href="#modalIngreso" data-toggle="modal" style="color:#FFCC29">Ver tus reservas</a>
						
					<?php endif ?>						

					</h6>

					<div class="clearfix"></div>

				</div>

				<!--=====================================
				CALENDARIO RESERVAS
				======================================	-->

				<div class="bg-white p-4 calendarioReservas">

				<?php if ($valor == $_POST["ruta"]): ?>

					<h1 class="pb-5 float-left">¡Está Disponible!</h1>

				<?php else: ?>

					<div class="infoDisponibilidad"></div>
					
				<?php endif ?>

					<div class="float-right pb-3">
							
						<ul>
							<li>
								<i class="fas fa-square-full" style="color:#847059"></i> No disponible
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#eee"></i> Disponible
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#FFCC29"></i> Tu reserva
							</li>
						</ul>

					</div>

					<div class="clearfix"></div>
			
					<div id="calendar"></div>

					<!--=====================================
					MODIFICAR FECHAS
					======================================	-->

					<h6 class="lead pt-4 pb-2">Puede modificar la fecha de acuerdo a los días disponibles:</h6>

					<form action="<?php echo $ruta; ?>reservas" method="post">

						<input type="hidden" name="id-habitacion" value="<?php echo $_POST["id-habitacion"]; ?>">

						<input type="hidden" name="ruta" value="<?php echo $_POST["ruta"]; ?>">

						<div class="container mb-3">

							<div class="row py-2" style="background:#509CC3">

								 <div class="col-6 col-md-3 input-group pr-1">
								
									<input type="text" class="form-control datepicker entrada" autocomplete="off" placeholder="Entrada" name="fecha-ingreso" value="<?php echo $_POST["fecha-ingreso"]; ?>"  required>

									<div class="input-group-append">
										
										<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
									
									</div>

								</div>

							 	<div class="col-6 col-md-3 input-group pl-1">
								
									<input type="text" class="form-control datepicker salida" autocomplete="off" placeholder="Salida" name="fecha-salida"  value="<?php echo $_POST["fecha-salida"]; ?>" readonly required>

									<div class="input-group-append">
										
										<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
									
									</div>

								</div>

								<div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
																
									<input type="submit" class="btn btn-block btn-md text-white" value="Ver disponibilidad" style="background:black">										
								</div>

							</div>

						</div>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-4 colDerReservas" style="display:none">

				<h4 class="mt-lg-5">Código de la Reserva:</h4>
				<h2 class="colorTitulos"><strong class="codigoReserva"></strong></h2>

				<div class="form-group">
				  <label>Ingreso 3:00 pm:</label>
				  <input type="text" class="form-control" value="<?php echo $_POST["fecha-ingreso"];?>" readonly>
				</div>

				<div class="form-group">
				  <label>Salida 1:00 pm:</label>
				  <input type="text" class="form-control" value="<?php echo $_POST["fecha-salida"];?>"  readonly>
				</div>

				<div class="form-group">
				  <label>Habitación:</label>
			<input type="text" class="form-control" value="Habitación <?php echo $reservas[$indice]["tipo"]." ".$reservas[$indice]["estilo"]; ?>" readonly>

				  <?php

				  	$galeria = json_decode($reservas[$indice]["galeria"], true);
				  
				  ?>

				  <img src="<?php echo $servidor.$galeria[0]; ?>" class="img-fluid">

				   <!-- ESCENARIO 2 Y 3 DE RESERVAS -->
				   <!-- <input type="text" class="form-control tituloReserva" value="" readonly>   -->

				</div>

				<div class="form-group">
				  <label><a href="#infoPlanes" data-toggle="modal">Escoge tu Plan:</a> <small>(Precio sugerido para 2 personas)</small></label>
				  <select class="form-control elegirPlan">
				  	
					<option value="<?php echo $precioContinental;?>,Plan Continental">Plan Continental $<?php echo number_format($precioContinental); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioAmericano;?>,Plan Americano">Plan Americano $<?php echo number_format($precioAmericano); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioRomantico;?>,Plan Romantico">Plan Romántico $<?php echo number_format($precioRomantico); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioLunaDeMiel;?>,Plan Luna de Miel">Plan Luna de Miel $<?php echo number_format($precioLunaDeMiel); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioAventura;?>,Plan Aventura">Plan Aventura $<?php echo number_format($precioAventura); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioSPA;?>,Plan SPA">Plan SPA $<?php echo number_format($precioSPA); ?> 1 día 1 noche</option>

				  </select>
				</div>
				
				<div class="form-group">
				  <label>Personas:</label>
				  <select class="form-control cantidadPersonas">
				  	
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>

				  </select>
				</div>

				<div class="row py-4">

					<div class="col-12 col-lg-6 col-xl-7 text-center text-lg-left">
						
						<h1 class="precioReserva">S/<span><?php echo number_format($precioContinental*$dias);?></span> SOLES</h1>

					</div>
					
					<div class="col-12 col-lg-6 col-xl-5">


					<?php if (isset($_SESSION["validarSesion"])): ?>

						<?php if ($_SESSION["validarSesion"] == "ok"): ?>

							<a href="<?php echo $ruta;?>perfil" 
								class="pagarReserva" 
								idHabitacion="<?php echo $reservas[$indice]["id_h"]; ?>"
								imgHabitacion="<?php echo $servidor.$galeria[0]; ?>"
								infoHabitacion="Habitación <?php echo $reservas[$indice]["tipo"]." ".$reservas[$indice]["estilo"]; ?>"
								pagoReserva="<?php echo ($precioContinental*$dias);?>"
								codigoReserva=""
								fechaIngreso="<?php echo $_POST["fecha-ingreso"];?>"
								fechaSalida="<?php echo $_POST["fecha-salida"];?>"
								plan="Plan Continental" 
								personas="2">
									<button type="button" class="btn btn-dark btn-lg w-100">PAGAR <br> RESERVA</button>
							</a>	


						<?php endif ?>
									
					<?php else: ?>

							<a href="#modalIngreso" data-toggle="modal"  
								class="pagarReserva" 
								idHabitacion="<?php echo $reservas[$indice]["id_h"]; ?>"
								imgHabitacion="<?php echo $servidor.$galeria[0]; ?>"
								infoHabitacion="Habitación <?php echo $reservas[$indice]["tipo"]." ".$reservas[$indice]["estilo"]; ?>"
								pagoReserva="<?php echo ($precioContinental*$dias);?>"
								codigoReserva=""
								fechaIngreso="<?php echo $_POST["fecha-ingreso"];?>"
								fechaSalida="<?php echo $_POST["fecha-salida"];?>"
								plan="Plan Continental" 
								personas="2">
									<button type="button" class="btn btn-dark btn-lg w-100">PAGAR <br> RESERVA</button>
							</a>						

					<?php endif ?>

					</div>
			
				</div>

			</div>

		</div>

	</div>

</div>


<!--=====================================
VENTANA MODAL PLANES
======================================-->

<div class="modal" id="infoPlanes">
	
	 <div class="modal-dialog modal-lg">
			
		<div class="modal-content">

			<div class="modal-header">
	        	<h4 class="modal-title text-uppercase">Habitación <?php echo $reservas[$indice]["tipo"].' '.$reservas[$indice]["estilo"]; ?></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>

	      	<div class="modal-body">

				<figure class="text-center">

       				<img src="<?php echo $servidor.$galeria[$indice]; ?>" class="img-fluid">

       			</figure>

				<p class="px-2"><?php echo $reservas[$indice]["descripcion_h"]; ?></p>

				<hr>

       			<div class="row">

       			<?php foreach ($planes as $key => $value): ?>

					<div class="col-12 col-md-6">
						
						<h2 class="text-uppercase p-2">Plan <?php echo $value["tipo"]; ?></h2>

						<figure class="center">
	       					<img src="<?php echo $servidor.$value["img"]; ?>" class="img-fluid">
	       				</figure>

	       				<p class="p-2"><?php echo $value["descripcion"]; ?></p>

	       				<h4 class="px-2">Precio por pareja</h4>

       					<p class="px-2">

	       				Temporada Baja: Plan Americano + S/ <?php echo number_format($value["precio_baja"]); ?> SOLES<br>

	       				Temporada Alta: Plan Americano + S/ <?php echo number_format($value["precio_alta"]); ?> SOLES

	       				</p>


					</div>
       				
       			<?php endforeach ?>
       			
       			</div>

	      	</div>

	      	<div class="modal-footer">
        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      		</div>

		</div>

	</div>

</div>