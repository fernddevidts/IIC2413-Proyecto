<?php
   include('./config/psql-config.php');
   session_start();
   
   $user_check = $_SESSION['username'];
   
   $ses_psql = pg_query($db_trans,"select username from admin where username = '$user_check' ");
   
   $row = pg_fetch_array($ses_psql);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['username'])){
      header("location:login.php");
   }
?>