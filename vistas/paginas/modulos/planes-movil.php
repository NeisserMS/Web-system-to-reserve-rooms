<?php

$planes = ControladorPlanes::ctrMostrarPlanes();

?>

<!--=====================================
PLANES MÓVIL
======================================-->

<div class="d-block d-lg-none planesMovil jd-slider bg-white" id="planesMovil">

	<h1 class="text-center py-3">PLANES</h1>

	 <div class="slide-inner">
	 	
		 <ul class="slide-area">

		 <?php foreach ($planes as $key => $value): ?>

		 	<li>
				
				<a href="#modalPlanes" data-toggle="modal" descripcion="<?php echo $value["descripcion"]; ?>">
					
					<img src="<?php echo $servidor.$value["img"]; ?>">
					<h6 class="py-2 text-center text-uppercase"><?php echo $value["tipo"]; ?></h6>

				</a>

			</li>
		 	
		 <?php endforeach ?>

		 </ul>

	 	<a class="prev" href="#">
            <i class="fas fa-angle-left text-muted"></i>
        </a>

        <a class="next" href="#">
            <i class="fas fa-angle-right text-muted"></i>
        </a>

 	</div>

  	<div class="controller">

        <div class="indicate-area"></div>

    </div>
			   
</div>
