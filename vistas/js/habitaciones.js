/*=============================================
COLOCAR ACTIVO EL PRIMER BOTÓN 
=============================================*/

var enlacesHabitaciones = $(".cabeceraHabitacion ul.nav li.nav-item a");
var tituloBtn = [];

for(var i = 0; i < enlacesHabitaciones.length; i++){

	$(enlacesHabitaciones[i]).removeClass("active");
	$(enlacesHabitaciones[i]).children("i").remove();
	tituloBtn[i] = $(enlacesHabitaciones[i]).html();
}

$(enlacesHabitaciones[0]).addClass("active");
$(enlacesHabitaciones[0]).html('<i class="fas fa-chevron-right"></i>'+ tituloBtn[0]);

$(enlacesHabitaciones[enlacesHabitaciones.length -1]).css({"border-right":0})

/*=============================================
ENLACES HABITACIONES
=============================================*/

$(".cabeceraHabitacion ul.nav li.nav-item a").click(function(e){

	e.preventDefault();

	var orden = $(this).attr("orden");
	var ruta = $(this).attr("ruta");

	for(var i = 0; i < enlacesHabitaciones.length; i++){

		$(enlacesHabitaciones[i]).removeClass("active");
		$(enlacesHabitaciones[i]).children("i").remove();
		tituloBtn[i] = $(enlacesHabitaciones[i]).html();
	}

	$(enlacesHabitaciones[orden]).addClass("active");
	$(enlacesHabitaciones[orden]).html('<i class="fas fa-chevron-right"></i>'+ tituloBtn[orden]);

	/*=============================================
	AJAX HABITACIONES
	=============================================*/

	var listaSlide = $(".slideHabitaciones .slide-inner .slide-area li");
	var alturaSlide = $(".slideHabitaciones .slide-inner .slide-area").height();

	for(var i = 0; i < listaSlide.length; i++){

		$(".slideHabitaciones .slide-inner .slide-area").css({"height":alturaSlide+"px"})
		$(listaSlide[i]).html("");

	}

	var datos = new FormData();
	datos.append("ruta", ruta);


	$.ajax({

		url:urlPrincipal+"ajax/habitaciones.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			var galeria = JSON.parse(respuesta[orden]["galeria"]);
			console.log("galeria", galeria);
	
			for(var i = 0; i < galeria.length; i++){		

				$(listaSlide[0]).html('<img class="img-fluid" src="'+urlServidor+galeria[galeria.length-1]+'">')

				$(listaSlide[i+1]).html('<img class="img-fluid" src="'+urlServidor+galeria[i]+'">')

				$(listaSlide[galeria.length+1]).html('<img class="img-fluid" src="'+urlServidor+galeria[0]+'">')
			}


			$(".videoHabitaciones iframe").attr("src", "https://www.youtube.com/embed/"+respuesta[orden]["video"]);

			$("#myPano").attr("back", urlServidor+respuesta[orden]["recorrido_virtual"]);

			$(".descripcionHabitacion h1").html(respuesta[orden]["estilo"]+" "+respuesta[orden]["tipo"]);

			$(".d-habitacion").html(respuesta[orden]["descripcion_h"]);

			$('input[name="id-habitacion"]').val(respuesta[orden]["id_h"]);

			/*=============================================
			TRAER TESTIMONIOS
			=============================================*/

			var datosTestimonios = new FormData();
			datosTestimonios.append("id_h", respuesta[orden]["id_h"]);

			$.ajax({

				url:urlPrincipal+"ajax/reservas.ajax.php",
				method: "POST",
				data: datosTestimonios,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta){

					var cantidadTestimonios = 0;
					var idTestimonios = [];
					
					$(".testimonios .row").html("");

					$(".verMasTestimonios").remove();
					$(".verMenosTestimonios").remove();

					$(".testimonios .row").css({'height':"auto"})

					for(var i = 0; i < respuesta.length; i ++){

						if(respuesta[i]["aprobado"] != 0){

							cantidadTestimonios++;
							idTestimonios.push(respuesta[i]["id_testimonio"]);

						}

					}

					if(cantidadTestimonios >= 4){

						var foto = [];

						for(var i = 0; i < idTestimonios.length; i ++){

							if(respuesta[i]["foto"] == ""){

								foto[i] = urlServidor+"vistas/img/usuarios/default/default.png";
							
							}else{

								if(respuesta[i]["modo"] == "directo"){

									foto[i] = urlServidor+respuesta[i]["foto"];

								}else{

									foto[i] = respuesta[i]["foto"];

								}

							}

							$(".testimonios .row").append(`

								<div class="col-12 col-lg-3 text-center p-4">

									<img src="`+foto[i]+`" class="img-fluid rounded-circle w-50">	
																
									<h4 class="py-4">`+respuesta[i]["nombre"]+`</h4>

									<p>`+respuesta[i]["testimonio"]+`</p>

								</div>

							`);

							$(".testimonios .row").css({'height':$(".testimonios .row div").height()+50+"px", 
														'overflow':'hidden'})

						}

					}else{

						$(".testimonios .row").html('<div class="col-12 text-white text-center">¡Esta habitación aún no tiene testimonios!</div>');

					}

					if(cantidadTestimonios > 4){

						$(".testimonios .row").after(`
							
			     				<button class="btn btn-default px-4 float-right verMasTestimonios">VER MÁS</button>
			     			
			     		`);

					}

				}

			})

		}

	})
	
})



/*=============================================
BLOQUE VER MAS TESTIMONIOS
=============================================*/

var alturaTestimonios = $(".testimonios .row").height();
var alturaTestimoniosCorta = $(".testimonios .row div").height()+50;

$(".testimonios .row").css({'height':alturaTestimoniosCorta+"px",
							'overflow':'hidden'})

$(document).on("click", ".verMasTestimonios", function(){


	$(".testimonios .row").css({'height':alturaTestimonios+"px", 
								'overflow':'hidden'})

	$(this).removeClass("verMasTestimonios");
	$(this).addClass("verMenosTestimonios");
	$(this).html("Ver menos");

})

$(document).on("click", ".verMenosTestimonios", function(){


	$(".testimonios .row").css({'height':alturaTestimoniosCorta+"px", 
								'overflow':'hidden'})

	$(this).removeClass("verMenosTestimonios");
	$(this).addClass("verMasTestimonios");
	$(this).html("Ver más");

})





