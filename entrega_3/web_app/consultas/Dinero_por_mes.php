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

	<!-- Load c3.css -->
	<link href="http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/consultas//c3/c3.css" rel="stylesheet">

	<!-- Load d3.js and c3.js -->
	<!-- <script src="/c3/d3.v5.min.js" charset="utf-8"></script>  -->
	<script src="http://bases.ing.puc.cl/~grupo6/entrega_3/web_app/consultas/c3/c3.min.js"></script>

	<script src="https://d3js.org/d3.v4.min.js"></script>

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

							$query3 = "SELECT extract(month from P.fecha) as mm, extract(year from P.fecha) as yy, SUM(P.cantidad*X.precio) as gasto
												 FROM productos AS X, (SELECT R.id_producto, R.cantidad, Y.fecha
																					 FROM rcompraproducto as R, (SELECT C.id_compra, C.fecha
																																			FROM compraproducto as C, tiendas as T
																																			WHERE C.id_tienda = T.id_tienda AND T.nombre LIKE '%$nombre_tienda%'
																																		  ) as Y
																					 WHERE Y.id_compra = R.id_compra) as P
												 WHERE X.id_producto = P.id_producto
												 GROUP BY mm, yy

											";



										$nombre_tienda = $_GET['nombre'];

							 $query4 = "SELECT extract(month from P.fecha_de_compra) as mm, extract(year from P.fecha_de_compra) as yy, SUM(S.precio) as gasto
												 FROM servicios S , (SELECT R.id_servicio, Y.fecha_de_compra
																					 FROM rcompraservicio as R,(SELECT C.id_compraservicio, C.fecha_de_compra
																																			FROM compraservicio as C, tiendasdeservicios as T
																																			WHERE C.id_tienda_s = T.id_tienda_s AND T.nombre LIKE '%$nombre_tienda%'
																																			) as Y
																					 WHERE Y.id_compraservicio = R.id_compraservicio) as P
												 WHERE S.id_servicio = P.id_servicio
												 GROUP BY mm, yy
											";

				  $result1 = $db -> prepare($query3);
					$result1 -> execute();
					$tiendas = $result1 -> fetchAll();

					$result2 = $db -> prepare($query4);
					$result2 -> execute();
					$tiendas_s = $result2 -> fetchAll();


                    echo "<div class='row'>";
					echo "<table class='table'<thead><tr><th scope='col'>Mes</th><th scope='col'>Año</th><th scope='col'>Monto</th><th>";
					echo "<tbody>";
					foreach ($tiendas as $tienda) {
						echo "<tr><td>$tienda[0]</td><td>$tienda[1]</td><td>$tienda[2]</td></tr>";
					};
					foreach ($tiendas_s as $tienda_s) {
						echo "<tr><td>$tienda_s[0]</td><td>$tienda_s[1]</td><td>$tienda_s[2]</td></tr>";
					};
					echo "</tbody>";
					echo "</table>";
					echo "</div>";

				?>
			</div>
<!-- php echo arreglo  -->

			<div id="chart">
				<script>
				var chart = c3.generate({
	    data: {
	        columns: [
	            ['Monto', <?php foreach ($tiendas as $tienda) {
								echo "$tienda[2],";
							};
							foreach ($tiendas_s as $tienda) {
								echo "$tienda[2],";
							};
							 ?>]
	        ]
	    },
	    axis: {
	        x: {
	            type: 'category',
	            categories: [ <?php foreach ($tiendas as $tienda) {
								echo "$tienda[0]$tienda[1],";
							};
							foreach ($tiendas_s as $tienda) {
								echo "$tienda[0]$tienda[1],";
							};

							 ?>]
	        }
	    }
	});
			</script>
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
