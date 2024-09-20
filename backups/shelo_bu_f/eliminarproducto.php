<?php 
    include_once("servidor.php");

    $id = $_GET['jsID'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone -> conecta();
    $sql = $conexion -> prepare("DELETE FROM catalogo WHERE id = $id");

    if($sql -> execute())
    {
        $res = "okay";
    }
    else
    {
        $res = "error";
    }

    $sql -> closeCursor();

    echo json_encode($res);
?>