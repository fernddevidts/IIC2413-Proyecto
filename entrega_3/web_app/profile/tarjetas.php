<?php
   include '../login/session.php';
   ini_set('display_errors', 0);
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



	    <title>Tarjetas</title>
	</head>
	<body>
		<?php 
			
		// ini_set('display_errors', 0);
		include '../partials/nav.php';
		?>

		<div class="container">
			<div class="row">
				<?php 
					session_start();
					$id = $_SESSION['id'];
					if(isset($_POST["remove"])) {
					$con = pg_connect("host=".HOST." dbname=".DATABASE_TRANS." user=".USER_TRANS." password=".PASSWORD_TRANS);

					$id_borrar = $_POST["id"];
					$query_borrar = "DELETE FROM tarjetas WHERE id_tarjeta=$id_borrar;";
					$result_borrar = $db_trans -> prepare($query_borrar);
					$result_borrar -> execute();
					$revision = pg_query($con, $query_borrar);

					$row = pg_fetch_row($revision);

					$active = $row['active'];

					$count = pg_num_rows($revision);
					}

					$query = "SELECT T.id_usuario, T.id_tarjeta, T.fecha_expiracion FROM tarjetas T WHERE T.id_usuario = $id";

					$result = $db_trans -> prepare($query);
					$result -> execute();
					$tarjetas = $result -> fetchAll();
				?>
			</div>
			<div class="row">
				<h3>Tarjetas</h3>
				<?php
					echo "<table class='table'><thead><tr><th scope='col'>ID Tarjeta</th><th scope='col'>Fecha Expiracion</th><th scope='col'></th></tr>";
					foreach ($tarjetas as $tarjeta) {
						echo "<tbody><form method='post' action=''><tr><td name='id'>$tarjeta[1]</td><td>$tarjeta[2]</td>";
						echo "<td><input type='hidden' name='id' value='$tarjeta[1]'></input></td>";
						echo "<td><button class='btn btn-secondary' id='$tarjeta[1]' type='submit' name='remove'>Remove</button></td></tr></form>";
					}
		
					echo "</tbody>";
					echo "</table>";
					echo "</div>";
				 ?>
			</div>

			<div class="container">
				<div class="row">
					<div class="col">
						<form action="profile.php" method="post">
							<button type="submit" class="btn btn-primary">Volver</button>
						</form>
					</div>
					<div class="col">
						<form action="agregar_tarjeta.php" method="post">
							<button type="submit" class="btn btn-primary">Agregar Tarjeta</button>
						</form>
					</div>
				</div>
			</div>
	</body>