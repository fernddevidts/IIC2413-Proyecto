<!DOCTYPE html>
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



	    <title>Contrato Seguros</title>
	</head>
	<body>
		<?php 
			// ini_set('display_errors', 0);
			session_start();
			include '../../partials/nav.php';
			include '../../config/psql-config.php';
			$id = $_SESSION['id'];

			$con = pg_connect("host=".HOST." dbname=".DATABASE_TRANS." user=".USER_TRANS." password=".PASSWORD_TRANS);

			$year_query = "SELECT EXTRACT(YEAR FROM CURRENT_DATE + interval '2 year')";
			$month_query = "SELECT EXTRACT(MONTH FROM CURRENT_DATE + interval '2 year')";
			$day_query = "SELECT EXTRACT(DAY FROM CURRENT_DATE + interval '2 year')";

			$year_exp = $db_trans -> prepare($year_query);
			$year_exp -> execute();
			$year_exp = $year_exp -> fetchAll();
			$year_exp = $year_exp[0][0];

			$month_exp = $db_trans -> prepare($month_query);
			$month_exp -> execute();
			$month_exp = $month_exp -> fetchAll();
			$month_exp = $month_exp[0][0];

			$day_exp = $db_trans -> prepare($day_query);
			$day_exp -> execute();
			$day_exp = $day_exp -> fetchAll();
			$day_exp = $day_exp[0][0];

			$fecha_exp = $year_exp."-".$month_exp."-".$day_exp;


			echo "<p>fecha!! $fecha_exp</p>";

			if(isset($_POST["agregar"])) {
				header('location: seguros.php');

			$id_seguro = $_POST["id"];


			$query = "INSERT INTO rusuarioseguro (id_usuario, id_seguro, fecha_de_contratacion, fecha_de_expiracion) VALUES ($id, $id_seguro, CURRENT_DATE, '$fecha_exp')";

			$result = $db_trans -> prepare($query);
			$result -> execute();

			$revisar = "SELECT RUS.id_seguro, RUS.id_usuario FROM rusuarioseguro AS RUS WHERE RUS.id_seguro=$id_seguro AND RUS.id_usuario = $id";
			$revision = pg_query($con, $revisar);

			$row = pg_fetch_row($revision);

			$count = pg_num_rows($revision);

			}

		
			$query = "SELECT id_seguro, nombre FROM seguros WHERE id_seguro NOT IN (SELECT id_seguro FROM rusuarioseguro WHERE id_usuario = $id)";
			$result = $db_trans -> prepare($query);
			$result -> execute();
			$seguros = $result -> fetchAll();
		?>

		<div class="container">
			<div class="row">
			</div>
			<div class="row">
				<h3>Contratar Seguro</h3>
			</div>
			<div class="row">
				<?php 
					echo "<div class='row'>";
				    echo "<table class='table'<thead><tr><th scope='col'>ID Seguro</th><th scope='col'>Nombre</th><th></th></tr>";
				    foreach ($seguros as $seguro) {
					    echo "<tbody><form method='post' action=''><tr><td name='id'>$seguro[0]</td><td>$seguro[1]</td>";
					    echo "<td><input type='hidden' name='id' value='$seguro[0]'></input></td>";
					    echo "<td><button class='btn btn-secondary' type='submit' name='agregar'>CONTRATAR</button></td></tr></form>";

				    }
				    echo "</tbody>";
				    echo "</table>";
					echo "</div>";
				?>
			</div>
			<div class="row">
				<form action="seguros.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		</div>
	</body>