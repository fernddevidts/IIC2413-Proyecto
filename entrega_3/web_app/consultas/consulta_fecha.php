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
    <link href="../index.css" rel="stylesheet">
    <link href="../consultas.css" rel="stylesheet">


    <title>NebCoin Bank</title>
	</head>

	<body>

		<?php include '../partials/nav.php';?>
		

		<div class="container">

			<?php 
				$fecha = $_POST["fecha"];
				echo "<div class='row'>";
				echo "<h3>Transacciones para $fecha</h3>";
				echo "</div>";

				include_once "psql-config.php";
				try {
					$db = new PDO("pgsql:dbname=".DATABASE.";host=".HOST.";port=".PORT.";user=".USER.";password=".PASSWORD);
				}
				catch(PDOException $e) {
				echo $e->getMessage();
				}
				$fecha = "'".$_POST["fecha"]."'";


				echo "<div class='row'>";


				$query = "SELECT P.id_pago, P.monto, U1.nombre AS emisor_del_pago, U2.nombre AS receptor_del_pago FROM pagos P, usuarios U1, usuarios U2, pagousuarios PU WHERE P.fecha_transaccion = $fecha AND P.id_pago = PU.id_pago AND PU.id_usuario1 = U1.id_usuario AND PU.id_usuario2 = U2.id_usuario;";



				$result = $db -> prepare($query);
				$result -> execute();

				$transacciones = $result -> fetchAll();
				echo "<table class='table'<thead><tr><th scope='col'>ID Pago</th><th scope='col'>Monto</th><th scope='col'>Nombre</th></tr>";
				foreach ($transacciones as $transaccion) {
					echo "<tbody><tr><td>$transaccion[0]</td><td>$ $transaccion[1]</td><td>$transaccion[2]</td></tr>";
				}
				echo "</tbody>";
				echo "</table>";
				echo "</div>";

			?>
		<div class="row">

			<form action="../consultas.php" method="post">
				<button type="submit" class="btn btn-primary">Volver</button>
			</form>
		</div>
	</div>

	</body>

	<div id="footer">
		<?php include '../partials/footer.php'; ?>
	</div>

</html>