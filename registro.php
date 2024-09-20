<?php
    include_once ("servidor.php");
    require "encabezado.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Shelo Cony</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(function () 
        {
            function limpiaAlta()
            {
                $('#inputEmail, #inputConfirmarEmail').val('');
                $('#inputPassword, #inputConfirmarPassword').val('');
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

            $('#grabar').on('click', function ()
            {
                event.preventDefault();
                var nombre = $('#inputNombre').val();
                var correo = $('#inputEmail').val();
                var correoConfirmacion = $('#inputConfirmarEmail').val();
                var password = $('#inputPassword').val();
                var passwordConfirmacion = $('#inputConfirmarPassword').val();
                var tipo = $('#inputTipoCuenta').val();

                if (!validarCampo(nombre, 'Debe introducir un nombre')) return;
                if (!validarCampo(correo, 'Debe introducir un correo')) return;
                if (!validarCampo(correoConfirmacion, 'Debe confirmar su correo')) return;
                if (!validarCampo(password, 'Debe introducir una contraseña')) return;
                if (!validarCampo(passwordConfirmacion, 'Debe confirmar su contraseña')) return;
                if (!validarCampo(tipo, 'Debe elegir un tipo de cuenta')) return;

                var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!regexCorreo.test(correo))
                {
                    alert("El formato del correo electrónico no es válido");
                    $('#inputEmail, #inputConfirmarEmail').val('');
                    $('#inputEmail').focus();
                }
                else if(correo !== correoConfirmacion)
                {
                    alert('Los correos no coinciden');
                    $('#inputEmail, #inputConfirmarEmail').val('');
                    $('#inputEmail').focus();
                    return;
                }
                else if(password !== passwordConfirmacion)
                {
                    alert('Las contraseñas no coinciden');
                    $('#inputPassword, #inputConfirmarPassword').val('');
                    $('#inputPassword').focus();
                    return;
                }
                else
                {
                    $.getJSON("verificarduplicado.php", { correoJS: correo }, function (datos)
                    {
                        if (datos == "okay")
                        {
                            alert('Este correo ya está registrado. Ingrese uno diferente.');
                            $('#inputEmail, #inputConfirmarEmail').val('');
                        }
                        else
                        {
                            alert('No existen otras cuentas con este correo.');

                            switch (tipo)
                            {
                                case 'ADM':
                                {
                                    alert('Registrando admin');
                                    $.getJSON("verificaradmin.php", { passwordJS: password }, function (respuesta)
                                    {
                                        if (respuesta == "okay")
                                        {
                                            registrarUsuario();
                                        }
                                        else
                                        {
                                            alert('AminPass erroneo. Verifique de nuevo');
                                            $('#inputPassword, #inputConfirmarPassword').val('');
                                            $('#inputPassword').focus();
                                        }
                                    });
                                    break;
                                }
                                case 'CLI':
                                {
                                    alert('Registrando cliente');
                                    registrarUsuario();
                                    break;
                                }
                                default:
                                {
                                    alert("Seleccione un tipo de cuenta.");
                                }                            
                            }
                        }
                    });
                }
             });

             function registrarUsuario()
             {
                var nombre = $('#inputNombre').val();
                var correo = $('#inputEmail').val();
                var password = $('#inputPassword').val();
                var tipo = $('#inputTipoCuenta').val();

                $.getJSON("registrarcuenta.php", { nombreJS: nombre, correoJS: correo, passwordJS: password, tipoJS: tipo }, function (respuesta)
                {
                    if (respuesta.respuesta == "okay")
                    {
                        alert('Usuario registrado con éxito');
                        limpiaAlta();
                        window.location.href = 'login.php';
                    }
                    else
                    {
                        alert('Verifique sus datos.');
                        return;
                }
                });
            }
        });
    </script>
</head>
<body>
    <form id="forma">
    <div id="registro-container" class="container">
        <div class="row justify-content-center">
            <div class="col">
                <br>
                <img src="imagenes/imagen-registro.png" class="imagen-registro" alt="Registro" width="960px" style="display: block; margin: 0 auto;">
            </div>
            <div class="col-sm-9">
                <br>
                <div class="mb-6 row">
                    <label for="inputNombre" class="col-sm-8 col-form-label">Nombre</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inputNombre">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputEmail" class="col-sm-8 col-form-label">Correo Electronico</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inputEmail">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputConfirmarEmail" class="col-sm-8 col-form-label">Confirmar Correo</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inputConfirmarEmail">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputPassword" class="col-sm-8 col-form-label">Contraseña</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="inputPassword">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputConfirmarPassword" class="col-sm-8 col-form-label">Confirmar Contraseña</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="inputConfirmarPassword">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputTipoCuenta" class="col-sm-8 col-form-label">Tipo de Cuenta</label>
                    <div class="col-sm-4">
                        <select id="inputTipoCuenta" class="form-select" aria-label="Tipo de Cuenta">
                            <option selected>Seleccione el tipo</option>
                            <option value="CLI">Cliente</option>
                            <option value="ADM">Administrador</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button id="grabar" type="submit" class="btn btn-primary mb-3 boton-grabar">Grabar</button>
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