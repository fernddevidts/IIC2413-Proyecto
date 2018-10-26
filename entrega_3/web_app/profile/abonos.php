<?php
   include '../login/session.php';
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

		<script type="text/javascript" src="valor_nc.js"></script>

	    <!-- Stylesheet -->
	    <link href="profile.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



	    <title>Abonar</title>
	</head>
	<body onload=UpdateEthPrice()>
		<?php 
		ini_set('display_errors', 0);
		include '../partials/nav.php';
		include '../config/psql-config.php';
		?>
		<div class="container">
			<div class="row">
				<?php 
					session_start();
					$id_usuario = $_SESSION['id'];
				?>
			</div>
			<div class="row">
				<h3>Nuevo Abono</h3>
			</div>

			<div class="row">
				<p>Valor NebCoin: </p>
				<p id="valor_nc"></p>
			</div>
			<div class="row">
				<form method="post" action="">

					<div class="col">
						<div class="form-group">
							<div class="row top-buffer">
									<label for='login'><p>Monto</p></label>
									<input type='text' name='monto' class='form-control'>
								</div>
								<div class="row top-buffer">
									<label for='login'><p>Numero Tarjeta</p></label>
									<select>
										<?php 
										$query = "SELECT T.id_usuario, T.id_tarjeta, T.fecha_expiracion FROM tarjetas T WHERE T.id_usuario = $id_usuario";

										$result = $db_trans -> prepare($query);
										$result -> execute();
										$tarjetas = $result -> fetchAll();
										foreach ($tarjetas as $tarjeta){
										echo "<option value='$tarjeta[1]' name='numero_tarjeta'>$tarjeta[1]</option>";
										echo "<input type='hidden' name='numero_tarjeta' value=$tarjeta[1]'></input>";
										}		
										?>
									</select>
									<!-- <input type='text' name='numero_tarjeta' class='form-control'> -->
								</div>
							</div>
						</div>
					</div>
					<button name="abonar" type="submit" class="btn btn-primary">Abonar</button>
				</form>
			<?php 
				$ncPrice = $_COOKIE['ncPrice'];
				$ncPrice = floatval($ncPrice);
				$con = pg_connect("host=".HOST." dbname=".DATABASE_TRANS." user=".USER_TRANS." password=".PASSWORD_TRANS);

				if(isset($_POST["abonar"])) {
					$query_last_id = "SELECT id_abono FROM abonos ORDER BY id_abono DESC LIMIT 1;";
					$ultimo_id = $db_trans -> prepare($query_last_id);
					$ultimo_id -> execute();
					$id_abono = $ultimo_id -> fetchAll();
					$id_abono = intval($id_abono[0][0]) + 1;


					$id_tarjeta = intval($_POST["numero_tarjeta"]);
					$monto = intval($_POST["monto"]);
					
					$query = "INSERT INTO abonos (id_tarjeta, cantidad, fecha, valor_nebcoin, id_abono) VALUES ($id_tarjeta, $monto, CURRENT_DATE, $ncPrice, $id_abono)";

					$result = $db_trans -> prepare($query);
					$result -> execute();

					$revisar = "SELECT id_abono FROM abonos WHERE id_abono=$id_abono";
					$revision = pg_query($con, $revisar);

					$row = pg_fetch_row($revision);

					$count = pg_num_rows($revision);
				}
				if($count==1) {
					echo "<p>Se han abonado $monto a tu saldo</p>";
					$query = "SELECT AB.abonado + R.monto - E.monto AS saldo_actual FROM (SELECT SUM(monto) as monto FROM (SELECT P.monto FROM pagos P WHERE P.id_usuario1 = $id_usuario UNION SELECT 0) C2) E, (SELECT SUM(abonado) AS abonado FROM (SELECT A.cantidad * A.valor_nebcoin AS abonado FROM abonos A, tarjetas TU WHERE A.id_tarjeta = TU.id_tarjeta AND TU.id_usuario =  $id_usuario  UNION SELECT 0) AS C2) AB, (SELECT SUM(monto) as monto FROM (SELECT P.monto FROM pagos P WHERE P.id_usuario2 =  $id_usuario  UNION SELECT 0) C2) R";
					$result = $db_trans -> prepare($query);
					$result -> execute();
					$saldos = $result -> fetchAll();
					echo "<div class='row'>";
				    echo "<table class='table'<thead><tr><th scope='col'>Saldo Actual</th></tr>";
				    foreach ($saldos as $saldo) {
					    echo "<tbody><tr><td>$saldo[0]</td></tr>";
				    }
				    echo "</tbody>";
				    echo "</table>";
					echo "</div>";

				}

			?>
		<div class="row">
			<div class="col">
				<form action="profile.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		</div>
	</div>
</body>