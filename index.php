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

  require "encabezado.php";
  include_once "servidor.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio - Shelo Cony</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cantarell:ital,wght@0,400;0,700;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=DM+Serif+Display:ital@0;1&family=Rakkas&family=Space+Grotesk:wght@300..700&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-3.6.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php
  $cone = new servidor("localhost", "shelo-cony", "");
  $conexion = $cone->conecta();
  $sql = $conexion->prepare("SELECT * FROM carrusel");
  $sql->setfetchMode(PDO::FETCH_ASSOC);
  $sql->execute();
  ?>
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" id="carusel">
      <?php
      $c = 0;
      while ($reg = $sql->fetch())
      {
        if ($c == 0)
        {
          $c++;
          ?>
          <div class="carousel-item active">
          <?php } else { ?>
            <div class="carousel-item">
            <?php } ?>
            <img src="<?php echo $reg['imagen']; ?>" width="1920" height="630" class="d-block" alt="<?php echo $reg['alterno']; ?>">
            <h5 class="titulo-producto-carrusel">
              "<?php echo $reg['titulo'] ?>"
            </h5>
            <p class="descripcion-producto-carrusel">
              <?php echo $reg['descripcion'] ?>
            </p>
          </div>
        <?php } ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <?php
      Include_once "pie.php";
      $sql->closeCursor();
    ?>
</body>
</html>