<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelo Cony</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid mr-auto">
      <a class="navbar-brand" href="index.php">
        <img src="imagenes/shelo-logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Shelo
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>     
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Acciones </a>
            <ul class="dropdown-menu">
          <?php
            if(isset($_SESSION['usuario']))
            {
              echo '<li><a class="dropdown-item" href="codigospostales.php">Codigos postales</a></li>';
              echo '<li><a class="dropdown-item" href="mantenimiento.php">Carrusel</a></li>';
              echo '<li><a class="dropdown-item" href="logout.php">Cerrar Sesion</a></li>';
            }
            else
            {
              echo '<li><a class="dropdown-item" href="registro.php">Registrate</a></li>';
              echo '<li><a class="dropdown-item" href="login.php">Autentícate</a></li>';
            }
          ?>
            </ul>
          </li>
          </div>
      </div>
      <img src="imagenes/perfil.png" width="32px" height="32px" alt="Perfil">
      <label for="inputUsuario" style="margin:15px"><h5>Usuario</h5></label>
            <div>
              <input type="text" class="form-control" id="inputUsuario" readonly>
            </div>
    </div>
  </nav>
</body>
</html>