<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!-- Bootstrap -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



	    <!-- Stylesheet -->
	    <link href="profile.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



	    <title>Profile</title>
	</head>

	<body>
		<?php
		ini_set('display_errors', 0);
		session_start();
		include '../partials/nav.php';
		include '../config/psql-config.php';


		$user_check = $_SESSION['username'];
		$ses_psql = pg_query($con_trans,"SELECT * from usuarios where correo = '$user_check' ");
		$row = pg_fetch_array($ses_psql);
   		$nombre = $row['nombre'];
   		$apellido = $row['apellido'];

		?>
		<div class="container">
			<div class="row">
				<ul class="nav nav-pills" id="myTab" role="tablist" >

				 </ul>
			</div>
			<div class="row">
				<h3>Bandeja de Entrada</h3>
			</div>
			<div class="row" id="profile">
			    <form action="../consultas/Mensajes_recibidos.php" method="GET">
			    	<div class="col">
			    		<div class="form-group">
					        <button class="btn btn-primary" id="submit" type="submit">Mensajes Recibidos</button>
					    </div>
					</div>
				</form>
			</div>
			<div class="row" id="profile">
					<form action="../consultas/Mensajes_enviados.php" method="GET">
						<div class="col">
							<div class="form-group">
									<button class="btn btn-primary" id="submit" type="submit">Mensajes Enviados</button>
							</div>
					</div>
				</form>
			</div>
			<div class="row" id="profile">
					<form action="../consultas/Enviar_mensaje.php" method="GET">
						<div class="col">
							<div class="form-group">
									<button class="btn btn-primary" id="submit" type="submit">Enviar Mensaje</button>
							</div>
					</div>
				</form>
			</div>
			<div class="row" id="profile">
					<form action="../consultas/Consultas_buscar_mensaje.php" method="GET">
						<div class="col">
							<div class="form-group">
									<button class="btn btn-primary" id="submit" type="submit">Buscar Mensaje</button>
							</div>
					</div>
				</form>
			</div>
<!--
			<div class="row" id="profile">
			    <form action="../consultas/Dinero_por_mes.php" method="GET">
			    	<div class="col">
			    		<div class="form-group">
					        <p>Dinero por mes</p>
					        <input class="form-control" name="nombre" id="search" type="text" placeholder="Nombre de la tienda">
					        <button class="btn btn-primary" id="submit" type="submit">Buscar</button>
					    </div>
					</div>
					</form>
			</div>
		-->
		</div>
	</body>
</html>
