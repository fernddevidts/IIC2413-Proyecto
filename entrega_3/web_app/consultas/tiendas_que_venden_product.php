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
    <link href="../index.css" rel="stylesheet">
    <link href="../consultas.css" rel="stylesheet">


    <title>NebCoin Bank</title>
	</head>

	<body>
		<?php 
		include '../partials/nav.php';
		include '../config/psql-config.php';

		?>
		<div class="container">
			<div class="row">
				<h3>Nombres de tienda</h3>

				<?php

					echo "</div>";
					echo "<div class='row'>";

					
					

					if(!empty($_REQUEST['id_prod'])) {
						$id_prod = $_REQUEST['id_prod'];

						$query = "SELECT T.nombre, T.id_tienda FROM tiendas T,productos P,rtiendaproducto RT WHERE P.id_producto = '$id_prod' and P.id_producto = RT.id_producto and T.id_tienda = RT.id_tienda";
					    $result = $db_tienda -> prepare($query);
					    $result -> execute();
					    $tiendas = $result -> fetchAll();

		            }

		            elseif( (!empty($_REQUEST['id_serv'])) || ($_REQUEST['id_serv'] == 0)) {
		            	$id_serv = $_REQUEST['id_serv'];
		            	$query = "SELECT T.nombre, T.id_tienda_s FROM tiendasdeservicios T, servicios S,rtiendaservicio RT WHERE S.id_servicio = '$id_serv' and S.id_servicio = RT.id_servicio and T.id_tienda_s = RT.id_tienda_s";
					    $result = $db_tienda -> prepare($query);
					    $result -> execute();
					    $tiendas = $result -> fetchAll();

		            }


					echo "<table class='table'<thead><tr><th scope='col'>Nombre</th><th scope='col'>Id</th></tr>";
					foreach ($tiendas as $tienda) {
						echo "<tbody><tr><td>$tienda[0]</td><td>$tienda[1]</td></tr>";
					}

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
