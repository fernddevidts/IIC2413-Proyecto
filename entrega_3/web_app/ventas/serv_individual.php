<?php 
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



	    <title>Producto</title>
	</head>

	<body>
		<?php 
		ini_set('display_errors', 0);

		session_start();
		include '../partials/nav.php';
		include '../config/psql-config.php';
		$id = $_SESSION['id'];


        $id_serv = $_POST['id_serv']; // get input    
		    
        //$query = "SELECT SV.id_servicio, SV.nombre, SV.precio, SV.descripcion FROM servicios SV WHERE SV.id_servicio = $id_serv";
        $query = "SELECT SV.id_servicio, SV.nombre, SV.precio, SV.descripcion, string_agg(T2.nombre::text, '<br>') as tiendas FROM servicios SV, (SELECT RTS.id_servicio, T.nombre FROM rtiendaservicio RTS, tiendasdeservicios T WHERE RTS.id_servicio = $id_serv AND RTS.id_tienda_s = T.id_tienda_s) AS T2 WHERE T2.id_servicio = SV.id_servicio GROUP BY SV.id_servicio, SV.nombre, SV.precio, SV.descripcion";

	    $result = $db_tienda -> prepare($query);
	    $result -> execute();
	    $productos = $result -> fetchAll();


		?>

		<div class="container">
			<div class="row">
				<h3>Servicio</h3>
			</div>
			<div class="row">
				<?php 
					echo "<div class='row'>";
				    echo "<table class='table'<thead><tr><th scope='col'>ID Servicio</th><th scope='col'>Nombre</th><th scope='col'>Descripción</th><th scope='col'>Precio</th><th scope='col'>Tiendas</th></tr>";
				    foreach ($productos as $producto) {
					    echo "<tbody><tr><td>$producto[0]</td><td>$producto[1]</td><td>$producto[3]</td><td>$producto[2]</td><td>$producto[4]</td></tr>";
				    }
				    echo "</tbody>";
				    echo "</table>";
					echo "</div>";
				?>
			</div>	

			<?php 
            if(isset($_SESSION['id'])) { ?>
            <div class="row">
				<form action="comprar.php" method="post">
					<button type="submit" class="btn btn-primary">Comprar</button>
					<input type="hidden" name="id_serv" value="<?php echo $id_serv; ?>"/>
				</form>
			</div>
		    <?php } ?>	

			<div class="row">
				<form action="servicios.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
			
		</div>
	</body>
</html>