<?php
    include_once ("servidor.php");
    require "encabezado.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion - Shelo Cony</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(function () 
        {
            var intentos = 0;
            function limpiaAlta()
            {
                $('#inputEmail, #inputConfirmarEmail').val('');
                $('#inputPassword, #inputConfirmarPassword').val('');
            }

            $('#grabar').on('click', function () 
            {
                event.preventDefault();

                var correo = $('#inputEmail').val();
                var password = $('#inputPassword').val();

                if (correo.length === 0)
                {
                    alert('El campo mail no puede estar vacio.');
                    $('#inputEmail, #inputConfirmarEmail').val('');
                    $('#inputEmail').focus();
                }
                else if (password.length === 0) 
                {
                    alert('El campo mail no puede estar vacio.');
                    $('#inputPassword, #inputConfirmarPassword').val('');
                    $('#inputPassword').focus();
                }
                else if (correo.length === 0 && password.length === 0)
                {
                    alert('Los campos mail y correo no pueden estar vacios.');
                    $('#inputEmail, #inputConfirmarEmail').val('');
                    $('#inputPassword, #inputConfirmarPassword').val('');
                    $('#inputEmail').focus();
                }
                else
                {
                    $.getJSON("verificarcredenciales.php", { correoJS: correo, passwordJS: password}, function (datos)
                    {
                        if(!datos)
                        {
                            $('#inputEmail').val('');
                            $('#inputEmail').focus();
                            alert('No existe el usuario.');
                        }
                        else
                        {
                            if(datos['password'] != password)
                            {
                                intentos++;
                                alert('Contraseña incorrecta. Intentos restantes: ' + (3 - intentos));
                                if (intentos >= 3)
                                {
                                    alert('Ha excedido el número de intentos permitidos. Por favor, inténtelo más tarde.');
                                    return;
                                }
                            }
                            else
                            {
                                alert('Bienvenido!');
                                document.getElementById('forma').reset();
                                window.location.href="index.php?nombre=" + datos['nombre'] + '&tipo=' + datos['tipo_cuenta'];
                            }
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>
    <form id="forma">
    <div id="ingreso-container" class="container">
        <div class="row justify-content-center">
            <div class="col">
                <img src="imagenes/ingreso-shelo.png" class="imagen-registro" alt="Registro">
            </div>
            <div class="col-sm-6">
                <br>
                <div class="mb-6 row">
                    <label for="inputEmail" class="col-sm-7 col-form-label">Correo Electronico</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputEmail">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputPassword" class="col-sm-7 col-form-label">Contraseña</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="inputPassword">
                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button id="grabar" type="submit" class="btn btn-primary mb-3">Ingresar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <?php 
        require "pie.php";
    ?>
</body>
</html>