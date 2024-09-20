<?php 
    include_once("servidor.php");

    $password = $_REQUEST['passwordJS'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone->conecta();

    $sql = $conexion->prepare("SELECT * FROM claves_acceso WHERE clave = :a");
    $sql -> bindParam(":a", $password);

    if($sql -> execute())
    {
        if($sql -> rowCount() > 0)
        {
            echo json_encode("Ok");
        }
        else
        {
            echo json_encode("Error");
        }
    }
    $sql -> closeCursor();
?>