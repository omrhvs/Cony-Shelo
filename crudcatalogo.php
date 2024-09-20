<?php
    require "encabezado.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Catalogo - Cony Shelo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(function () 
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

            function imprimirDatos() 
            {
                $.getJSON("datoscatalogo.php", {}, function (respuesta) 
                {
                    for (let i = 0; i < respuesta.length; i=i+8)
                    {
                        $("#tabla tr:last").after('<tr><td>' + respuesta[i].id + '</td><td>' + respuesta[i+1].nombre + '</td><td>' + respuesta[i+2].descripcion + '</td><td>' + respuesta[i+3].cantidad + '</td><td>' + respuesta[i+4].precio + '</td><td>' + respuesta[i+5].estado + '</td><td>' + respuesta[i+6].foto + '</td><td>' + respuesta[i+7].alterno + '</td><td><button class="borra btn" data-id="'+ respuesta[i].id+'"> <img class="img-fluid" src="imagenes/eliminar.png"></button></td><td><button class="cambia btn" data-id="'+ respuesta[i].id+'"> <img class="img-fluid" id="cambia" src="imagenes/editar.png"></button></td></tr>');
                    }   
                });
            }

            function refrescarPagina() 
            {
                location.reload();
            }

            $('#tabla').on('click', '.borra', function ()
            {
                event.preventDefault();
                const respuesta = confirm("¿Estás seguro de que quieres eliminar este registro?");

                if (respuesta === true)
                {
                    var id = $(this).data('id');

                    $.getJSON("eliminarproducto.php", { jsID: id }, function (renglon)
                    {
                        if (renglon == "okay")
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
                event.preventDefault();
                var id = $(this).data('id');
                var nombre = $(this).closest('tr').find('td:eq(1)').text();
                var descripcion = $(this).closest('tr').find('td:eq(2)').text();
                var cantidad = $(this).closest('tr').find('td:eq(3)').text();
                var precio = $(this).closest('tr').find('td:eq(4)').text();
                var estado = $(this).closest('tr').find('td:eq(5)').text();
                var foto = $(this).closest('tr').find('td:eq(6)').text();
                var alterno = $(this).closest('tr').find('td:eq(7)').text();

                $('#inputID').val(id).prop('readonly', false);
                $('#inputNombre').val(nombre);
                $('#inputDescripcion').val(descripcion);
                $('#inputCantidad').val(cantidad);
                $('#inputPrecio').val(precio);
                if (estado === "Disponible")
                {
                    $('#flexRadioDefault2').prop('checked', true);
                }
                else if (estado === "Agotado")
                {
                    $('#flexRadioDefault1').prop('checked', true);
                }
                $('#inputFoto').val(foto);
                $('#inputAlterno').val(alterno);
            });

            function limpiaAlta() 
            {
                $('#inputID').val("");
                $('#inputNombre').val("");
                $('#inputDescripcion').val("");
                $('#inputCantidad').val("");
                $('#inputPrecio').val("");
                $('#inputEstado').val("");
                $('#inputFoto').val("");
                $('#inputAlterno').val("");
            }

            imprimirDatos();

            $('#grabar').on('click', function () 
            {
                var id = $('#inputID').val();
                var nombre = $('#inputNombre').val();
                var descripcion = $('#inputDescripcion').val();
                var cantidad = $('#inputCantidad').val();
                var precio = $('#inputPrecio').val();
                var estado = $("input[name='flexRadioDefault']:checked").val();
                var foto = $('#inputFoto').val();
                var alterno = $('#inputAlterno').val();

                if (!validarCampo(id, 'Debe introducir un ID valido.')) return;
                if (!validarCampo(nombre, 'Debe introducir un nombre')) return;
                if (!validarCampo(descripcion, 'Debe introducir una descripcion')) return;
                if (!validarCampo(cantidad, 'Debe introducir una cantidad')) return;
                if (!validarCampo(precio, 'Debe introducir un precio')) return;
                if (!validarCampo(estado, 'Debe introducir un estado')) return;
                if (!validarCampo(foto, 'Debe introducir una foto')) return;
                if (!validarCampo(alterno, 'Debe introducir un alterno')) return;
                
                $.getJSON("altacatalogo.php", { idJS: id, nombreJS: nombre, descripcionJS: descripcion, cantidadJS: cantidad, precioJS: precio, estadoJS: estado, fotoJS: foto, alternoJS: alterno  }, function (respuesta)
                {
                    if (respuesta.respuesta == "okay") 
                    {
                        alert('Registro grabado  o editado exitosamente');
                        limpiaAlta();
                        refrescarPagina();
                        $('#inputID').prop('readonly', true).addClass('lectura');
                    }
                    else 
                    {
                        alert('Ha ocurrido un error SQL');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <br>
    <h2 class="titulo">Mantenimiento de Catálogo</h2>
    <form id="formu" enctype="multipart/form-data">
    <div id="contenedor" class="container">
        <div class="row">
        <div class="col-md-9">
                <table class="table table-hover table-responsive" id="tabla">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Alterno</th>
                            <th scope="col">Borrar</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-3">
                <form>
                    <div class="mb-3">
                        <label for="inputID" class="form-label">ID del Producto</label>
                        <input type="text" class="form-control" id="inputID">
                    </div>
                    <div class="mb-3">
                        <label for="inputNombre" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="inputNombre">
                    </div>
                    <div class="mb-3">
                        <label for="inputDescripcion" class="form-label">Descripción del Producto</label>
                        <input type="text" class="form-control" id="inputDescripcion">
                    </div>
                    <div class="mb-3">
                        <label for="inputCantidad" class="form-label">Cantidad de Producto</label>
                        <input type="text" class="form-control" id="inputCantidad">
                    </div>
                    <div class="mb-3">
                        <label for="inputPrecio" class="form-label">Precio del Producto</label>
                        <input type="text" class="form-control" id="inputPrecio">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" readonly>Estado del Producto</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Disponible" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                            Disponible
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Agotado" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            Agotado
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputFoto" class="form-label">Foto del Producto (Ruta)</label>
                        <input type="text" class="form-control" id="inputFoto">
                    </div>
                    <div class="mb-3">
                        <label for="inputAlterno" class="form-label">Alterno</label>
                        <input type="text" class="form-control" id="inputAlterno">
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-primary btn-grabar" id="grabar">Grabar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>
    <?php require_once "pie.php"; ?>
</body>
</html>