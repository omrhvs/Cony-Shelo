<?php 
    include_once("servidor.php");

    $id = $_REQUEST['idJS'];
    $nombre = $_REQUEST['nombreJS'];
    $descripcion = $_REQUEST['descripcionJS'];
    $cantidad = $_REQUEST['cantidadJS'];
    $precio = $_REQUEST['precioJS'];
    $estado = $_REQUEST['estadoJS'];
    $foto = $_REQUEST['fotoJS'];
    $alterno = $_REQUEST['alternoJS'];

    $cone = new servidor("root", "shelo-cony", "");
    $conexion = $cone -> conecta();

    $res = "";

    if(empty($id))
    {
        $sql = $conexion -> prepare("INSERT INTO catalogo (id, nombre, descripcion, cantidad, precio, estado, foto, alterno) VALUES (:a, :b, :c, :d, :e, :f, :g, :h)");
    }
    else
    {
        $sql = $conexion->prepare("UPDATE catalogo SET nombre = :b, descripcion = :c, cantidad = :d, precio = :e, estado = :f, foto = :g, alterno = :h WHERE id = :a");
        $sql->bindParam(':a', $id);
    }

    $sql -> bindParam(":a", $id);
    $sql -> bindParam(":b", $nombre);
    $sql -> bindParam(":c", $descripcion);
    $sql -> bindParam(":d", $cantidad);
    $sql -> bindParam(":e", $precio);
    $sql -> bindParam(":f", $estado);
    $sql -> bindParam(":g", $foto);
    $sql -> bindParam(":h", $alterno);
    
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