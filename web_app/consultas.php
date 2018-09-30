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
    <link href="index.css" rel="stylesheet">
    <link href="consultas.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



    <title>NebCoin Bank</title>
	</head>

	<body>
		<?php include 'partials/nav.php'; ?>
		<div class="container">
			<h2>Aquí puedes realizar consultas a la base de datos de NebCoin Bank</h2>
		</div>
		<div class="container">
			<p>Pagos realizados en una fecha específica</p>
			<div class="row">
				<form action="consultas/consulta_fecha.php" method="post">
					<div class="form-group">
						<label for="consultaFecha">Fecha</label>
						<input type="text" name="fecha" class="form-control" id="inputFecha">
					</div>
					<button type="submit" class="btn btn-primary">Consultar</button>
				</form>
			</div>

			<p>Todos los abonos</p>
			<div class="row">

				<form action="consultas/consulta_abonos.php" method="post">
					<button type="submit" class="btn btn-primary">Consultar Abonos</button>
				</form>
			</div>

			<p>Seguro más adquirido</p>
			<div class="row">

				<form action="consultas/consulta_seguro.php" method="post">
					<button type="submit" class="btn btn-primary">Consultar Seguros</button>
				</form>
			</div>

			<p>Persona que más ha pagado</p>
			<div class="row">

				<form action="consultas/consulta_mayor_pago.php" method="post">
					<button type="submit" class="btn btn-primary">Consultar Mayor Pago</button>
				</form>
			</div>

			<p>Monto no pagado para una transacción específica</p>
			<div class="row">
				<form action="consultas/consulta_transaccion_nopagado.php" method="post">
					<div class="form-group">
						<label for="consultaFecha">ID Transacción</label>
						<input type="text" name="id_transaccion" class="form-control" id="inputIdTransaccion">
					</div>
					<button type="submit" class="btn btn-primary">Consultar</button>
				</form>
			</div>


	</div>

	</body>

	<footer class="footer">
		<?php include 'partials/footer.php'; ?>
	</footer>
</html>