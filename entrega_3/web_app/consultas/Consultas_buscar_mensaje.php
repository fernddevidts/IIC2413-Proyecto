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


<?php include '../partials/nav.php'; ?>
	    <title>Buscar Mensajes</title>
	</head>

	<body>

		<div class="container">
			<div class="row">
				<h3>Buscar Mensajes</h3>
			</div>
			<div class="row">

			</div>

			<?php
			if(!isset($_SESSION['id'])) { ?>
			<div class="row">
				<form action="../consultas/Buscar_mensajes/msg_not_words.php" method="GET">
					<p>Mensajes que no contengan palabras</p>
					<input class="form-control" name="nombre1" id="search" type="text" placeholder="Ingrese palabras que no esten en el mensaje..">
					<input class="form-control" name="nombre" id="search" type="text" placeholder="Ingrese palabras que si esten en el mensaje..">

					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
			</div>
			<div class="row">
				<form action="../consultas/Buscar_mensajes/msg_yes_words.php" method="GET">
					<p>Mensajes que contengan palabras</p>
					<input class="form-control" name="nombre" id="search" type="text" placeholder="Ingrese palabras separadas por comas..">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
			</div>
			<div class="row">
				<form action="../consultas/Buscar_mensajes/msg_user_frase.php" method="GET">
					<p>Mensajes enviados por un usuario que contenga una frase especifica</p>
					<input class="form-control" name="id" id="search" type="text" placeholder="Ingrese usuario..">
					<input class="form-control" name="mensaje" id="search" type="text" placeholder="Ingrese frase..">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
			</div>
			<div class="row">
				<form action="../consultas/Buscar_mensajes/msg_frase.php" method="GET">
					<p>Mensajes que contengan una frase</p>
					<input class="form-control" name="frase" id="search" type="text" placeholder="Ingrese frase..">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
			</div>
			<div class="row">
				<form action="../consultas/Buscar_mensajes/msg_user_word.php" method="GET">
					<p>Mensajes enviados por un usuario que contenga una palabra especifica</p>
					<input class="form-control" name="id" id="search" type="text" placeholder="Ingrese usuario..">
					<input class="form-control" name="mensaje" id="search" type="text" placeholder="Ingrese palabras..">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
			</div>
			<div class="row">
				<form action="../consultas/Buscar_mensajes/msg_user_not_words.php" method="GET">
					<p>Mensajes enviados por un usuario que no contenga una palabra especifica</p>
					<input class="form-control" name="nombre" id="search" type="text" placeholder="Ingrese usuario..">
					<input class="form-control" name="nombre" id="search" type="text" placeholder="Ingrese palabras..">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
			</div>
			<div class="row">
				<form action="../consultas/Inbox.php" method="post">
					<button type="submit" class="btn btn-primary">Volver</button>
				</form>
			</div>
		    <?php } ?>

		</div>
	</body>
</html>
