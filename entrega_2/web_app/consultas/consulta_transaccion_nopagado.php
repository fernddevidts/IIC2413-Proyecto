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

				<?php
					$transaccion = $_POST["id_transaccion"];
					echo "<h3>Monto restante para transacción ID: $transaccion</h3>";

					include_once "psql-config.php";
					try {
						$db = new PDO("pgsql:dbname=".DATABASE.";host=".HOST.";port=".PORT.";user=".USER.";password=".PASSWORD);
					}
					catch(PDOException $e) {
					echo $e->getMessage();
					}
					echo "</div>";


					echo "<div class='row'>";

					$query = "SELECT P2.monto FROM (SELECT CP.id_pago, SUM(CP.monto) AS monto FROM cuotapago CP, (SELECT id_cuota FROM cuotas WHERE pagado = 'f') AS C2 WHERE CP.id_cuota = C2.id_cuota GROUP BY CP.id_pago) AS P2 WHERE P2.id_pago = $transaccion;";

					$result = $db -> prepare($query);
					$result -> execute();

					$montos = $result -> fetchAll();


					foreach ($montos as $monto) {
						echo "<h3>$ $monto[0]</h3>";
					}
					
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