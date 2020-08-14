/*=============================================
FECHAS RESERVA
=============================================*/
$('.datepicker.entrada').datepicker({
	startDate: '0d',
  datesDisabled: '0d',
	format: 'yyyy-mm-dd',
	todayHighlight:true
});

$('.datepicker.entrada').change(function(){

  $('.datepicker.salida').attr("readonly", false);
	
  var fechaEntrada = $(this).val();

	$('.datepicker.salida').datepicker({
		startDate: fechaEntrada,
		datesDisabled: fechaEntrada,
		format: 'yyyy-mm-dd'
	});

})

/*=============================================
SELECTS ANIDADOS
=============================================*/

$(".selectTipoHabitacion").change(function(){

  var ruta = $(this).val();

  if(ruta != ""){

    $(".selectTemaHabitacion").html("");

  }else{

    $(".selectTemaHabitacion").html('<option>Temática de habitación</option>')

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

      $("input[name='ruta']").val(respuesta[0]["ruta"]);
      
      for(var i = 0; i < respuesta.length; i++){

        $(".selectTemaHabitacion").append('<option value="'+respuesta[i]["id_h"]+'">'+respuesta[i]["estilo"]+'</option>')

      }

    }

  })

})

/*=============================================
CÓDIGO ALEATORIO
=============================================*/

var chars ="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

function codigoAleatorio(chars, length){

  codigo = "";

  for(var i = 0; i < length; i++){

    rand = Math.floor(Math.random()*chars.length);
    codigo += chars.substr(rand, 1);
  
  }

  return codigo;

}


/*=============================================
CALENDARIO
=============================================*/

if($(".infoReservas").html() != undefined){

  var idHabitacion = $(".infoReservas").attr("idHabitacion");
  var arrayHabitacion = JSON.parse("["+idHabitacion +"]");
  var fechaIngreso = $(".infoReservas").attr("fechaIngreso");
  var fechaSalida = $(".infoReservas").attr("fechaSalida");
  var dias = $(".infoReservas").attr("dias");

  for (var i = 0; i < arrayHabitacion.length; i++) {
   
    var totalEventos = [];
    var opcion1 = [];
    var opcion2 = [];
    var opcion3 = [];
    var validarDisponibilidad = false;

    var datos = new FormData();
    datos.append("idHabitaciones", arrayHabitacion[i]);
    datos.append("fechaIngreso", fechaIngreso);
    datos.append("fechaSalida", fechaSalida);

    $.ajax({

      url:urlPrincipal+"ajax/reservas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){  

        if(respuesta != ""){

          function quitarHabitaciones(indice){
             return indice == respuesta;  
          }

          arrayHabitacion.splice(arrayHabitacion.findIndex(quitarHabitaciones), 1);

        }

        var datosHabitacion = new FormData();
        datosHabitacion.append("idHabitacion", arrayHabitacion[0]);

        $.ajax({

          url:urlPrincipal+"ajax/reservas.ajax.php",
          method: "POST",
          data: datosHabitacion,
          cache: false,
          contentType: false,
          processData: false,
          dataType:"json",
          success:function(respuesta){

              if(respuesta.length != 0){

                $(".infoDisponibilidad").html('<h1 class="pb-5 float-left">¡Está Disponible!</h1>'); 

                $('#calendar').fullCalendar({
                   defaultDate:fechaIngreso,
                  header: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                  },
                  events: [{
                    start: fechaIngreso,
                    end: fechaSalida,
                    rendering: 'background',
                    color: '#FFCC29'
                 }]

                });

                colDerReservas(respuesta[0]["tipo"],respuesta[0]["estilo"]);

              }else{

                 $('#calendar').html("");
                 $(".colDerReservas").hide();

                 $(".infoDisponibilidad").html('<h5 class="pb-5 float-left">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>'); 

              }

          }

        })
       
      }

    })

  }

}



/*=============================================
FUNCIÓN COL.DERECHA RESERVAS
=============================================*/

function colDerReservas(tipo, estilo){

   $(".tituloReserva").val("Habitación "+tipo+" "+estilo);

   $(".colDerReservas").show(); 

   var codigoReserva = codigoAleatorio(chars, 9);
   
   var datos = new FormData();
   datos.append("codigoReserva", codigoReserva);

   $.ajax({

    url:urlPrincipal+"ajax/reservas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
     
       if(!respuesta){

         $(".codigoReserva").html(codigoReserva);

       }else{

          $(".codigoReserva").html(codigoReserva+codigoAleatorio(chars, 3));

       }

        /*=============================================
        CAMBIO DE PLAN
        =============================================*/

        $(".elegirPlan").change(function(){

          cambioPlanesPersonas();

           
        })

        /*=============================================
        CAMBIO DE PERSONAS
        =============================================*/

        $(".cantidadPersonas").change(function(){

         cambioPlanesPersonas();


        })

    }

  })

}


function cambioPlanesPersonas(){

  switch($(".cantidadPersonas").val()){
            
    case "2":

       $(".precioReserva span").html($(".elegirPlan").val().split(",")[0]*dias);
       $(".precioReserva span").number(true);

    break;

    case "3":

     $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.25) + Number($(".elegirPlan").val().split(",")[0])*dias);
     $(".precioReserva span").number(true);

    break;

    case "4":

     $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.50) + Number($(".elegirPlan").val().split(",")[0])*dias);
     $(".precioReserva span").number(true);

    break;

    case "5":

     $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.75) + Number($(".elegirPlan").val().split(",")[0])*dias);
     $(".precioReserva span").number(true);

    break;

  }

}

