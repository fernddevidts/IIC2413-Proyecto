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
	    <link src="profile.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



	    <title>Profile</title>
	</head>

	<body>
		<?php 
		ini_set('display_errors', 0);
		session_start();
		include '../partials/nav.php';
		include '../config/psql-config.php';
		$id = $_SESSION['id'];
		$username = $_SESSION['username'];

		$query = "SELECT * FROM Usuarios WHERE id=$id";
		$result = $db_trans -> prepare($query);
		$result -> execute();

		$usuarios = $result -> fetchAll();

		?>
		<div class="container">
			<div class="row">
				<ul class="nav nav-pills" id="myTab" role="tablist" >
     				 <li class="nav-item">
				        <a class="nav-link" id="transferencias-pill" href="transferencias.php" role="tab" onclick="selected()">Transferencias</a>
				     </li>
				     <li class="nav-item">
				     	<a class="nav-link" id="compras-pill" href="compras.php" role="tab" onclick="selected()">Compras</a>
				     </li>
				     <li class="nav-item">
				     	<a class="nav-link" id="tarjetas-pill" href="tarjetas/tarjetas.php" role="tab" onclick="selected()">Tarjetas</a>
				     </li>
				     <li class="nav-item">
				     	<a class="nav-link" id="seguros-pill" href="seguros/seguros.php" role="tab" onclick="selected()">Seguros</a>
				     </li>
				 </ul>
			</div>
			<div class="row">
				<?php
				foreach ($usuarios as $usuario) {
					echo "<h3>$usuario[2] $usuario[1]</h3>";
				}
				?>
			</div>

		</div>
	</body>
</html>