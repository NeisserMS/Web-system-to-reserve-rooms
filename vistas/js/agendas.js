/*=============================================
FECHAS RESERVA
=============================================*/

$.datetimepicker.setLocale('es');

$('.datepicker.entrada').datetimepicker({
   format:'Y-m-d H:00:00',
   minDate: 0,
   // minTime: 0,
   defaultTime:(new Date().getHours()+1)+":00",
   allowTimes:[
    '08:00',
    '09:00',
    '10:00',
    '11:00',
    '12:00',
    '13:00',
    '14:00',
    '15:00',
    '16:00',
    '17:00',
    '18:00',
   ],
   disabledWeekDays: [0, 6],
   closeOnDateSelect:false
});

$('.datepicker.entrada').change(function(){

  $('.datepicker.salida').attr("readonly", false);
	
  var fechaEntrada = $(this).val().split(" ");
  
  console.log("fechaEntrada", fechaEntrada);

   var fechaEscogida = new Date($(this).val());

	$('.datepicker.salida').val(fechaEntrada[0] +" "+(fechaEscogida.getHours()+1)+":00:00");

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
  var fechaIngreso = $(".infoReservas").attr("fechaIngreso");
  var fechaSalida = $(".infoReservas").attr("fechaSalida");
  
  var fechaEscogida = new Date(fechaIngreso);
  var nombreHabitacion = "";
  var dias = $(".infoReservas").attr("dias");

  var totalEventos = [];
  var opcion1 = [];
  var opcion2 = [];
  var opcion3 = [];
  var validarDisponibilidad = false;

  var datos = new FormData();
  datos.append("idHabitacion", idHabitacion);

  $.ajax({

    url:urlPrincipal+"ajax/reservas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){

        if(respuesta.length == 0){

          $('#calendar').fullCalendar({
            defaultDate:fechaIngreso,
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            events: [
              {
                start: fechaIngreso,
                end: fechaSalida,
                rendering: 'background',
                color: '#FFCC29'
              }
            ]

          });

          colDerReservas(); 

        }else{   

          for(var i = 0; i < respuesta.length; i++){

            /* VALIDAR CRUCE DE FECHAS OPCIÓN 1 */         

            if(fechaIngreso == respuesta[i]["fecha_ingreso"]){

              opcion1[i] = false;            

            }else{

              opcion1[i] = true;

            }


            /* VALIDAR DISPONIBILIDAD */    

            if(opcion1[i] == false){

              validarDisponibilidad = false;
            
            }else{

              validarDisponibilidad = true;
             
            }

            if(!validarDisponibilidad){

                totalEventos.push(
                  {
                    "title": respuesta[i]["estilo"],
                    "start": respuesta[i]["fecha_ingreso"],
                    "end": respuesta[i]["fecha_salida"],
                    // "rendering": 'background',
                    "color": '#847059'
                  }
                )

                 $(".infoDisponibilidad").html('<h5 class="pb-5 float-left">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>');

                 break;

            }else{

              totalEventos.push(
                {
                  "title": respuesta[i]["estilo"],
                  "start": respuesta[i]["fecha_ingreso"],
                  "end": respuesta[i]["fecha_salida"],
                  // "rendering": 'background',
                  "color": '#847059'
                }

              )

              nombreHabitacion = respuesta[i]["estilo"];

              $(".infoDisponibilidad").html('<h1 class="pb-5 float-left">¡Está Disponible!</h1>'); 

              colDerReservas();
            }        

          }
          // FIN CICLO FOR

          if(validarDisponibilidad){

            totalEventos.push(
               {
                  "title": nombreHabitacion,
                  "start": fechaIngreso,
                  "end": fechaSalida,
                  // "rendering": 'background',
                  "color": '#FFCC29'
                }
            )

          }

          $('#calendar').fullCalendar({
            defaultDate:fechaIngreso,
            defaultView: 'agendaFourDay',
            allDaySlot:false,
            scrollTime:fechaEscogida.getHours()+":00:00",
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            views: {
                agendaFourDay: {
                   type: 'agenda',
                   duration: { days: 4 }   
                }
            },
            events:totalEventos

          });

        }
      
    }

  })

}

/*=============================================
FUNCIÓN COL.DERECHA RESERVAS
=============================================*/

function colDerReservas(){

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
         $(".pagarReserva").attr("codigoReserva",codigoReserva );

       }else{

          $(".codigoReserva").html(codigoReserva+codigoAleatorio(chars, 3));
          $(".pagarReserva").attr("codigoReserva",codigoReserva+codigoAleatorio(chars, 3));

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
       $(".pagarReserva").attr("pagoReserva",$(".elegirPlan").val().split(",")[0]*dias)
       $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
       $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case "3":

     $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.25) + Number($(".elegirPlan").val().split(",")[0])*dias);
     $(".precioReserva span").number(true);
     $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split(",")[0]*0.25) + Number($(".elegirPlan").val().split(",")[0])*dias);
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case "4":

     $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.50) + Number($(".elegirPlan").val().split(",")[0])*dias);
     $(".precioReserva span").number(true);
     $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split(",")[0]*0.50) + Number($(".elegirPlan").val().split(",")[0])*dias);
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case "5":

     $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.75) + Number($(".elegirPlan").val().split(",")[0])*dias);
     $(".precioReserva span").number(true);
     $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split(",")[0]*0.75) + Number($(".elegirPlan").val().split(",")[0])*dias);
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

  }

}


/*=============================================
FUNCIÓN PARA GENERAR COOKIES
=============================================*/

function crearCookie(nombre, valor, diasExpedicion){

  var hoy = new Date();

  hoy.setTime(hoy.getTime() + (diasExpedicion * 24 * 60 * 60 * 1000));

  var fechaExpedicion = "expires=" + hoy.toUTCString();

  document.cookie = nombre + "=" + valor + "; " + fechaExpedicion;

}

/*=============================================
CAPTURAR DATOS DE LA RESERVA
=============================================*/

$(".pagarReserva").click(function(){


  var idHabitacion = $(this).attr("idHabitacion");
  var imgHabitacion = $(this).attr("imgHabitacion");
  var infoHabitacion = $(this).attr("infoHabitacion")+" - "+$(this).attr("plan")+" - "+$(this).attr("personas")+" personas";
  var pagoReserva = $(this).attr("pagoReserva");
  var codigoReserva = $(this).attr("codigoReserva");
  var fechaIngreso = $(this).attr("fechaIngreso");
  var fechaSalida = $(this).attr("fechaSalida");  

  crearCookie("idHabitacion", idHabitacion, 1);
  crearCookie("imgHabitacion", imgHabitacion, 1);
  crearCookie("infoHabitacion", infoHabitacion, 1);
  crearCookie("pagoReserva", pagoReserva, 1);
  crearCookie("codigoReserva", codigoReserva, 1);
  crearCookie("fechaIngreso", fechaIngreso, 1);
  crearCookie("fechaSalida", fechaSalida, 1);

})