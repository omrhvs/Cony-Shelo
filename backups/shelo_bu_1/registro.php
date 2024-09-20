<?php
include_once ("servidor.php");
include_once ("encabezado.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelo - Registro</title>
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

            function registrarUsuario()
            {
                var nombre = $('#inputNombre').val();
                var correo = $('#inputEmail').val();
                var correoConfirmacion = $('#inputConfirmarEmail').val();
                var password = $('#inputPassword').val();
                var passwordConfirmacion = $('#inputConfirmarPassword').val();
                var tipo = $('#inputTipoCuenta').val();

                $.getJSON("altacuenta.php", { nombreJS: nombre, correoJS: correo, passwordJS: password, tipoJS: tipo }, function (datos)
                {
                    if (datos == "Ok") 
                    {
                        limpiaAlta();
                        alert('Usuario registrado con éxito');
                        window.location.href = 'index.php';
                    }
                    else
                    {
                        alert('Verifique sus datos.');
                        return;
                    }
                });
            }

            $('#grabar').on('click', function () {
                var nombre = $('#inputNombre').val();
                var correo = $('#inputEmail').val();
                var correoConfirmacion = $('#inputConfirmarEmail').val();
                var password = $('#inputPassword').val();
                var passwordConfirmacion = $('#inputConfirmarPassword').val();
                var tipo = $('#inputTipoCuenta').val();

                // Verificar que los campos de correo y password coincidan
                if (correo !== correoConfirmacion) 
                {
                    alert('Los campos de email no coinciden');
                    $('#inputEmail, #inputConfirmarEmail').val('');
                    $('#inputEmail').focus();
                }
                else if (password !== passwordConfirmacion) 
                {
                    alert('Los campos de password no coinciden');
                    $('#inputPassword, #inputConfirmarPassword').val('');
                    $('#inputPassword').focus();
                }
                else if (correo !== correoConfirmacion && password !== passwordConfirmacion)
                {
                    alert('Los campos de email y password no coinciden');
                    $('#inputEmail, #inputConfirmarEmail').val('');
                    $('#inputPassword, #inputConfirmarPassword').val('');
                    $('#inputEmail').focus();
                }
                else if (password.length < 4 || !/\d/.test(password))
                {
                    alert('La contraseña debe tener al menos 4 caracteres y contener al menos un número');
                    $('#inputPassword, #inputConfirmarPassword').val('');
                    $('#inputPassword').focus();
                }
                else
                {
                    $.getJSON("verificarduplicado.php", { correoJS: correo }, function (datos)
                    {
                        if (datos == "Ok") 
                        {
                            alert('Este correo ya esta registrado. Ingrese uno diferente.');
                            $('#inputEmail, #inputConfirmarEmail').val('');
                        }
                        else
                        {
                            switch(tipo)
                            {
                                case 'ADM':
                                {
                                    $.getJSON("verificaradmin.php", { passwordJS: password}, function (respuesta)
                                    {
                                        if (respuesta == "Ok")
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
        });
    </script>
</head>

<body>
    <br><br><br><br>
    <div id="registro-container" class="container">
        <div class="row justify-content-center">
            <div class="col">
                <img src="imagenes/imagen-registro.png" class="imagen-registro" alt="Registro">
            </div>
            <div class="col-sm-6  text-end">
                <br>
                <div class="mb-6 row">
                    <label for="inputNombre" class="col-sm-5 col-form-label">Nombre</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputNombre">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputEmail" class="col-sm-5 col-form-label">Email</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputEmail">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputConfirmarEmail" class="col-sm-5 col-form-label">Confirmar Email</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputConfirmarEmail">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputPassword" class="col-sm-5 col-form-label">Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="inputPassword">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputConfirmarPassword" class="col-sm-5 col-form-label">Confirmar Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="inputConfirmarPassword">
                    </div>
                </div>
                <br>
                <div class="mb-6 row">
                    <label for="inputTipoCuenta" class="col-sm-5 col-form-label">Tipo de Cuenta</label>
                    <div class="col-sm-5">
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
                        <button id="grabar" type="submit" class="btn btn-primary mb-3">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</body>
</html>

<?php
include_once ("pie.php");
?>