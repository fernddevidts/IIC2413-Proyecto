<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php

    require("psql-config.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    $db = new PDO("pgsql:dbname=".DATABASE_TIENDA.";host=".HOST.";port=".PORT_TIENDA.";user=".USER_TIENDA.";password=".PASSWORD_TIENDA);

    #$query = "SELECT ... WHERE something = '$id';";
    #$query = "SELECT Distinct u.nombre from usuario u, compra_servicio s WHERE u.id = s.id_usuario and u.edad > 18;";
    $query = "SELECT * FROM (SELECT usuarios.nombre, sum(servicio.precio) total
    FROM usuarios, compra_servicio, servicio
    Where usuarios.id = compra_servicio.id_usuario
    and compra_servicio.id_tienda = '8'
    and compra_servicio.id_servicio = servicio.id
    group by usuarios.nombre) as maximo WHERE maximo.total IN (SELECT MAX(total)
    FROM (SELECT usuarios.nombre, sum(servicio.precio) total
    FROM usuarios, compra_servicio, servicio
    Where usuarios.id = compra_servicio.id_usuario
    and compra_servicio.id_servicio = servicio.id
    and compra_servicio.id_tienda = '8'
    group by usuarios.nombre) As auxiliar) ;";
    $result = $db -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
    #print_r($dataCollected); #si quieren ver el arreglo de la consulta usar print_r($array);

    echo "<table><tr><th>Nombre</th> <th>total gasto</th> </tr>";
    foreach ($dataCollected as $p) {
      echo "<tr> <th>$p[0]</th> <th>$p[1]</th> </tr>";
    }
    echo "</table>";
    ?>

    </table>


  </body>
</html>
