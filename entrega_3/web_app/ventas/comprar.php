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



	    <title>Compra</title>
	</head>

	<body>
		<?php 
		ini_set('display_errors', 0);

		session_start();
		include '../partials/nav.php';
		include '../config/psql-config.php';
		$id = $_SESSION['id'];

		if(!empty($_POST['id_prod'])) {
            $id_prod = $_POST['id_prod']; // get input   		    

		    $query = "SELECT T2.id_producto, T2.nombre FROM productos P, (SELECT RTP.id_producto, T.nombre FROM rtiendaproducto RTP, tiendas T WHERE RTP.id_producto = $id_prod AND RTP.id_tienda = T.id_tienda) AS T2 WHERE T2.id_producto = P.id_producto";
		    $query2 = "SELECT P.nombre FROM productos P WHERE P.id_producto = $id_prod";

		    $result = $db_tienda -> prepare($query);
		    $result -> execute();
		    $items = $result -> fetchAll();

		    $result2 = $db_tienda -> prepare($query2);
		    $result2 -> execute();
		    while ($row2 = $result2 -> fetch()) {
		    	$nombre = $row2[0];
		    }
		}

		if(!empty($_POST['id_serv'])) {
            $id_serv = $_POST['id_serv']; // get input   		    

		    $query = "SELECT T2.id_servicio, T2.nombre FROM servicios SV, (SELECT RTS.id_servicio, T.nombre FROM rtiendaservicio RTS, tiendasdeservicios T WHERE RTS.id_servicio = $id_serv AND RTS.id_tienda_s = T.id_tienda_s) AS T2 WHERE T2.id_servicio = SV.id_servicio";
		    $query2 = "SELECT SV.nombre FROM servicios SV WHERE SV.id_servicio = $id_serv";

		    $result = $db_tienda -> prepare($query);
		    $result -> execute();
		    $items = $result -> fetchAll();

		    $result2 = $db_tienda -> prepare($query2);
		    $result2 -> execute();
		    while ($row2 = $result2 -> fetch()) {
		    	$nombre = $row2[0];
		    }
		}

		?>

		<div class="container">
			<div class="row">
				<h3><?php echo $nombre; ?></h3>
			</div>
			<div class="row">
				<?php 
					
	
				    echo '<form id="my-form" method="post" action="exit.php">';

				    echo "<div class='row'>";
				    echo '¿Cuántas unidades del producto desea?';
				    echo "</div>";

                    echo "<div class='row'>";
				    echo '<select name="unidades" size="1">';
				    foreach (range(1, 10) as $numero) {
				    	echo "<option value='$numero'>$numero</option> <br>";
				    }
				    echo '</select>';
				    echo "</div>";

				    echo "<div class='row'>";
				    echo '¿En qué tienda desea comprar?';
				    echo '</div>';

                    echo "<div class='row'>";
				    echo '<select name="tienda" size="1">';
				    foreach ($items as $item) {
					    echo "<option value='$item[0]'>$item[1]</option> <br>";
				    }
				    echo '</select>';
				    echo "</div>";

				    echo "<div class='row'>";
				    echo '¿En cuántas cuotas desea realizar el pago?';
				    echo "</div>";

				    echo "<div class='row'>";
				    echo '<select name="cuotas" size="1">';
				    foreach (range(1, 6) as $numero) {
				    	echo "<option value='$numero'>$numero</option> <br>";
				    }
				    echo '</select>';
				    echo "</div>";
				    
				    echo '</form>';
				?>
			</div>		

			<div class="row">
				<form action="../profile/profile.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
            <div class="row">
				<form action="exit.php" method="post">
					<button type="submit" class="btn btn-primary">Comprar</button>
				</form>
			</div>
		</div>

	</body>
</html>