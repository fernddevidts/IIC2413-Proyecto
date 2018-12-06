<?php
ini_set('display_errors', 0);
include('../login/session.php');?>
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



	    <title>Servicios</title>
	</head>

	<body >
		<?php include '../partials/nav.php'; ?>
		<div class="container">
			<div class="row">
				<h3>Mensajes Recibidos</h3>
				</div>
				<div class="row">

				<?php
					include_once "psql-config.php";
					try {
						$db = new PDO("pgsql:dbname=".DATABASE_TIENDA.";host=".HOST.";port=".PORT_TIENDA.";user=".USER_TIENDA.";password=".PASSWORD_TIENDA);
					}
					catch(PDOException $e) {
					echo $e->getMessage();
					}
					$link = "http://rapanui3.ing.puc.cl/receptant/";
					$link .= (string)$id_usuario;



$contents = file_get_contents($link);
$contents = json_decode($contents, true);
echo "<div class='row'>";
echo "<table class='table'<thead><tr><th scope='col'>Sender</th><th scope='col'>Mensaje</th><th";
echo "<tbody>";
foreach ($contents as $content) {
echo "<tr><td>$content[sender]</td><td>$content[message]</td></tr>";
};

echo "</tbody>";
echo "</table>";
echo "</div>";

?>




<div class="row">
	<form action="../consultas/Inbox.php" method="post">
		<button type="submit" class="btn btn-primary">Volver</button>
	</form>
</div>
</div>
	</body>
</html>
