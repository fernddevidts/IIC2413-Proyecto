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
		    </div>
		    <div class="row">

				<?php
					include_once "psql-config.php";
					try {
						$db = new PDO("pgsql:dbname=".DATABASE_TIENDA.";host=".HOST.";port=".PORT_TIENDA.";user=".USER_TIENDA.";password=".PASSWORD_TIENDA);
					}
					catch(PDOException $e) {
					echo $e->getMessage();
					}


                    $nombre_tienda = $_GET['nombre'];

						$query3 = "SELECT CONCAT(U.nombre, U.apellido) as nombre_completo, H.Gastos
											 FROM Usuarios as U, (SELECT SUM(X.cantidad*P.precio) as Gastos, X.id_usuario
																					 FROM (SELECT R.id_producto, R.cantidad, Y.id_usuario
																					 FROM rcompraproducto as R, (SELECT C.id_compra, C.id_usuario
																					 														FROM compraproducto as C, tiendas as T
																					 														WHERE T.id_tienda = C.id_tienda AND T.nombre LIKE '%$nombre_tienda%') as Y
																					 WHERE Y.id_compra = R.id_compra) as X, productos as P
																					 WHERE X.id_producto = P.id_producto
																					 GROUP BY X.id_usuario) as H
											 WHERE U.id_usuario = H.id_usuario
											 ORDER BY H.Gastos DESC

											 ";
							 $query4 = "SELECT CONCAT(U.nombre,U.apellido) as nombre_completo, H.Gastos
			 															 FROM Usuarios as U, (SELECT SUM(S.precio) as Gastos, X.id_usuario
			 																									 FROM (SELECT R.id_servicio, Y.id_usuario
			 																									 FROM rcompraservicio as R, (SELECT C.id_compraservicio, C.id_usuario
			 																									 														FROM compraservicio as C, tiendasdeservicios as T
			 																									 														WHERE T.id_tienda_s = C.id_tienda_s AND T.nombre LIKE '%$nombre_tienda%') as Y
			 																									 WHERE Y.id_compraservicio = R.id_compraservicio) as X, servicios as S
			 																									 WHERE X.id_servicio = S.id_servicio
			 																									 GROUP BY X.id_usuario) as H
			 															 WHERE U.id_usuario = H.id_usuario
			 															 ORDER BY H.Gastos DESC
																		 ";
				  $result1 = $db -> prepare($query3);
					$result1 -> execute();
					$tiendas = $result1 -> fetchAll();

					$result2 = $db -> prepare($query4);
					$result2 -> execute();
					$tiendas_s = $result2 -> fetchAll();


                    echo "<div class='row'>";
					echo "<table class='table'<thead><tr><th scope='col'>Nombre</th><th scope='col'>Monto</th><th";
					echo "<tbody>";
					foreach ($tiendas as $tienda) {
						echo "<tr><td>$tienda[0]</td><td>$tienda[1]</td></tr>";
					};
					foreach ($tiendas_s as $tienda_s) {
						echo "<tr><td>$tienda_s[0]</td><td>$tienda_s[1]</td></tr>";
					};   
					echo "</tbody>";
					echo "</table>";
					echo "</div>";

				?>
			</div>

			<div class="row">
				<form action="../consultas/Estadisticas.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		</div>

	</body>

	<div id="footer">
		<?php include '../partials/footer.php'; ?>
	</div>

</html>
