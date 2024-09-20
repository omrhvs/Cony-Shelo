<?php
    require "encabezado.php";

    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
  
    if (!isset($_SESSION['nombre'])) {
        $_SESSION['nombre'] = "Sin identificar";
    } else {
        if (isset($_REQUEST['nombre'])) {
            $_SESSION['nombre'] = $_REQUEST['nombre'];
            $_SESSION['tipo'] = $_REQUEST['tipo'];
        }
    }

    if (!isset($_GET['pagina'])) {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }

    $registros = 3;
    $inicio = ($pagina - 1) * $registros;

    require_once "servidor.php";
        
    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone->conecta();
        
    $sql = $conexion->prepare("SELECT id FROM catalogo");
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $sql->execute();
    $totalRegistros = $sql->rowCount();

    $sql = $conexion->prepare("SELECT * FROM catalogo ORDER BY nombre ASC LIMIT $inicio, $registros");
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $sql->execute();
    $totalPaginas = ceil($totalRegistros / $registros);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo - Shelo Cony</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 id="encabezado-catalogo">Catálogo</h2>
                <p id="info-catalogo"><?php echo $totalRegistros; ?> productos. (<?php echo $totalPaginas; ?> páginas)</p>
                <div class="row">
                    <?php
                        if ($totalRegistros)
                        {
                        while ($reg = $sql->fetch())
                        {
                    ?>
                            <div class="col-md-4 mb-4">
                                <div class="card tarjeta-catalogo">
                                    <img src="<?php echo $reg['foto']; ?>" class="card-img-top" alt="<?php echo $reg['alterno']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title titulo-catalogo"><?php echo $reg['nombre']; ?></h5>
                                        <p id="precio-catalogo" class="card-text">$<?php echo $reg['precio']; ?></p>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><br> Stock: <?php echo $reg['cantidad'] . ' (' . $reg['estado'] . ')'; ?></h6>
                                        <br>
                                        <a id="detalles" href="detallesproducto.php?id=<?php echo $reg['id']; ?>" class="btn btn-primary">Detalles</a>
                                    </div>
                                </div>
                            </div>
                        <?php } } else { ?>
                        <div class="col-md-12">
                            <p>No hay registros disponibles.</p>
                        </div>
                    <?php } ?>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($pagina > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="catalogo.php?pagina=<?php echo ($pagina - 1); ?>">Anterior</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <a class="page-link">Anterior</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                            <li class="page-item <?php echo ($pagina == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="catalogo.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($pagina < $totalPaginas): ?>
                            <li class="page-item">
                                <a class="page-link" href="catalogo.php?pagina=<?php echo ($pagina + 1); ?>">Siguiente</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <a class="page-link">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php
      require "pie.php";
      $sql->closeCursor();
    ?>
</body>
</html>