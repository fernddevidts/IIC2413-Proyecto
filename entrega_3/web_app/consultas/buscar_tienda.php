<!DOCTYPE html>
<?php include '../login/session.php';
ini_set('display_errors', 0); ?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <!-- Stylesheet -->
    <link href="../profile/profile.css" rel="stylesheet">
    <link href="../consultas.css" rel="stylesheet">


    <title>NebCoin Bank</title>
	</head>

	<body>
		<?php include '../partials/nav.php'; ?>
		<div class="container">
			<div class="row">
				<h3>Tiendas</h3>

				<?php
					include_once "psql-config.php";
					try {
						$db = new PDO("pgsql:dbname=".DATABASE_TIENDA.";host=".HOST.";port=".PORT_TIENDA.";user=".USER_TIENDA.";password=".PASSWORD_TIENDA);
					}
					catch(PDOException $e) {
					echo $e->getMessage();
					}

					echo "</div>";


					echo "<div class='row'>";
          $nombre_tienda = $_GET['nombre'];
					$query = "SELECT TS.nombre, TS.id_tienda
          FROM tiendas AS TS
          WHERE TS.nombre LIKE '%$nombre_tienda%'
          UNION
          SELECT TS.nombre, TS.id_tienda_s
          FROM tiendasdeservicios AS TS
          WHERE TS.nombre LIKE '%$nombre_tienda%'
          ;";
					$result = $db -> prepare($query);
					$result -> execute();

					$seguros = $result -> fetchAll();

					echo "<table class='table'<thead><tr><th scope='col'>Nombre</th><th scope='col'>Id</th><th scope='col'>Link</th></tr>";
					foreach ($seguros as $seguro) {
						echo "<tbody><tr><td>$seguro[0]</td><td>$seguro[1]</td><td><a href='tiendaquevendeproductos.php?tienda=".$seguro[1]."'><button class='btn btn-secondary' type='submit' name='id_prod'/>Ir a $seguro[0]</a></td></tr>";
					};
					echo "</tbody>";
					echo "</table>";



					echo "</div>";



				?>

			<div class="row">
				<form action="../profile/profile.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		</div>

	</body>

	<div id="footer">
		<?php include '../partials/footer.php'; ?>
	</div>

</html>
