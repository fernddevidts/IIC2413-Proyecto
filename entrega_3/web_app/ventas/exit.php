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
	    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



	    <title>Compra Exitosa</title>
	</head>

	<body>
		<?php 
		ini_set('display_errors', 0);

		session_start();
		include '../partials/nav.php';
		include '../config/psql-config.php';
		$id = $_SESSION['id'];

		$n_cuotas = $_POST['cuotas'];
		$id_tienda = $_POST['tienda'];
		$id_item = $_POST['item'];		
		$tipo_item = $_POST['tipo_item'];
		if ($tipo_item == 'producto') {
			$n_unidades = $_POST['unidades'];
		}


		$query = "SELECT to_char(now()::date, 'DD/MM/YYYY')";
		$result = $db_tienda -> prepare($query);
		$result -> execute();

		while ($row = $result -> fetch()){
		    $fecha = $row[0];
		}

		if ($tipo_item == 'producto') {

		    $query2 = "SELECT id_compra + 1 FROM compraproducto WHERE id_compra = (SELECT MAX(id_compra) FROM compraproducto)";
		    $result2 = $db_tienda -> prepare($query2);
		    $result2 -> execute();

		    while ($row2 = $result2 -> fetch()){
		        $id_compra = $row2[0];
		    }

		    $query3 = "INSERT INTO compraproducto VALUES ($id_compra, '$fecha', $id_tienda, $id)"; 
		    $result3 = $db_tienda -> prepare($query3);
		    $result3 -> execute();

		    $query4 = "SELECT id_compraproducto + 1 FROM rcompraproducto WHERE id_compraproducto = (SELECT MAX(id_compraproducto) FROM rcompraproducto)";
		    $result4 = $db_tienda -> prepare($query4);
		    $result4 -> execute();

		    while ($row4 = $result4 -> fetch()){
		        $id_compraproducto = $row4[0];
		    }

		    $query5 = "INSERT INTO rcompraproducto VALUES ($id_compra, $id_item, $n_unidades, $id_compraproducto)"; 
		    $result5 = $db_tienda -> prepare($query5);
		    $result5 -> execute();

		    $query6 = "SELECT precio*$n_unidades FROM productos WHERE id_producto = $id_item";
		    $result6 = $db_tienda -> prepare($query6);
		    $result6 -> execute();

		    while ($row6 = $result6 -> fetch()){
		        $monto_pago = $row6[0];
		    }

	    }

	    elseif ($tipo_item == 'servicio') {

	    	$query2 = "SELECT id_compraservicio + 1 FROM compraservicio WHERE id_compraservicio = (SELECT MAX(id_compraservicio) FROM compraservicio)";
		    $result2 = $db_tienda -> prepare($query2);
		    $result2 -> execute();

		    while ($row2 = $result2 -> fetch()){
		        $id_compra = $row2[0];
		    }

		    $query25 = "SELECT to_char((now()::date + (6 * interval '1 month')), 'DD/MM/YYYY')";
		    $result25 = $db_tienda -> prepare($query25);
		    $result25 -> execute();

		    while ($row25 = $result25 -> fetch()){
		        $fecha_exp_servicio = $row25[0];
		    }

		    $query3 = "INSERT INTO compraservicio VALUES ($id_compra, $id_tienda, $id, '$fecha', '$fecha_exp_servicio')"; 
		    $result3 = $db_tienda -> prepare($query3);
		    $result3 -> execute();

		    $query4 = "SELECT id_compraserviciounitaria + 1 FROM rcompraservicio WHERE id_compraserviciounitaria = (SELECT MAX(id_compraserviciounitaria) FROM rcompraservicio)";
		    $result4 = $db_tienda -> prepare($query4);
		    $result4 -> execute();

		    while ($row4 = $result4 -> fetch()){
		        $id_compraserviciounitaria = $row4[0];
		    }

		    $query5 = "INSERT INTO rcompraservicio VALUES ($id_item, $id_compra, $id_compraserviciounitaria)"; 
		    $result5 = $db_tienda -> prepare($query5);
		    $result5 -> execute();

		    $query6 = "SELECT precio FROM servicios WHERE id_servicio = $id_item";
		    $result6 = $db_tienda -> prepare($query6);
		    $result6 -> execute();

		    while ($row6 = $result6 -> fetch()){
		        $monto_pago = $row6[0];
		    }

	    }

		$query7 = "SELECT id_pago + 1 FROM pagos WHERE id_pago = (SELECT MAX(id_pago) FROM pagos)";
		$result7 = $db_trans -> prepare($query7);
		$result7 -> execute();

		while ($row7 = $result7 -> fetch()){
		    $id_pago = $row7[0];
		}

		
		$query8 = "INSERT INTO pagos VALUES ($id_pago, $id, $id_tienda, $monto_pago, '$fecha')"; 
		$result8 = $db_trans -> prepare($query8);
		$result8 -> execute();

		$monto_cuota = $monto_pago/$n_cuotas;

		$query9 = "SELECT id_cuota FROM cuotas WHERE id_cuota = (SELECT MAX(id_cuota) FROM cuotas)";
		$result9 = $db_trans -> prepare($query9);
		$result9 -> execute();

		while ($row9 = $result9 -> fetch()){
		    $id_ult_cuota = $row9[0];
		}

		foreach (range(1, $n_cuotas) as $numero) {
			$id_cuota = $id_ult_cuota + $numero;
			$query10 = "SELECT to_char((now()::date + ($numero * interval '1 month')), 'DD/MM/YYYY')";
		    $result10 = $db_tienda -> prepare($query10);
		    $result10 -> execute();

		    while ($row10 = $result10 -> fetch()){
		        $fecha_expiracion = $row10[0];
		        $query11 = "INSERT INTO cuotas VALUES ($id_cuota, $id_pago, $monto_cuota, '$fecha_expiracion', FALSE)"; 
		        $result11 = $db_trans -> prepare($query11);
		        $result11 -> execute();
		    }

		}

		?>



		<div class="container">
			<div class="row">
				<h3>¡Éxito!</h3>
			</div>
			<div class="row">
				<?php 

                    echo "<div class='row'>";
                    
                    echo 'Su compra ha sido realizada con éxito.';	
                    	    
				    echo "</div>";

				?>
			</div>
			

			<div class="row">
				<form action="../profile/profile.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		</div>
	</body>
</html>