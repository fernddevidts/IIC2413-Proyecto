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
		<?php include '../partials/nav.php'; ?>
		<div class="container">
			<div class="row">
				<h3>Seguros más adquiridos</h3>
				
				<?php
					include_once "psql-config.php";
					try {
						$db = new PDO("pgsql:dbname=".DATABASE.";host=".HOST.";port=".PORT.";user=".USER.";password=".PASSWORD);
					}
					catch(PDOException $e) {
					echo $e->getMessage();
					}


					/*$query = "SELECT S.id_seguro, S.nombre FROM Seguros S, (SELECT Suma.id_seguro, MAX(Suma.total) FROM (SELECT US.id_seguro, COUNT(*) AS total FROM usuarioseguro US GROUP BY US.id_seguro) AS Suma) AS Final WHERE S.id_seguro = Final.id_seguro;";

					$result = $db -> prepare($query);
					$result -> execute();

					$transacciones = $result -> fetchAll();
						echo "<table><tr><th>ID Pago</th><th>Monto</th><th>Nombre</th><th>Apellido</th><th>Nombre Empresa</th></tr>";
					foreach ($transacciones as $transaccion) {
						echo "<tr><td>$transaccion[0]</td><td>$transaccion[1]</td><td>$transaccion[2]</td><td>$transaccion[3]</td><td>$transaccion[4]</td></tr>";
					}
					echo "</table>";*/


				?>
			</div>

			<div class="row">
				<form action="../consultas.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		</div>

	</body>

</html>