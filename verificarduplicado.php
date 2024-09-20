<?php 
    include_once("servidor.php");

    $correo = $_REQUEST['correoJS'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone -> conecta();

    $sql = $conexion -> prepare("SELECT * FROM cuentas WHERE email = :a");
    $sql -> bindParam(":a", $correo);

    if( $sql -> execute() )
    {
        if($sql -> rowCount() > 0)
        {
            echo json_encode("okay");
        }
        else
        {
            echo json_encode("error");
        }
    }
    $sql -> closeCursor();
?>