<?php
    require "encabezado.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Carrousel - Cony Shelo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
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
                        $("#tabla tr:last").after('<tr><td>'+respuesta[i].id+'</td><td>'+respuesta[i+1].imagen+'</td><td>'+respuesta[i+2].titulo+'</td><td>'+respuesta[i+3].descripcion+'</td><td>'+respuesta[i+4].alterno + '</td><td><button class="borra btn" data-id="'+ respuesta[i].id+'"> <img class="img-fluid" src="imagenes/eliminar.png"></button></td><td><button class="cambia btn" data-id="'+ respuesta[i].id+'"> <img class="img-fluid" id="cambia" src="imagenes/editar.png"></button></td></tr>');
                    }   
                });
            }

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
                var titulo = $(this).closest('tr').find('td:eq(2)').text();
                var descripcion = $(this).closest('tr').find('td:eq(3)').text();
                var alta = $(this).closest('tr').find('td:eq(4)').text();

                $('#inputID').val(id).prop('readonly', true);
                $('#inputRuta').val(imagen);
                $('#inputAlterno').val(alta);
                $('#inputTitulo').val(titulo);
                $('#inputDesc').val(descripcion);
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

                if (!validarCampo(ruta, 'Debe introducir una ruta de imagen.')) return;
                if (!validarCampo(ruta, 'Debe introducir un alternativo de imagen.')) return;
                if (!validarCampo(ruta, 'Debe introducir un titulo de imagen.')) return;
                if (!validarCampo(ruta, 'Debe introducir una descripcion de imagen.')) return;

                $.getJSON("altacarrusel.php", { idJS: id, rutaJS: ruta, alternoJS: alt, tituloJS: titulo, descripcionJS: desc }, function (datos) 
                {
                    if (datos == "okay") 
                    {
                        alert('Registro grabado o editado exitosamente');
                        limpiaAlta();
                        refrescarPagina();
                        $('#inputID').prop('readonly', true).addClass('lectura');
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
    <h2 class="titulo">Mantenimiento al Carrousel</h2>
    <div id="contenedorcarrusel" class="container">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-hover table-responsive" id="tabla">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ruta</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Alterno</th>
                            <th scope="col">Borrar</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-3 formudomi">
                <label for="inputID" class="form-label">ID del Elemento</label>
                <input type="text" class="form-control" id="inputID" readonly>
                <br>
                <label for="inputRuta" class="form-label">Ruta del Elemento</label>
                <input type="text" class="form-control" id="inputRuta">
                <br>
                <label for="inputAlterno" class="form-label">Alterno del Elemento</label>
                <input type="text" class="form-control" id="inputAlterno">
                <br>
                <label for="inputTitulo" class="form-label">TÍtulo del Elemento</label>
                <input type="text" class="form-control" id="inputTitulo">
                <br>
                <label for="inputDesc" class="form-label">Descripción del Elemento</label>
                <input type="text" class="form-control" id="inputDesc">
                <br>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary" id="grabar">Grabar</button>
                </div>
            </div>
        </div>
    </div>
    <?php require "pie.php" ?>
</body>
</html>