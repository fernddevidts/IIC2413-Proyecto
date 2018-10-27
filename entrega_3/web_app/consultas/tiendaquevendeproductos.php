<?php include '../login/session.php';
ini_set('display_errors', 0); ?>
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
    <link href="../profile/profile.css" rel="stylesheet">
    <link href="../consultas.css" rel="stylesheet">


    <title>NebCoin Bank</title>
	</head>

	<body>
		<?php include '../partials/nav.php'; ?>
		<div class="container">
			<div class="row">


			<?php
			include_once "psql-config.php";
			try {
				$db = new PDO("pgsql:dbname=".DATABASE_TIENDA.";host=".HOST.";port=".PORT_TIENDA.";user=".USER_TIENDA.";password=".PASSWORD_TIENDA);
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}


			echo "</div>";

            $id_tienda = $_REQUEST['tienda'];
            $id_tienda_s = $_REQUEST['tienda_s'];

            if(!empty($id_tienda)) {
                $name_id = 'id_prod';
          	    $nombre_query = "SELECT nombre FROM tiendas WHERE id_tienda = $id_tienda";

                $nombre = $db -> prepare($nombre_query);
                $nombre -> execute();

                $nombre = $nombre -> fetchAll();
                $nombre = $nombre[0][0];

                $query = "SELECT P.nombre, P.descripcion, P.precio, P.id_producto FROM rtiendaproducto as T, productos as P WHERE T.id_tienda = '$id_tienda' and P.id_producto = T.id_producto";
            }

            elseif(!empty($id_tienda_s)) {
            	$name_id = 'id_serv';
          	    $nombre_query = "SELECT nombre FROM tiendasdeservicios WHERE id_tienda_s = $id_tienda_s";

                $nombre = $db -> prepare($nombre_query);
                $nombre -> execute();

                $nombre = $nombre -> fetchAll();
                $nombre = $nombre[0][0];

                $query = "SELECT P.nombre, P.descripcion, P.precio, P.id_servicio FROM rtiendaservicio as T, servicios as P WHERE T.id_tienda_s = '$id_tienda_s' and P.id_servicio = T.id_servicio";
            }

          
            echo "<div class='row'><h3>$nombre</h3></div>";
          
			$result = $db -> prepare($query);
			$result -> execute();

			$items = $result -> fetchAll();
			echo "<div class='row'>";

			echo "<table class='table'<thead><tr><th scope='col'>Nombre</th><th scope='col'>Descripcion</th><th scope='col'>Precio</th><th scope='col'>Link</th></tr>";
			echo "<form action='../ventas/comprar.php' method='post'>";
			foreach ($items as $item) {
				echo "<tbody><tr><td>$item[0]</td><td>$item[1]</td><td>$item[2]</td><td><button class='btn btn-secondary' type='submit' value='$item[3]' name='$name_id'/>  Comprar</td></tr>";
			}
					
			echo "</tbody>";
			echo "</form>";
			echo "</table>";
			echo "</div>";
            ?>

            <div class="row">
                <form action="../profile/profile.php" method="post">
                    <button type="submit" class="btn btn-primary">Volver</button>
                </form>
            </div>
        </div>
    </body>

    <div id="footer">
        <?php include '../partials/footer.php'; ?>
    </div>
</html>