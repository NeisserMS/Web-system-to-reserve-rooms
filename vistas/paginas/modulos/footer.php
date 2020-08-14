<!--=====================================
CONTÁCTENOS
======================================-->

<div class="contactenos container-fluid bg-white py-4" id="contactenos">
	
	<div class="container text-center">
		
		<h1 class="py-sm-4">CONTÁCTENOS</h1>

		<form method="post">

			<div class="input-group input-group-lg">
				
				<input type="text" class="form-control mb-3 mr-2 form-control-lg" placeholder="Nombre" name="nombreContactenos" required>

				<input type="text" class="form-control mb-3 ml-2 form-control-lg" placeholder="Apellido" name="apellidoContactenos" required>

			</div>

			<div class="input-group input-group-lg">
				
				<input type="text" class="form-control mb-3 mr-2 form-control-lg" placeholder="Móvil" name="movilContactenos" required>

				<input type="text" class="form-control mb-3 ml-2 form-control-lg" placeholder="Correo Electrónico" name="emailContactenos" required>

			</div>

			<textarea class="form-control" rows="6" placeholder="Escribe aquí tu mensaje" name="mensajeContactenos" required></textarea>

			<button type="submit" class="btn btn-dark my-4 btn-lg py-3 text-uppercase w-50">Enviar</button>
			
			<?php

				$contactenos = new ControladorUsuarios();
				$contactenos -> ctrFormularioContactenos();
			
			?>

		</form>

	</div>

</div>

<!--=====================================
MAPA
======================================-->
<div class="mapa container-fluid bg-white p-0">
	
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2181015083097!2d-75.16167268476889!3d6.2349559954867315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e441d2a2f90b049%3A0xe73c0a7060062903!2sHOTEL+PORTOBELO+GUATAPE!5e0!3m2!1ses!2sco!4v1544281019677" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

	<div class=" p-4 info"> 

		<h3 class="mt-4"><strong>Visítanos</strong></h3>
		<p>Av. Husares de Junin, cerca a la UPAO</p>

		<p>
		Proyecto<br>
		Fin de Curso<br>
		Desarrollo de App<br>
		408-996-1010
		</p>

		<p class="pb-4">Email: QuilicheZeladaArthur@gmail.com<br>
		TEL: 902421218</p>

	</div>	

</div>

<!--=====================================
FOOTER
======================================-->

<footer class="container-fluid p-0">

	<div class="grid-container">
			
		<div class="grid-item d-none d-lg-block pt-2"></div>

		<div class="grid-item d-none d-lg-block pt-2">
			
			<p>PROYECTO FINAL DE DESARROLLO DE APLICACIONES - 2020 - TODOS LOS DERECHOS RESERVADOS</p>

		</div>

		<div class="grid-item pt-2">
			
			<ul class="py-1">

				<li>
					<a href="#" target="_blank"><i class="fab fa-facebook-f lead text-white float-left mx-3"></i></a>
				</li>

				<li>
					<a href="#" target="_blank"><i class="fab fa-twitter lead text-white float-left mx-3"></i></a>
				</li>

				<li>
					<a href="#" target="_blank"><i class="fab fa-youtube lead text-white float-left mx-3"></i></a>
				</li>


				<li>
					<a href="#" target="_blank"><i class="fab fa-instagram lead text-white float-left mx-3"></i></a>
				</li>	
			
			</ul>	

		</div>

	</div>

</footer>

<!--=====================================
REDES SOCIALES MÓVIL
======================================-->

<ul class="redesMovil p-2 nav nav-justified">

	<li class="nav-item">
		<a href="#" target="_blank"><i class="fab fa-facebook-f lead text-white"></i></a>
	</li>

	<li class="nav-item">
		<a href="#" target="_blank"><i class="fab fa-twitter lead text-white"></i></a>
	</li>

	<li class="nav-item">
		<a href="#" target="_blank"><i class="fab fa-youtube lead text-white"></i></a>
	</li>

	<li class="nav-item">
		<a href="#" target="_blank"><i class="fab fa-instagram lead text-white"></i></a>
	</li>	

</ul>	
