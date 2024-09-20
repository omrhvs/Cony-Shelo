<?php
    include_once "encabezado.php";
    include_once "servidor.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelo Cony</title>
    <link href='https://fonts.googleapis.com/css?family=Space Grotesk' rel='stylesheet'>
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Conexion Base Datos -->
    <?php
        $cone = new servidor("localhost", "shelo-cony", "");
        $conexion = $cone->conecta();
        $sql = $conexion -> prepare("SELECT * FROM carrusel");
        $sql -> setfetchMode(PDO::FETCH_ASSOC);
        $sql -> execute();
    ?>
    
    <br> <br>

    <!-- Carrusel -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">

      <div class="carousel-inner">

        <?php 
          $c=0;
          while($reg = $sql ->fetch())
          {
            if($c == 0)
            {
              $c++;
        ?>

        <div class="carousel-item active">

        <?php } else { ?>

        <div class="carousel-item">

        <?php } ?>
            <img src="<?php echo $reg['imagen']; ?>" width="1920" height="425" class="d-block" alt="<?php echo $reg['alterno']; ?>">
            <h5 class="titulo-producto-carrusel">"<?php echo $reg['titulo'] ?>"</h5>
            <p class="descripcion-producto-carrusel">"<?php echo $reg['descripcion'] ?>"</p>
        </div>

        <?php } ?>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <br><br>
    <?php 
      include_once "pie.php";
      $sql->closeCursor();
    ?>
</body>
</html>