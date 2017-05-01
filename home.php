<?php 
session_start();
if(!$_SESSION['userVars']) {
	header("Location: index.php");	
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INGENIERIA DE SOFTWARE</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.yeti.min.css">
	<link rel="stylesheet" href="assets/home/default.css">
  <link rel="stylesheet" href="assets/sweetalert2.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel='stylesheet' href='assets/fullcalendar/fullcalendar.css' />
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" id="logo" href="#"><b>SPA</b></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Salas <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Masajes</a></li>
            <li><a href="#">---</a></li>
            <li><a href="#">---</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">           
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>   <?=$_SESSION['userVars']['name']." ".$_SESSION['userVars']['lastname'];?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="./php/logout.php">Cerrar sesion</a></li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
	<div class="container-fluid">
		<div id='calendar'></div>

		<div class="row">
			
		</div>
	</div>

<script src="assets/jquery.js"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>
<script src='assets/moment.js'></script>
<script src='assets/sweetalert2.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.js'></script>
<script src='assets/fullcalendar/locale/es.js'></script>
<script src='http://168.232.165.15:3000/socket.io/socket.io.js'></script>

<script>

  var room = "masaje tailandes";
  var socket = io('http://168.232.165.15:3000');

  socket.on('connect', function(){
    $('#logo').css('color', '#00C853');
    socket.emit('room', room);
  });

  socket.on('disconnect', function(){
    $('#logo').css('color', '#e74c3c');
  });

  socket.on('event', function(data){
    $('#calendar').fullCalendar('removeEventSources'); // Removemos todos los eventos  
    $('#calendar').fullCalendar('addEventSource', // Cargamos todos los eventos
      data,
      true // make the event "stick"
    );
  });

  socket.on('newEvent', function(data){  
    console.log(data)
    $('#calendar').fullCalendar('renderEvent', // Cargamos todos los eventos
      data,
      true // make the event "stick"
    );
  });

	$(document).ready(function() {
   

    $('#calendar').fullCalendar({
      
      allDaySlot: false,
      slotDuration: '00:15:00',
      snapDuration: '00:05:00',
    	defaultView: 'agendaWeek',
      slotLabelFormat: 'h(:mm)a',
    	locale: 'es',
      minTime: "09:00",
      maxTime: "18:00",
      hiddenDays: [ 0,6 ],
      editable: true,
      eventOverlap:false,
      dayClick: function(date, jsEvent, view) {

        swal({
          title: "¿Quieres crear un nuevo agendamiento?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No',
          html: $('<div>')
            //.addClass('some-class')
            .text(moment(date.format()).format("LLLL")),
        }).then(function () {
             
          //                                             AGREGAR EVENTO SOCKET
          socket.emit('event',
            {
              room: room,
              title: 'title', 
              start: date.format(),
              minutes: 30
            }
          );

          /*
          $('#calendar').fullCalendar('renderEvent',
            {
              title: 'title',
              start: date.format(),
              end: moment(date.format()).add(30, 'minute'),
            },
            true // make the event "stick"
          );*/

          swal(
            'Agendamiento Creado!',
            '',
            'success'
          );
        });

        //alert('Clicked on: ' + date.format());

        //alert('Current view: ' + view.name);

        // change the day's background color just for fun
        //$(this).css('background-color', 'red');

      },
      eventClick: function(calEvent, jsEvent, view) {

        swal({
          title: "Confirmar asistencia",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#5CB85C',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Asistira',
          cancelButtonText: 'No asistira',
          html: $('<div>')
            //.addClass('some-class')
            //.text('hora inicio: ' + moment(date.format()).format("LLLL")),
        }).then(function () {
          swal(
            'Asistencia confirmada!',
            '',
            'success'
          );
        });

        console.log(calEvent);
        //alert('Event: ' + calEvent.title);

        // change the border color just for fun
        $(this).css('background-color', 'green');

      },
      events: [
        {
          title: 'Meeting',
          start:'2017-04-19T17:30:00',
          end: '2017-04-19T18:00:00'
        }
      ]
        // put your options and callbacks here
    });

});

</script>

</body>
</html>



