<?php
   include('../login/session.php');
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!-- Bootstrap -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



	    <!-- Stylesheet -->
	    <link href="profile.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



	    <title>Compras</title>
	</head>
	<body>
		<?php 
		ini_set('display_errors', 0);
		include '../partials/nav.php';
		include '../config/psql-config.php';
		$id = $_SESSION['id'];

		$query2 = "SELECT CP.id_compra, CP.id_tienda, CP.fecha, string_agg(PD.nombre::text, '<br>') as productos FROM compraproducto CP, rcompraproducto RCP, productos PD WHERE CP.id_compra = RCP.id_compra AND CP.id_usuario = $id AND RCP.id_producto = PD.id_producto GROUP BY CP.id_compra, CP.id_tienda, CP.fecha";


		$result2 = $db_tienda -> prepare($query2);
		$result2 -> execute();
		?>

		<div class="container">
			<div class="row">
				<h3>Compras</h3>
			</div>
			<div class="row">
				<?php 
					

					echo "<div class='row'>";
				    echo "<table class='table'<thead><tr><th scope='col'>ID Compra</th><th scope='col'>Productos</th><th scope='col'>Monto</th><th scope='col'>Cuotas(id, monto, fecha de expiración, pagado)</th></tr>";

				    while ($row2 = $result2 -> fetch()) {
				    	$query1 = "SELECT id_pago, id_usuario2, monto, fecha_transaccion, string_agg(informacion_cuotas::text, '<br>') AS cuotas FROM (SELECT PG.id_pago, PG.id_usuario2, PG.monto, PG.fecha_transaccion, concat_ws(', ', C.id_cuota, C.monto, C.fecha_expiracion, C.pagado) AS informacion_cuotas FROM pagos PG, cuotas C WHERE PG.id_pago = C.id_pago) AS C1 GROUP BY id_pago, id_usuario2, monto, fecha_transaccion";
				    	$result1 = $db_trans -> prepare($query1);
		                $result1 -> execute();
                        while ($row1 = $result1 -> fetch()) {
                            if ($row2[1] == $row1[1] && $row2[2] == $row1[3]) {
                                echo "<tbody><tr><td>$row2[0]</td><td>$row2[3]</td><td>$row1[2]</td><td>$row1[4]</td></tr>";
                            }
                        }
                    }

				    echo "</tbody>";
				    echo "</table>";
					echo "</div>";
				?>
			</div>
			
			<div class="row">
				<form action="profile.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		</div>
	</body>