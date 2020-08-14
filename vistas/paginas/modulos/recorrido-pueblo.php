<?php

$recorrido = ControladorRecorrido::ctrMostrarRecorrido();

?>

<!--=====================================
RECORRIDO POR EL PUEBLO
======================================-->

<div class="recorridoPueblo container-fluid bg-white pb-5" id="pueblo">
	
	<div class="container">

		<h1 class="pt-5 text-center">RECORRIDO POR EL PUEBLO</h1>	

			<div class="jd-slider slidePueblo">
				
				<div class="slide-inner">
					
					<ul class="slide-area">

						<?php foreach ($recorrido as $key => $value): ?>

						<li>
						
							<div class="grid-container pt-4 pb-1 pb-lg-3 px-0 px-lg-5">
				
								<div class="grid-item">
									
									<img src="<?php echo $servidor.$value["foto_peq"]; ?>" class="img-fluid" width="100%">

								</div>

								<div class="grid-item">
									
									<h1 class="mt-4 mb-0 my-lg-2"><?php echo $value["titulo"]; ?></h1>

									<p class="small p-3"><?php echo $value["descripcion"]; ?></p>

								</div>

								<div class="grid-item d-none d-lg-block">
									
									<img src="<?php echo $servidor.$value["foto_grande"]; ?>" class="img-fluid" width="100%">

								</div>
								
							</div>

						</li>
							
						<?php endforeach ?>
						
					</ul>

				</div>

				<a class="d-none d-md-block prev" href="#">
	            	<i class="fas fa-angle-left fa-2x" style="color:#3E92BD"></i>
		        </a>

		        <a class="d-none d-md-block next" href="#">
		            <i class="fas fa-angle-right fa-2x" style="color:#3E92BD"></i>
		        </a>

		        <div class="controller">
		            <div class="indicate-area"></div>
		        </div>

			</div>	
	
	</div>

</div>
