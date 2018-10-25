<?php
define("HOST","localhost");
define("PORT","5432");

define("USER_TRANS","grupo11");
define("PASSWORD_TRANS","grupo11");
define("DATABASE_TRANS","grupo11");

define("USER_TIENDA", "grupo6");
define("DATABASE_TIENDA", "grupo6");
define("PASSWORD_TIENDA", "grupo6");

$db_trans = new PDO("pgsql:dbname=".DATABASE_TRANS.";host=".HOST.";port=".PORT.";user=".USER_TRANS.";password=".PASSWORD_TRANS);
$con_trans = pg_connect("host=".HOST." dbname=".DATABASE_TRANS." user=".USER_TRANS." password=".PASSWORD_TRANS);

$db_tienda = new PDO("pgsql:dbname=".DATABASE_TIENDA.";host=".HOST.";port=".PORT.";user=".USER_TIENDA.";password=".PASSWORD_TIENDA);
//define("MONGO_DATABASE",'test');
/*
define("cursos",'cursos');
define("universidades",'universidades');
define("alumnos",'alumnos');
*/
 ?>
