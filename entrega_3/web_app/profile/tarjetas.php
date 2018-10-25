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
	    <link href="../profile.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



	    <title>Tarjetas</title>
	</head>
	<body>
		<?php 
			
		// ini_set('display_errors', 0);
		include '../../partials/nav.php';
		include '../../config/psql-config.php';
		?>

		<div class="container">
			<div class="row">
				<?php 
				$id = 0;
					session_start();
					$id_usuario = $_SESSION['id'];

					$query = "";

					$result = $db_trans -> prepare($query);
					$result -> execute();

					$tarjetas = $result -> fetchAll();


				?>
			</div>
			<div class="row">
				<h3>Tarjetas</h3>
				<?php
					// echo "<table class='table'><thead><tr><th scope='col'>ID Tarjeta</th><th scope='col'>Fecha Expiracion</th><th scope='col'></th></tr>";
					// foreach ($tarjetas as $tarjeta) {
					// 	echo "<tbody method='post'><tr id='$tarjeta[0]'><td name='remove'>$tarjeta[0]</td><td>$tarjeta[1]</td>";
					// 	echo "<td><button type='submit'>Remove</button></td></tr>"
					// }
		
					// echo "</tbody>";
					// echo "</table>";
					// echo "</div>";

					echo "<table class='table'><thead><tr><th scope='col'>ID Tarjeta</th><th scope='col'>Fecha Expiracion</th><th scope='col'></th></tr>";
					echo "<tbody><form method='post' action=''><tr><td id='id' name='id'>1</td><td>123</td>";
					echo "<input type='hidden' name='id' value='1'></input>";
					echo "<td><button id='1' type='submit' name='remove'>Remove</button></td></tr></form>";
					
		
					echo "</tbody>";
					echo "</table>";
					echo "</div>";
					if (isset($_POST["remove"]))
					{
						$id = $_POST['id'];
					  echo "$id es tu id";
					} 
					else 
					{
					  $user = null;
					  echo "no username supplied";
					}
				 ?>
			</div>

			<div class="row">
				<div class="col">
					<form action="../profile.php" method="post">
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