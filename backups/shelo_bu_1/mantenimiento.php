<?php
include_once("encabezado.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cony Shelo - Carrousel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mantenimiento.css">
    <link rel="stylesheet" href="css/form.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        $(function () 
        {
            function imprimirDatos() 
            {
                $.getJSON("datoscarrusel.php", {}, function (respuesta) 
                {
                    for (let i = 0; i < respuesta.length; i=i+5)
                    {
                        $("#tabla tr:last").after('<tr><td>'+respuesta[i].id+'</td><td>'+respuesta[i+1].imagen+'</td><td>'+respuesta[i+2].alterno+'</td><td>'+respuesta[i+3].titulo+'</td><td>'+respuesta[i+4].descripcion+'</td></tr>');
                        $("#tabla td:last").after('<td><button class="borra btn" data-id="'+ respuesta[i].id+'"> <img class="img-fluid" src="imagenes/eliminar.png"></button></td>');
                        $("#tabla td:last").after('<td><button class="cambia btn" data-id="'+ respuesta[i].id+'"> <img class="img-fluid" id="cambia" src="imagenes/editar.png"></button></td>');
                    }   
                });
            }

            function refrescarPagina() 
            {
                location.reload();
            }

            $('#tabla').on('click', '.borra', function ()
            {
                const respuesta = confirm("¿Estás seguro de que quieres eliminar este registro?");

                if (respuesta === true)
                {
                    var id = $(this).data('id');

                    $.getJSON("eliminar.php", { jsID: id }, function (renglon)
                    {
                        if (renglon == "Ok")
                        {
                            alert('Registro eliminado exitosamente');
                            limpiaAlta();
                            imprimirDatos();
                            refrescarPagina();
                        }
                        else
                        {
                            alert('Ha ocurrido un error inesperado.');
                        }
                    });
                }
                else
                {
                    alert("Operacion cancelada correctamente.");
                }
            });

            $('#tabla').on('click', '.cambia', function () 
            {
                var id = $(this).data('id');
                var imagen = $(this).closest('tr').find('td:eq(1)').text();
                var alta = $(this).closest('tr').find('td:eq(2)').text();
                var titulo = $(this).closest('tr').find('td:eq(3)').text();
                var descripcion = $(this).closest('tr').find('td:eq(4)').text();

                $('#inputID').val(id).prop('readonly', false);
                $('#inputRuta').val(imagen);
                $('#inputAlterno').val().prop(alterno);
                $('#inputTitulo').val().prop(titulo);
                $('#descripcion').val().prop(descripcion);
            });

            function limpiaAlta() 
            {
                $("#inputID").val("");
                $("#inputRuta").val("");
                $("#inputAlterno").val("");
                $("#inputTitulo").val("");
                $("#inputDesc").val("");
            }

            imprimirDatos();

            $('#grabar').on('click', function () 
            {
                var id = $('#inputID').val();
                var ruta = $('#inputRuta').val();
                var alt = $('#inputAlterno').val();
                var titulo = $('#inputTitulo').val();
                var desc = $('#inputDesc').val();

                $.getJSON("altacarrusel.php", { idJS: id, rutaJS: ruta, alternoJS: alt, tituloJS: titulo, descripcionJS: desc }, function (datos) 
                {
                    if (datos == "Ok") 
                    {
                        alert('Registro grabado exitosamente');
                        limpiaAlta();
                        refrescarPagina();
                        $('#clave').prop('readonly', true).addClass('lectura');
                    }
                    else 
                    {
                        alert('Ha ocurrido un error');
                    }
                });
            });
        });
    </script>
</head>

<body>
    <br>
    <h2 class="titulo">Mantenimiento al Carrousel</h2>
    <br><br>
    <div id="contenedor" class="container">
        <div class="row">
            <div class="col-md-4">
                <form>
                    <div class="mb-3">
                        <label for="inputID" class="form-label">ID</label>
                        <input type="text" class="form-control" id="inputID">
                    </div>

                    <div class="mb-3">
                        <label for="inputRuta" class="form-label">Ruta</label>
                        <input type="text" class="form-control" id="inputRuta">
                    </div>

                    <div class="mb-3">
                        <label for="inputAlterno" class="form-label">Alterno</label>
                        <input type="text" class="form-control" id="inputAlterno">
                    </div>

                    <div class="mb-3">
                        <label for="inputTitulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" id="inputTitulo">
                    </div>

                    <div class="mb-3">
                        <label for="inputDesc" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="inputDesc">
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary" id="grabar">Grabar</button>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <table class="table table-striped table-hover" id="tabla">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">RUTA</th>
                            <th scope="col">ALTERNATIVO</th>
                            <th scope="col">TITULO</th>
                            <th scope="col">DESCIPCION</th>
                            <th scope="col">BORRAR</th>
                            <th scope="col">EDITAR</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
    <?php
    include_once("pie.php");
    ?>
</body>

</html>