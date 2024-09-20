<?php 
    include_once("servidor.php");

    $nombre = $_REQUEST['nombreJS'];
    $correo = $_REQUEST['correoJS'];
    $password = $_REQUEST['passwordJS'];
    $tipo = $_REQUEST['tipoJS'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone->conecta();

    $sql = $conexion -> prepare("INSERT INTO cuentas (nombre, email, password, tipo_cuenta)
    VALUES (:a, :b, :c, :d)");

    $sql -> bindParam(":a", $nombre);
    $sql -> bindParam(":b", $correo);
    $sql -> bindParam(":c", $password);
    $sql -> bindParam(":d", $tipo);

    $res = "";

    if($sql -> execute())
    {
        $res = "okay";
    }
    else
    {
        $res = "error";
    }

    $sql -> closeCursor();

    echo json_encode(array("respuesta" => $res));
?>