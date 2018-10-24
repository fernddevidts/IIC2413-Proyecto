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
				<h3>Persona que más ha pagado</h3>

				<?php
					include_once "psql-config.php";
					try {
						$db = new PDO("pgsql:dbname=".DATABASE.";host=".HOST.";port=".PORT.";user=".USER.";password=".PASSWORD);
					}
					catch(PDOException $e) {
					echo $e->getMessage();
					}

					echo "</div>";

					echo "<div class='row'>";

					$query = "SELECT U.id_usuario, U.nombre, U.apellido FROM usuarios U, (SELECT PU.id_usuario1, SUM(P.monto) AS monto FROM pagousuarios PU, Pagos P WHERE PU.id_pago = P.id_pago GROUP BY id_usuario1) AS Montos WHERE U.id_usuario = Montos.id_usuario1 AND Montos.monto = (SELECT MAX(monto) FROM (SELECT PU.id_usuario1, SUM(P.monto) as monto FROM pagousuarios PU, Pagos P WHERE PU.id_pago = P.id_pago GROUP BY id_usuario1) AS Final); 
";

					$result = $db -> prepare($query);
					$result -> execute();

					$personas = $result -> fetchAll();


					echo "<table class='table'<thead><tr><th scope='col'>ID Usuario</th><th scope='col'>Nombre </th><th>Apellido</th></tr>";
					foreach ($personas as $persona) {
						echo "<tbody><tr><td>$persona[0]</td><td>$persona[1]</td><td>$persona[2]</td></tr>";
					}
					echo "</tbody>";
					echo "</table>";


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