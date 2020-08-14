<?php

if(isset($_SESSION["validarSesion"])){	

	if($_SESSION["validarSesion"] == "ok"){

		include "modulos/banner-interior.php";
		include "modulos/info-perfil.php";
		include "modulos/habitaciones.php";
		include "modulos/planes.php";
		include "modulos/planes-movil.php";
		include "modulos/recorrido-pueblo.php";
		include "modulos/restaurante.php";
		echo '<div class="mb-5"></div>';

	}

}else{

	echo '<script> window.location="'.$ruta.'"</script>';
}


