<?php
    require "encabezado.php";
    require_once "servidor.php";

    if (isset($_GET['id']))
    {
        $id_producto = $_GET['id'];

        $conexion = new servidor("root", "shelo-cony", "");

        $sql = $conexion->conecta()->prepare("SELECT * FROM catalogo WHERE id = :id");
        $sql->bindParam(':id', $id_producto);
        $sql->execute();

        $producto = $sql->fetch(PDO::FETCH_ASSOC);

        if ($producto)
        {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto - Shelo Cony</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card mb-3" id="tarjeta">
            <div class="row g-0">
                <div class="col-md-6">
                    <img id="imagen-producto" src="<?php echo $producto['foto']; ?>" class="img-fluid rounded-start" alt="<?php echo $producto['alterno']; ?>">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title detalles-titulo"><?php echo $producto['nombre']; ?></h5>
                        <p class="card-text precio">$<?php echo $producto['precio']; ?>.00</p>
                        <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Stock: <?php echo $producto['cantidad']; ?></h6>
                        <div class="input-group mb-3">
                            <label id="titulo-cantidad" for="cantidad-compra" class="input-group-text">Cantidad:</label>
                            <input type="number" id="cantidad-compra" class="form-control" value="1" min="1">
                        </div>
                        <button id="comprar" type="button" class="btn btn-primary">Comprar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
        }
        else
        {
?>
            <p class="mensaje-error">El producto no fue encontrado.</p>
<?php
        }
    }
    else
    {
?>
            <p class="mensaje-error">No se proporcionó un ID de producto.</p>
<?php
    }

    require "pie.php";
    $sql -> closeCursor();
?>
    <script>
        $(function ()
        {
            function refrescarPagina() 
            {
                location.reload();
            }

            $('#comprar').on('click', function ()
            {
                var cantidadCompra = parseInt(document.getElementById("cantidad-compra").value);
                var stock = <?php echo $producto['cantidad']; ?>;
                if (cantidadCompra > stock)
                {
                    alert("No hay suficiente stock disponible.");
                    document.getElementById("cantidad-compra").value = 1;
                }
                else
                {
                    var nuevoStock = stock - cantidadCompra;
                    
                    $.getJSON("actualizarcatalogo.php", { id: <?php echo $producto['id']; ?>, nuevoStock: nuevoStock  }, function(respuesta)
                    {
                        if(respuesta ===  "okay")
                        {
                            alert("Compra exitosa. Nuevo stock: " + nuevoStock);
                            document.getElementById("cantidad-compra").value = 1;
                            refrescarPagina();
                        }
                        else
                        {
                            alert("No se pudo actualizar el catalogo.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>