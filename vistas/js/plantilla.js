var urlPrincipal = $("#urlPrincipal").val();
var urlServidor = $("#urlServidor").val();
$(".contactenos form input, .contactenos form textarea").val("");

/*=============================================
ANIMACIONES CON EL SCROLL
=============================================*/

$(window).scroll(function(){

	var posY = window.pageYOffset;

	if(window.matchMedia("(min-width:769px)").matches){
	
		if(posY > 50){

			$(".formReservas").slideUp("fast");
			$(".mostrarBloqueReservas").attr("modo", "arriba");
			$(".flechaReserva").removeClass("fa-caret-up");
			$(".flechaReserva").addClass("fa-caret-down");

		}else{

			$(".formReservas").slideDown("fast");
			$(".mostrarBloqueReservas").attr("modo", "abajo");
			$(".flechaReserva").removeClass("fa-caret-down");
			$(".flechaReserva").addClass("fa-caret-up");

		}

	}

	posicionBloqueReservas();

})

/*=============================================
BOTÓN RESERVA
=============================================*/

$(".mostrarBloqueReservas").click(function(){

	$(".formReservas").slideToggle("fast");

	$(".menu").slideUp('fast');

	if($(".mostrarBloqueReservas").attr("modo") == "abajo"){

		$(".mostrarBloqueReservas").attr("modo", "arriba");

		$(".flechaReserva").removeClass("fa-caret-up");

		$(".flechaReserva").addClass("fa-caret-down");

	}else{

		$(".mostrarBloqueReservas").attr("modo", "abajo");

		$(".flechaReserva").removeClass("fa-caret-down");

		$(".flechaReserva").addClass("fa-caret-up");

	}

	posicionBloqueReservas();
})

/*=============================================
SCROLL UP
=============================================*/

$.scrollUp({
	scrollText:"",
	scrollSpeed: 2000,
	easingType: "easeOutQuint"
})

/*=============================================
SLIDE BANNER
=============================================*/

$('.fade-slider').jdSlider({

    isSliding: false,
    isAuto: true,
    isLoop: true,
    isDrag: false,
    interval: 7000,
    isCursor: false,
    speed: 3000

})

$(".verMas").click(function(){

	var vinculo = $(this).attr("vinculo");

	$("html, body").animate({

		scrollTop: $(vinculo).offset().top - 60

	}, 1000, "easeInOutBack")

})

$(".banner .fade-slider").css({"margin-top":$("header").height()})

/*=============================================
INTERACCIÓN PLANES
=============================================*/

$(".planes .grid-item").mouseover(function() {

	$(this).children("figure").css({"height":"25%", "transition":".5s all"})

	$(".tituloPlan").html($(this).children("figure").children("h1").html());

	$(".descripcionPlan").html($(this).children("figure").children("h1").attr("descripcion"));

})


$(".planes .grid-item").mouseout(function() {

	$(this).children("figure").css({"height":"100%", "transition":".5s all"})

	$(".tituloPlan").html($(".tituloPlan").attr("tituloPlan"));

	$(".descripcionPlan").html($(".descripcionPlan").attr("descripcionPlan"));

})

/*=============================================
PLANES MOVIL
=============================================*/

$('.planesMovil').jdSlider({
	wrap: '.slide-inner',
    slideShow: 3,
    slideToScroll: 3,
    isLoop: false
})

$(".planesMovil li").click(function(){

	$(".modal-title").html($(this).children("a").children("h6").html());
	$(".modal-body img").attr("src", $(this).children("a").children("img").attr("src"));
	$(".modal-body p").html($(this).children("a").attr("descripcion"));

})


$(".planes .grid-item").click(function(){

	$(".modal-title").html($(this).children("figure").children("h1").html());
	$(".modal-body img").attr("src", $(this).children("img").attr("src"));
	$(".modal-body p").html($(this).children("figure").children("h1").attr("descripcion"));

})

/*=============================================
RECORRIDO POR EL PUEBLO
=============================================*/

 $('.slidePueblo').jdSlider();

 /*=============================================
RESTAURANTE
=============================================*/

$(".restaurante .carta div").hide();

if(window.matchMedia("(max-width:768px)").matches){

	$(".restaurante .verCarta").click(function(){	

		$(".restaurante .bloqueRestaurante").slideToggle("fast")

		$(".restaurante .carta div").slideToggle("fast");	

		$(".restaurante .carta div").css({"background":"rgba(0,0,0,0.7)"})

		$(".contactenos").css({"margin-top":"0px"})
	})

	$(".restaurante .volverCarta").click(function(){	

		$(".restaurante .bloqueRestaurante").slideToggle("fast")

		$(".restaurante .carta div").slideToggle("fast");	

		$(".contactenos").css({"margin-top":"-80px"})
	})

}else{

	$(".restaurante .verCarta").click(function(){		

		$(".restaurante .carta div").slideToggle("fast")

		$(".restaurante .carta div").css({"background":"rgba(0,0,0,0.7)"})

	})

}

/*=============================================
SLIDE HABITACIONES
=============================================*/

 $('.slideHabitaciones').jdSlider( {

 	isSliding: true,
    isAuto: true,
    isLoop: true,
    isDrag: true,
    interval: 3000,
    isCursor: false,
    margin:0,
    timingFunction: 'ease',
    easing: 'swing'


});

 /*=============================================
360 GRADOS
=============================================*/

 $("#myPano").pano({
	img: $("#myPano").attr("back")
});

 /*=============================================
VISUALIZAR MULTIMEDIA HABITACIÓN
=============================================*/

$(".colIzqHabitaciones button").click(function(){

	var vista = $(this).attr("vista");

	if(vista == "fotos"){

		$(".slideHabitaciones").removeClass("d-none");
		$(".slideHabitaciones").addClass("d-block");

		$(".videoHabitaciones").addClass("d-none");
		$(".videoHabitaciones").removeClass("d-block");

		$(".360Habitaciones").addClass("d-none");
		$(".360Habitaciones").removeClass("d-block");
	}

	if(vista == "video"){

		$(".videoHabitaciones").removeClass("d-none");
		$(".videoHabitaciones").addClass("d-block");

		$(".slideHabitaciones").addClass("d-none");
		$(".slideHabitaciones").removeClass("d-block");

		$(".360Habitaciones").addClass("d-none");
		$(".360Habitaciones").removeClass("d-block");
	}

	if(vista == "360"){

		$(".360Habitaciones").removeClass("d-none");
		$(".360Habitaciones").addClass("d-block");

		$(".slideHabitaciones").addClass("d-none");
		$(".slideHabitaciones").removeClass("d-block");

		$(".videoHabitaciones").addClass("d-none");
		$(".videoHabitaciones").removeClass("d-block");
	}

})

/*=============================================
POSICION BLOQUE RESERVAS
=============================================*/

function posicionBloqueReservas(){

	if(window.matchMedia("(min-width:769px)").matches){

		if($(".mostrarBloqueReservas").attr("modo") == "abajo"){

			$(".colDerHabitaciones").css({"margin-top":"100px"})
			$(".colDerReservas").css({"margin-top":"100px"})
			$(".colDerPerfil").css({"margin-top":"100px"})

		}

		if($(".mostrarBloqueReservas").attr("modo") == "arriba"){

			$(".colDerHabitaciones").css({"margin-top":"20px"})
			$(".colDerReservas").css({"margin-top":"20px"})
			$(".colDerPerfil").css({"margin-top":"20px"})

		}

	}else{

		$(".colDerHabitaciones").css({"margin-top":"20px"})
		$(".colDerReservas").css({"margin-top":"20px"})
		$(".colDerPerfil").css({"margin-top":"20px"})

	}

}

posicionBloqueReservas();

if(window.matchMedia("(max-width:768px)").matches){

	$(".infoHabitacion .colIzqHabitaciones").css({"margin-top":$("header").height()})
	$(".infoReservas .colIzqReservas").css({"margin-top":$("header").height()})
	$(".infoPerfil .colIzqPerfil").css({"margin-top":($("header").height()+100)+"px"})

}