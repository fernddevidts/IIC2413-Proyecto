<?php
include '../login/session.php';
ini_set('display_errors', 0);
?>
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
				<h3>Nombres de producto o servicio</h3>

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
          $nombre_tienda = $_GET['query'];
					$query = "SELECT P.nombre, P.id_producto,P.descripcion
          FROM productos AS P
          WHERE P.nombre LIKE '%$nombre_tienda%'
					UNION
					SELECT S.nombre, S.id_servicio,S.descripcion
          FROM servicios AS S
          WHERE S.nombre LIKE '%$nombre_tienda%'
          ;";
					$result = $db -> prepare($query);
					$result -> execute();

					$seguros = $result -> fetchAll();

					echo "<table class='table'<thead><tr><th scope='col'>Nombre</th><th scope='col'>Descripcion</th><th scope='col'>Tiendas</th></tr>";
					foreach ($seguros as $seguro) {
						echo "<tbody><tr><td>$seguro[0]</td><td>$seguro[2]</td>><td><a href='tiendas_que_venden_product.php?store_id=".$seguro[1]."'>Detalle de tienda</a></td>";
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
