<!-- Stylesheet -->
<link href="/~grupo6/entrega_3/web_app/partials/nav.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,600" rel="stylesheet">
<script type="text/javascript" src="/~grupo6/entrega_3/web_app/partials/nav.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse-2">
    <?php
      if(isset($_SESSION['id'])) { ?>
        <a class="navbar-brand" href="/~grupo6/entrega_3/web_app/login/welcome.php">
        	<img src="/~grupo6/entrega_3/web_app/imgs/logo_chico.png" height="40">
        </a>
    <?php }else{ ?>
      <a class="navbar-brand" href="/~grupo6/entrega_3/web_app/index.php">
          <img src="/~grupo6/entrega_3/web_app/imgs/logo_chico.png" height="40">
        </a>
    <?php } ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  <div class="navbar-collapse collapse w-100 order-3 dual-collapse-2" id="navbarSupportedContent">
    <ul class="nav nav-pills" id="myTab" role="tablist" >

<!--       <li class="nav-item">
        <a class="nav-link" id="consultas-pill" href="/~grupo6/entrega_3/web_app/consultas.php" role="tab" onclick="selected()">Consultas</a>
      </li> -->
      <?php
      if(isset($_SESSION['id'])) { ?>
        <li class="nav-item">
        <a class="nav-link" id="home-pill" href="/~grupo6/entrega_3/web_app/login/welcome.php" role="tab" onclick="selected()">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="home-pill" href="/~grupo6/entrega_3/web_app/consultas/Estadisticas.php" role="tab" onclick="selected()">Estadisticas</a>
        </li>

        <li class="nav-item">
        <a class="nav-link" id="home-pill" href="/~grupo6/entrega_3/web_app/consultas/Inbox.php" role="tab" onclick="selected()">Inbox</a>
        </li>

        <li class="nav-item">
        <a class="nav-link" id="home-pill" href="/~grupo6/entrega_3/web_app/ventas/productos.php" role="tab" onclick="selected()">Productos</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="home-pill" href="/~grupo6/entrega_3/web_app/ventas/servicios.php" role="tab" onclick="selected()">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-pill" href="/~grupo6/entrega_3/web_app/profile/profile.php" role="tab" onclick="selected()">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="logout-pill" href="/~grupo6/entrega_3/web_app/login/logout.php" role="tab" onclick="selected()">Logout</a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" id="home-pill" href="/~grupo6/entrega_3/web_app/ventas/productos.php" role="tab" onclick="selected()">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="home-pill" href="/~grupo6/entrega_3/web_app/ventas/servicios.php" role="tab" onclick="selected()">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="home-pill" href="/~grupo6/entrega_3/web_app/index.php" role="tab" onclick="selected()">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="login-pill" href="/~grupo6/entrega_3/web_app/login/login.php" role="tab" onclick="selected()">Login</a>
        </li>

      <?php } ?>
    </ul>
  </div>


</nav>
