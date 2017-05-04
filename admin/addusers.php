<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion Usuarios</title>
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.yeti.min.css">
	<link rel="stylesheet" href="../assets/home/default.css">
  <link rel="stylesheet" href="../assets/sweetalert2.min.css">
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
	<link rel='stylesheet' href='../assets/fullcalendar/fullcalendar.css' />
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
  	<link rel="stylesheet" href="../src/palette-color-picker.css">
</head>
<body>
<!-- -->
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8 col-md-offset-2 for" id="form-user">
			<h2>Agregar usuario</h2>
			<div class="form-group row">
			  <label for="email-user" class="col-2 col-form-label">Email:</label>
			  <div class="col-10">
			    <input class="form-control" type="email" id="email-user" required>
			  </div>
			</div>
			<div class="form-group row">
			  <label for="name-user" class="col-2 col-form-label">Usuario:</label>
			  <div class="col-10">
			    <input class="form-control" type="text" id="name-user" required>
			  </div>
			</div>
			<div class="form-group row">
			  <label for="passwd-user" class="col-2 col-form-label">Contraseña:</label>
			  <div class="col-10">
			    <input class="form-control" type="password" id="passwd-user" required>
			  </div>
			</div>
			<div class="form-group row">
			  <label for="perfil-user" class="col-2 col-form-label">Perfil:</label>
			  <div class="col-10">
			    <select class="form-control" id="perfil-user" required>
			    	<option>-- Seleccione una opción --</option>
			    </select>
			  </div>
			</div>
			<div class="form-group row">
				<input type="text" name="duplicated-name-2" id="palette" class="form-control sr-only" data-palette='["#D50000","#304FFE","#00B8D4","#00C853","#FFD600","#FF6D00","#FF1744","#3D5AFE","#00E5FF","#00E676","#FFEA00","#FF9100","#FF5252","#536DFE","#18FFFF","#69F0AE","#FFFF00","#FFAB40"]' value="" style="margin-right:48px;">
			</div>
			<button type="button" class="btn btn-primary" href="javascript:;" onclick="saveuser($('#email-user').val(), $('#name-user').val(), $('#passwd-user').val(), $('#perfil-user').val(), $('#palette').val());return false;">Guardar</button>
			<div class="" id="resp"></div>
		</div>

	</div>
</div>


<script src="../assets/jquery.js"></script>
<script src="../assets/bootstrap/js/bootstrap.js"></script>
<script src="../src/palette-color-picker.js"></script>
<script src="../ready.js"></script>

<script>
$(document).ready(function() {
	//$("#perfil-user").change(function(){
	$.ajax({
		url: 'getperfil.php',
		type: 'GET'
	})
	.done(function(data) {
		//console.log(data);
		$('#perfil-user').append(data);

	})
	.fail(function() {
		console.log("error");
	})
	//});
});
</script>

<script>
function saveuser(email_user, name_user, passwd_user, perfil_user, palette){
        var parametros = {
                "email_user" : email_user,
                "name_user" : name_user,
				"passwd_user" : passwd_user,
			    "perfil_user" : perfil_user,
			    "palette" : palette
        };
				//console.log(parametros);
        $.ajax({
                data:  parametros,
                url:   '../php/addusers.php',
                type:  'post',
                beforeSend: function () {
                        $("#resp").html("Procesando, espere por favor...");
                },
                success:  function (response) {
						console.log(response);
                        //$("#resp").html(response);
						if (response) {
							$('#resp').append('<div class="alert alert-success" role="alert">Los datos se han regitrado correctamente.</div>');
						}else{
							$('#resp').append('<div class="alert alert-danger" role="alert">Los datos no se han regitrado correctamente.</div>');
						}

                }
        });
}
</script>

</body>
</html>
