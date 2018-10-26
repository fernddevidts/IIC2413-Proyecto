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



	    <title>Productos</title>
	</head>

	<body>
		<?php 
		ini_set('display_errors', 0);

		session_start();
		include '../partials/nav.php';
		include '../config/psql-config.php';
		$id = $_SESSION['id'];

		$query = "SELECT PD.id_producto, PD.nombre FROM productos PD";

		$result = $db_tienda -> prepare($query);
		$result -> execute();
		$productos= $result -> fetchAll();


		?>

		<div class="container">
			<div class="row">
				<h3>Productos</h3>
			</div>
			<div class="row">
				<?php 
					

					// echo "<h3>Monto restante para transacción ID: $transaccion</h3>";

	
					//echo "<div class='row'>";
				    //echo "<table class='table'<thead><tr><th scope='col'>Producto</th></tr>";
                    echo "<div class='row'>";
				    echo "<table class='table'<thead><tr><th scope='col'>Productos</th></tr>";

				    echo '<form method="POST" action="prod_individual.php">';
				    foreach ($productos as $producto) {
				    	echo "<tbody><tr><td><button class='btn btn-secondary' type='submit' value='$producto[0]' name='id_prod'/>  $producto[1]</td></tr>";
					    //echo "<form action='prod_individual.php'><tbody><tr><td><button>$producto[0]</button></td></tr></form> ";
				    }
				    echo "</tbody>";
				    echo '</form>';
				    echo "</table>";
				    echo "</div>";

				    //echo "</tbody>";
				    //echo "</table>";
					//echo "</div>";
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