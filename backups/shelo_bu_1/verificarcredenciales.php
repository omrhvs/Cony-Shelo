<?php 
    include_once("servidor.php");

    $correo = $_REQUEST['correoJS'];
    $password = $_REQUEST['passwordJS'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone->conecta();

    $sql = $conexion->prepare("SELECT * FROM cuentas WHERE email = :a AND password = :b");
    $sql -> bindParam(":a", $correo);
    $sql -> bindParam(":b", $password);

    if($sql -> execute())
    {
        if($sql -> rowCount() > 0)
        {
            session_start();
            $_SESSION['usuario'] = true;

            echo json_encode("Ok");
        }
        else
        {
            echo json_encode("Error");
        }
    }
    $sql -> closeCursor();
?>