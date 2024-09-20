<?php 
    include_once("servidor.php");

    $id = $_GET['jsID'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone -> conecta();
    $sql = $conexion -> prepare("DELETE FROM carrusel WHERE id = $id");

    if($sql -> execute())
    {
        $res = "Ok";
    }
    else
    {
        $res = "Error";
    }

    $sql -> closeCursor();

    echo json_encode($res);
?>