<?php
    include_once ("servidor.php");
    include_once ("encabezado.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelo - LogIn</title>
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

            $('#grabar').on('click', function () 
            {
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
                    $.getJSON("verificarcredenciales.php", { correoJS: correo}, function (datos)
                    {
                        if (datos != false) 
                        {
                            limpiaAlta();
                            alert('Bienvenido de nuevo.');
                            //location.href = "index.php?usuario="
                        }
                        else
                        {
                            alert('Verifique sus datos.');
                            return;
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
                <img src="imagenes/ingreso-shelo.png" class="imagen-registro" alt="Registro">
            </div>
            <div class="col-sm-6  text-end">
                <br>
                <div class="mb-6 row">
                    <label for="inputEmail" class="col-sm-5 col-form-label">Email</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputEmail">
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
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button id="grabar" type="submit" class="btn btn-primary mb-3">Ingresar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>

<?php
    include_once ("pie.php");
?>