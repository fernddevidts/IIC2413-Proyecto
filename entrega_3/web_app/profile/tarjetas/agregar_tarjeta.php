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
	    <link href="../profile.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



	    <title>Seguros</title>
	</head>
	<body>
		<?php 
		ini_set('display_errors', 0);
		include '../../partials/nav.php';
		include '../../config/psql-config.php';
		?>

		<div class="container">
			<div class="row">
				<?php 
					session_start();
					$id_usuario = $_SESSION['id'];
				?>
			</div>
			<div class="row">
				<h3>Nueva Tarjeta</h3>
			</div>
			<div class="row">
				<form method="post">
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
				</form>
				
			</div>
			<div class="row">
				<form action="tarjetas.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		</div>
	</body>