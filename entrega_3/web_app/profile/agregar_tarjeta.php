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
	    <title>Agregar Tarjeta</title>
	</head>
	<body>
		<?php 
		ob_start();
		ini_set('display_errors', 0);
		session_start();
		include '../partials/nav.php';
		include '../config/psql-config.php';
        $id_usuario = $_SESSION['id'];
		?>
		<div class="container">
			<div class="row">
				<h3>Nueva Tarjeta</h3>
			</div>
			<div class="row">
				<form method="post" action="">
					<div class="col">
						<div class="form-group">
							<div class="row top-buffer">
									<label for='login'><p>Numero</p></label>
									<input type='text' name='numero' class='form-control'>
								</div>
								<div class="row top-buffer">
									<label for='login'><p>CVV</p></label>
									<input type='text' name='cvv' class='form-control'>
								</div>
								<div class="row top-buffer">
									<label for='login'><p>Fecha Expiración</p></label>
									<input type='text' name='fecha_exp' class='form-control'>
								</div>
						</div>
					</div>
					<button name="agregar" type="submit" class="btn btn-primary">Agregar Tarjeta</button>
				</form>
			</div>
			<?php 
				$con = pg_connect("host=".HOST." dbname=".DATABASE_TRANS." user=".USER_TRANS." password=".PASSWORD_TRANS);
				if(isset($_POST["agregar"])) {
				$id_tarjeta = $_POST["numero"];
				$cvv = $_POST["cvv"];
				$fecha_exp = $_POST["fecha_exp"];
				$query = "INSERT INTO tarjetas (id_usuario, id_tarjeta, cvv, fecha_expiracion) VALUES ($id_usuario, $id_tarjeta, $cvv, '$fecha_exp')";
				$result = $db_trans -> prepare($query);
				$result -> execute();
				$revisar = "SELECT T.id_tarjeta FROM tarjetas AS T WHERE T.id_tarjeta=$id_tarjeta";
				$revision = pg_query($con, $revisar);
				$row = pg_fetch_row($revision);
				$count = pg_num_rows($revision);
			    }
				if($count==1) {
					header("location: /~grupo6/entrega_3/web_app/profile/tarjetas.php");
					exit;
				}
			?>
			<div class="row">
				<div class="col">
					<form action="tarjetas.php" method="post">
						<button type="submit" class="btn btn-primary">Volver</button>
					</form>
				</div>
			</div>
		</div>
	</body>