/*=============================================
BOTÓN MENÚ
=============================================*/

if(window.matchMedia("(max-width:768px)").matches){

	$(".botonMenu").click(function(){

		$(".menuMovil").slideToggle('fast');
		$(".menuMovil").css({"top":$("header").height()})

	})	

	$(".menuMovil ul li a").click(function(e){

		$(".menuMovil").slideToggle('fast');

		e.preventDefault();

		var vinculo = $(this).attr("href");
		
		$("html, body").animate({

			scrollTop: $(vinculo).offset().top - 55

		}, 1000, "easeInOutBack")

	})

}else{

	$(".botonMenu").click(function(){

		$(".menu").slideToggle('fast');

		$(".formReservas").slideUp('fast');

	})

	$(".menu ul li a").click(function(e){

		$(".menu").slideToggle('fast');

		e.preventDefault();

		var vinculo = $(this).attr("href");
		
		$("html, body").animate({

			scrollTop: $(vinculo).offset().top - 60

		}, 1000, "easeInOutBack")

	})

}


$(".btnModalPlan").click(function(e){

	e.preventDefault();

	var vinculo = $(this).attr("href");
	
	$("html, body").animate({

		scrollTop: $(vinculo).offset().top - 60

	}, 1000, "easeInOutBack")

})


