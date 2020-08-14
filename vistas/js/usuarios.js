/*=============================================
LIMPIAR FORMULARIOS DE REGISTRO E INGRESO
=============================================*/

$('.modal.formulario').on('hidden.bs.modal', function(){

	 $(this).find('form')[0].reset();

})

/*=============================================
FORMATEAR LOS IPUNT
=============================================*/

$('input[name="registroEmail"]').change(function(){

	$(".alert").remove();

})

/*=============================================
VALIDAR EMAIL REPETIDO
=============================================*/

$('input[name="registroEmail"]').change(function(){

	var email = $(this).val();

	var datos = new FormData();
	datos.append("validarEmail", email);

	$.ajax({

		url:urlPrincipal+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			
			if(respuesta){

				var modo = respuesta["modo"];

				if(modo == "directo"){

					modo = "esta página";

				}

				$("input[name='registroEmail']").val("");

				$("input[name='registroEmail']").after(`

				<div class="alert alert-warning">
					<strong>ERROR:</strong>
					El correo electrónico ya existe en la base de datos, fue registrado a través de `+modo+`, por favor ingrese otro diferente
				</div>

				`);

				return;

			}
		
		}

	})

})

/*=============================================
BOTÓN FACEBOOK
=============================================*/

$(".facebook").click(function(){

	FB.login(function(response){

		validarUsuario();

	}, {scope: 'public_profile, email'})

})

/*=============================================
VALIDAR EL INGRESO
=============================================*/

function validarUsuario(){

	FB.getLoginStatus(function(response){

		statusChangeCallback(response);

	})

}

/*=============================================
VALIDAMOS EL CAMBIO DE ESTADO EN FACEBOOK
=============================================*/

function statusChangeCallback(response){

	if(response.status === 'connected'){

		testApi();

	}else{

		swal({
			type: "error",
          title: "¡ERROR!",
          text: "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!",
          showConfirmButton: true,
		confirmButtonText: "Cerrar"
	
		}).then(function(result){

			if(result.value){   
              	history.back();
            } 
      	});

	}

}

/*=============================================
INGRESAMOS A LA API DE FACEBOOK
=============================================*/

function testApi(){

	FB.api('/me?fields=id,name,email,picture',function(response){

		if(response.email == null){

			swal({
				type: "error",
	          title: "¡ERROR!",
	          text: "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!",         
	        showConfirmButton: true,
			confirmButtonText: "Cerrar"
		
			}).then(function(result){

				if(result.value){  
	              	history.back();
	            } 
	      	});

	      	return;

		}else{

			var email = response.email;
			var nombre = response.name;
			var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";

			var datos = new FormData();
			datos.append("email", email);
			datos.append("nombre",nombre);
			datos.append("foto",foto);

			$.ajax({

				url:urlPrincipal+"ajax/usuarios.ajax.php",
				method:"POST",
				data:datos,
				cache:false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					
					if(respuesta == "ok"){

						window.location = urlPrincipal+"perfil";

					}else{

						swal({
						type: "error",
				          title: "¡ERROR!",
				          text: "¡El correo electrónico "+email+" ya está registrado con un método diferente a Facebook!",				          
				         showConfirmButton: true,
						confirmButtonText: "Cerrar"
					
						}).then(function(result){

							if(result.value){    

								 FB.getLoginStatus(function(response){	

								 	 if(response.status === 'connected'){     

								 	 		FB.logout(function(response){

								 	 			deleteCookie("fblo_2180677115313399");

								 	 			setTimeout(function(){

							   		 	 			window.location=urlPrincipal+"salir";

							   		 	 		},500)

								 	 		});

								 	 		function deleteCookie(name){

					           		 	 		 document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
				           		 	 	}

								 	 }

								 })

							}							

						})

					}

				}

			})

		}

	})

}

/*=============================================
SALIR DE FACEBOOK
=============================================*/

$(".salir").click(function(e){



	e.preventDefault();

	FB.getLoginStatus(function(response){	

	 	 if(response.status === 'connected'){     

	 	 		FB.logout(function(response){

	 	 			deleteCookie("fblo_2180677115313399");

	 	 			setTimeout(function(){

   		 	 			window.location=urlPrincipal+"salir";

   		 	 		},500)

	 	 		});

	 	 		function deleteCookie(name){

			 	 		 document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		 	 	}

	 	 }else{

	 	 	setTimeout(function(){

 	 			window.location=urlPrincipal+"salir";

 	 		},500)

	 	 }

	 })

})