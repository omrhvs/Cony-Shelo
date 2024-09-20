<?php
    include_once("servidor.php");

    $id = $_REQUEST['id'];
    $nuevoStock = $_REQUEST['nuevoStock'];

    $estado = ($nuevoStock == 0) ? "Agotado" : "Disponible";

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone->conecta();

    $sql = $conexion->prepare("UPDATE catalogo SET cantidad = :nuevoStock, estado = :estado WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":nuevoStock", $nuevoStock);
    $sql->bindParam(":estado", $estado);

    if ($sql->execute())
    {
        echo json_encode("okay");
    }
    else
    {
        echo json_encode("error");
    }

    $sql->closeCursor();
?>
