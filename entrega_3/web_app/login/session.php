<?php
   include('../config/psql-config.php');
   session_start();
   
   $user_check = $_SESSION['username'];
   
   $ses_psql = pg_query($con_trans,"SELECT correo from usuarios where correo = '$user_check' ");
   
   $row = pg_fetch_array($ses_psql);
   
   $login_session = $row['correo'];
   
   if(!isset($_SESSION['username'])){
      header("Location: login.php");
   }
?>