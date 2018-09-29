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
    <link href="index.css" rel="stylesheet">


    <title>NebCoin Bank</title>
	</head>

	<body>
		<?php include 'partials/nav.php'; ?>
		 <?php

		    require("config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db
		    $query = "SELECT * FROM abonos";
		    $result = $db -> prepare($query);
		    $result -> execute();
		    $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
		    #print_r($dataCollected); #si quieren ver el arreglo de la consulta usar print_r($array);
		    ?>

		    <table><tr> <th>var1</th> <th>var2</th> <th>var3</th> </tr>

		    <?php
		    foreach ($dataCollected as $p) {
		      echo "<tr> <th>$p[0]</th> <th>$p[1]</th> <th>$p[2]</th> </tr>";
    }
		?>

	</body>

	<footer class="footer">
		<?php include 'partials/footer.php'; ?>
	</footer>
</html>