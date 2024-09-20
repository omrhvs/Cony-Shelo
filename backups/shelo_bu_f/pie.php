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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelo Cony</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cantarell:ital,wght@0,400;0,700;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=DM+Serif+Display:ital@0;1&family=Rakkas&family=Space+Grotesk:wght@300..700&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/pie.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid" id="footer">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Inicio</a></li>
                <?php
                    if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'ADM')
                    {
                        echo '<li class="nav-item"><a href="codigospostales.php" class="nav-link px-2 text-muted">Panel Códigos Postales</a></li>';
                        echo '<li class="nav-item"><a href="mantenimiento.php" class="nav-link px-2 text-muted">Panel Carrusel</a></li>';
                        echo '<li class="nav-item"><a href="crudcatalogo.php" class="nav-link px-2 text-muted">Panel Catálogo</a></li>';
                    }
                    if(isset($_SESSION['nombre']) && $_SESSION['nombre'] !== 'Sin identificar')
                    {
                        echo '<li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Cerrar Sesión</a></li>';
                    }
                    else
                    {
                        echo '<li class="nav-item"><a href="catalogo.php" class="nav-link px-2 text-muted">Catálogo</a></li>';
                        echo '<li class="nav-item"><a href="registro.php" class="nav-link px-2 text-muted">Registrate</a></li>';
                        echo '<li class="nav-item"><a href="login.php" class="nav-link px-2 text-muted">Autentícate</a></li>';
                    }
                ?>
            </ul>
            <p class="text-center text-muted">&copy; 2024 Shelo, Inc</p>
        </footer>
    </div>
</body>
</html>