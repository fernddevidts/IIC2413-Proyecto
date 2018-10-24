<?php

  try {
    require('./config/data.php'); #Pide las variables para conectarse a la base de datos.
    $db_trans = new PDO("pgsql:dbname=$DBgrupo_trans;host=localhost;port=5432;user=$DBuser_trans;password=$DBpassword_trans");
    $db_tienda = new PDO("pgsql:dbname=$DBgrupo_tienda;host=localhost;port=5431;user=$DBuser_tienda;password=$DBpassword_tienda");
    echo "<script>console.log('Conexion hecha');</script>";

  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }


?>
