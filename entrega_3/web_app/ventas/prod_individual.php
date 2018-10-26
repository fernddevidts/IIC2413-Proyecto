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



	    <title>Producto</title>
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
            echo '<tr><td><form method="post" action=""><input type="hidden" name="id_prod" value="$id_prod"/></form></td></tr>';  
		    
		    //$query = "SELECT P.id_producto, P.nombre, P.descripcion, P.precio FROM productos P WHERE P.id_producto = $id_prod";
		    $query = "SELECT P.id_producto, P.nombre, P.descripcion, P.precio, string_agg(T2.nombre::text, '<br>') as tiendas FROM productos P, (SELECT RTP.id_producto, T.nombre FROM rtiendaproducto RTP, tiendas T WHERE RTP.id_producto = $id_prod AND RTP.id_tienda = T.id_tienda) AS T2 WHERE T2.id_producto = P.id_producto GROUP BY P.id_producto, P.nombre, P.descripcion, P.precio";

		    $result = $db_tienda -> prepare($query);
		    $result -> execute();
		    $productos = $result -> fetchAll();
		}

		?>

		<div class="container">
			<div class="row">
				<h3>Producto</h3>
			</div>
			<div class="row">
				<?php 
					echo "<div class='row'>";
				    echo "<table class='table'<thead><tr><th scope='col'>ID Producto</th><th scope='col'>Nombre</th><th scope='col'>Descripción</th><th scope='col'>Precio</th><th scope='col'>Tiendas</th></tr>";
				    foreach ($productos as $producto) {
					    echo "<tbody><tr><td>$producto[0]</td><td>$producto[1]</td><td>$producto[2]</td><td>$producto[3]</td><td>$producto[4]</td></tr>";
				    }
				    echo "</tbody>";
				    echo "</table>";
					echo "</div>";
				?>
			</div>		

			<div class="row">
				<form action="productos.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
			<?php 
            if(isset($_SESSION['id'])) { ?>	
            <div class="row">
				<form action="comprar.php" method="post">
					<button type="submit" class="btn btn-primary">Comprar</button>
					<input type="hidden" name="id_prod" value="<?php echo $id_prod; ?>"/>
				</form>
			</div>
		    <?php } ?>
		</div>

	</body>
</html>