<?php

/*=============================================
CREAR EL OBJETO DE LA API GOOGLE
=============================================*/

$cliente = new Google_Client();
$cliente->setAuthConfig('modelos/client_secret.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

$rutaGoogle = $cliente->createAuthUrl();

/*=============================================
RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
=============================================*/
if(isset($_GET["code"])){

	$token = $cliente->authenticate($_GET["code"]);

	$_SESSION['id_token_google'] = $token;

	$cliente->setAccessToken($token);

}

/*=============================================
RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/

if($cliente->getAccessToken()){

	$item = $cliente->verifyIdToken();

	$datos = array("nombre"=>$item["name"],
				   "email"=>$item["email"],
				   "foto"=>$item["picture"],
				   "password"=>"null",
				   "modo"=>"google",
				   "verificacion"=>1,
				   "email_encriptado"=>"null");

	$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

	if($respuesta == "ok"){

			echo '<script>

			setTimeout(function(){
				
				window.location = "'.$ruta.'perfil";

			},1000);

			</script>';

	}

}

?>




<!--=====================================
VENTANA MODAL PLANES
======================================-->

<div class="modal" id="modalPlanes">
	
	 <div class="modal-dialog">
			
		<div class="modal-content">
			
	      	<div class="modal-header">
	        	<h4 class="modal-title text-uppercase"></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
			
	 		<div class="modal-body">
       			
       			<img src="" class="img-thumbnail">
    			
    			<p class="py-3"></p>
       			
       			<div class="text-center">
        			<a href="#habitaciones" class="btn btn-primary text-center  btnModalPlan" data-dismiss="modal">Separa tu habitación</a>
        		</div>

      		</div>

  		 	<div class="modal-footer">
        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      		</div>

		</div> 	

	 </div>

</div>

<!--=====================================
VENTANA MODAL INGRESO
======================================-->

<div class="modal formulario" id="modalIngreso">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h4 class="modal-title">Ingresar</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->
       
      	<div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor:pointer"> 
					<i class="fab fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<div class="px-2 flex-fill">

			<!-- https://console.developers.google.com
			https://github.com/google/google-api-php-client -->

				<a href="<?php echo $rutaGoogle; ?>">

					<p class="p-2 bg-danger text-center text-white" style="cursor:pointer">
						<i class="fab fa-google"></i>
						Ingreso con Google
					</p>

				</a>

			</div>

      	</div>

      	<!--=====================================
		INGRESO DIRECTO
		======================================-->

		<hr class="mt-0">

		<form method="post">

			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-envelope"></i>

			      </span>

			    </div>

			    <input type="email" class="form-control" placeholder="Email" name="ingresoEmail"  required>

		  	</div>

		  	<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
					<i class="fas fa-unlock-alt"></i>

			      </span>

			    </div>

			    <input type="password" class="form-control" placeholder="Contraseña" name="ingresoPassword" required>

		  	</div>

		  	<div class="text-center pb-3">
		
				<a href="#modalRecuperarPassword" data-toggle="modal" data-dismiss="modal">
					¿Olvidó su contraseña?
				</a>

			</div>
			

			<input type="submit" class="btn btn-dark btn-block" value="Ingresar">

			<?php

				$ingresoUsuario = new ControladorUsuarios();
				$ingresoUsuario -> ctrIngresoUsuario();

			?>

		</form>

      </div>


      <div class="modal-footer">
        
		¿No tiene una cuenta registrada? | 

		<strong>

			<a href="#modalRegistro" data-toggle="modal" data-dismiss="modal">
				Registrarse
			</a>

		</strong>

      </div>

    </div>

  </div>

</div>

<!--=====================================
VENTANA MODAL REGISTRO
======================================-->

<div class="modal formulario" id="modalRegistro">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h4 class="modal-title">Registarse</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->
       
      	<div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor:pointer">
					<i class="fab fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<div class="px-2 flex-fill">

			<!-- https://console.developers.google.com
			https://github.com/google/google-api-php-client -->

				<a href="<?php echo $rutaGoogle; ?>">

					<p class="p-2 bg-danger text-center text-white" style="cursor:pointer">
						<i class="fab fa-google"></i>
						Ingreso con Google
					</p>

				</a>

			</div>

      	</div>

      	<!--=====================================
		REGISTRO DIRECTO
		======================================-->

		<hr class="mt-0">

		<form method="post">

			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-user"></i>

			      </span>

			    </div>

			    <input type="text" class="form-control" placeholder="Nombre" name="registroNombre" required>

		  	</div>


			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-envelope"></i>

			      </span>

			    </div>

			    <input type="email" class="form-control" placeholder="Email" name="registroEmail" required>

		  	</div>

		  	<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
					<i class="fas fa-unlock-alt"></i>

			      </span>

			    </div>

			    <input type="password" class="form-control" placeholder="Contraseña" name="registroPassword" required>

		  	</div>
			

			<input type="submit" class="btn btn-dark btn-block" value="Registrarse">

			<?php

			$registroUsuario = new ControladorUsuarios();
			$registroUsuario -> ctrRegistroUsuario();


			?>

		</form>

      </div>


      <div class="modal-footer">
        
		¿Ya tienes una cuenta registrada? | 

		<strong>

			<a href="#modalIngreso" data-toggle="modal" data-dismiss="modal">
				Ingresar
			</a>

		</strong>

      </div>

    </div>

  </div>

</div>

<!--=====================================
VENTANA MODAL RECUPERAR CONTRASEÑA
======================================-->

<div class="modal formulario" id="modalRecuperarPassword">
	
	<div class="modal-dialog">

	    <div class="modal-content">

	    	<div class="modal-header bg-info text-white">

		        <h4 class="modal-title">Recuperar contraseña</h4>

		        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>

		    </div>

			 <div class="modal-body">
			 	
				<form method="post">

					<p class="text-muted">Escriba su correo electrónico con el que estás registrado y allí le enviaremos una nueva contraseña:</p>

					<div class="input-group mb-3">
						
						<div class="input-group-prepend">

					      <span class="input-group-text">
					      	
					      	<i class="far fa-envelope"></i>

					      </span>

					    </div>

					    <input type="email" class="form-control" placeholder="Email" name="emailRecuperarPassword" required>

					</div>

					<input type="submit" class="btn btn-dark btn-block" value="Enviar">

					<?php

						$recuperarPassword = new ControladorUsuarios();
						$recuperarPassword -> ctrRecuperarPassword();

					?>

				</form>

			 </div>

	    </div>

    </div>


</div>