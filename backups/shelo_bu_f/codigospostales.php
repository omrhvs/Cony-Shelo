<?php
    require "encabezado.php";
    include_once "servidor.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codigos Postales - Shelo Cony</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(function()
        {
            function validarCampo(campo, mensaje)
            {
                if (campo === "")
                {
                    alert(mensaje);
                    campo.focus();
                    return false;
                }
                return true;
            }

            $('#enviar').on('click', function()
            {
                var cp = $('#cp').val();

                var opciondefault = $('#colonias option:first-child').detach();

                if (!validarCampo(cp, 'Debe introducir un código postal.')) return;

                $('#colonias').empty().append(opciondefault);

                $.getJSON("consultacp.php", {codigo:cp}, function(datos)
                {
                    $('#municipio').val(datos[3].municipio);
                    $('#ciudad').val(datos[4].ciudad);
                    $('#estado').val(datos[5].estado);

                    select=document.getElementById("colonias");

                    for(i = 0; i < datos.length; i=i+6)
                    {
                        option = document.createElement('option');

                        option.value=datos[i+2].colonia;

                        option.text=datos[i+2].colonia;

                        select.appendChild(option);
                    }
                });
            });
            return;
        });
    </script>
</head>
<body>
    <?php
        $cone = new servidor("localhost", "shelo-cony", "");
        $conexion = $cone->conecta();
        $sql = $conexion -> prepare("SELECT * FROM codigospostales");
        $sql -> setfetchMode(PDO::FETCH_ASSOC);
        $sql -> execute();
    ?>
    <h2 class="titulo">Códigos Postales</h2>
    <div id="contenedorpostales" class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> C.P. </th>
                            <th> Colonia </th>
                            <th> Municipio </th>
                            <th> Ciudad </th>
                            <th> Estado </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($reg = $sql ->fetch()) { ?>
                        <tr>
                            <td>
                                <?php echo $reg['id'] ?>
                            </td>
                            <td>
                                <?php echo $reg['cp'] ?>
                            </td>
                            <td>
                                <?php echo $reg['colonia'] ?>
                            </td>
                            <td>
                                <?php echo $reg['municipio'] ?>
                            </td>
                            <td>
                                <?php echo $reg['ciudad'] ?>
                            </td>
                            <td>
                                <?php echo $reg['estado'] ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 formudomi">
                <input id="cp" type="text" class="form-control" placeholder="Código Postal">
                <br>
                <div class="row justify-content-center">
                    <button id="enviar" type="submit" class="btn btn-primary mb-3">Enviar</button>
                </div>
                <br>
                <select id="colonias" class="form-select">
                    <option selected>Seleccione</option>
                </select>
                <br>
                <input id="municipio" class="form-control" type="text" value="Municipio" readonly>
                <br>
                <input id="ciudad" class="form-control" type="text" value="Ciudad" readonly>
                <br>
                <input id="estado" class="form-control" type="text" value="Estado" readonly>
            </div>
        </div>
    </div>
    <?php require "pie.php"; $sql->closeCursor(); ?>
</body>
</html>