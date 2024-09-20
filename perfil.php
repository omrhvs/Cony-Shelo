<?php
  if (session_status() == PHP_SESSION_NONE)
  {
    session_start();
  }

  if (!isset ($_SESSION['nombre']))
  {
    $_SESSION['nombre'] = "Sin identificar";
  }
    else
  {
    if (isset ($_REQUEST['nombre']))
    {
      $_SESSION['nombre'] = $_REQUEST['nombre'];
      $_SESSION['tipo'] = $_REQUEST['tipo'];
    }
  }
  include_once "encabezado.php";
  include_once "servidor.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Shelo Cony</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registro.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form id="forma">
    <div id="registro-container" class="container">
        <div class="row justify-content-center">
            <div class="row">
                <br>
                <img src="imagenes/imagen-registro.png" class="imagen-registro" alt="Registro" width="960px" style="display: block; margin: 0 auto;">
            </div>

            <div class="row">
            <div class="col-sm-4">
              <br>
              <div class="mb-2 row text-end">
                    <img src="imagenes/perfil2.png" class="imagen-registro" alt="Registro" width="128px" style="display: block; margin: 0 auto;">
                    <label>Foto de perfil</label>
                    <div>
                        <input type="file" class="form-control" id="inputFoto">
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <br>
                <div class="mb-6 row text-end">
                    <label for="inputNombre" class="col-sm-6 col-form-label">Nombre</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputNombre">
                    </div>
                </div>
                <br>
                <div class="mb-6 row text-end">
                    <label for="inputEmail" class="col-sm-6 col-form-label">Correo Electronico</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputEmail">
                    </div>
                </div>
                <br>
                <div class="mb-6 row text-end">
                    <label for="inputConfirmarEmail" class="col-sm-6 col-form-label">Confirmar Correo</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputConfirmarEmail">
                    </div>
                </div>
                <br>
                <div class="mb-6 row text-end">
                    <label for="inputPassword" class="col-sm-6 col-form-label">Contraseña</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputPassword">
                    </div>
                </div>
                <br>
                <div class="mb-6 row text-end">
                    <label for="inputConfirmarPassword" class="col-sm-6 col-form-label">Confirmar Contraseña</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputConfirmarPassword">
                    </div>
                </div>
                <br>
                <div class="mb-6 row text-end">
                    <label for="inputTipoCuenta" class="col-sm-6 col-form-label">Tipo de Cuenta</label>
                    <div class="col-sm-6">
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
    </div>
    </form>
    <?php include_once "pie.php"; ?>
</body>
</html>