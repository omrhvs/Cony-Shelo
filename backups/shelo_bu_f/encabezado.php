<?php
  if (session_status() == PHP_SESSION_NONE)
  {
    session_start();
  }

  if (!isset ($_SESSION['nombre']))
  {
    $_SESSION['nombre'] = "Sin identificar";
  }
    else
  {
    if (isset ($_REQUEST['nombre']))
    {
      $_SESSION['nombre'] = $_REQUEST['nombre'];
      $_SESSION['tipo'] = $_REQUEST['tipo'];
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelo Cony</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/encabezado.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <nav id="header-border"  class="navbar navbar-expand-lg bg-body-tertiary">
    <div id="header" class="container-fluid mr-auto">
      <a class="navbar-brand" href="index.php" id="marca"> <img src="imagenes/shelo-logo.png" alt="Logo" class="d-inline-block align-text-top" id="logo"> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>     
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
          <a class="nav-link active" aria-current="page" href="catalogo.php">Catálogo</a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Panel </a>
            <ul class="dropdown-menu">
          <?php
            if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'ADM')
            {
              echo '<li><a class="dropdown-item" href="codigospostales.php">Panel Códigos Postales</a></li>';
              echo '<li><a class="dropdown-item" href="mantenimiento.php">Panel Carrusel</a></li>';
              echo '<li><a class="dropdown-item" href="crudcatalogo.php">Panel Catálogo</a></li>';
            }
            
            if(isset($_SESSION['nombre']) && $_SESSION['nombre'] !== 'Sin identificar')
            { 
              echo '<li><hr class="dropdown-divider"></li>';
              echo '<li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>';
            } else {
              echo '<li><a class="dropdown-item" href="registro.php">Registrate</a></li>';
              echo '<li><a class="dropdown-item" href="login.php">Autentícate</a></li>';
            }
          ?>
            </ul>
          </li>
          </div>
      </div>
      <img src="imagenes/perfil.png" id="fotoPerfil" alt="Perfil">
      <label id="tituloUsuario" for="inputUsuario">Usuario</label>
      <div>
        <input type="text" class="form-control" id="inputUsuario" placeholder="<?php echo $_SESSION['nombre'] ?>" readonly>
      </div>
    </div>
  </nav>
</body>
</html>